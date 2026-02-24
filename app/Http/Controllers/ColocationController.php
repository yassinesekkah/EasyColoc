<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColocationRequest;
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

    public function store(StoreColocationRequest $request)
    {
        //check if user already has active colocation
        $hasActive = auth()->user();
    }
}
