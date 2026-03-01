<?php

namespace App\Services;

use App\Contracts\ReputationStrategy;
use App\Models\User;

class NegativeReputation implements ReputationStrategy
{
    public function apply(User $user): void
    {
        $user->decrement('reputation');
    }
}