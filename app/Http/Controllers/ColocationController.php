<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColocationRequest;
use App\Models\colocation;
use App\Models\Colocation as ModelsColocation;
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

        return view('colocations.index', compact(
            'activeColocation',
            'pastColocations'
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
}
