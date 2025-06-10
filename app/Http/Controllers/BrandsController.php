<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Faq;
use App\Models\Category;
use App\Models\Brands;
use Illuminate\Support\Str;
use DataTables, Auth;

class BrandsController extends Controller
{
    public function __construct(Request $request)
    {
        $this->model = new Brands();
        $this->sortableColumns = ['id', 'name', 'status', 'created_at'];
    }

    public function index()
    {
        $Category = Brands::whereNull('deleted_at')->get();
         $categoryss  = Category::orderBy('name', 'asc')->get();
        return view('content/brands/list', compact('Category','categoryss'));
    }

    //list of email template
    public function list(Request $request)
    {
        $limit = $request->input('length');
        $start = $request->input('start');
        $search = $request['search']['value'];
        $orderby = $request['order']['0']['column'];
        $order = $orderby != "" ? $request['order']['0']['dir'] : "";
        $draw = $request['draw'];
        $sortableColumns = $this->sortableColumns;

        $search_data = array();
        $search_data['status'] = $request->input('status');
        // $search_data['type'] = $request->input('type');

        $search_data['name'] = $request->input('name');

        $totaldata = $this->getData($search, $sortableColumns[$orderby], $order, $search_data);

        $totaldata = $totaldata->count();
        $response = $this->getData($search, $sortableColumns[$orderby], $order, $search_data);
        $response = $response->offset($start)->limit($limit)->orderBy('id', 'desc')->get();
        if (!$response) {
            $data = [];
            $paging = [];
        } else {
            $data = $response;
            $paging = $response;
        }

        $datas = [];
        //print_r($data);die;
        $i = 1;
        foreach ($data as $value) {
            $row['id'] = $start + $i;
            $row['name'] = ucfirst($value->name);

            $val = '';
            if (auth()->user()->can('master_edit_faqs')) {
                $val .= '<label class="switch">
                                    <input class="status-checkbox" type="checkbox" ' . ($value->status == '2' ? 'checked' : '') . ' data-id=' . $value->id . '>
                                    <span class="slider round"></span>
                            </label>';
            } else {
                $val .= '<label class="switch">
                                    <input disabled type="checkbox" ' . ($value->status == '2' ? 'checked' : '') . ' data-id=' . $value->id . '>
                                    <span class="slider round"></span>
                            </label>';
            }
            $row['status'] = $val;
            $row['image'] = '<div class="table_img_"><img src="/uploads/Brands/' . $value->image . '" alt="Image"></div>';
            $row['created_at'] = date('d-m-Y', strtotime($value->created_at));



            $status = '';
            $status .= '<div class="table-actions">';


            $status = '<a href="" onclick="updateItem(' . $value->id . ')" title="Edit"   data-bs-toggle="offcanvas" data-bs-target="#addEditModal"><i class="bx bx-edit f-16 me-1 text-green"></i></a>';
            // $status .= '<a href="javascript:void(0)" data-toggle="tooltip" title="Edit" onclick="updateItem(' . $value->id . ')"><i class="bx bx-edit f-16 mr-15 text-green me-1"></i></a>';



            // $status = '<a href="" onclick="viewItem(' . $value->id . ')" class="table-actions"  data-bs-toggle="offcanvas" data-bs-target="#viewModal"><i class="bx bxs-happy-heart-eyes f-16 text-green"></i></a>';
            // $status .= '<a href="javascript:void(0)" title="View"  onclick="viewItem(' . $value->id . ')" data-bs-toggle="offcanvas" data-bs-target="#viewModal"><i class="bx bxs-happy-heart-eyes f-16 text-green"></i></a> ';

            $status .= '<a href="javascript:void(0)" data-toggle="offcanvas" title="Delete" onclick="deleteItem(' . $value->id . ')"><i class="bx bx-trash  f-16 text-red "></i></a>';


            $status .= '</div>';
            $row['action'] = $status;
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


    public function getData($search = null, $orderby = null, $order = null, $request = null)
    {
        $q = Brands::where('id', '!=', '0');
        // print_r($q);die;
        $orderby = $orderby ? $orderby : 'created_at';
        $order = $order ? $order : 'desc';

        if ($search && !empty($search)) {
            $q->where(function ($query) use ($search) {
                $query->where('brands.name', 'LIKE', '%' . $search . '%');
            });
        }
        if (isset($request['status']) && !empty($request['status'])) {
            $q->where(function ($query) use ($request) {
                $query->where('status', $request['status']);
            });
        }
        if (isset($request['name']) && !empty($request['name'])) {
            $q->where(function ($query) use ($request) {
                $query->where('brands.name', 'LIKE', '%' . $request['name'] . '%');
            });
        }

        $response = $q->orderBy($orderby, $order);
        return $response;
    }


    //store data
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|string|alpha',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',

        ];
        if ($request->id) { // editing an existing record
            $rules['image'] = 'image|mimes:jpg,jpeg,png'; // remove the required rule
        } else { // creating a new record
            $rules['image'] = 'nullable|image|mimes:jpg,jpeg,png';
        }
        $msg = ['name.unique' => 'The brands has already been taken.'];

        if (isset($request->id) && $request->id > 0) {
            $rules['name'] = 'required|unique:brands,name,' . $request->id . ',id,deleted_at,NULL';
            $validator = Validator::make($request->all(), $rules, $msg);
        } else {
            $rules['name'] = 'required|unique:brands,name,NULL,id,deleted_at,NULL';
            $validator = Validator::make($request->all(), $rules, $msg);
        }


        if ($validator->fails()) {
            $res = array('code' => 201, 'msg' => $validator->messages()->first());
            return json_encode($res);
        }
        try {
            //if id found then update else insert
            if (isset($request->id) && $request->id > 0) {
                //update
                $item = Brands::find($request->id);
                $item->name = $request->name;
                $item->slug = Str::slug($request->name);
                if ($profile_image = $request->file('image')) {
                    $destination_path = 'uploads/Brands';
                    $source_path = $profile_image;
                    $file_name = image_upload_public($source_path, $destination_path);
                    $item->image = $file_name;
                }

                $item->save();
                
                // Sync categories
                if ($request->has('category') && is_array($request->category)) {
                    $item->categories()->sync($request->category);
                }

                if ($item) {
                    $res = array('code' => 200, 'msg' => 'Updated successfully');
                } else {
                    $res = array('code' => 201, 'msg' => 'Failed! Try again');
                }
            } else {
                //store
                $item = new Brands;
                $item->name = $request->name;
                $item->slug = Str::slug($request->name);
                if ($profile_image = $request->file('image')) {
                    $destination_path = 'uploads/Brands';
                    $source_path = $profile_image;
                    $file_name = image_upload_public($source_path, $destination_path);
                    $item->image = $file_name;
                }
                $item->status = '2';
                $item->save();

                // Attach categories
                if ($request->has('category') && is_array($request->category)) {
                    $item->categories()->attach($request->category);
                }

                if ($item) {
                    $res = array('code' => 200, 'msg' => 'Added successfully');
                } else {
                    $res = array('code' => 201, 'msg' => 'Failed! Try again');
                }
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            $res = array('code' => 201, 'msg' => 'Something went wrong! Try again' . $e);
        }
        return json_encode($res);
    }

    public function get_by_id(Request $request)
    {
        try {
            $item = Brands::find($request->id);
            //   echo "<pre>";
            //   print_r($item) ; die ;
            $res = array('code' => 200, 'data' => $item);
        } catch (\Exception $e) {
            $res = array('code' => 201, 'msg' => 'Something went wrong! Try again');
        }
        return json_encode($res);
    }


    public function delete(Request $request)
    {
        $id = $request->id;
        try {
            $banner = Brands::findOrFail($id);
            $status =  $banner->delete();

            if ($status === true) {
                return response()->json(['success' => 'Deleted successfully', "status" => $status], 200);
            } else {
                return response()->json(['error' => 'Something went wrong', "status" => $status], 201);
            }
        } catch (Throwable $e) {
            report($e);
            return response()->json(['error' => 'Something went wrong']);
            // return "Something went wrong";
        }
    }

    //store new data
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
                $item = Brands::find($request->id);
                // print_r($item);die;
                //update active/inactive status
                if (isset($request->type) && $request->type == 'status') {
                    // echo '=-----';die;
                    if ($request->value == "1") {
                        $item->status = '2';
                    } else {
                        $item->status = '1';
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
};
