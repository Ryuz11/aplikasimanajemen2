<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Barang;

class BarangPolicy
{
    public function create(User $user)
    {
        return $user->hasRole('warehouse') || $user->hasRole('admin');
    }
    public function update(User $user, Barang $barang)
    {
        return $user->hasRole('warehouse') || $user->hasRole('admin');
    }
    public function delete(User $user, Barang $barang)
    {
        return $user->hasRole('warehouse') || $user->hasRole('admin');
    }
}
