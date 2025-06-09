<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Product extends Model
{
    use HasApiTokens,HasFactory, SoftDeletes,AuthenticableTrait;
    protected $table = 'products';
     public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    // In the Product model
    public function category() 
    {
        // You can specify the foreign key explicitly if it's not the default (category_id)
        return $this->belongsTo(Category::class, 'category_id','id'); 
    }

    public function subcategory() 
    {
        // You can specify the foreign key explicitly if it's not the default (subcategory_id)
        return $this->belongsTo(SubCategory::class, 'subcategory_id','id');
    }
    public function brands() 
    {
        // You can specify the foreign key explicitly if it's not the default (subcategory_id)
        return $this->belongsTo(Brands::class, 'brands','id');
    }

}
