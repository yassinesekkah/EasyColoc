<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColocationRequest;
use App\Models\colocation;
use App\Models\Colocation as ModelsColocation;
use App\Models\Expense;
use App\Models\ExpenseShare;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Http\Request;

class ColocationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $activeColocation = $user->colocations()
            ->wherePivotNull('left_at')
            ->first();

        $pastColocations = $user->colocations()
            ->wherePivotNotNull('left_at')
            ->get();

        $expenses = collect();

        if ($activeColocation) {

            //njibo members
            $members = $activeColocation->users()
                ->wherePivotNull('left_at')
                ->get();

            foreach ($members as $member) {

                $totalPaid = Expense::where('colocation_id', $activeColocation->id)
                    ->where('user_id', $member->id)
                    ->sum('amount');

                $totalShare = ExpenseShare::where('user_id', $member->id)
                    ->whereHas('expense', function ($q) use ($activeColocation) {
                        $q->where('colocation_id', $activeColocation->id);
                    })
                    ->sum('share_amount');

                $member->balance = $totalPaid - $totalShare;

                $expenses = Expense::with(['payer', 'category'])
                    ->where('colocation_id', $activeColocation->id)
                    ->latest()
                    ->get();
            }

            

            $activeColocation->members = $members;
        }

        return view('colocations.index', compact(
            'activeColocation',
            'pastColocations',
            'expenses'
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

    public function leave(Colocation $colocation)
    {
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

        $user->colocations()->updateExistingPivot($colocation->id, [
            'left_at' => now()
        ]);

        return redirect()->route('colocations.index')
            ->with('success', 'You have left the colocation.');
    }
}
