<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;
      protected $fillable = ['user_id', 'product_id', 'qty','price','total_price','session_id'];
    protected $table = 'cart';

     public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
