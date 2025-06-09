<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'category';

    // Define relationship to subcategories
    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function brands()
    {
        return $this->belongsToMany(\App\Models\Brands::class, 'brand_category', 'category_id', 'brand_id');
    }
}
