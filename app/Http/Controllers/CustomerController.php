<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Country;
use App\Models\Order;
use App\Models\Whislist;
use Illuminate\Validation\Rule;
use Mail;
use App\Mail\CustomerMail;

use DataTables, Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    protected $title = 'Customer';
    protected $page = '/content/customer';
    protected $routeLable = 'customer';
    public function __construct(Request $request)
    {
        $this->model = new Customer();
        $this->sortableColumns = ['id', 'first_name', 'phone', 'status', '', 'created_at'];
    }
    public function getData($search = null, $orderby = null, $order = null, $request = null)
    {
        $q =    Customer::select('*');
        $orderby = $orderby ? $orderby : 'customers.id';
        $order = $order ? $order : 'desc';
        if ($search && !empty($search)) {
            $q->where(function ($query) use ($search) {
                $query->where('customers.name', 'LIKE', '%' . $search . '%')
                    ->where('customers.email', 'LIKE', '%' . $search . '%')
                    ->where('customers.phone', 'LIKE', '%' . $search . '%');
            });
        }
        if (isset($request['status']) && $request['status'] != '') {
            $q->where('customers.status', $request['status']);
        }
        if (isset($request['type']) && $request['type'] != '') {
            $q->where('customers.user_type', $request['type']);
        }
        if (isset($request['name']) && !empty($request['name'])) {
            $search_terms = explode(' ', $request['name']); // split the search query into individual words
            $q->where(function ($query) use ($search_terms) {
                foreach ($search_terms as $term) {
                    $query->where(function ($subQuery) use ($term) {
                        $subQuery->where('customers.first_name', 'LIKE', '%' . $term . '%')
                            ->orWhere('customers.last_name', 'LIKE', '%' . $term . '%')
                            ->orWhere('customers.phone', 'LIKE', '%' . $term . '%')
                            ->orWhere('customers.email', 'LIKE', '%' . $term . '%');
                    });
                }
            });
        }

        if (isset($request['start_range']) && !empty($request['start_range']) && isset($request['end_range']) && !empty($request['end_range'])) {
            $start_range = $request['start_range'];
            $end_range = $request['end_range'];


            $q->whereBetween(DB::raw('DATE_FORMAT(customers.created_at, "%Y-%m-%d")'), [$start_range, $end_range]);
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

            // $end_date = ($request->get('end_date')) ? date('Y-m-d 23:59:59', strtotime($request->get('end_date'))) : date('Y-m-d 23:59:59');

            $s_data = array();
            $s_data['status'] = $request->input('status');
            $s_data['name'] = $request->input('name');
            // $s_data['name'] = $request->input('first_name') . $request->input('last_name');
            $s_data['start_range'] = $request->input('start_range');
            $s_data['end_range'] = $request->input('end_range');
            $s_data['type'] = $request->input('type');

            $totaldata = $this->getData($search, $sortableColumns[$orderby], $order, $s_data);

            $totaldata = $totaldata->count();
            $response = $this->getData($search, $sortableColumns[$orderby], $order, $s_data);
            // $response->whereBetween('devlopments.created_at', [$start_date, $end_date]);

            $response = $response->offset($start)->limit($limit)->orderBy('customers.id', 'desc')->get();
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
                $row['name'] = $value->first_name . ' ' . $value->last_name;
                $row['email'] = $value->email;
                $row['phone'] = $value->phone;

                $row['user_type'] = ucfirst($value->user_type);




                if (Auth::user()->can('customer_edit')) {
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

                $row['created_at'] =  date("d-m-Y ", strtotime($value->created_at));

                $edit = '';
                // $edit = '<div class="table-actions"><a href="javascript:void(0)" onclick="addEditForm(' . $value->id . ')" data-toggle="tooltip" title="Edit"><i class="ik ik-edit-2 f-16 mr-1 text-green"></i></a> ';
                if (Auth::user()->can('customer_edit')) {
                    // $edit = '<a href="javascript:void(0)" data-toggle="tooltip" data-bs-target="#addEditModal   title="Edit" onclick="updateItem(' . $value->id . ')"><i class="bx bx-edit f-16 mr-15 text-green"></i></a>';
                    $edit = '<a href="javascript:void(0)" onclick="updateItem(' . $value->id . ')" class="table-actions"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><i class="bx bx-edit f-16 mr-15 text-green"></i></a>';
                }

                $view = '';
                // $view = '<a href="javascript:void(0)" onclick="viewItem('.$value->id.')" data-toggle="tooltip" title="View"><i class="ik ik-eye f-16 text-green mr-1"></i></a> ';
                // if (Auth::user()->can('customer_view')) {
                $view = '<a href="' . url('customer/view/' . $value->id) . '" data-toggle="tooltip" data-bs-target="#viewModal   " title="View"><i class="bx bxs-show f-16 text-green mr-1"></i></a> ';
              
$password = '';
if (Auth::user()->can('customer_edit')) {
$password = '<a href="javascript:void(0)" onclick="updatePassword(' . $value->id . ')" class="table-actions" >  <i class="bx bx-pencil f-16 text-green mr-1"></i></a>';

}
                // }
                $delete = '';
                if (Auth::user()->can('customer_delete')) {
                    $delete = '<a href="javascript:void(0)" data-toggle="tooltip" title="Delete" onclick="deleteItem(' . $value->id . ')"><i class="bx bx-trash  f-16 text-red mr-1"></i></a>';
                }

                // if (Auth::user()->can('invoice_quotation')) {
                // $qt = '<a href="'.url('invoice-quotation?c='.$value->id).'" data-toggle="tooltip" title="Quotation"><i class="fas fa-file f-16 text-red mr-1"></i></a>';
                // }
                $row['actions'] = '<div class="table-actions">' . $view . $edit . $password . $delete . '</div>';

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
        $total_users = Customer::count();

        if ($total_users > 0) {
            $active_users = Customer::where('status', '1')->count();
            $active_percentage = number_format(($active_users / $total_users) * 100, 2) . '%';
            $inactive_users = Customer::where('status', '2')->count();
            $inactive_percentage = number_format(($inactive_users / $total_users) * 100, 2) . '%';
        } else {

            $active_percentage = '0%';
            $inactive_percentage = '0%';
        }


        $data = [
            'title' => ucfirst($this->title),
            'label' => $this->routeLable,
            'total_users' => $total_users ?? 0,
            'active_percentage' => $active_percentage ?? 0,
            'active_users' => $active_users ?? 0,
            'inactive_users' => $inactive_users ?? 0,
            'inactive_percentage' => $inactive_percentage ?? 0,
        ];

        return view($this->page . '.list', $data);
        // } catch (\Exception $e) {
        //     if ($request->ajax()) {
        //     return abort(500, 'Server Error');
        //     }
        //     return 'Server Error';
        // }
    }
    //Load Datatable or list view file --------------------------------------------------------- End

    //Load create view file --------------------------------------------------------- Start
    public function create()
    {
        $data = array();
        return view('customer.add_customer')->with($data);
    }
    //Load create view file --------------------------------------------------------- End
    // function for store address ----->


    public function address(Request $request)
    {
        // return $request->all();die;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'state' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'pin' => 'required|numeric', // note: I changed "number" to "numeric"
            'phone' => 'required|numeric', // note: I changed "number" to "numeric"
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $item_customer = new CustomerAddress;
            $item_customer->address = $request->address;
            $item_customer->pin_code = $request->pin;
            $item_customer->city = $request->city;
            $item_customer->state = $request->state;
            $item_customer->country = $request->country;
            $item_customer->customer_id = $request->id;
            $item_customer->mobile_number = $request->phone;
            $item_customer->full_name = $request->name;
            if (isset($request->bill) && $request->bill == 'on') {
                $item_customer->is_billingtype = "2";
            }
            $item_customer->save();
        }
        if ($item_customer) {
            $res = array('code' => 200, 'msg' => 'Added successfully');
        }
        return json_encode($res);
    }

    // add address end 

    // function for update customer password --->

    public function password_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8', // note: I changed "number" to "numeric"
            // 'confirm_password' => 'required|min:8', // note: I changed "number" to "numeric"
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $find_customer  = Customer::find($request->id);
            if ($find_customer) {
                $find_customer->password = $request->password;
            }
            $find_customer->save();
        }
        if ($find_customer) {
            $res = array('code' => 200, 'msg' => 'Password updated successfully');
        }
        return json_encode($res);
    }

    //store data
    public function store(Request $request)
    {


        // create 
        $rules = [
            'first_name' => 'required | string ',
            'last_name' => 'required | string ',
            'phone' => 'required',
            'image' => 'mimetypes:image/jpeg,image/png,image/gif',
            'email' => 'required|email',
            'user_type' => 'required'
        ];
        $msg = ['phone' => 'The phone number has already been taken.'];
        if (isset($request->id) && $request->id > 0) {
            // if($request->phone){
            //     $rules['phone']= 'required|digits:10|unique:customers,phone,' . $request->id . ',id,deleted_at,NULL';
            // }

            // if ($request->phone) {
            //     $rules['phone'] = [
            //         'required',
            //         'digits:10',
            //         Rule::unique('customers', 'phone')
            //             ->where('id','!=',$request->id)
            //             ->whereNull('deleted_at'),
            //     ];
            // }
            $validator = Validator::make($request->all(), $rules, $msg);
        } else {
            if ($request->phone) {
                $rules['phone'] = 'required|digits:10|unique:customers,phone,0,id,deleted_at,NULL';
            }
            $validator = Validator::make($request->all(), $rules, $msg);
        }

        if ($validator->fails()) {
            $res = array('code' => 201, 'msg' => $validator->messages()->first());
            return json_encode($res);
        }
        // try {
        //if id found then update else insert
        if (isset($request->id) && $request->id > 0) {

            //update
            $item = Customer::select('*')->where('id', $request->id)->first();
            $item->password = Hash::make($request->password);
            $item->first_name = $request->first_name;
            $item->last_name = $request->last_name;
            $item->gender = $request->gender;
            $item->email = $request->email;
            $item->user_type = $request->user_type;
            $item->phone = $request->phone;
            if ($profile_image = $request->file('image')) {
                $destination_path = 'uploads/customer_profile_img';
                $source_path = $profile_image;
                $file_name = image_upload_public($source_path, $destination_path);
                $item->image = $file_name;
            }
            $item->save();

            if ($item) {
                $res = array('code' => 200, 'msg' => 'Updated successfully');
            } else {
                $res = array('code' => 201, 'msg' => 'Failed! Try again');
            }
        } else {
            //store
            $password = $request->password;
            $item = new Customer;
            $item->password = Hash::make($request->password);
            $item->first_name = $request->first_name;
            $item->last_name = $request->last_name;
            $item->gender = $request->gender;
            $item->email = $request->email;
            $item->user_type = $request->user_type;
            $item->phone = $request->phone;
            if ($profile_image = $request->file('image')) {
                $destination_path = 'uploads/customer_profile_img';
                $source_path = $profile_image;
                $file_name = image_upload_public($source_path, $destination_path);
                $item->image = $file_name;
            }
            $item->save();

            if ($item) {
                Mail::to($item->email)->send(new CustomerMail($item, $password));
                $res = array('code' => 200, 'msg' => 'Added successfully');
            } else {
                $res = array('code' => 201, 'msg' => 'Failed! Try again');
            }
        }
        return json_encode($res);
    }


    // function for delete customer added address --- >sarwan 

    public function delete_address(Request $request)
    {
        $address_id = $request->address_id;
        $find_address = CustomerAddress::findorfail($address_id);
        $find_address->delete();
        $res = array('code' => 200, 'msg' => 'Address deleted successfully');
        return json_encode($res);
    }

    //get by id
    public function get_by_id(Request $request)
    {
        $id =  $request->id;

        try {
            $data = array();
            $data['customer_detail'] = $customer_detail = Customer::select('customers.*', 'customer_addresses.id as cid', 'customer_addresses.type', 'customer_addresses.address', 'customer_addresses.city', 'customer_addresses.state', 'customer_addresses.pin_code')
                ->leftjoin('customer_addresses', 'customers.id', '=', 'customer_addresses.customer_id')
                ->where('customers.id', $id)
                ->first();

            // return view('/content/customer/list')->with($data);
            $res = array('code' => 200, 'data' => $data);
        } catch (\Exception $e) {
            $res = array('code' => 201, 'msg' => 'Something went wrong! Try again' . $e);
        }
        return json_encode($res);
    }
    public function get_by_id_pass(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
        $password = $request->password;
    
        try {
            // Find the customer
            $customer = Customer::find($id);
    
            if (!$customer) {
                return response()->json(['code' => 404, 'msg' => 'Customer not found.']);
            }
    
            // Update the password, make sure to hash it
            $customer->password = bcrypt($password);
            $customer->save();
    
            $res = array('code' => 200, 'msg' => 'Password updated successfully!');
        } catch (\Exception $e) {
            $res = array('code' => 500, 'msg' => 'Something went wrong! Try again. Error: ' . $e->getMessage());
        }
    
        return response()->json($res);
    }
    
    public function view($id, Request $request)
    {

        $data = array();
        $data['countries']  =  Country::where('is_deleted', '0')->get();
        $data['whislist_count']  =  Whislist::where('user_id', $id)->count();
        $data['whislist_count']  =  Whislist::where('user_id', $id)->whereNull('deleted_at')->count();
        $data['address_count']  =  CustomerAddress::where('customer_id', $id)->whereNull('deleted_at')->count();
        $data['orders_count'] = Order::where('customer_id', $id)->count();
        $data['total_orders'] = Order::where('customer_id', $id)->get();

        $data['total_spent'] =  Order::where('customer_id', $id)->sum('total_amount');
        $data['customer_detail'] = $customer_detail = Customer::select('customers.*')->findOrFail($id);
        $data['address_details'] = CustomerAddress::select('customer_addresses.*', 'country.country_name as country_name')->join('country', 'customer_addresses.country', '=', 'country.id')->where('customer_id', $id)->get();
        $data['address_default'] = CustomerAddress::select('customer_addresses.*',)->where('customer_id', $id)->where('is_default', '1')->first();
        // print_r($data['address_default']);die;
        return view('content/customer/view')->with($data);
    }

    //update status
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
            if (isset($request->id) && $request->id > 0) {
                $item = Customer::find($request->id);
                if (isset($request->type) && $request->type == 'status') {
                    if ($request->value == "1") {
                        $item->status = '1';
                    } else {
                        $item->status = '2';
                        Auth::guard('local')->logout($item);
                       
                    }
                }
                $item->save();
                if ($item) {
                    if (isset($request->type) && $request->type == 'status') {
                        if ($request->value == "1") {
                        }
                        $res = array('code' => 200, 'msg' => 'Status Updated successfully');
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

    public function delete(Request $request)
    {
        $id = $request->id;
        try {
            $customer = Customer::findOrFail($id);
            $status =  $customer->delete();

            if ($status === true) {
                return response()->json(['success' => 'Customer deleted successfully', "status" => $status], 200);
            } else {
                return response()->json(['error' => 'Something went wrong', "status" => $status], 201);
            }
        } catch (Throwable $e) {
            report($e);
            return response()->json(['error' => 'Something went wrong']);
        }
    }
}
