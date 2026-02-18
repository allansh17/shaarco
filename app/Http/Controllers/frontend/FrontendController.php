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

    // Check if the product is out of stock
    if (!$product || $product->stock_status == 0) {
        return redirect()->back()->with('error', 'This product is out of stock and cannot be added to the cart.');
    }

    // Get the current cart from the cookie
    $cart = json_decode(Cookie::get('cart', '[]'), true);

    // Check if the product already exists in the cart
    $found = false;
    foreach ($cart as &$item) {
        if ($item['product_id'] == $productId) {
            // If the product is already in the cart, update the quantity
            $item['quantity'] += $request->qty;
            $item['price'] = $item['price_per_unit'] * $item['quantity'];
            $found = true;
            break;
        }
    }

    // If the product is not found, add a new product to the cart
    if (!$found) {
        $loyal_price = $product->loyal_price;
        $wholesaler_price = $product->wholesaler_price;
        $normal_price = $product->normal_price;

        if (Auth::guard('local')->check()) {
            $user = Auth::guard('local')->user();
            if ($user->user_type == "loyal") {
                $price = $loyal_price;
            } elseif ($user->user_type == "wholesaler") {
                $price = $wholesaler_price;
            } else {
                $price = $normal_price;
            }
        } else {
            $price = $product->price;
        }

        $total_price = $price * $request->qty;

        $cart[] = [
            'product_id' => $productId,
            'price' => $total_price,
            'price_per_unit' => $price,
            'quantity' => $request->qty,
            'name' => $product->name,
            'loyal_price' => $loyal_price,
            'wholesaler_price' => $wholesaler_price,
        ];
    }

    Cookie::queue('cart', json_encode($cart), (60 * 24 * 7));

    $userId = Auth::guard('local')->check() ? Auth::guard('local')->id() : null;
    foreach ($cart as $item) {
        $existingCartItem = Cart::where('user_id', $userId)->where('product_id', $item['product_id'])->first();

        if ($existingCartItem) {
            $existingCartItem->qty = $item['quantity'];
            $existingCartItem->total_price = $existingCartItem->price * $existingCartItem->qty;
            $existingCartItem->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $item['product_id'],
                'qty' => $item['quantity'],
                'price' => $item['price_per_unit'],
                'total_price' => $item['price'],
            ]);
        }
    }

    return redirect()->route('cart-page')->with('message', 'Product added to cart successfully!');
}






    public function remove_tocart(Request $request)
    {
        // dd($request->all());
        // Retrieve cart from the cookie
        $cart = json_decode($request->cookie('cart'), true);
        // dd($cart);
        // Check if the cart exists and the item ID is provided
        if ($cart && $request->has('item_id')) {
            $itemId = $request->input('item_id');

            // Remove the item using the correct key
            $cart = array_filter($cart, function ($item) use ($itemId) {
                return $item['product_id'] != $itemId; // Use 'product_id' or the correct key
            });

            // Save the updated cart back to the cookie
            Cookie::queue('cart', json_encode(array_values($cart)), 60); // Save for 60 minutes
            return redirect()->back()->with('success', 'Item removed from cart!');
        }

        return redirect()->back()->with('error', 'Item not found in cart!');
    }


    public function add_cartpage()
    {
        $totalSubTotal = 0;
        // $shippingCost = 0;
        // $tax = 0;
        $totalItems = 0;
        $cart = [];

        // Only process cart if user is authenticated
        // Guests shouldn't have items in cart
        if (Auth::guard('local')->check()) {
            $cart = json_decode(Cookie::get('cart', '[]'), true);

            foreach ($cart as $item) {
                $totalSubTotal += $item['price'];
                $totalItems += $item['quantity'];
            }
        }

        // $tax = $totalSubTotal * 0.05;
        $shippingCost = 0; // Update based on your shipping logic
        // $totalAmount = $totalSubTotal + $shippingCost + $tax;
        $totalAmount = $totalSubTotal;

        $userId = auth()->id();
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();
        $categorys = Category::all();
                $brands = Brands::all();


        return view('stc_products.cart-page', compact('cartItems', 'categorys', 'totalSubTotal', 'shippingCost', 'totalAmount', 'totalItems','brands'));
    }

    public function getCartData(Request $request)
    {
        $userId = $request->input('user_id');
        
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
    // dd($request->all());
    // Validate the incoming request
    $request->validate([
        'message' => 'required|string|max:1000', // Validate message
        'product_id' => 'required|array',        // Validate product IDs (array of IDs)
        'qty' => 'required|array',               // Validate quantities (array of quantities)
    ]);

    // Fetch the authenticated user
    $userId = Auth::guard('local')->id();  // Get the authenticated user's ID

    // Get product IDs and quantities from the request
    $productIds = $request->input('product_id');  // Array of product IDs
    $quantities = $request->input('qty');          // Array of quantities

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
    
    // Filter out any products that aren't in the current cookie cart
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
    // Optionally, delete the cart data (if needed, assuming the data is no longer needed in the cart table)
    Cart::where('user_id', $userId)->delete();

    // Clear the cart cookie after saving the inquiry
    Cookie::queue('cart', json_encode([]), 0);  // Clear the cart cookie by setting it to an empty array and expiration time to 0
    // Return success response with redirect URL
    return response()->json([
        'success' => 'Inquiry saved successfully!',
        'redirect' => url('/')  // Redirect to the desired route
    ]);
}


public function updateQuantity(Request $request)
{
    $request->validate([
        'user_id' => 'required|integer',
        'product_id' => 'required|integer',
        'quantity' => 'required|integer|min:1|max:10',
    ]);
    $cart = json_decode(Cookie::get('cart', '[]'), true);
    
    // Find product in cart and update its quantity
    foreach ($cart as &$item) {
        if ($item['product_id'] == $request->product_id) {
            $item['quantity'] = $request->quantity;
            $item['price'] = ($request->quantity * $item['price_per_unit']);
            break;
        }
    }

    Cookie::queue('cart', json_encode(array_values($cart)), 60);
    if (Auth::guard('local')->check() && Auth::guard('local')->id() == $request->user_id) {
        // Update only the logged-in user's product
        $cartItem = Cart::where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->qty = $request->quantity;
            $cartItem->total_price = ($request->quantity * $cartItem->price);
            $cartItem->save();
            return response()->json(['message' => 'Quantity updated successfully']);
        }

        return response()->json(['message' => 'Item not found'], 404);
    }

    return response()->json(['message' => 'Unauthorized'], 403);
}











}