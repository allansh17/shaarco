<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'category';

    protected $fillable = ['name', 'slug', 'image', 'status'];

    // Define relationship to subcategories
    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    // Define many-to-many relationship with brands
    public function brands()
    {
        return $this->belongsToMany(Brands::class, 'category_brand', 'category_id', 'brand_id');
    }
}
