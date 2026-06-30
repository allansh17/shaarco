<?php
namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\CartHelper;
use App\Models\MasterPage;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Product;
// use App\Services\CartService;

use App\Models\Customer;
use App\Models\Category;
use App\Models\Brands;


use Illuminate\Http\Request;
use App\Services\SimpleCaptchaService;
use PhpParser\Node\Expr\Cast\Object_;
use Auth;
use Illuminate\Support\Facades\Hash;
// use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;


class FrontendController extends Controller
{


    // public function add_tocart(Request $request, $productId)
    // {
    //     // Get the current cart from the cookie
    //     $cart = json_decode(Cookie::get('cart', '[]'), true);

    //     // Check if the product already exists in the cart
    //     $found = false;
    //     foreach ($cart as &$item) {
    //         if ($item['product_id'] == $productId) {
    //             // If the product is already in the cart, update the quantity
    //             $item['quantity'] += $request->qty;
    //             // Recalculate the total price based on updated quantity
    //             $item['price'] = $item['price_per_unit'] * $item['quantity']; // Update total price
    //             $found = true;
    //             break;
    //         }
    //     }
      

    //     // If the product is not found, add a new product to the cart
    //     if (!$found) {
    //         $product = Product::find($productId);

    //         $loyal_price = $product->loyal_price;
    //         $wholesaler_price = $product->wholesaler_price;
    //         $normal_price = $product->normal_price;
    //         // Set price based on user type
    //         if (Auth::guard('local')->check()) {
    //             $user = Auth::guard('local')->user();
    //             if ($user->user_type == "loyal") {
    //                 $price = $loyal_price;
    //             } elseif ($user->user_type == "wholesaler") {
    //                 $price = $wholesaler_price;
    //             } elseif ($user->user_type == "normal") {
    //                 $price = $normal_price;
    //             } else {
    //                 $price = $product->price; // Default price for normal users
    //             }
    //         } else {
    //             $price = $product->price; // Default price if no user is logged in
    //         }

    //         // Calculate the total price based on quantity
    //         $total_price = $price * $request->qty;

    //         $cart[] = [
    //             'product_id' => $productId,
    //             'price' => $total_price,
    //             'price_per_unit' => $price, // Store the price per unit for quantity-based recalculation
    //             'quantity' => $request->qty,
    //             'name' => $product->name,
    //             'loyal_price' => $loyal_price,
    //             'wholesaler_price' => $wholesaler_price,
    //         ];
    //     }

    //     // Store the updated cart back in the cookie (valid for 7 days)
    //     Cookie::queue('cart', json_encode($cart), (60 * 24 * 7));

    //     return redirect()->route('cart-page')->with(['message' => 'Product added to cart successfully!']);
    // }

    public function add_tocart(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (!$product || $product->stock_status == 0) {
            return redirect()->back()->with('error', 'This product is out of stock and cannot be added to the cart.');
        }

        $qty = (int) $request->qty;
        $price = $this->resolveProductPrice($product);

        if (Auth::guard('local')->check()) {
            $userId = Auth::guard('local')->id();
            $existingCartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

            if ($existingCartItem) {
                $existingCartItem->qty += $qty;
                $existingCartItem->total_price = $existingCartItem->price * $existingCartItem->qty;
                $existingCartItem->save();
            } else {
                Cart::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'qty' => $qty,
                    'price' => $price,
                    'total_price' => $price * $qty,
                ]);
            }

            return redirect()->route('cart-page')->with('message', 'Product added to cart successfully!');
        }

        $cart = json_decode(Cookie::get('cart', '[]'), true);
        if (!is_array($cart)) {
            $cart = [];
        }

        $found = false;
        foreach ($cart as &$item) {
            if ($item['product_id'] == $productId) {
                $item['quantity'] += $qty;
                $item['price'] = $item['price_per_unit'] * $item['quantity'];
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = [
                'product_id' => $productId,
                'price' => $price * $qty,
                'price_per_unit' => $price,
                'quantity' => $qty,
            ];
        }

        Cookie::queue('cart', json_encode($cart), (60 * 24 * 7));

        return redirect()->route('cart-page')->with('message', 'Product added to cart successfully!');
    }






    public function remove_tocart(Request $request)
    {
        if (!$request->has('item_id')) {
            return redirect()->back()->with('error', 'Item not found in cart!');
        }

        $itemId = $request->input('item_id');

        if (Auth::guard('local')->check()) {
            $userId = Auth::guard('local')->id();
            $deleted = Cart::where('user_id', $userId)->where('product_id', $itemId)->delete();

            if ($deleted) {
                return redirect()->back()->with('success', 'Item removed from cart!');
            }

            return redirect()->back()->with('error', 'Item not found in cart!');
        }

        $cart = json_decode($request->cookie('cart'), true);
        if ($cart) {
            $cart = array_filter($cart, function ($item) use ($itemId) {
                return $item['product_id'] != $itemId;
            });

            Cookie::queue('cart', json_encode(array_values($cart)), 60);

            return redirect()->back()->with('success', 'Item removed from cart!');
        }

        return redirect()->back()->with('error', 'Item not found in cart!');
    }


    public function add_cartpage()
    {
        $totalSubTotal = 0;
        $totalItems = 0;
        $cart = [];
        $cartItems = collect();

        if (Auth::guard('local')->check()) {
            $userId = Auth::guard('local')->id();
            $this->mergeCookieCartIntoDatabase($userId);

            $cartItems = Cart::with('product')->where('user_id', $userId)->get();

            foreach ($cartItems as $item) {
                $product = $item->product;
                if (!$product || $product->trashed()) {
                    continue;
                }

                $cart[] = [
                    'product_id' => $item->product_id,
                    'name' => $product->name ?? '',
                    'product_image' => $product->product_image ?? '',
                    'price' => (float) $item->total_price,
                    'quantity' => (int) $item->qty,
                    'price_per_unit' => (float) $item->price,
                ];
                $totalSubTotal += $item->total_price;
                $totalItems += $item->qty;
            }
        } else {
            $cart = $this->buildGuestCartArray();
            foreach ($cart as $item) {
                $totalSubTotal += $item['price'];
                $totalItems += $item['quantity'];
            }
        }

        $shippingCost = 0;
        $totalAmount = $totalSubTotal;
        $categorys = Category::all();
        $brands = Brands::all();

        return view('stc_products.cart-page', compact('cart', 'cartItems', 'categorys', 'totalSubTotal', 'shippingCost', 'totalAmount', 'totalItems', 'brands'));
    }

    public function getCartCount()
    {
        return response()->json(['count' => CartHelper::getTotalItems()]);
    }

    public function getCartData(Request $request)
    {
        $userId = $request->input('user_id');

        if (Auth::guard('local')->check()) {
            $userId = Auth::guard('local')->id();
        }

        // For logged-in users, use database Cart table (no size limit)
        // For guests, use cookie cart
        if ($userId) {
            $cartItems = Cart::where('user_id', $userId)->get();
            
            $cartData = [];
            foreach ($cartItems as $item) {
                // Skip if product doesn't exist or is soft-deleted
                $product = Product::find($item->product_id);
                if (!$product || $product->trashed()) {
                    // Skip invalid/deleted products
                    continue;
                }
                
                $cartData[] = [
                    'product_id' => $item->product_id,
                    'qty' => $item->qty,
                    'price' => $item->price ?? 0,
                    'total_price' => $item->total_price ?? 0,
                    'user_id' => $userId
                ];
            }
            
            // Using database cart for logged-in user (no size limit)
        } else {
            // Guest user - use cookie cart
            $cartCookie = Cookie::get('cart', '[]');
            $cart = json_decode($cartCookie, true);
            
            // Ensure cart is an array
            if (!is_array($cart)) {
                $cart = [];
            }
            
            // Using cookie cart for guest user
            
            // Convert cookie cart format to match database Cart format
            $cartData = [];
            foreach ($cart as $item) {
                // Validate item structure
                if (!isset($item['product_id']) || !isset($item['quantity'])) {
                    // Skip invalid item structure
                    continue;
                }
                
                // Skip if product doesn't exist or is soft-deleted
                $product = Product::find($item['product_id']);
                if (!$product || $product->trashed()) {
                    // Skip invalid/deleted products
                    continue;
                }
                
                $cartData[] = [
                    'product_id' => $item['product_id'],
                    'qty' => $item['quantity'],
                    'price' => $item['price_per_unit'] ?? 0,
                    'total_price' => $item['price'] ?? 0,
                    'user_id' => $userId
                ];
            }
        }
        
        // Return cart data

        return response()->json($cartData);
    }

    // public function saveInquiry(Request $request)
    // {
    //     try {
    //         // Validate the form input
    //         $validatedData = $request->validate([
    //             'product_id' => 'required|integer',
    //             'qty' => 'required|integer',
    //             'message' => 'nullable|string',
    //         ]);

    //         // Save to the `checkouts` table
    //         \DB::table('checkouts')->insert([
    //             'user_id' => auth()->id(), // Assuming the user is authenticated
    //             'product_id' => $validatedData['product_id'],
    //             'qty' => $validatedData['qty'],
    //             'message' => $validatedData['message'],
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);

    //         // Delete data from the cart table for this user
    //         \DB::table('cart')->where('user_id', auth()->id())->delete();

    //         // Redirect the user to a specific page
    //         return response()->json(['redirect' => route('enquire_now')]);
    //     } catch (\Exception $e) {
    //         // Handle errors
    //         return response()->json(['error' => 'An error occurred while processing your request.'], 500);
    //     }
    // }

    public function saveInquiry(Request $request)
{
    $userId = Auth::guard('local')->id();

    $rules = [
        'product_id' => 'required|array',
        'qty' => 'required|array',
    ];

    if ($userId) {
        $rules['message'] = 'required|string|max:1000';
    } else {
        $rules['guest_first_name'] = 'required|string|max:100';
        $rules['guest_last_name'] = 'required|string|max:100';
        $rules['guest_phone'] = 'required|string|max:30';
        $rules['guest_location'] = 'required|string|max:500';
        $rules['guest_email'] = 'nullable|email|max:255';
        $rules['message'] = 'nullable|string|max:1000';
        $rules['captcha'] = 'required|string|max:10';
    }

    $messages = [
        'captcha.required' => 'يرجى إدخال رمز التحقق.',
    ];

    $request->validate($rules, $messages);

    if (!$userId) {
        $captcha = app(SimpleCaptchaService::class);
        if (!$captcha->verify($request->input('captcha'))) {
            return response()->json(['error' => 'رمز التحقق غير صحيح. يرجى المحاولة مرة أخرى.'], 422);
        }
    }

    // Get product IDs and quantities from the request
    $productIds = $request->input('product_id');
    $quantities = $request->input('qty');

    // Get current cart (source of truth - what user actually sees)
    // For logged-in users, use database Cart table (no size limit)
    // For guests, use cookie cart
    if ($userId) {
        $cartItems = Cart::where('user_id', $userId)->get();
        $validProductIds = $cartItems->pluck('product_id')->toArray();
        // Using database cart for logged-in user
    } else {
        $cookieCart = json_decode(Cookie::get('cart', '[]'), true);
        if (!is_array($cookieCart)) {
            $cookieCart = [];
        }
        $validProductIds = array_column($cookieCart, 'product_id');
        // Using cookie cart for guest
    }
    
    // Validate products against cart
    
    // Filter out any products that aren't in the current cart
    $filteredProductIds = [];
    $filteredQuantities = [];
    foreach ($productIds as $index => $productId) {
        // Only allow products that are in the cookie cart
        if (in_array($productId, $validProductIds)) {
            // Also verify product exists and is not soft-deleted
            $product = Product::find($productId);
            if ($product && !$product->trashed()) {
                $filteredProductIds[] = $productId;
                $filteredQuantities[] = $quantities[$index];
            } else {
                // Skip invalid/deleted products
            }
        } else {
            // Skip products not in cart
        }
    }
    
    // Use filtered arrays - only products from cookie cart
    $productIds = $filteredProductIds;
    $quantities = $filteredQuantities;
    
    // Use filtered products only
    
    // If no valid products, return error
    if (empty($productIds)) {
        return response()->json(['error' => 'No valid products in cart.'], 400);
    }

    // Create a new Checkout entry
    $checkout = new Checkout();
    $checkout->user_id = $userId;
    $checkout->message = $request->message;

    if (!$userId) {
        $checkout->guest_first_name = $request->guest_first_name;
        $checkout->guest_last_name = $request->guest_last_name;
        $checkout->guest_phone = $request->guest_phone;
        $checkout->guest_email = $request->guest_email;
        $checkout->guest_location = $request->guest_location;
    }

    // Save product IDs and quantities as comma-separated values
    $checkout->product_id = implode(',', $productIds); // Storing product IDs as comma-separated values
    $checkout->qty = implode(',', $quantities);  // Storing quantities as comma-separated values

    // Save the checkout entry
    $checkout->save();
    
    // Insert products into product_orders
    foreach ($productIds as $index => $productId) {
        DB::table('product_orders')->insert([
            'product_id' => $productId,
            'checkout_id' => $checkout->id,
            'qty' => $quantities[$index],
        ]);
    }
    
    // TEMPORARY FIX: Remove any products that weren't in our filtered list
    $validProductIdsInt = array_map('intval', $productIds);
    $invalidProducts = DB::table('product_orders')
        ->where('checkout_id', $checkout->id)
        ->whereNotIn('product_id', $validProductIdsInt)
        ->pluck('product_id')
        ->toArray();
    
    if (!empty($invalidProducts)) {
        \Log::warning('saveInquiry - Removing invalid products that were auto-added:', ['invalid_product_ids' => $invalidProducts, 'checkout_id' => $checkout->id]);
        DB::table('product_orders')
            ->where('checkout_id', $checkout->id)
            ->whereNotIn('product_id', $validProductIdsInt)
            ->delete();
    }
    if ($userId) {
        Cart::where('user_id', $userId)->delete();
    }

    // Clear the cart cookie after saving the inquiry
    Cookie::queue('cart', json_encode([]), 0);

    $successMessage = $userId
        ? 'تم إرسال طلبك بنجاح! سنتواصل معك في أقرب وقت.'
        : 'تم استلام طلبك بنجاح! سنتواصل معك في أقرب وقت.';

    session()->flash('order_placed', $successMessage);

    return response()->json([
        'success' => $successMessage,
        'redirect' => route('index'),
    ]);
}


public function updateQuantity(Request $request)
{
    $request->validate([
        'user_id' => 'nullable|integer',
        'product_id' => 'required|integer',
        'quantity' => 'required|integer|min:1|max:10',
    ]);

    if (Auth::guard('local')->check()) {
        $userId = Auth::guard('local')->id();
        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->qty = $request->quantity;
            $cartItem->total_price = $request->quantity * $cartItem->price;
            $cartItem->save();

            return response()->json(['message' => 'Quantity updated successfully']);
        }

        return response()->json(['message' => 'Item not found'], 404);
    }

    $cart = json_decode(Cookie::get('cart', '[]'), true);
    if (!is_array($cart)) {
        $cart = [];
    }

    foreach ($cart as &$item) {
        if ($item['product_id'] == $request->product_id) {
            $product = Product::find($item['product_id']);
            $pricePerUnit = $product
                ? $this->resolveProductPrice($product)
                : (float) ($item['price_per_unit'] ?? 0);
            $item['price_per_unit'] = $pricePerUnit;
            $item['quantity'] = (int) $request->quantity;
            $item['price'] = $request->quantity * $pricePerUnit;
            break;
        }
    }

    Cookie::queue('cart', json_encode(array_values($cart)), 60 * 24 * 7);

    return response()->json(['message' => 'Quantity updated successfully']);
}

    protected function resolveProductPrice(Product $product): float
    {
        if (Auth::guard('local')->check()) {
            $user = Auth::guard('local')->user();
            if ($user->user_type == 'loyal') {
                return (float) $product->loyal_price;
            }
            if ($user->user_type == 'wholesaler') {
                return (float) $product->wholesaler_price;
            }

            return (float) $product->normal_price;
        }

        return (float) $product->normal_price;
    }

    protected function buildGuestCartArray(): array
    {
        $cart = [];
        $cookieCart = json_decode(Cookie::get('cart', '[]'), true);

        if (!is_array($cookieCart)) {
            return $cart;
        }

        foreach ($cookieCart as $item) {
            if (!isset($item['product_id'], $item['quantity'])) {
                continue;
            }

            $product = Product::find($item['product_id']);
            if (!$product || $product->trashed()) {
                continue;
            }

            $qty = (int) $item['quantity'];
            $pricePerUnit = $this->resolveProductPrice($product);
            $lineTotal = $pricePerUnit * $qty;

            $cart[] = [
                'product_id' => $item['product_id'],
                'name' => $product->name ?? '',
                'product_image' => $product->product_image ?? '',
                'price' => $lineTotal,
                'quantity' => $qty,
                'price_per_unit' => $pricePerUnit,
            ];
        }

        return $cart;
    }

    public function guestCaptchaImage(Request $request)
    {
        $captcha = app(SimpleCaptchaService::class);
        $code = $request->boolean('refresh')
            ? $captcha->generateCode()
            : $captcha->getOrCreateCode();

        return $captcha->imageResponse($code);
    }

    protected function mergeCookieCartIntoDatabase(int $userId): void
    {
        $cookieCart = json_decode(Cookie::get('cart', '[]'), true);
        if (!is_array($cookieCart) || empty($cookieCart)) {
            return;
        }

        foreach ($cookieCart as $item) {
            if (!isset($item['product_id'], $item['quantity'])) {
                continue;
            }

            $product = Product::find($item['product_id']);
            if (!$product || $product->trashed()) {
                continue;
            }

            $qty = (int) $item['quantity'];
            $pricePerUnit = isset($item['price_per_unit'])
                ? (float) $item['price_per_unit']
                : $this->resolveProductPrice($product);

            $existingCartItem = Cart::where('user_id', $userId)
                ->where('product_id', $item['product_id'])
                ->first();

            if ($existingCartItem) {
                $existingCartItem->qty = max($existingCartItem->qty, $qty);
                $existingCartItem->total_price = $existingCartItem->price * $existingCartItem->qty;
                $existingCartItem->save();
            } else {
                Cart::create([
                    'user_id' => $userId,
                    'product_id' => $item['product_id'],
                    'qty' => $qty,
                    'price' => $pricePerUnit,
                    'total_price' => $pricePerUnit * $qty,
                ]);
            }
        }

        Cookie::queue('cart', json_encode([]), 0);
    }











}