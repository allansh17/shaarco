<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product_small_image extends Model
{
    use HasFactory , SoftDeletes;
    protected $table = 'product_small_images';
}
