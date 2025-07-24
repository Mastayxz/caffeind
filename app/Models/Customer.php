<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'description',
        'stock',
        'category_id',
        'image',
        'created_at',
        'updated_at',
    ];
}
