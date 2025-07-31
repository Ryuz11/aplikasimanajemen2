<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PurchaseRequest;

class PurchaseRequestPolicy
{
    public function approve(User $user, PurchaseRequest $pr)
    {
        return $user->hasRole('purchase');
    }

    public function reject(User $user, PurchaseRequest $pr)
    {
        return $user->hasRole('purchase');
    }

    public function create(User $user)
    {
        return $user->hasRole('warehouse');
    }
}
