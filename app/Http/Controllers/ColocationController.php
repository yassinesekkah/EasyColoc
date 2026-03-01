<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColocationRequest;
use App\Models\colocation;
use App\Models\Colocation as ModelsColocation;
use App\Models\Expense;
use App\Models\ExpenseShare;
use App\Models\Payment;
use App\Services\BalanceService;
use App\Services\ReputationService;
use App\Services\SettlementService;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Http\Request;

class ColocationController extends Controller
{
    public function index(SettlementService $settlementService, BalanceService $balanceService)
    {
        $user = auth()->user();

        $activeColocation = $user->colocations()
            ->wherePivotNull('left_at')
            ->first();

        $pastColocations = $user->colocations()
            ->wherePivotNotNull('left_at')
            ->get();

        $expenses = collect();
        $settlements = collect();
        $currentBalance = 0;
        $totalPaid = 0;
        $totalOwed = 0;

        if ($activeColocation) {

            //njibo members
            $members = $activeColocation->users()
                ->wherePivotNull('left_at')
                ->get();

            ///calculate members balance
            $members = $balanceService->calculateBalances($activeColocation, $members);

            ///calcule dyal settlemets 
            $settlements = $settlementService->calculate($members);

            $expenses = Expense::with(['payer', 'category'])
                ->where('colocation_id', $activeColocation->id)
                ->latest()
                ->take(5)
                ->get();

            $activeColocation->members = $members;

            $summary = $balanceService
                ->getUserFinancialSummary($activeColocation, $user);

            $currentBalance = $summary['balance'];
            $totalPaid = $summary['totalPaid'];
            $totalOwed = $summary['totalShare'];
        }


        return view('colocations.index', compact(
            'activeColocation',
            'pastColocations',
            'expenses',
            'settlements',
            'currentBalance',
            'totalPaid',
            'totalOwed'
        ));
    }


    public function create()
    {
        return view('colocations.create');
    }

    public function store(StoreColocationRequest $request)
    {
        //check if user already has active colocation
        $user = auth()->user();
        $hasActive = $user->colocations()
            ->wherePivotNull('left_at')
            ->exists();

        if ($hasActive) {
            return redirect()
                ->route('colocations.index')
                ->withErrors([
                    'name' => 'You already belong to an active colocation.'
                ]);
        }

        //Create a new Colocation
        $colocation = Colocation::create([
            'name' => $request->name,
            'status' => 'active',
        ]);

        //attach user as owner 
        $colocation->users()->attach($user->id, [
            'role' => 'owner',
        ]);


        return redirect()->route('colocations.index')
            ->with('success', 'Colocation created successfully');
    }

    public function leave(
        Colocation $colocation,
        ReputationService $reputationService,
        BalanceService $balanceService
    ) {
        $user = auth()->user();

        $membership = $user->colocations()
            ->where('colocation_id', $colocation->id)
            ->wherePivotNull('left_at')
            ->first();


        if (!$membership) {
            abort(404);
        }

        /// nman3o owner mn leave colocation
        if ($membership->pivot->role === 'owner') {
            ///khaliha haka daba hta nraj3o nkamloha mnin n9ado l calcul
            return redirect()->back()
                ->with('error', 'Owner cannot leave the colocation.');
        };

        //nhasbo balance
        $balance = $balanceService->calculateSingle($colocation, $user);

        $hasDebt = $balance < 0;

        if ($hasDebt) {
            $debtAmount = abs($balance);

            $balanceService->transferDebtToOwner($colocation, $user, $debtAmount);
        }

        // reputation
        $reputationService->handle($user, $hasDebt);

        $user->colocations()->updateExistingPivot($colocation->id, [
            'left_at' => now()
        ]);

        return redirect()->route('colocations.index')
            ->with('success', 'You have left the colocation.');
    }
}
