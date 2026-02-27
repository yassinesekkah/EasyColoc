<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Colocation;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request, Colocation $colocation)
    {
        $user = auth()->user();
        
        ///check wach membership fel colocation
        $membership = $user->colocations()
                ->where('colocation_id', $colocation->id)
                ->wherePivotNull('left_at')
                ->first();
        
        
        if(!$membership){
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100'
        ]);

        Category::create([
            'colocation_id' => $colocation->id,
            'name' => $validated['name'],
        ]); 

        return back()->with('success', 'Category created successfully.');
    }
}
