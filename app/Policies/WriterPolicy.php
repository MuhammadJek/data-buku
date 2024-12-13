<?php

namespace App\Policies;

use App\Models\Buku;
use App\Models\User;

class WriterPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function writer(User $user, User $users)
    {
        return $user->role == 'writer';
    }
}
