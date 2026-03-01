<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'colocation_id' => 'required|exists:colocations,id',
            'from_user_id' => 'required|exists:users,id',
            'to_user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        Payment::create([
            ...$validated,
            'paid_at' => now(),
        ]);

        return redirect()->route('colocations.index')
                    ->with('success', 'Payment recorded successfully.');
    }
}
