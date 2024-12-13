<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = [
        'uuid',
        'title',
        'description',
        'image',
        'price',
        'author',
        'penerbit_id',
        'category_id',
        'jumlah',   
    ];


    public function users()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
    public function penerbits()
    {
        return $this->belongsTo(Penerbit::class, 'penerbit_id', 'id');
    }
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
