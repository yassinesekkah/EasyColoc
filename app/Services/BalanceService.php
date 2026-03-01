<?php

namespace App\Services;

use App\Models\Expense;
use App\Models\ExpenseShare;
use App\Models\Payment;

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
}
