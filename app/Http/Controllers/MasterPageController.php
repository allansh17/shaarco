<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\MasterPage;
use DataTables, Auth;

class MasterPageController extends Controller
{

    public function __construct(Request $request)
    {
        $this->model = new MasterPage();
        $this->sortableColumns = ['id','title','status','created_at'];
    }


    public function index()
    {
        return view('content/master_page/list');
    }

    
    //list of email template
    public function list(Request $request) {
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

            $search_data['name_s'] = $request->input('name');

            $totaldata = $this->getData($search, $sortableColumns[$orderby], $order,$search_data );

            $totaldata = $totaldata->count();
            $response = $this->getData($search, $sortableColumns[$orderby], $order,$search_data );
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
                $row['title'] = ucfirst($value->title);
                $row['meta_title'] = ucfirst($value->meta_title);

                $val = '';
  
                    $val .= '<label class="switch">
                                    <input class="status-checkbox" type="checkbox" ' . ($value->status == '1' ? 'checked' : '') . ' data-id=' . $value->id . '>
                                    <span class="slider round"></span>
                            </label>';
          
            $row['status'] = $val;
            $row['created_at'] = date('d-m-Y', strtotime($value->created_at));

               
              
                $status = '';
                    $status .= '<div class="table-actions">';
                  
                     
                            $status = '<a href="" onclick="updateItem(' . $value->id . ')" title="Edit"   data-bs-toggle="offcanvas" data-bs-target="#addEditModal"><i class="bx bx-edit f-16 me-1 text-green"></i></a>';
                         
                             
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

    
    public function getData($search = null  ,$orderby = null, $order = null,$request = null)
    {
        $q = MasterPage::where('id','!=','0');
        // print_r($q);die;
        $orderby = $orderby ? $orderby : 'created_at';
        $order = $order ? $order : 'desc';

        if (isset($request['status']) && !empty($request['status'])) {
            $q->where(function ($query) use ($request) {
                $query->where('status', $request['status']);
            });
        }
        if (isset($request['name_s']) && !empty($request['name_s'])) {
            $q->where(function ($query) use ($request) {
                $query->where('title', 'LIKE', '%' . $request['name_s'] .'%');
            });
        }

        $response = $q->orderBy($orderby, $order);
        return $response;
    }

    //store data
    public function store(Request $request)
    {
        // print($request->description);
        // print($request->title);
        // die;
        // set validation rule
        if (isset($request->id) && $request->id > 0) {
            $validator = Validator::make($request->all(), [
                'title'     => 'required | string | unique:master_pages,title,' . $request->id . ',id,deleted_at,NULL',
                'description'  => 'required',
            ],[
                'description.required' => 'Page body field is required.',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'title'     => 'required | string | unique:master_pages,title,0,deleted_at,NULL',
                'description'  => 'required',
            ],[
                'description.required' => 'Page body field is required.',
            ]);
        }

        if ($validator->fails()) {
            $res = array('code' => 201, 'msg' => $validator->messages()->first());
            return json_encode($res);
        }
        try {
            //if id found then update else insert
            if (isset($request->id) && $request->id > 0) {
                //update
                $item = MasterPage::find($request->id);
                $item->title = $request->title;
                $item->meta_title = $request->meta_title;
                $item->meta_keyword = $request->meta_keyword;
                $item->meta_description = $request->meta_description;
                $item->description = $request->description;
                
                if ($image = $request->file('img')) {
                    $destination_path = 'uploads/page';
                    $source_path = $image;
                    $file_name = image_upload_public($source_path, $destination_path);
                    $item->image = $file_name;
                    // ImageResize($file_name, $destination_path, 'small', 500, 500);
                }
                
                $item->save();
                if ($item) {
                    $res = array('code' => 200, 'msg' => 'Updated successfully');
                } else {
                    $res = array('code' => 201, 'msg' => 'Failed! Try again');
                }
            } else {
                //store
                $item = new MasterPage;
                $item->title = $request->title;
                $item->meta_title = $request->meta_title;
                $item->meta_keyword = $request->meta_keyword;
                $item->meta_description = $request->meta_description;
                $item->description = $request->description;
                $item->status = '1';
                
                if ($image = $request->file('img')) {
                    $destination_path = 'uploads/page';
                    $source_path = $image;
                    $file_name = image_upload_public($source_path, $destination_path);
                    $item->image = $file_name;
                    // ImageResize($file_name, $destination_path, 'small', 500, 500);
                }
                
                $item->save();
                if ($item) {
                    $res = array('code' => 200, 'msg' => 'Added successfully');
                } else {
                    $res = array('code' => 201, 'msg' => 'Failed! Try again');
                }
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
        
            // Debugging line
            // dd($bug); // Uncomment this line to see the error immediately
        
            // Log the error for later review
            \Log::error('Error in MasterPage operation: ' . $bug);
        
            $res = array('code' => 201, 'msg' => 'Something went wrong! Try again', 'error' => $bug);
        }
        return json_encode($res);
    }

    //get by id
    public function get_by_id(Request $request)
    {
        try {
            $item  = MasterPage::find($request->id);
            // echo '<pre>';
            // print_r($item);
            // die;
            $config = '';
           
            //   $config_val =  config('constants.email_variables.'.$request->id);
            
            $res = array('code' => 200, 'data' => $item);
        } catch (\Exception $e) {
            $res = array('code' => 201, 'msg' => 'Something went wrong! Try again');
        }
        return json_encode($res);
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
                $item = MasterPage::find($request->id);
                //update delete value
                if (isset($request->type) && $request->type == 'delete') {
                    $item->delete = $request->value;
                }
                //update active/inactive status
                if (isset($request->type) && $request->type == 'status') {
                    $item->status = $request->value;
                }
                $item->save();
                if ($item) {
                    if (isset($request->type) && $request->type == 'delete') {
                        $res = array('code' => 200, 'msg' => 'Deleted successfully');
                    } else {
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
}
