<?php

namespace App\Services;

use App\Contracts\ReputationStrategy;
use App\Models\User;

class PositiveReputation implements ReputationStrategy
{
    public function apply(User $user): void
    {
        $user->increment('reputation');
    }
}