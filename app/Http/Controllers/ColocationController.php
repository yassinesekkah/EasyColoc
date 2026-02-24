<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColocationRequest;
use Illuminate\Http\Request;

class ColocationController extends Controller
{
    public function store(StoreColocationRequest $request)
    {
        //check if user already has active colocation
        $hasActive = auth()->user()
    }
}
