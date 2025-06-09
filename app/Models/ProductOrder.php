<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductOrder extends Model
{
    use HasFactory;
    protected $table = 'product_orders';

     // ProductOrder.php
     public function productIntroImage()
     {
         return $this->hasOne(Product::class, 'product_id', 'id');
     }
     // In ProductOrder model
public function products()
{
    return $this->belongsTo(Product::class, 'product_id', 'id');
}
   
}
