<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Cookie; 
class CartHelper
{
    public static function getTotalItems()
    {
        $cart = json_decode(Cookie::get('cart', '[]'), true);
        $totalItems = 0;

        foreach ($cart as $item) {
            $totalItems += $item['quantity'];  // Add the quantity of each item to the total count
        }

        return $totalItems;
    }
}
