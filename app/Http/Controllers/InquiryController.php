<?php

namespace App\Http\Controllers;

use PDF;
use Mail;
use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Staff;
use DataTables, Auth;
use App\Models\Coupon;
use App\Models\Dealer;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\MasterUnit;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use App\Models\CompanySetting;
use App\Models\CustomerAddress;
use App\Models\ProjectCustomer;
use Illuminate\Support\Facades\DB;
use App\Models\MasterEmailTemplate;
use App\Models\MasterCompanySetting;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;


class InquiryController extends Controller
{
    protected $title = 'Inquiry';
    //this variable use for blade file path 
    protected $page = 'content/inquiry';
    //this variable use for route prefix and view folder 
    protected $routeLable = 'inquiry';

    public function __construct(Request $request)
    {
        $this->model = new Order();
        $this->sortableColumns = ['id', 'name', 'orders.payment_type', 'orders.total_amount', 'orders.created_at'];
    }
    //get data from database for dat table --------------------------------------------------------- Strat

    public function download_order_invoice($id, Request $request)
    {
        $id = base64_decode($id);

        $order_data = Order::select('*')
            ->with('productOrders',)
            ->where('orders.id', $id)
            ->first();

        $company = CompanySetting::first();


        if ($order_data) {

            if ($order_data->customer_address_id) {

                $customer_addressid = $order_data->customer_address_id;
            } else {
                $customer_addressid = '';
            }

            if ($order_data->customer_billingaddress_id) {
                $customer_billingaddress_id = $order_data->customer_billingaddress_id;
            } else {
                $customer_billingaddress_id = '';
            }



            $customer_addressdata = CustomerAddress::where('id', $customer_addressid)->first();
            $customer_billingaddressdata = CustomerAddress::where('id', $customer_billingaddress_id)->first();
        } else {
            $customer_addressdata = '';
            $customer_billingaddressdata = '';
        }



        $data = ['order_data' => $order_data, 'customer_addressdata' => $customer_addressdata, 'customer_billingaddressdata' => $customer_billingaddressdata, 'company' => $company];


        // return view($this->page . '.download_invoice', $data);

        $pdf = PDF::loadView($this->page . '.download_invoice', $data)->setPaper('a4', 'portrait');
        return $pdf->download('invoice.pdf');
    }

    public function getData($search = null, $orderby = null, $order = null, $request = null)
    {
        // $q = Order::select('orders.*', DB::raw("CONCAT(customers.first_name, ' ', customers.last_name) as customer_name"), 'customers.phone as mobile_number', DB::raw("COUNT(product_orders.product_id) as product_count"))
        //     ->leftJoin('customers', 'customers.id', '=', 'orders.customer_id')
        //     ->leftjoin('product_orders', 'product_orders.order_id', '=', 'orders.id');
        $q = Contact::query();
        // $orderby = $orderby ? 'orders.' . $orderby : 'orders.id';
        // $order = $order ? $order : 'desc';
        // if ($search && !empty($search)) {
        //     $q->where(function ($query) use ($search) {

        //         $query->where('name', 'LIKE', '%' . $search . '%');
        //     });
        // }
        // if (isset($request['status']) && $request['status'] != '') {
        //     $q->where('orders.order_status', $request['status']);
        // }
        if (isset($request['stock_status']) && $request['stock_status'] != '') {
            $q->where('contact.status', $request['stock_status']);
        }
        // if (isset($request['payment_type']) && $request['payment_type'] != '') {
        //     $q->where('orders.payment_type', $request['payment_type']);
        // }
        // if (isset($request['dealer']) && $request['dealer'] != '') {
        //     $q->where('orders.dealer_id', $request['dealer']);
        // }

        if (isset($request['name']) && !empty($request['name'])) {
            $search_all = $request['name'];
            $q->where(function ($query) use ($search_all) {
                $query->Where('contact.name', 'LIKE', '%' . $search_all . '%');
            });
        }

        // if (isset($request['id_search']) && !empty($request['id_search'])) {
        //     $id_search = $request['id_search'];
        //     $q->where(function ($query) use ($id_search) {
        //         $query->where('orders.id', 'LIKE', '%' . $id_search . '%');
        //     });
        // }



        // if (isset($request['start_range']) && !empty($request['start_range']) && isset($request['end_range']) && !empty($request['end_range'])) {
        //     $start_range = $request['start_range'];
        //     $end_range = $request['end_range'];


        //     $q->whereBetween(DB::raw('DATE_FORMAT(orders.created_at, "%Y-%m-%d")'), [$start_range, $end_range]);
        // }

        // $response = $q->groupBy('product_orders.order_id')
        //     ->orderBy($orderby, $order);
        $response = $q;
        return $response;
    }

//     public function getData(Request $request)
// {
//     $q = Contact::query();

//     // Default ordering
//     $orderby = $request->orderby ? 'orders.' . $request->orderby : 'orders.id';
//     $order = $request->order ? $request->order : 'desc';

//     // Search by name
//     if ($search = $request->search) {
//         $q->where('name', 'LIKE', '%' . $search . '%');
//     }

//     // Filter by various criteria
//     $filters = [
//         'status' => 'orders.order_status',
//         'stock_status' => 'orders.order_status',
//         'payment_type' => 'orders.payment_type',
//         'dealer' => 'orders.dealer_id'
//     ];

//     foreach ($filters as $key => $column) {
//         if ($request->filled($key)) {
//             $q->where($column, $request->$key);
//         }
//     }

//     // Advanced search by customer name or phone
//     if ($name = $request->name) {
//         $q->where(function ($query) use ($name) {
//             $query->where(DB::raw("CONCAT(customers.first_name, ' ', customers.last_name)"), 'LIKE', '%' . $name . '%')
//                 ->orWhere('customers.phone', 'LIKE', '%' . $name . '%');
//         });
//     }

//     // Search by order ID
//     if ($idSearch = $request->id_search) {
//         $q->where('orders.id', 'LIKE', '%' . $idSearch . '%');
//     }

//     // Filter by date range
//     if ($request->filled(['start_range', 'end_range'])) {
//         $startRange = $request->start_range;
//         $endRange = $request->end_range;

//         $q->whereBetween('orders.created_at', [$startRange, $endRange]);
//     }

//     // Apply grouping and sorting
//     $response = $q->groupBy('product_orders.order_id')
//         ->orderBy($orderby, $order)
//         ->get();

//     return $response;
// }

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
            $s_data['payment_type'] = $request->input('payment_type');
            $s_data['id_search'] = $request->input('id_search');
            $s_data['dealer'] = $request->input('dealer');
            // $s_data['sub_category_id'] = $request->input('sub_category_name');

            $s_data['start_range'] = $request->input('start_range');
            $s_data['end_range'] = $request->input('end_range');



            $totaldata = $this->getData($search, $sortableColumns[$orderby], $order, $s_data);

            $totaldatas = $totaldata->get();
            $totaldata = $totaldatas->groupBy('customer_id')->map(function ($items, $key) {
                return $items->count();
            });
            $totaldata = $totaldata->sum();
            // $totaldata = $totaldata->count();
            $response = $this->getData($search, $sortableColumns[$orderby], $order, $s_data);
            // $response->whereBetween('devlopments.created_at', [$start_date, $end_date]);

            $response = $response->offset($start)->limit($limit)->orderBy('contact.id', 'desc')->get();
            if (!$response) {
                $data = [];
                $paging = [];
            } else {
                $data = $response;
                $paging = $response;
            }



            $datas = [];
            $i = 1;
            // echo "<pre>";
            // print_r($data);die;
            foreach ($data as $value) {
                $row['id'] = $start + $i;
               
                $row['name'] = $value->name;
                $row['email'] = $value->email;
                $row['phone'] = $value->phone;
                $row['message'] = $value->message;
                $row['status'] = '
                <div class="col-sm-2 form-group">
                    <select name="status[]" id="status_' . $value->id . '" 
                            class="form-control" 
                            onchange="updateStatus(' . $value->id . ', this.value)">
                        <option value="">Select Status</option>
                        <option value="1" ' . ($value->status == 1 ? 'selected' : '') . '>Pending</option>
                        <option value="2" ' . ($value->status == 2 ? 'selected' : '') . '>Complete</option>
                        <option value="3" ' . ($value->status == 3 ? 'selected' : '') . '>Cancelled</option>
                    </select>
                </div>';
                

$row['created_at'] = Carbon::parse($value->created_at)->format('Y-m-d'); // Format to only date (e.g., 2025-01-28)
// Format to only date

           
                // $edit = '';
                // // $edit = '<div class="table-actions"><a href="javascript:void(0)" onclick="addEditForm(' . $value->id . ')" data-toggle="tooltip" title="Edit"><i class="ik ik-edit-2 f-16 mr-1 text-green"></i></a> ';

                // // $edit = '<a href="javascript:void(0)" data-toggle="tooltip" data-bs-target="#addEditModal   title="Edit" onclick="updateItem(' . $value->id . ')"><i class="bx bx-edit f-16 mr-15 text-green"></i></a>';
                // $edit = '<a href="' . url('order/edit/' . base64_encode($value->id)) . '" " title="Edit" "><i class="bx bx-edit f-16 mr-15 text-green"></i></a>';



                $view = '';
                // $view = '<a href="javascript:void(0)" onclick="viewItem('.$value->id.')" data-toggle="tooltip" title="View"><i class="ik ik-eye f-16 text-green mr-1"></i></a> ';
                // if (Auth::user()->can('customer_view')) {

                $view = '<a href="' . url('inquiry/view/' . base64_encode($value->id)) . '" title="View" data-toggle="tooltip" data-bs-target="#viewModal   " title="View"><i class="bx bxs-show f-16 text-green mr-1"></i></a> ';

                // }
                // $delete = '';

                // $delete = '<a href="javascript:void(0)" data-bs-toggle="tooltip" title="Delete" onclick="deleteItem(' . $value->id . ')"><i class="bx bx-trash  f-16 text-red mr-1"></i></a>';





                $row['actions'] = '<div class="table-actions">' . $view . '</div>';

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
        // condition changed to listed only approved dealer and orderBY name ----- sarwan ---->
        $order_data = Order::select('*')->get();
        $total_order = Contact::count();
        $completed_order  = Contact::where('status', '2')->count();
        $pending_order  = Contact::where("status", '1')->count();

        $cancel_order  = Contact::where('status', '3')->count();


        $data = ['title' => ucfirst($this->title), 'label' => $this->routeLable, 'order' => $order_data, 'total_order' => $total_order, 'completed_order' => $completed_order, 'pending_order' => $pending_order, 'cancel_order' => $cancel_order];
        return view($this->page . '.list', $data);
    }
    //Load Datatable or list view file --------------------------------------------------------- End

    public function updateStatus(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
    
        if (!$id || !$status) {
            return response()->json(['message' => 'Invalid request'], 400);
        }
    
        $record = Contact::find($id);
        if ($record) {
            $record->status = $status;
            $record->save();
    
            return response()->json(['message' => 'Status updated successfully']);
        }
    
        return response()->json(['message' => 'Record not found'], 404);
    }
    

    public function create()
    {
        $data = array();
        //  $data['customer_address'] = CustomerAddress::select('id','name')->where('status','1')->whereNull('deleted_at')->get()
        $data['customer'] = Customer::select('id', 'first_name', 'phone')->where('status', '1')->whereNull('deleted_at')->orderBy('first_name', 'asc')->get();
        $data['products'] = Product::select('id', 'name')->where('status', '1')->whereNull('deleted_at')->orderBy('name', 'asc')->get();
        $data['orders'] =  array();
        $data['customers_add'] = array();
        return view('content/inquiry.add_product')->with($data);
    }
    //store data
    public function store(Request $request)
    {
        $rules = [
            'prdct_id' => 'required',
        ];
        $msg = [
            'prdct_id.required' => 'Product details are required.',
        ];


        $validator = Validator::make($request->all(), $rules, $msg);
        if ($validator->fails()) {
            $res = array('code' => 201, 'msg' => $validator->messages()->first());
            return json_encode($res);
        }
        // try {
        //if id found then update else insert
        if (isset($request->id) && $request->id > 0) {

            //update
            $item = Order::findOrFail($request->id);
            $item->created_by = "1";
            $item->customer_id = $request->customer_id;
            $item->mrp = $request->mrp;
            $item->customer_address_id = $request->customer_address;
            $item->customer_billingaddress_id = $request->customer_address;
            $item->discount = $request->discount;
            $item->coupon_id = $request->coupon_id;
            // $setting_data = CompanySetting::first();$setting_data->shipping_charges;
            $shipping_charges =  0;
            $item->shipping_charges = $shipping_charges;
            $item->total_amount = $request->total + $shipping_charges;
            $customer = Customer::select('*')->where('id', $request->customer_id)->first();
            $item->name =  $customer->first_name;
            $item->mobile_no = $customer->phone;
            //$item->gst_no = $request->meta_title;
            //$item->company_name = $request->meta_keyword;
            $item->save();
            $itemId = $item->id;


            /*
            *  Qty Update BY Pranav Raj 
            *
            */
            // for ($i = 0; $i < count($request->prdct_id); $i++) {
            //     $productOrders = ProductOrder::where('product_id', $request->prdct_id[$i])->first();
            //     $product_qty = Product::where('id', $request->prdct_id[$i])->first();

            //     if ($productOrders!== null && $product_qty!== null) {
            //         if ($productOrders->qty > $request->qty[$i]) {
            //             $productqty = $productOrders->qty - $request->qty[$i];
            //             $product_qty->stock_quantity =  $product_qty->stock_quantity + $productqty;
            //         } else {
            //             $productqty = $request->qty[$i] - $productOrders->qty;
            //             $product_qty->stock_quantity =  $product_qty->stock_quantity - $productqty;
            //         }

            //         $data_save = $product_qty->save();
            //     } else {
            //         // Handle the case when either $productOrders or $product_qty is null
            //         // You can log an error, throw an exception, or return an error message
            //     //    ("ProductOrder or Product not found for product ID: ". $request->prdct_id[$i]);
            //     }
            // }
            /*
            * End code Qty Update 
            */




            $productOrdersToDelete = ProductOrder::where('order_id', $itemId)->delete();
            for ($i = 0; $i < count($request->prdct_id); $i++) {
                $product = new ProductOrder();
                $product->order_id = $itemId;
                $product->customer_id = $request->customer_id;
                $product->product_id = $request->prdct_id[$i];
                $product->price = $request->mrp1[$i];
                $product->qty = $request->qty[$i];
                $product->total_price = $request->price[$i];
                $product->sub_total_price = $request->sub_total[$i];
                $product->cgst = Product::where('id', $request->prdct_id[$i])->value('cgst');
                $product->sgst = Product::where('id', $request->prdct_id[$i])->value('sgst');
                $product_prce = Product::where('id', $request->prdct_id[$i])->first();
                // $productOrders->mrp = $product_mrp->price;
                // $product->product_price = $product_prce->mrp;

                $product->save();
            }

            if ($item) {
                $res = array('code' => 200, 'msg' => 'Updated successfully');
            } else {
                $res = array('code' => 201, 'msg' => 'Failed! Try again');
            }
        } else {
            //store
            $item = new Order;
            $item->created_by = "1";
            $item->customer_id = $request->customer_id;
            $item->mrp = $request->mrp;
            $item->customer_address_id = $request->customer_address;
            $item->customer_billingaddress_id = $request->customer_address;
            $item->discount = $request->discount;
            $item->coupon_id = $request->coupon_id;
            // $setting_data = CompanySetting::first();$setting_data->shipping_charges;
            $shipping_charges =  0;
            $item->shipping_charges = $shipping_charges;
            $item->total_amount = $request->total + $shipping_charges;
            $customer = Customer::select('*')->where('id', $request->customer_id)->first();
            $item->name =  $customer->first_name;
            $item->mobile_no = $customer->phone;
            //$item->gst_no = $request->meta_title;
            //$item->company_name = $request->meta_keyword;
            $item->save();
            $itemId = $item->id;

            for ($i = 0; $i < count($request->prdct_id); $i++) {
                $product_qty = Product::where('id', $request->prdct_id[$i])->first();
                if ($product_qty->stock_quantity >= $request->qty[$i]) {
                    $product = new ProductOrder();
                    $product->order_id = $itemId;
                    $product->customer_id = $request->customer_id;
                    $product->product_id = $request->prdct_id[$i];
                    $product->price = $request->mrp1[$i];
                    $product->qty = $request->qty[$i];
                    $product->total_price = $request->price[$i];
                    $product->sub_total_price = $request->sub_total[$i];
                    $product->cgst = Product::where('id', $request->prdct_id[$i])->value('cgst');
                    $product->sgst = Product::where('id', $request->prdct_id[$i])->value('sgst');
                    $product_prce = Product::where('id', $request->prdct_id[$i])->first();
                    // $productOrders->mrp = $product_mrp->price;
                    // $product->product_price = $product_prce->mrp;

                    $product->save();
                } else {
                    return $res = array('code' => 201, 'msg' => 'No more stock of ' . $request->prdct_id[$i] . '! Try again');
                }


                $product_qty = Product::where('id', $request->prdct_id[$i])->first();
                if ($product_qty) {
                    $product_qty->stock_quantity = $product_qty->stock_quantity - $request->qty[$i];
                    $data_save = $product_qty->save();
                } else {
                    // handle the case where the product is not found
                }
            }

            if ($item) {
                $phone =  $customer->phone;
                $phone =  "9680588232";
                $template_name = 'new_order_place_notification_to_customer_';
                $text = "Hi! Your order with InfraHub is confirmed. Details: Order Number : " . $item->id . " . We'll notify you once it's shipped. Thank you for choosing us!";

                $post_fields = '{
                    "countryCode": "+91",
                    "phoneNumber": "' . $phone . '",
                    "callbackData": "some text here",
                    "type": "Template",
                    "template": {
                        "name": "' . $template_name . '",
                        "languageCode": "en",
                        "headerValues": [
                            "header_variable_value"
                        ],
                        "bodyValues": [
                            "' . $text . '"
                            
                        ]
                    }
                }';


                $res = array('code' => 200, 'msg' => 'Order added successfully');
            } else {
                $res = array('code' => 201, 'msg' => 'Failed! Try again');
            }
        }

        return json_encode($res);
    }
    //get by id
    public function get_by_id($id, Request $request)
    {

        try {
            $id = base64_decode($id);
            $data = array();
            $data['order'] = $order = Order::select('orders.*')->where('orders.id', $id)->first();
            $data['customers_add'] = CustomerAddress::select('*')->where('customer_id', $order->customer_id)->get();
            $data['orders'] = Order::select('orders.*', 'products.stock_quantity as stock_quantity', 'coupons.coupon_code as coupon_code', 'products.name as pname', 'products.id as pid', 'products.price as pprice', 'products.cgst as cgst', 'products.sgst as sgst', 'products.mrp as mrp', 'product_orders.total_price as pprice', 'product_orders.qty as pqty', 'product_orders.sub_total_price as ptotal_price')
                ->where('orders.id', $id)
                ->join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                ->join('products', 'products.id', '=', 'product_orders.product_id')
                ->leftjoin('coupons', 'coupons.id', '=', 'orders.coupon_id')
                ->get();
            // echo "<pre>";download_order_invoice
            // print_r($data11);die;
            $data['customer'] = Customer::select('id', 'first_name', 'phone')->where('status', '1')->whereNull('deleted_at')->get();
            $data['products'] = Product::select('id', 'name')->where('status', '1')->whereNull('deleted_at')->get();
            // return $data['orders'];die;
            return view('content.inquiry.add_product')->with($data);
        } catch (\Exception $e) {
            $res = array('code' => 201, 'msg' => 'Something went wrong! Try again' . $e);
        }
        return json_encode($res);
    }

    public function get_address(Request $request)
    {
        $id = $request->id;
        $data = CustomerAddress::select('*')->where('customer_id', $id)->get();
        // $res = array('code' => 201, 'msg' => 'Successfull', 'data' => $data);
        $res = '<option value="">Select Address</option>';
        if (count($data)) {
            foreach ($data as $value) {
                $res .= '<option value="' . $value->id . '" ' . ($value->is_default == "1" ? "selected" : "") . '>' . $value->address . "," . $value->city . "," . $value->state . "," . $value->pin_code . '</option>';
            }
        }
        $resdata = array('sub' => $res);
        return json_encode($resdata);
    }

    public function view($id, Request $request)
    {
    $id = base64_decode($id);
            $data = Contact::find($id);
            // dd($data);
            
            // $Id = Order::select('customer_id')->findorfail($id);
            // $customer_id = $Id->customer_id;
            // $data = array();
            // $data['order'] = $orders =  Order::select('orders.*', 'customers.first_name', 'customers.last_name', 'customers.image as profileImage', 'customers.email', 'customers.phone', 'customers.user_type')->join('customers', 'customers.id', 'orders.customer_id')->findOrFail($id);
            // $data['product_order'] = $p_orders = ProductOrder::select('product_orders.*', 'products.*', 'category.name as category_name')->join('products', 'products.id', 'product_orders.product_id')->join('category', 'category.id', 'products.category_id')->where('order_id', $id)->get();
            // $data['shipping_address'] = CustomerAddress::select('*')->where('id', $orders->customer_address_id)->first();
            // $data['billing_address'] = CustomerAddress::select('*')->where('id', $orders->customer_billingaddress_id)->first();
            // $data['total_order'] = Order::where('customer_id', $customer_id)->count();


            //    return print_r($data['total_order']);die;
            return view('content/inquiry/product_view', compact('data'));

        
        // return json_encode($res);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        try {
            $product = Order::findOrFail($id);
            $status =  $product->delete();

            if ($status === true) {
                return response()->json(['success' => 'Order deleted successfully', "status" => $status], 200);
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
        //print_r($request->all());die;
        // create user 
        $validator = Validator::make($request->all(), [
            'id'     => 'required',
            'value'     => 'required',
        ]);

        if ($validator->fails()) {
            $res = array('code' => 201, 'msg' => 'All fields reuired');
        }
        try {
            //if id found then update else insert
            if (isset($request->id) && $request->id > 0) {
                //update
                $item = Order::find($request->id);
                //update active/inactive status
                $item->status = $request->value;
                $item->save();
                if ($item) {
                    $res = array('code' => 200, 'msg' => 'Updated successfully');
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

    public function status_update(Request $request)
    {
        //print_r($request->all());die;
        // create user 
        $validator = Validator::make($request->all(), [
            'id'     => 'required',
            'value'     => 'required',
        ]);

        if ($validator->fails()) {
            $res = array('code' => 201, 'msg' => 'All fields reuired');
        }
        try {
            //if id found then update else insert
            if (isset($request->id) && $request->id > 0) {
                //update
                $item = Order::find($request->id);
                //update active/inactive status
                $item->status = $request->value;
                $item->save();
                if ($item) {
                    $res = array('code' => 200, 'msg' => 'Updated successfully');
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
    public function update_status1(Request $request)
    {
        //if id found then update else insert
        if (isset($request->id) && $request->id > 0) {
            //update
            $item = Order::find($request->id);
            //update active/inactive status
            $item->order_status = $request->status;
            $item->dispatched_date = $request->dispatchDate;

            $item->delivery_date = $request->deliveryDate;
            $item->note = $request->note;
            $item->update();



            // if (isset($request->delivery) && !empty($request->delivery)) {
            //     $item1 = ProductOrder::where('order_id', $request->id)
            //         ->update([
            //             'status' => $request->status,
            //             'deliver_date' => $request->delivery
            //         ]);
            // } else {
            //     $item1 = ProductOrder::where('order_id', $request->id)
            //         ->update([
            //             'status' => $request->status
            //         ]);
            // }


            if ($item) {
                $res = array('code' => 200, 'msg' => 'Updated successfully');
            } else {
                $res = array('code' => 201, 'msg' => 'Failed! Try again');
            }
        } else {
            $res = array('code' => 201, 'msg' => 'Failed! Try again');
        }

        return json_encode($res);
    }

    public function update_status2(Request $request)
    {

        //if id found then update else insert
        if (isset($request->id) && $request->id > 0) {
            //update
            $item = Order::find($request->id);
            //update active/inactive status
            $item->order_status = $request->status;
            $item->delivery_date = $request->deliveryDate;
            $item->dispatched_from = $request->dispatchedFrom;
            $item->dispatched_date = $request->dispatchDate;
            $item->exact_destination = $request->exactDestination;
            $item->vehicle_number = $request->vehicleNumber;
            $item->dispatch_number = $request->dispatchNo;
            $item->update();

            // For Cancel then Product Qty increase 
            if ($request->status == '5') {
                $p_order_item = ProductOrder::where('order_id', $request->id)->get();

                foreach ($p_order_item as $p_item) {
                    $product_qty = Product::where('id', $p_item->product_id)->first();
                    $product_qty->stock_quantity = $product_qty->stock_quantity + $p_item->qty;
                    $data_save = $product_qty->save();
                }
            }

            if (isset($request->deliveryDate) && !empty($request->deliveryDate)) {
                $item1 = ProductOrder::where('order_id', $request->id)
                    ->update([
                        'status' => $request->status,
                        'deliver_date' => $request->deliveryDate
                    ]);
            } else {
                $item1 = ProductOrder::where('order_id', $request->id)
                    ->update([
                        'status' => $request->status
                    ]);
            }


            if ($item) {
                $res = array('code' => 200, 'msg' => 'Updated successfully', 'item1' => $request->deliveryDate);
            } else {
                $res = array('code' => 201, 'msg' => 'Failed! Try again');
            }
        } else {
            $res = array('code' => 201, 'msg' => 'Failed! Try again');
        }

        return json_encode($res);
    }


    /**
     * product Order Status Update 
     */

    public function inquiry_status(Request $request)
    {



        try {
            $item = ProductOrder::find($request->id);
            if ($request->status == "5") {

                $product_qty = Product::where('id', $item->product_id)->first();
                $product_qty->stock_quantity = $product_qty->stock_quantity + $item->qty;
                $data_save = $product_qty->save();
            }
            //update active/inactive status
            $item->status = $request->status;

            if (isset($request->delivery)) {
                $item->deliver_date = $request->delivery;
            }

            $item->update();
            $current_status  =  $item->status;
            if ($item) {
                $res = array('code' => 200, 'status' => $current_status, 'msg' => 'Updated successfully');
            } else {
                $res = array('code' => 201, 'msg' => 'Failed! Try again');
            }
        } catch (\Exception $e) {
            $res = array('code' => 201, 'msg' => 'Something went wrong! Try again');
        }
        return json_encode($res);
    }





    public function product_detail(Request $request)
    {

        $id = $request->id;
        $data = Product::where('id', $id)->get();
        $resdata = array('data' => $data);
        return json_encode($resdata);
    }





    public function  coupon_code(Request $request)
    {
        $coupon_data = Coupon::select('*')->where('coupon_code', $request->coupon_code)->whereNull('deleted_at')->where('status', '1')->first();


        if (isset($coupon_data) && !empty($coupon_data)) {

            if ($request->mrp >= $coupon_data->min_amount && $request->mrp <= $coupon_data->max_amount) {
                if ($coupon_data->discount_type == "2") {

                    $resdata = array('coupon_data' => $coupon_data, 'code' => '200', 'msg' => "Coupon applied successfully", 'dis_amt' => $coupon_data->discount);
                } else {
                    // return '--------';
                    // die;
                    $dis_amount = ($request->mrp *  $coupon_data->discount) / 100;
                    $resdata = array('coupon_data' => $coupon_data, 'code' => '200', 'msg' => "Coupon applied successfully", 'dis_amt' => $dis_amount);
                }
            } else {
                $resdata = array('coupon_data' => $coupon_data, 'code' => '201', 'error' => "Coupon code not apply for this amount minimum Rs." . $coupon_data->min_amount, 'type' => 1);
            }
        } else {

            $resdata = array('coupon_data' => $coupon_data, 'code' => '201', 'error' => "Coupon code not found");
        }

        return json_encode($resdata);
    }
}
