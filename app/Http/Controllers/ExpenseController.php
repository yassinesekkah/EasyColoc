<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Expense;
use App\Models\ExpenseShare;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function store(Request $request, $colocationId)
    {
        $user = auth()->user();

        $colocation = Colocation::findOrFail($colocationId);

        //check wach user active fel colocation
        $isActive = $colocation->users()
                ->where('users.id', $user->id)
                ->wherePivotNull('left_at')
                ->exists();

        if(!$isActive){
            abort(403);
        }

        ///validate inputs
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'amount' => 'required|numeric|min:0.01',
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
        ]);

        ///check wach category dyal had l colocation
        $category = $colocation->categories()
            ->where('categories.id', $validated['category_id'])
            ->first();

        if(!$category){
            abort(403);
        }

        ///creation expense
        $expense = Expense::create([
            'colocation_id' => $colocation->id,
            'user_id' => $user->id,
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'amount' => $validated['amount'],
            'date' => $validated['date'],
        ]);

        ///njibo active members
        $activeMembers = $colocation->users()
                ->wherePivotNull('left_at')
                ->get();
        
        ///n7asbohom
        $count = $activeMembers->count();

        //n9asmo amount 3la active members
        $share = round($validated['amount'] / $count, 2);

        /// n insirtiw kol member chhal khaso ykhales
        foreach($activeMembers as $member){
            ExpenseShare::create([
                'expense_id' => $expense->id,
                'user_id' => $member->id,
                'share_amount' => $share,
            ]);
        }

        return redirect()
            ->route('colocations.index')
            ->with('success', 'Expense added successfully.');
        
    }
}
