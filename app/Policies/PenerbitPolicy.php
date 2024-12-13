<?php

namespace App\Policies;

use App\Models\Penerbit;
use App\Models\User;

class PenerbitPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function admin(User $user, Penerbit $penerbit)
    {
        return $user->role == 'admin';
    }
}
