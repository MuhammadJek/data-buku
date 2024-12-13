<?php

namespace App\Policies;

use App\Models\Buku;
use App\Models\Category;
use App\Models\User;

class PenulisPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function admin(User $user, Buku $buku)
    {
        return $user->role == 'admin';
    }
}
