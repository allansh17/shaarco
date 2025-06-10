<?php

namespace App\Http\Controllers;
use App\Models\ad;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Brands;
use App\Models\Slider;
use App\Models\Enquiry;
use App\Models\Product;
use App\Models\Category;
use App\Mail\EnquiryMail;
use App\Models\MasterPage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ListingImages;



// use App\Models\Enquiry;
use Illuminate\Support\Facades\DB;


use App\Models\ProductOverviewImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\EnquiryController;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {

        if (Auth::guard('local')->user()) {
            $customerType = Auth::guard('local')->user()->user_type;
        } else {
            $customerType = "normal";
        }
        $sliders = Slider::where('customer_type', $customerType)->orWhere('customer_type', 'all')->get();
        $ads = ad::where('customer_type', $customerType)->orWhere('customer_type', 'all')->where('published_status',1)->get();

        $brands = Brands::all();
        // $products = Product::where('new_products', 'yes')
        // ->where('products.status','1')
        // ->orWhere('best_seller', 'yes')
        // ->orderBy('created_at', 'desc')
        // ->leftJoin('category', 'products.category_id', '=', 'category.id')
        // ->select('products.*', 'category.name as category_name')
        // ->limit(4)
        // ->get();
        $products = Product::where('products.status', '1') // Ensure status = 1 applies to all
            ->where(function ($query) {
                $query->where('new_products', 'yes')
                    ->orWhere('best_seller', 'yes')
                ; // Group the 'new_products' and 'best_seller' conditions
            })
            ->orderBy('created_at', 'desc')
            ->leftJoin('category', 'products.category_id', '=', 'category.id')
            ->select('products.*', 'category.name as category_name')
            ->limit(4)
            ->get();

        $mostproducts = Product::where('products.status', '1') // Ensure status = 1 applies to all
            ->where(function ($query) {
                $query->Where('most_populer', 'yes'); // Group the 'new_products' and 'best_seller' conditions
            })
            ->orderBy('created_at', 'desc')
            ->leftJoin('category', 'products.category_id', '=', 'category.id')
            ->select('products.*', 'category.name as category_name')
            ->orderBy('products.created_at', 'desc')
            ->limit(2)
            ->get();
        $categorys = Category::all();
        $subcategories = SubCategory::all();
        return view('stc_products.index', compact('ads','sliders', 'brands', 'products', 'categorys', 'mostproducts', 'subcategories'));
    }

    public function productdetails($id)
    {
        $productdetails = DB::table('products') // Use query builder
            ->leftJoin('category', 'products.category_id', '=', 'category.id') // Join with category table
            // ->select('products.*') // Select product fields and category name
            ->leftJoin('brands', 'products.brands', '=', 'brands.id')
            ->select('products.*', 'brands.name as brands_name', 'category.name as category_name')
            ->where('products.id', $id) // Filter by product ID
            ->first(); // Get the first matching record
            // dd($productdetails);
            // $productColors = DB::table('colors')
            // ->whereRaw("FIND_IN_SET(colors.id, ?)", [$productdetails->color])
            // ->get(); 
            // dd($productColors);
        if (!$productdetails) {
            abort(404); // Return a 404 error if the product is not found
        }
        $productImages = DB::table('product_listing_images')
            ->where('product_id', $id)
            ->get(); // Get all images related to the product

        $categorys = Category::all();
        $brands = Brands::all();

        // $productvideo= DB::table('product_listing_images')
        // ->where('product_id', $id)
        // ->get(); 
        // $slidertvideo= DB::table('product_slider_images')
        // ->where('product_id', $id)
        // ->get(); 
        // $productss = Product::limit(4)->get();
        // $productss = Product::orderBy('created_at', 'desc')->limit(4)->get();
        $productss = Product::select('products.*', 'category.name as category_name')
                    ->join('category', 'category.id', '=', 'products.category_id')
                    ->orderBy('products.created_at', 'desc')
                    ->limit(4)
                    ->get();

        // dd($productss);
        return view('stc_products.productdetails', compact('productdetails', 'productImages', 'categorys', 'brands','productss')); // Pass product details and images to the view
    }


    // public function products(Request $request)
    // {
    //     $query = $request->query('query'); // Search query
    //     $query1 = $request->query('query1'); // Search query
    //     $selectedCategories = $request->input('categories', []);
    //     $selectedsubCategories = $request->input('subcategories', []);
    //     $selectedBrands = $request->input('brands', []);
    //     // dd($query);

    //     // Define the base query for products
    //     $productsQuery = DB::table('products')
    //         ->join('category', 'products.category_id', '=', 'category.id')
    //         ->join('brands', 'products.brands', '=', 'brands.id')
    //         ->join('subcategory','products.subcategory_id','=','subcategory.id')
    //         ->select('products.*', 'category.name as category_name', 'brands.name as brand_name','subcategory.name as subcategory_name');

    //     // Apply search query if provided
    //     if (!empty($query)) {
    //         $productsQuery->where('products.name', 'like', "%{$query}%");
    //         // dd($productsQuery);
    //     }
    //     if (!empty($query1)) {
    //         $productsQuery->where('products.name', 'like', "%{$query1}%");
    //     }
    //     // Apply category filters if selected
    //     if (!empty($selectedCategories)) {
    //         $productsQuery->whereIn('products.category_id', $selectedCategories);
    //     }

    //     if (!empty($selectedsubCategories)) {
    //         $productsQuery->whereIn('products.subcategory_id', $selectedsubCategories);
    //     }

    //     // Apply brand filters if selected
    //     if (!empty($selectedBrands)) {
    //         $productsQuery->whereIn('products.brands', $selectedBrands);
    //     }
        
    //     // Get the filtered products using simple pagination
    //     $allProducts = $productsQuery->Paginate(12);  // Change paginate to simplePaginate

    //     // Get all brands and categories for filters
    //     $brands = Brands::all();
    //     $categorys = Category::all();
    //     $subcategorys = SubCategory::all();
    //     // dd($allProducts);
    //     // Return the view with data
    //     return view('stc_products.product-list', compact(
    //         'allProducts',
    //         'brands',
    //         'categorys',
    //         'selectedCategories',
    //         'selectedBrands',
    //         'selectedsubCategories',
    //         'query',
    //         'subcategorys'
    //     ));
    // }

 public function products(Request $request)
{
    $query = $request->query('query'); // Search query
    $query1 = $request->query('query1'); // Another search query
    $selectedCategories = $request->input('categories', []);
    $selectedSubcategories = $request->input('subcategories', []);
    $selectedBrands = $request->input('brands', []);

    // Define the base query for products
    $productsQuery = Product::with(['category', 'subcategory', 'brands']) // Eager load relationships
        ->whereNull('deleted_at'); // Soft deletes handle karna

    // 🟢 **Apply Search Query (Name, Code, Category, Subcategory, Brand)**
    if (!empty($query)) {
        $productsQuery->where(function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('code', 'like', "%{$query}%")
              ->orWhereHas('category', function ($q) use ($query) {
                  $q->where('name', 'like', "%{$query}%");
              })
              ->orWhereHas('subcategory', function ($q) use ($query) {
                  $q->where('name', 'like', "%{$query}%");
              })
              ->orWhereHas('brands', function ($q) use ($query) {
                  $q->where('name', 'like', "%{$query}%");
              });
        });
    }

    // 🟢 **Apply Second Search Query (Name, Measurements, Code)**
    if (!empty($query1)) {
        $productsQuery->where(function ($q) use ($query1) {
            $q->where('name', 'like', "%{$query1}%")
              ->orWhere('measurements', 'like', "%{$query1}%")
              ->orWhere('code', 'like', "%{$query1}%");
        });
    }

    // 🟢 **Apply Category Filter (Multiple categories using FIND_IN_SET)**
    if (!empty($selectedCategories)) {
        $categoryConditions = implode(',', array_fill(0, count($selectedCategories), '?'));
        $productsQuery->whereRaw("EXISTS (SELECT 1 FROM category WHERE FIND_IN_SET(category.id, products.category_id) AND category.id IN ($categoryConditions))", $selectedCategories);
    }

    // 🟢 **Apply Subcategory Filter (Multiple subcategories using FIND_IN_SET)**
    if (!empty($selectedSubcategories)) {
        $subcategoryConditions = implode(',', array_fill(0, count($selectedSubcategories), '?'));
        $productsQuery->whereRaw("EXISTS (SELECT 1 FROM subcategory WHERE FIND_IN_SET(subcategory.id, products.subcategory_id) AND subcategory.id IN ($subcategoryConditions))", $selectedSubcategories);
    }

    // 🟢 **Apply Brand Filter**
    if (!empty($selectedBrands)) {
        $productsQuery->whereIn('brands', $selectedBrands);
    }

    // 🟢 **Paginate Products (12 Per Page)**
    $allProducts = $productsQuery->paginate(12);

    // 🟢 **Fetch Brands, Categories & Subcategories for Filters**
    $brands = Brands::all();
    $categories = Category::all();
    $subcategories = SubCategory::all();

    // 🟢 **Return View with Data**
    return view('stc_products.product-list', compact(
        'allProducts',
        'brands',
        'categories',
        'selectedCategories',
        'selectedBrands',
        'selectedSubcategories',
        'query',
        'subcategories'
    ));
}



    // public function products(Request $request)
    // {
    //     $query = $request->input('query'); // Search query
    //     $selectedCategories = $request->input('categories', []);
    //     $selectedBrands = $request->input('brands', []);

    //     // Convert comma-separated values into an array if they are sent as a string
    //     if (!is_array($selectedCategories)) {
    //         $selectedCategories = explode(',', $selectedCategories);
    //     }
    //     if (!is_array($selectedBrands)) {
    //         $selectedBrands = explode(',', $selectedBrands);
    //     }

    //     // Define the base query for products
    //     $productsQuery = DB::table('products')
    //         ->join('category', 'products.category_id', '=', 'category.id')
    //         ->join('brands', 'products.brands', '=', 'brands.id')
    //         ->select('products.*', 'category.name as category_name', 'brands.name as brand_name');

    //     // Apply search query if provided
    //     if (!empty($query)) {
    //         $productsQuery->where('products.name', 'like', "%{$query}%");
    //     }

    //     // Apply category filters if selected
    //     if (!empty($selectedCategories) && $selectedCategories[0] !== '') {
    //         $productsQuery->whereIn('products.category_id', $selectedCategories);
    //     }

    //     // Apply brand filters if selected
    //     if (!empty($selectedBrands) && $selectedBrands[0] !== '') {
    //         $productsQuery->whereIn('products.brand_id', $selectedBrands);
    //     }

    //     // Get the filtered products using simple pagination
    //     $allProducts = $productsQuery->simplePaginate(12);

    //     // Get all brands and categories for filters
    //     $brands = Brands::all();
    //     $categorys  = Category::all();

    //     // Return the view with data
    //     return view('stc_products.product-list', compact(
    //         'allProducts',
    //         'brands',
    //         'categorys',
    //         'selectedCategories',
    //         'selectedBrands',
    //         'query'
    //     ));
    // }


//     public function getproducts($id, Request $request)
//     {
//         $query = $request->query('query'); // Search query
//         $selectedCategories = $request->input('categories', []);
//         $selectedBrands = $request->input('brands', []);

//         // Define the base query for products
//         // $productsQuery = DB::table('products')
//         //     ->join('category', 'products.category_id', '=', 'category.id')
//         //     ->join('brands', 'products.brands', '=', 'brands.id')
//         //     ->select('products.*', 'category.name as category_name', 'brands.name as brand_name');
//        $productsQuery = DB::table('products')
//     ->join('category', function ($join) {
//         $join->on(DB::raw('FIND_IN_SET(category.id, products.category_id)'), '>', DB::raw('0'));
//     })
//     ->join('brands', 'products.brands', '=', 'brands.id')
//     ->select('products.*', 'category.name as category_name', 'brands.name as brand_name')
//     ->whereRaw("FIND_IN_SET(?, products.category_id)", [$id]) // This will fetch products of the selected category
//     ->whereNull('products.deleted_at'); // Ensuring deleted products are not shown

// // Apply search query if provided
// if (!empty($query)) {
//     $productsQuery->where('products.name', 'like', "%{$query}%");
// }

// // Apply category filters correctly
// if (!empty($selectedCategories)) {
//     $categoryConditions = [];
//     foreach ($selectedCategories as $category) {
//         $categoryConditions[] = "FIND_IN_SET($category, products.category_id)";
//     }
//     $productsQuery->whereRaw(implode(' OR ', $categoryConditions));
// }

// // Apply brand filters correctly
// if (!empty($selectedBrands)) {
//     $productsQuery->whereIn('products.brands', $selectedBrands);
// }

// // Get paginated products
// $allProducts = $productsQuery->paginate(9);

// // Get all brands and categories for filters
// $brands = Brands::all();
// $categorys = Category::all();

// // Return the view with data
// return view('stc_products.product-list', compact(
//     'allProducts',
//     'brands',
//     'categorys',
//     'selectedCategories',
//     'selectedBrands',
//     'query'
// ));

//     }

public function getproducts($id, Request $request)
{
    $query = $request->query('query'); // Search query
    $selectedBrands = $request->input('brands', []); // Brand filter
    $selectedCategories = $request->input('categories', []); // Category filter
    $selectedSubcategories = $request->input('subcategories', []); // Subcategory filter

    // Define the base query for products
    $productsQuery = DB::table('products')
        ->join('category', function ($join) {
            $join->on(DB::raw('FIND_IN_SET(category.id, products.category_id)'), '>', DB::raw('0'));
        })
        ->join('subcategory', function ($join) {
            $join->on(DB::raw('FIND_IN_SET(subcategory.id, products.subcategory_id)'), '>', DB::raw('0'));
        })
        ->join('brands', 'products.brands', '=', 'brands.id')
        ->select('products.*', 
                 DB::raw('GROUP_CONCAT(DISTINCT category.name) as category_names'),
                 DB::raw('GROUP_CONCAT(DISTINCT subcategory.name) as subcategory_names'),
                 'brands.name as brand_name')
        ->where('products.brands', $id) // Brand-wise filtering
        ->whereNull('products.deleted_at')
        ->groupBy('products.id');

    // 🟢 **Apply Search Filter**
    if (!empty($query)) {
        $productsQuery->where('products.name', 'like', "%{$query}%");
    }

    // 🟢 **Apply Brand Filter**
    if (!empty($selectedBrands)) {
        $productsQuery->whereIn('products.brands', $selectedBrands);
    }

    // 🟢 **Apply Category Filter**
    if (!empty($selectedCategories)) {
        $productsQuery->where(function ($q) use ($selectedCategories) {
            foreach ($selectedCategories as $category) {
                $q->orWhereRaw("FIND_IN_SET(?, products.category_id)", [$category]);
            }
        });
    }

    // 🟢 **Apply Subcategory Filter**
    if (!empty($selectedSubcategories)) {
        $productsQuery->where(function ($q) use ($selectedSubcategories) {
            foreach ($selectedSubcategories as $subcategory) {
                $q->orWhereRaw("FIND_IN_SET(?, products.subcategory_id)", [$subcategory]);
            }
        });
    }

    // 🟢 **Paginate the Products**
    $allProducts = $productsQuery->paginate(9);

    // 🟢 **Fetch Brands, Categories, and Subcategories for Filters**
    $brands = Brands::all();
    $categories = Category::all();
    $subcategories = SubCategory::all();

    // 🟢 **Return the View with Data**
    return view('stc_products.product-list', compact(
        'allProducts',
        'brands',
        'selectedBrands',
        'categories',
        'selectedCategories',
        'subcategories',
        'selectedSubcategories',
        'query'
    ));
}



    public function aboutus()
    {

        $aboutus = MasterPage::where('title', '=', 'About Us')->get();
        $categorys = Category::all();
    $brands = Brands::all();


        return view('stc_products.about-us', compact('aboutus', 'categorys','brands'));
    }

    public function contactus()
    {

    $brands = Brands::all();


        $categorys = Category::all();

        return view('stc_products.contact_us', compact('categorys','brands'));
    }

    public function enquirenow()
    {
        $categorys = Category::all();
    $brands = Brands::all();

        return view('stc_products/enquire_now', compact('categorys','brands'));
    }



    //get data from database for dat table --------------------------------------------------------- End

    //Load Datatable or list view file  --------------------------------------------------------- Start
    public function enquiresubmit(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric|max:11',
            'message' => 'required|string',
        ]);

        // Save the enquiry in the database
        $enquiry = Enquiry::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'message' => $request->input('message'),
        ]);

        // Email content
        $emailContent = "
            <h1>New Enquiry Received</h1>
            <p><strong>Name:</strong> {$enquiry->name}</p>
            <p><strong>Email:</strong> {$enquiry->email}</p>
            <p><strong>Phone:</strong> {$enquiry->phone}</p>
            <p><strong>Message:</strong></p>
            <p>{$enquiry->message}</p>
        ";

        $subject = "New Enquiry from {$enquiry->name}";

        // Send the email
        Mail::send([], [], function ($message) use ($emailContent, $subject) {
            $recipient = 'recipient@example.com'; // Replace with the recipient's email
            $message->to($recipient)
                ->subject($subject)
                ->setBody($emailContent, 'text/html');
        });

        // Return success response
        return back()->with('success', 'تم إرسال الاستفسار بنجاح!');
    }


    /**
     * Show the form for creating a new resource.
     */

}
