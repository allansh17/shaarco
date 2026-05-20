<?php

namespace App\Helpers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartHelper
{
    public static function getTotalItems()
    {
        if (Auth::guard('local')->check()) {
            $userId = Auth::guard('local')->id();

            return (int) Cart::where('user_id', $userId)->sum('qty');
        }

        $cart = json_decode(Cookie::get('cart', '[]'), true);
        if (!is_array($cart)) {
            return 0;
        }

        $totalItems = 0;
        foreach ($cart as $item) {
            $totalItems += (int) ($item['quantity'] ?? 0);
        }

        return $totalItems;
    }
}
