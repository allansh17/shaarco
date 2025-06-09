<?php


namespace App\Http\Controllers;

use App\Models\ad;
use DataTables, Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AdController extends Controller
{
    protected $title = 'ad';
    //this variable use for blade file path 
    protected $page = 'content/ad';
    //this variable use for route prefix and view folder 
    protected $routeLable = 'ad';

    public function __construct(Request $request)
    {
        $this->model = new ad();
        $this->sortableColumns = ['id', 'title', 'link', 'status', 'customer_type', 'published_status', 'start_date', 'end_date'];
    }
    //get data from database for dat table --------------------------------------------------------- Strat
    public function getData($search = null, $orderby = null, $order = null, $request = null)
    {
        $q =    ad::select('*');
        //  print_r($q);die;
        $orderby = $orderby ? $orderby : 'ads.id';
        $order = $order ? $order : 'desc';
        if ($search && !empty($search)) {
            $q->where(function ($query) use ($search) {
                $query->where('ads.title', 'LIKE', '%' . $search . '%');
            });
        }
        if (isset($request['title']) && $request['title'] != '') {
            $q->where('ads.title', 'LIKE', '%' . $request['title'] . '%');
        }
        if (isset($request['customer_type']) && $request['customer_type'] != '') {
            $q->whereIn('ads.customer_type', [$request['customer_type'], 'all']);
        }
        if (isset($request['status']) && $request['status'] != '') {
            $q->where('ads.published_status', $request['status']);
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

            $s_data = array();
            $s_data['status'] = $request->input('status');
            $s_data['title'] = $request->input('title');
            $s_data['customer_type'] = $request->input('customer_type');




            $totaldata = $this->getData($search, $sortableColumns[$orderby], $order, $s_data);

            $totaldata = $totaldata->count();
            $response = $this->getData($search, $sortableColumns[$orderby], $order, $s_data);
            // $response->whereBetween('devlopments.created_at', [$start_date, $end_date]);

            $response = $response->offset($start)->limit($limit)->orderBy('ads.id', 'desc')->get();
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
                $row['title'] = $value->title;
                // $row['link'] = $value->link;


                if (Auth::user()->can('master_edit_blog')) {
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
                if ($value->published_status == 1) {
                    $row['published_status'] =  'Published';
                } else if ($value->published_status == 2) {
                    $row['published_status'] =  'Unpublished';
                }

                if ($value->customer_type == 'all') {
                    $row['customers'] =  'All Customers';
                } else if ($value->customer_type == 'normal') {
                    $row['customers'] =  'Normal';
                } else if ($value->customer_type == 'loyal') {
                    $row['customers'] =  'Loyal';
                } else if ($value->customer_type == 'wholesaler') {
                    $row['customers'] =  'Wholesaler';
                }

                $row['start_date'] =  date("d-m-Y", strtotime($value->start_date));
                $row['end_date'] =  date("d-m-Y", strtotime($value->end_date));
                $row['image'] = '<div class="table_img_"><img src="/uploads/ad_image/' . $value->image . '" alt="Image"></div>';

// dd($value->image);
// exit;
                $edit = '';

                // $edit = '<a href="javascript:void(0)" data-toggle="tooltip" data-bs-target="#addEditModal   title="Edit" onclick="updateItem(' . $value->id . ')"><i class="bx bx-edit f-16 mr-15 text-green"></i></a>';
                $edit = '<a href="javascript:void(0)" onclick="updateItem(' . $value->id . ')" class="table-actions"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><i class="bx bx-edit f-16 mr-15 text-green"></i></a>';


                $view = '';

                $view = '<a href= "javascript:void(0)" onclick="viewItem(' . $value->id . ')" class="table-actions" data-bs-toggle="offcanvas" data-bs-target="#viewModal   " title="View"><i class="bx bxs-show f-16 text-green mr-1"></i></a> ';

                $delete = '';

                $delete = '<a href="javascript:void(0)" data-toggle="tooltip" title="Delete" onclick="deleteItem(' . $value->id . ')"><i class="bx bx-trash  f-16 text-red mr-1"></i></a>';

                $row['actions'] = '<div class="table-actions">' . $view . $edit . $delete . '</div>';

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
        $publishstatus = ad::groupBy('published_status')->get();
        $data = ['title' => ucfirst($this->title), 'label' => $this->routeLable, 'published_status' => $publishstatus];
        return view($this->page . '.list', $data);
    }

    public function create()
    {
        $data = array();
        return view('content/blog.add_blog')->with($data);
    }

    // }
    public function store(Request $request)
    {
        //     $file = $request->file('image');
        // $mimeType = $file->getMimeType();
        // echo $mimeType;die;
        // create

        $rules = [
            // 'title' => 'required|string',
            // 'link' => 'required',
            // 'date' => 'required',
            'published_status' => 'nullable',
            'user_type' => 'nullable',
            'image' => 'required|mimetypes:image/*,video/*',
            
        ];
        $msg = [
            // 'title.unique' => 'The title has already been taken.',
            'image.mimetypes' => 'ad Image/Video must be a JPG, JPEG,  PNG or VIDEO file.',
            // 'image.dimensions'=>'The image must be exactly 700 pixels wide and 400 pixels tall',

        ];

        if (isset($request->id) && $request->id > 0) {
            $rules['image'] = 'nullable|mimetypes:image/*,video/*';

            // $rules['title'] = 'required';

            $validator = Validator::make($request->all(), $rules, $msg);
        } else {
            $rules['image'] = 'required|mimetypes:image/*,video/*';
            // $rules['title'] = 'required|unique:ads,title,0,id,deleted_at,NULL';

            $validator = Validator::make($request->all(), $rules, $msg);
        }

        if ($validator->fails()) {
            $res = array('code' => 201, 'sg' => $validator->messages()->first());
            return json_encode($res);
        }

        // try {
        //if id found then update else insert
        if (isset($request->id) && $request->id > 0) {

            //update
            $item = ad::findOrFail($request->id);

            // $item->title = $request->title;
            // $item->link = $request->link;
            // $item->description = $request->description;
            $item->customer_type = $request->user_type;
            // $item->start_date = $request->start_range;
            // $item->end_date = $request->end_range;
            $item->published_status = $request->published_status;

            //if profile image set then upload
            if ($image = $request->file('image')) {
                $destination_path = 'uploads/ad_image';
                $source_path = $image;
                $file_name = image_upload_public($source_path, $destination_path);
                $item->image = $file_name;
                // ImageResize($file_name, $destination_path, 'mall', 500, 500);
            }

            $item->save();

            if ($item) {
                $res = array('code' => 200, 'msg' => 'Updated successfully');
            } else {
                $res = array('code' => 201, 'msg' => 'Failed! Try again');
            }
        } else {
            //store
            // return '000000000';

            $item = new ad;
            // $item->title = $request->title;
            // $item->link = $request->link;
            // $item->description = $request->description;
            $item->customer_type = $request->user_type;
            // $item->start_date = $request->start_range;
            // $item->end_date = $request->end_range;
            $item->published_status = $request->published_status;

            //if profile image set then upload
            if ($image = $request->file('image')) {
                $destination_path = 'uploads/ad_image';
                $source_path = $image;
                $file_name = image_upload_public($source_path, $destination_path);
                $item->image = $file_name;
                // ImageResize($file_name, $destination_path, 'mall', 500, 500);
            }
            $item->save();

            if ($item) {
                $res = array('code' => 200, 'msg' => 'Added successfully');
            } else {
                $res = array('code' => 201, 'msg' => 'Failed! Try again');
            }
        }

        return json_encode($res);
    }
    //get by id
    public function get_by_id(Request $request)
    {
        $id = $request->input('id');
        // Validate the ID parameter
        $validator = Validator::make(['id' => $id], ['id' => 'required|integer']);
        if ($validator->fails()) {
            return response()->json(['code' => 400, 'msg' => 'Invalid ID'], 400);
        }

        try {
            // $id = base64_decode($id);
            $ad = ad::find($id);
            if (!$ad) {
                return response()->json(['code' => 404, 'msg' => 'ad not found'], 404);
            }
            $data = array();
            $data = ['ad' => $ad];
            $res = array('code' => 200, 'data' => $data);
        } catch (\Exception $e) {
            $res = array('code' => 201, 'msg' => 'Something went wrong! Try again' . $e);
        }
        return json_encode($res);
    }

    public function view($id, Request $request)
    {
        try {

            $id = base64_decode($id);

            $data = array();
            $data['ad'] = $blog_detail =  ad::select('ads.*')
                ->findOrFail($id);
            return view('content/blog/blog_view')->with($data);
        } catch (\Exception $e) {
            $res = array('code' => 201, 'msg' => 'Something went wrong! Try again' . $e);
        }
        return json_encode($res);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        try {
            $ad = ad::findOrFail($id);
            $status =  $ad->delete();

            if ($status === true) {
                return response()->json(['success' => 'ad deleted successfully', "status" => $status], 200);
            } else {
                return response()->json(['error' => 'Something went wrong', "status" => $status], 201);
            }
        } catch (Throwable $e) {
            report($e);
            return response()->json(['error' => 'Something went wrong' . $e]);
            // return "Something went wrong";
        }
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
                $item = ad::find($request->id);
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
}
