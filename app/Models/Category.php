<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'uuid',
        'name',
    ];


    public function buku()
    {
        return $this->hasMany(Buku::class, 'category_id');
    }
}
