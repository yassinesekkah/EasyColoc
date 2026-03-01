<?php

namespace App\Services;

use App\Models\Colocation;
use App\Models\Expense;
use App\Models\ExpenseShare;
use App\Models\Payment;
use App\Models\User;

class BalanceService
{
    public function calculateBalances($colocation, $members)
    {
        foreach ($members as $member) {

            $totalPaid = Expense::where('colocation_id', $colocation->id)
                ->where('user_id', $member->id)
                ->sum('amount');

            $totalShare = ExpenseShare::where('user_id', $member->id)
                ->whereHas('expense', function ($q) use ($colocation) {
                    $q->where('colocation_id', $colocation->id);
                })
                ->sum('share_amount');

            $totalPaymentsSent = Payment::where('from_user_id', $member->id)
                ->where('colocation_id', $colocation->id)
                ->sum('amount');

            $totalPaymentsReceived = Payment::where('to_user_id', $member->id)
                ->where('colocation_id', $colocation->id)
                ->sum('amount');

            $member->balance =
                $totalPaid
                - $totalShare
                + $totalPaymentsSent
                - $totalPaymentsReceived;
        }

        return $members;
    }

    public function calculateSingle(Colocation $colocation, User $user): float
    {

        $totalPaid = Expense::where('colocation_id', $colocation->id)
            ->where('user_id', $user->id)
            ->sum('amount');


        $totalShare = ExpenseShare::where('user_id', $user->id)
            ->whereHas('expense', function ($q) use ($colocation) {
                $q->where('colocation_id', $colocation->id);
            })
            ->sum('share_amount');

        return round($totalPaid - $totalShare, 2);
    }

    public function transferDebtToOwner(Colocation $colocation, float $debtAmount): void
    {
        $owner = $colocation->users()
            ->wherePivot('role', 'owner')
            ->wherePivotNull('left_at')
            ->first();

        if (!$owner) {
            return;
        }

        Payment::create([
            'colocation_id' => $colocation->id,
            'from_user_id' => $owner->id,
            'to_user_id' => null,
            'amount' => $debtAmount,
            'paid_at' => now(),
        ]);
    }

    public function getUserFinancialSummary(Colocation $colocation, User $user): array
    {
        $totalPaid = Expense::where('colocation_id', $colocation->id)
            ->where('user_id', $user->id)
            ->sum('amount');

        $totalShare = ExpenseShare::where('user_id', $user->id)
            ->whereHas('expense', function ($q) use ($colocation) {
                $q->where('colocation_id', $colocation->id);
            })
            ->sum('share_amount');

        $totalPaymentsSent = Payment::where('colocation_id', $colocation->id)
            ->where('from_user_id', $user->id)
            ->sum('amount');

        $totalPaymentsReceived = Payment::where('colocation_id', $colocation->id)
            ->where('to_user_id', $user->id)
            ->sum('amount');

        $balance = round(
            $totalPaid
                - $totalShare
                + $totalPaymentsSent
                - $totalPaymentsReceived,
            2
        );

        return [
            'totalPaid' => $totalPaid,
            'totalShare' => $totalShare,
            'balance' => $balance,
        ];
    }
}
