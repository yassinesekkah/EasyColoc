<?php

use App\Http\Controllers\ColocationController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'banned'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/colocations', [ColocationController::class, 'index'])->name('colocations.index');
    Route::get('/colocations/create', [ColocationController::class, 'create'])->name('colocations.create');
    Route::post('/colocations', [ColocationController::class, 'store'])->name('colocations.store');

    //Owner send Invitation
    Route::post('/invitations', [InvitationController::class, 'store'])->name('invitations.store');
    ///user open Invitation
    Route::get('/invitations/accept/{token}', [InvitationController::class, 'showAccept'])->name('invitations.accept');
    ////User confirm Invitation
    Route::post('/invitations/accept/{token}', [InvitationController::class, 'accept'])->name('invitations.process');
});

require __DIR__ . '/auth.php';
