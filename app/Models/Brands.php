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

    public function categories()
    {
        return $this->belongsToMany(\App\Models\Category::class, 'brand_category', 'brand_id', 'category_id');
    }
}
