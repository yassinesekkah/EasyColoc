<?php

namespace App\Services;

use App\Models\User;

class ReputationService
{
    public function handle(User $user, bool $hasDept)
    {
        $strategy = $hasDept
            ? new NegativeReputation()
            : new PositiveReputation();

        $strategy->apply($user);
    }
}