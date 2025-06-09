<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Brands;
use App\Models\Cart;
use App\Models\Lifestyle;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Feature_Products;
use App\Models\ProductFeatures;
use App\Models\Product_Features_Product;
use App\Models\product_slider_image;
use App\Models\ProductOverviewImage;
use App\Models\ListingImages;
use Illuminate\Support\Str;
use App\Models\Staff;
use getID3;
use App\Models\MasterEmailTemplate;
use App\Models\MasterCompanySetting;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use DataTables, Auth;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{




    protected $title = 'Product';
    //this variable use for blade file path 
    protected $page = 'content/product';
    //this variable use for route prefix and view folder 
    protected $routeLable = 'product';


//    public function searchproduct(Request $request)
// {
//     $query = $request->input('query');
    
//     if ($query) {
//         $products = Product::where('name', 'like', "%{$query}%")
//                     ->orwhere('code','like',"%{$query}%")->get();
//         // return view('index', compact('products', 'query'));
//         return response()->json([
//                 'status' => true,
//                 'data'   => $products,
//         ]);
//     }

//     return redirect()->back()->with('message', 'Please enter a search query.');
// }

public function searchproduct(Request $request)
{
    $query = $request->input('query');
    
    if ($query) {
        // Ensure the query is sanitized
        $query = trim($query);

        // Search products by name, code, category name, subcategory name, and brand name
        $products = Product::where('name', 'like', "%{$query}%")
                           ->orWhere('code', 'like', "%{$query}%")
                           ->orWhereHas('category', function ($q) use ($query) {
                               $q->where('name', 'like', "%{$query}%");
                           })
                           ->orWhereHas('subcategory', function ($q) use ($query) {
                               $q->where('name', 'like', "%{$query}%");
                           })
                           ->orWhereHas('brands', function ($q) use ($query) {
                               $q->where('name', 'like', "%{$query}%");
                           })
                           ->get();

        // if ($products->isEmpty()) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'No products found matching your search query.',
        //     ]);
        // }

        // Return products as JSON response
        return response()->json([
            'status' => true,
            'data'   => $products,
        ]);
    }

    // Return a message if no query was provided
    return response()->json([
        'status' => false,
        'message' => 'Please enter a search query.',
    ]);
}




    public function __construct(Request $request)
    {
        $this->model = new Product();
        $this->sortableColumns = ['products.id', 'products.name',  'products.stock_status', 'products.status', 'products.created_at'];
    }

    //get data from database for dat table --------------------------------------------------------- Strat
    public function getData($search = null, $orderby = null, $order = null, $request = null)
    {
        $q =    Product::select('products.*');
        $orderby = $orderby ? $orderby : 'products.id';
        $order = $order ? $order : 'desc';
        if ($search && !empty($search)) {
            $q->where(function ($query) use ($search) {
                $query->where('products.name', 'LIKE', '%' . $search . '%')
                ->where('products.code', 'LIKE', '%' . $search . '%');
            });
        }
        if (isset($request['status']) && $request['status'] != '') {
            $q->where('products.status', $request['status']);
        }
        if (isset($request['stock_status']) && $request['stock_status'] != '') {
            $q->where('products.stock_status', $request['stock_status']);
        }

        if (isset($request['name']) && !empty($request['name'])) {
            $search_all = $request['name'];
            $q->where(function ($query) use ($search_all) {
                $query->where('products.name', 'LIKE', '%' . $search_all . '%');
            });
        }



        if (isset($request['start_range']) && !empty($request['start_range']) && isset($request['end_range']) && !empty($request['end_range'])) {
            $start_range = $request['start_range'];
            $end_range = $request['end_range'];


            $q->whereBetween(DB::raw('DATE_FORMAT(products.created_at, "%Y-%m-%d")'), [$start_range, $end_range]);
        }

        $response = $q->orderBy($orderby, $order);
        return $response;
    }
    //get data from database for dat table --------------------------------------------------------- End

    //Load Datatable or list view file  --------------------------------------------------------- Start
    public function index(Request $request)
    {
        // try {
        //if request from ajex when retun list of items 
        if ($request->ajax()) {
            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search']['value'];
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
            $sortableColumns = $this->sortableColumns;

            // $start_date = ($request->get('start_date')) ? date('Y-m-d 00:00:01', strtotime($request->get('start_date'))) : date('Y-m-d 00:00:01', strtotime('-1 year', strtotime(date('Y-m-d'))));
            // $end_date = ($request->get('end_date')) ? date('Y-m-d 23:59:59', strtotime($request->get('end_date'))) : date('Y-m-d 23:59:59');

            $s_data = array();
            $s_data['status'] = $request->input('status');
            $s_data['stock_status'] = $request->input('stock_status');
            $s_data['name'] = $request->input('name');
            // $s_data['category_id'] = $request->input('category_name');
            // $s_data['sub_category_id'] = $request->input('sub_category_name');

            $s_data['start_range'] = $request->input('start_range');
            $s_data['end_range'] = $request->input('end_range');



            $totaldata = $this->getData($search, $sortableColumns[$orderby], $order, $s_data);

            $totaldata = $totaldata->count();
            $response = $this->getData($search, $sortableColumns[$orderby], $order, $s_data);
            // $response->whereBetween('devlopments.created_at', [$start_date, $end_date]);

            $response = $response->offset($start)->limit($limit)->orderBy('products.id', 'desc')->get();

        //    dd($response);
            if (!$response) {
                $data = [];
                $paging = [];
            } else {
                $data = $response;
                $paging = $response;
            }



            $datas = [];
            $i = 1;
            foreach ($data as $value) {
                $row['id'] = $start + $i;
                $row['name'] = $value->name;
                $row['code'] = $value->code;
                // $row['sku'] = $value->sku;
                // $row['category_name'] = $value->category_name;
                // $row['sub_category_name'] = $value->sub_category_name;
                // $row['brand_title'] = $value->brand_title;
                if(isset($value->product_image)){
                    $filePath = 'uploads/product/product_image/' . $value->product_image;
                }else{
                    $filePath = '';
                }
               
                $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                    $row['small_image'] = '<div class="table_img_"><img src="' . $filePath . '" alt="Image 1"></div>';
                } elseif (in_array($extension, ['mp4', 'avi', 'mov'])) {
                    $videoType = 'video/' . $extension;
                    $row['small_image'] = '<div class="table_img_"><video width="70" height="70" controls><source src="' . $filePath . '" type="' . $videoType . '"></video></div>';
                } else {
                    $row['small_image'] = '<div class="table_img_"><img src="uploads/lifestyle_gear/default/defaul_banner.png" alt="Default Image"></div>';
                }
                


                if ($value->stock_status == '1') {
                    $row['stock_status'] = 'In stock';
                } else {
                    $row['stock_status'] = 'Out of stock';
                }


                if (Auth::user()->can('master_edit_products')) {
                    $row['status'] =  ' <label class="switch">
                                                <input class="status-checkbox" type="checkbox" ' . ($value->status == '1' ? 'checked' : '') . ' data-id=' . $value->id . '>
                                                <span class="slider round"></span>
                                            </label>';
                } else {
                    $row['status'] = '<label class="switch">
                                                <input disabled type="checkbox" ' . ($value->status == '1' ? 'checked' : '') . ' data-id=' . $value->id . '>
                                                <span class="slider round"></span>
                                        </label>';
                }

                $row['created_at'] =  date("d-m-Y", strtotime($value->created_at));

                $edit = '';
                
                $edit = '<a href="' . url('product/edit/' . $value->id) . '" " title="Edit" "><i class="bx bx-edit f-16 mr-15 text-green"></i></a>';



                $view = '';
                
                    // $view = '<a href="javascript::void(0)" title="View" ><i class="bx bxs-show f-16 text-green mr-1"></i></a>';
                    $view = '<a href="' . url('product/view/' . base64_encode($value->id))  . '" title="View" data-toggle="tooltip" data-bs-target="#viewModal   " title="View"><i class="bx bxs-show f-16 text-green mr-1"></i></a> ';


                // }
                $delete = '';

                $delete = '<a href="javascript:void(0)" data-toggle="tooltip" title="Delete" onclick="deleteItem(' . $value->id . ')"><i class="bx bx-trash  f-16 text-red mr-1"></i></a>';





                $row['actions'] = '<div class="table-actions">' . $edit . $view . $delete . '</div>';

                $datas[] = $row;
                $i++;
                unset($u);
            }
            $return = [
                "draw" => intval($draw),
                "recordsFiltered" => intval($totaldata),
                "recordsTotal" => intval($totaldata),
                "data" => $datas,
            ];
            return $return;
        }
        $data = ['title' => ucfirst($this->title), 'label' => $this->routeLable];
        return view($this->page . '.list', $data);
    }
    public function create()
    {
        $brands  = Brands::orderBy('name', 'asc')->get();
        $category  = Category::orderBy('name', 'asc')->get();
        $subcategory  = SubCategory::orderBy('name', 'asc')->get();
        $lifestyle_gear  = Lifestyle::where('status', '1')->orderBy('name', 'asc')->get();
        $Feature_Products  = Feature_Products::where('status', '1')->orderBy('name', 'asc')->get();
        

        $data = array();
        $data['brands'] = $brands;
        $data['category'] = $category;
        $data['subcategory'] = $subcategory;
        $data['lifestyle_gear'] = $lifestyle_gear;
        $data['Feature_Products'] = $Feature_Products;
       
        return view('content/product/add_product', $data);
    }

    //store data
   public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'name' => 'required | string ',
            'code' => 'required ',
            'category_id' => 'array',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',
            'attachments' => 'mimes:pdf,xls,xlsx,csv',
            'product_intro_image' => 'nullable|mimes:jpg,jpeg,png',
            // 'sliderImages' => 'nullable|array',
            'sliderImages.*' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi,wmv|max:20480',
            'listing_images.*' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi,wmv|max:20480',
            'product_main_image' => 'mimetypes:image/*,video/*',
            'product_listing' => 'mimetypes:image/*,video/*',
            'product_feature_image' => 'nullable|mimes:jpg,jpeg,png,mp4,mov|dimensions:min_width=1080,min_height=600,max_width=1080,max_height=600',
           // 'overviewImages'=>'nullable|mimes:jpg,jpeg,png,mp4,mov|dimensions:min_width=1080,min_height=600,max_width=1080,max_height=600',
            // 'sku' => 'required',
            // 'stock_quantity' => 'nullable|numeric',
             'best_seller' => 'nullable',
             'new_products' => 'nullable',
             'most_populer' => 'nullable',

            // 'price' => 'required',
            // 'cutoff_price' => 'required',
           
        ];
        $msg = [
            'name.unique' => 'The product name has already been taken.',
            'product_feature.max'=>'Only Six Features are Allowed.',
            'attachments' => 'Attachments must be pdf,xls,xlsx, file.',
            'product_intro_image.mimetypes' => 'Small Image/Vedio  must be a JPG, JPEG, PNG Or ,mp4,mov file.',
            'product_main_image.mimes' => 'Product Image/Vedio  must be a JPG, JPEG, PNG Or ,mp4,mov file.',
            'product_intro_image.dimensions' => 'Small Image/Vedio must be 1080x600 pixels in size.',
            'product_main_image.dimensions' => 'Product Image/Vedio must be 1080x600 pixels in size.',
            'product_feature_image.mimes' => 'Product Feature Image/Vedio  must be a JPG, JPEG, PNG Or ,mp4,mov file.',
            'product_feature_image.dimensions' => 'Product Feature Image/Vedio must be 1080x600 pixels in size.',
            'sliderImages.mimes' => 'Slider Images must be JPG, JPEG, or PNG files.',
            'sliderImages.dimensions' => 'Slider Images must be 1080x600 pixels in size.',
            'best_seller' => 'Best seller.',
        'new_products' => 'New product .',
        'most_populer' => 'most_populer .',

        
        ];

        if (isset($request->id) && $request->id > 0) {
            $rules['name'] = 'required|unique:products,name,' . $request->id . ',id,deleted_at,NULL';
            // $rules['sku'] = 'required|unique:products,sku,' . $request->id . ',id,deleted_at,NULL';

            $validator = Validator::make($request->all(), $rules, $msg);
        } else {
            $rules['name'] = 'required|unique:products,name,0,id,deleted_at,NULL';
            // $rules['sku'] = 'required|unique:products,sku,0,id,deleted_at,NULL';

            $validator = Validator::make($request->all(), $rules, $msg);
        }



        if ($validator->fails()) {
            $res = array('code' => 201, 'msg' => $validator->messages()->first());
            return json_encode($res);
        }

        if (isset($request->id) && $request->id > 0) {
            //update
            // print_r(111);die;
            $item = Product::findOrFail($request->id);
            if ($item->name != $request->name) {
                $item->slug = Str::slug($request->name);
            };

            $item->code = $request->code;
            $item->brands = $request->brands;
            // $item->category_id = $request->category;
            $item->category_id = implode(',', $request->category);
            $item->origin = $request->origin;
           
            $item->normal_price = $request->normal_price;
            // $item->subcategory_id = $request->subcategory;
            // $item->subcategory_id = implode(',', $request->subcategory);
            $item->subcategory_id = $request->has('subcategory') ? implode(',', $request->subcategory) : null;

        
            $item->wholesaler_price = $request->wolesales_price;
            $item->loyal_price = $request->loyal_price;
            $item->name = $request->name;
            $item->measurements = $request->measurement;

            // $item->stock_quantity = $request->stock_quantity;
           
            if ($request->stock_status == 'on') {
                $item->stock_status = '1';
            } else {
                $item->stock_status = '0';
            }
            // $item->sku = $request->sku;
            // $item->price = $request->price;
            // $item->cutoff_price = $request->cutoff_price;
            // $item->discount_percentage = $request->discount_percentage;
            $item->meta_title = $request->meta_title;
            $item->meta_keyword = $request->meta_keyword;
            $item->meta_description = $request->meta_description;
            $item->warranty = $request->warranty;
            $item->full_description = $request->description;
            $item->overview = $request->overview;
            $item->summary = $request->summary;
            
             $item->best_seller = $request->best_seller ?? 0;
        $item->new_products = $request->new_products ?? 0;
        $item->most_populer = $request->most_populer ?? 0;

                $item->titles = implode(',', $request->titles);
                $item->descriptions = implode(',', $request->descriptions);

            //if Product Introduction  image set then upload
            if ($image = $request->file('attachments')) {
                $destination_path = 'uploads/product/attachments';
                $source_path = $image;
                $file_name = image_upload_public($source_path, $destination_path);
                $item->attachments = $file_name;
                // ImageResize($file_name, $destination_path, 'small', 500, 500);
            }
            if ($image = $request->file('product_intro_image')) {
                $destination_path = 'uploads/product/product_image';
                $source_path = $image;
                $file_name = image_upload_public($source_path, $destination_path);
                $item->product_image = $file_name;
                // ImageResize($file_name, $destination_path, 'small', 500, 500);
            }
            // if ($image = $request->file('product_main_image')) {
            //     $destination_path = 'uploads/product/product_main_image';
            //     $source_path = $image;
            //     $file_name = image_upload_public($source_path, $destination_path);
            //     $item->product_intro_image = $file_name;
            //     // ImageResize($file_name, $destination_path, 'small', 500, 500);
            // }

            // $item->updated_by_id = Auth::user()->id;
            $item->save();

            $itemId = $item->id;


        $files = $request->file('listing_images');
        if ($files && is_array($files)) {

            foreach ($files as $file) {
                $destination_path = 'uploads/product/listing_images';
                $source_path = $file;
                $file_name = image_upload_public($source_path, $destination_path);
                DB::table('product_listing_images')->insert(
                    array(
                        'product_id' => $itemId,
                        'list_image'   => $file_name
                    )
                );
                // ImageResize($file_name, $destination_path, 'small', 200, 200);
                // ImageResize($file_name, $destination_path, 'medium', 700, 700);
            }
        }



            // $files = $request->file('sliderImages');
            // if ($files && is_array($files)) {
            //     foreach ($files as $file) {
            //         $destination_path = 'uploads/product/slider_images';
            //         $source_path = $file;
            //         $file_name = image_upload_public($source_path, $destination_path);
            //         DB::table('product_slider_images')->insert(
            //             array(
            //                 'product_id' => $itemId,
            //                 'images'   => $file_name
            //             )
            //         );
            //         // ImageResize($file_name, $destination_path, 'small', 200, 200);
            //         // ImageResize($file_name, $destination_path, 'medium', 700, 700);
            //     }
            // }
            $files = $request->file('sliderImages');

            if ($files && is_array($files)) {
                foreach ($files as $file) {
                    $extension = $file->getClientOriginalExtension();
                    if (in_array($extension, ['mp4', 'mov', 'avi', 'wmv'])) {
                        try {
                            $getID3 = new getID3();
                            $fileInfo = $getID3->analyze($file->getPathname());
                            $duration = isset($fileInfo['playtime_seconds']) ? $fileInfo['playtime_seconds'] : 0;

                            if ($duration > 60) {  
                                return back()->withErrors(['sliderImages' => 'Video must be 1 minute or less.'])->withInput();
                            }
                        } catch (\Exception $e) {
                            return back()->withErrors(['sliderImages' => 'Error checking video duration.'])->withInput();
                        }
                    }

                    
                    $destination_path = 'uploads/product/slider_images';
                    $file_name = image_upload_public($file, $destination_path);
                    DB::table('product_slider_images')->insert([
                        'product_id' => $itemId,
                        'images' => $file_name
                    ]);
                }
            }

          

            if ($item) {
                $res = array('code' => 200, 'msg' => 'Updated successfully');
            } else {
                $res = array('code' => 201, 'msg' => 'Failed! Try again');
            }
        } else {

            $item = new Product;
            if ($item->name != $request->name) {
                $item->slug = Str::slug($request->name);
            };
            $item->code = $request->code;
            $item->brands = $request->brands;
            // $item->category_id = $request->category;
            $item->category_id = implode(',', $request->category);
            $item->origin = $request->origin;
            $item->normal_price = $request->normal_price;
            // $item->subcategory_id = $request->subcategory;
            // $item->subcategory_id = implode(',', $request->subcategory);
            $item->subcategory_id = $request->has('subcategory') ? implode(',', $request->subcategory) : null;

            $item->wholesaler_price = $request->wolesales_price;
            $item->loyal_price = $request->loyal_price;
            $item->name = $request->name;
            $item->measurements = $request->measurement;
            // $item->stock_quantity = $request->stock_quantity;

            if ($request->stock_status == 'on') {
                $item->stock_status = '1';
            } else {
                $item->stock_status = '0';
            }
            // $item->sku = $request->sku;
            // $item->price = $request->price;
            // $item->cutoff_price = $request->cutoff_price;
            // $item->discount_percentage = $request->discount_percentage;
            $item->meta_title = $request->meta_title;
            $item->meta_keyword = $request->meta_keyword;
            $item->meta_description = $request->meta_description;
            $item->warranty = $request->warranty;
            $item->full_description = $request->description;
            $item->overview = $request->overview;
         
            $item->summary = $request->summary;
            $item->best_seller = $request->best_seller ?? 0;
        $item->new_products = $request->new_products ?? 0;
                $item->most_populer = $request->most_populer ?? 0;

                $item->titles = implode(',', $request->titles);
                $item->descriptions = implode(',', $request->descriptions);

            //if Product Introduction  image set then upload
            if ($image = $request->file('attachments')) {
                $destination_path = 'uploads/product/attachments';
                $source_path = $image;
                $file_name = image_upload_public($source_path, $destination_path);
                $item->attachments = $file_name;
                // ImageResize($file_name, $destination_path, 'small', 500, 500);
            }

            if ($image = $request->file('product_intro_image')) {
                $destination_path = 'uploads/product/product_image';
                $source_path = $image;
                $file_name = image_upload_public($source_path, $destination_path);
                $item->product_image = $file_name;
                // ImageResize($file_name, $destination_path, 'small', 500, 500);
            }
            // if ($image = $request->file('product_main_image')) {
            //     $destination_path = 'uploads/product/product_main_image';
            //     $source_path = $image;
            //     $file_name = image_upload_public($source_path, $destination_path);
            //     $item->product_intro_image = $file_name;
            //     // ImageResize($file_name, $destination_path, 'small', 500, 500);
            // }
            
            // $item->updated_by_id = Auth::user()->id;

            $item->save();

            $itemId = $item->id;

            $files = $request->file('sliderImages');
           
           

            if ($files  && is_array($files) ) {
                foreach ($files as $file) {
                    $destination_path = 'uploads/product/slider_images';
                    $source_path = $file;
                    $file_name = image_upload_public($source_path, $destination_path);
                    DB::table('product_slider_images')->insert(
                        array(
                            'product_id' => $itemId,
                            'images'   => $file_name
                        )
                    );
                    // ImageResize($file_name, $destination_path, 'small', 200, 200);
                    // ImageResize($file_name, $destination_path, 'medium', 700, 700);
                }
            }

            
            //cho '_____'; die;
            

            $files = $request->file('listing_images');
            if ($files && is_array($files)) {

                foreach ($files as $file) {
                    $destination_path = 'uploads/product/listing_images';
                    $source_path = $file;
                    $file_name = image_upload_public($source_path, $destination_path);
                    DB::table('product_listing_images')->insert(
                        array(
                            'product_id' => $itemId,
                            'list_image'   => $file_name
                        )
                    );
                    // ImageResize($file_name, $destination_path, 'small', 200, 200);
                    // ImageResize($file_name, $destination_path, 'medium', 700, 700);
                }
            }

            
            

            if ($item) {
                $res = array('code' => 200, 'msg' => 'Added successfully');
            } else {
                $res = array('code' => 201, 'msg' => 'Failed! Try again');
            }
        }

        // } catch (\Exception $e) {
        //     $bug = $e->getMessage();
        //     $res = array('code' => 201, 'msg' => 'Something went wrong! Try again',$bug);
        // }
        return json_encode($res);
    } 
    //get by id

public function getCategoriesByBrand(Request $request)
{
    $brand_id = $request->brand_id;

    // Fetch categories where brand_id matches the selected brand
    $categories = Category::whereIn('brands', [$brand_id])->get();

    if ($categories->count() > 0) {
        return response()->json(['status' => true, 'categories' => $categories]);
    } else {
        return response()->json(['status' => false, 'categories' => []]);
    }
}


    public function get_by_id($id, Request $request)
    {
        // return $id;die;
        try {
            $data = array();
            $data['product_detail'] = $product_detail = Product::select('products.*')->findOrFail($id);
       
        
            
            $ProductSliderImages =  product_slider_image::select('*')->where('product_id', $id)->get();
            
            $ListingImages=ListingImages::where('product_id',$id)->get();
            $brands  = Brands::orderBy('name', 'asc')->get();
            $category  = Category::orderBy('name', 'asc')->get();
            $subcategory  = SubCategory::orderBy('name', 'asc')->get();
         
            $data['brands'] = $brands;
            $data['category'] = $category;
            $data['subcategory'] = $subcategory;
         


            // Format static files data
        $data['product_listing_images'] = $ListingImages->map(function ($image) {
            return [
                'name' => $image->list_image, // Assuming filename column in your table
                'size' => '9856325', // Assuming size column in your table
                'url' => url('uploads/product/listing_images/' . $image->list_image)  // Assuming url column in your table
            ];
        });

        $data['productSliders'] = $ProductSliderImages->map(function ($image) {
            return [
                'name' => $image->images, // Assuming filename column in your table
                'size' => '9856325', // Assuming size column in your table
                'url' => url('uploads/product/slider_images/' . $image->images)  // Assuming url column in your table
            ];
        });

      


            
            return view('content/product/add_product', $data);
        } catch (\Exception $e) {
            $res = array('code' => 201, 'msg' => 'Something went wrong! Try again' . $e);
        }
        return json_encode($res);
    }



    public function delete(Request $request)
    {
        $id = $request->id;
        try {
            $product = Product::findOrFail($id);
            $status =  $product->delete();

            if ($status === true) {
                return response()->json(['success' => 'Product deleted successfully', "status" => $status], 200);
            } else {
                return response()->json(['error' => 'Something went wrong', "status" => $status], 201);
            }
        } catch (Throwable $e) {
            report($e);
            return response()->json(['error' => 'Something went wrong']);
            // return "Something went wrong";
        }
    }


    public function deleteImage($id)
    {


        $image = ProductImage::findOrFail($id);


        if (!$image) {
            return response()->json(['error' => 'Image not found']);
        }

        $image->delete();

        return response()->json(['status' => '200', 'id' => $id, 'success' => 'Image deleted successfully'], 200);
    }


    public function update_status(Request $request)
    {
        // create user 
        $validator = Validator::make($request->all(), [
            'id'     => 'required',
            'type'     => 'required',
            'value'     => 'required',
        ]);

        if ($validator->fails()) {
            $res = array('code' => 201, 'msg' => 'All fields reuired');
        }
        try {
            //if id found then update else insert
            if (isset($request->id) && $request->id > 0) {
                //update
                $item = Product::find($request->id);
                //update active/inactive status
                if (isset($request->type) && $request->type == 'status') {
                    if ($request->value == "1") {
                        $item->status = '1';
                    } else {
                        $item->status = '2';
                    }
                }
                $item->save();
                if ($item) {
                    if (isset($request->type) && $request->type == 'status') {
                        if ($request->value == "1") {
                        }

                        $res = array('code' => 200, 'msg' => 'Updated successfully');
                    }
                } else {
                    $res = array('code' => 201, 'msg' => 'Failed! Try again');
                }
            } else {
                $res = array('code' => 201, 'msg' => 'Failed! Try again');
            }
        } catch (\Exception $e) {
            $res = array('code' => 201, 'msg' => 'Something went wrong! Try again');
        }
        return json_encode($res);
    }



    public function img_remove(Request $request){

       //print_r($request->all());die;
       ProductOverviewImage::where('overview_image',$request->file_remove)->forceDelete();
       $res = array('code' => 200, 'msg' => 'File removed successfully');
       return json_encode($res);

    }

    public function slider_img_remove(Request $request){

       //print_r($request->all());die;
       product_slider_image::where('images',$request->slider_remove)->forceDelete();
       $res = array('code' => 200, 'msg' => 'File removed successfully');
       return json_encode($res);

    }

    public function listing_img_remove(Request $request){

    //    print_r($request->all());die;
       ListingImages::where('list_image',$request->list_remove)->forceDelete();
       $res = array('code' => 200, 'msg' => 'File removed successfully');
       return json_encode($res);

    }

public function getProductsByCategory(Request $request)
{$categoryName = $request->input('category_name');
    
    if ($categoryName) {
        // Find the category by its name
        $category = Category::where('name', $categoryName)->first();
        
        // If the category exists, retrieve its products
        if ($category) {
            $products = Product::where('category_id', $category->id)->get();
        } else {
            $products = []; // No products if the category is not found
        }
    } else {
        // If no category is selected, fetch all products
        $products = Product::all();
    }
    
    $categorys = Category::all();  // Get all categories for the dropdown
    return view('products.index', compact('products', 'categorys'));
}



    public function upload_ck_image(Request $request)
    {

        $this->validate($request, [
            'upload' => 'required',
        ]);

        if ($request->hasFile('upload')) {
            $path = 'uploads/ck_images/';
            echo $path;

            $imagePath = image_upload_public($request->file('upload'), $path);

            if ($imagePath) {
                $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                $url = url('uploads/ck_images') . '/' . $imagePath;
                $msg = 'Image uploaded successfully';
                $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            } else {
                $re = '<script>alert("Unable to upload the file")</script>';
            }
        }

        // Render HTML output 
        @header('Content-type: text/html; charset=utf-8');
        echo $re;
    }
  
    public function getSubcategories($id)
    {
        $subcategories = SubCategory::where('category_id', $id)->get();
        return response()->json(['subcategories' => $subcategories]);
    }
    public function view($id, Request $request)
    {
        try {
            $id = base64_decode($id);
            $data = Product::find($id);
            // dd($data);
            // $customer_id = $Id->customer_id;
            // $data = array();
            // $data['order'] = $orders =  Order::select('orders.*', 'customers.first_name', 'customers.last_name', 'customers.image as profileImage', 'customers.email', 'customers.phone', 'customers.user_type')->join('customers', 'customers.id', 'orders.customer_id')->findOrFail($id);
            // $data['product_order'] = $p_orders = ProductOrder::select('product_orders.*', 'products.*', 'category.name as category_name')->join('products', 'products.id', 'product_orders.product_id')->join('category', 'category.id', 'products.category_id')->where('order_id', $id)->get();
            // $data['shipping_address'] = CustomerAddress::select('*')->where('id', $orders->customer_address_id)->first();
            // $data['billing_address'] = CustomerAddress::select('*')->where('id', $orders->customer_billingaddress_id)->first();
            // $data['total_order'] = Order::where('customer_id', $customer_id)->count();


            //    return print_r($data['total_order']);die;
            return view('content/product/product_view_new', compact('data'));

        } catch (\Exception $e) {
            $res = array('code' => 201, 'msg' => 'Something went wrong! Try again' . $e);
        }
        return json_encode($res);
    }

}
