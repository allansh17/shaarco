<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brands extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'brands';

    // Define relationship to products
    public function products()
    {
        return $this->hasMany(Product::class, 'brands', 'id');
    }

    // Define many-to-many relationship with categories
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_brand', 'brand_id', 'category_id');
    }
}
