<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brands extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'brands';

    // Define relationship to subcategories
    public function products()
    {
        return $this->hasMany(Product::class, 'brands', 'id');  // Matching based on the brand name
    }
}
