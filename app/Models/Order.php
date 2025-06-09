<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    // Order.php
    public function productOrders()
    {
        return $this->hasMany(ProductOrder::class, 'order_id', 'id');
    }


}
