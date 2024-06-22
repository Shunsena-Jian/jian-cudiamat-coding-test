<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'product_name',
        'product_desc',
        'product_price',
        'created_at',
        'updated_at'
    ];
}
