<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    protected $fillable = [
        'uuid',
        'name',
        'code_penerbits',
    ];


    public function buku()
    {
        return $this->hasMany(Buku::class, 'penerbit_id');
    }
}
