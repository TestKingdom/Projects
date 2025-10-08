<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    public $timestamps = false;
    use HasFactory;

     protected $fillable = [
        'product_name',
        'quantity',
        'price',
        'added_date',
        'product_image'
    ];

    protected $casts = [
        'added_date' => 'datetime',
    ];
}
