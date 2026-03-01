<?php

namespace App\Contracts;

use App\Models\User;

interface ReputationStrategy
{
    public function apply(User $user): void;
}