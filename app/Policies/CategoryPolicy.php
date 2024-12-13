<?php

namespace App\Policies;

use App\Models\Buku;
use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function admin(User $user, Category $buku)
    {
        return $user->role == 'admin';
    }
}
