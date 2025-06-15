<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'subcategory';
    
    protected $fillable = ['name', 'category_id', 'status'];
    
    // Define relationship to category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}