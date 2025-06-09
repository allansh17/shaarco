<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Feature_Products;
use Illuminate\Support\Str;
use App\Models\Staff;
use App\Models\MasterEmailTemplate;
use App\Models\MasterCompanySetting;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use DataTables,Auth;
use Illuminate\Support\Facades\DB;


class ProductFeaturesController extends Controller {
    protected $title = 'Feature_Products';
    //this variable use for blade file path 
    protected $page = 'content/feature_products';
    //this variable use for route prefix and view folder 
    protected $routeLable = 'blog';

    public function __construct(Request $request)
    {
        $this->model = new Feature_Products();
        $this->sortableColumns = ['id', 'title','status','created_at'];
    }
     //get data from database for dat table --------------------------------------------------------- Strat
     public function getData($search = null, $orderby = null, $order = null, $request = null)
     {
         $q =    Feature_Products::select('*');
        //  print_r($q);die;
         $orderby = $orderby ? $orderby : 'feature_products.id';
         $order = $order ? $order : 'desc';
      
         if (isset($request['name']) && $request['name']!='') {
             $q->where('feature_products.name','Like','%'. $request['name'].'%');
         }
         if (isset($request['status']) && $request['status']!='') {
             $q->where('feature_products.status', $request['status']);
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
                $s_data['name'] = $request->input('name');
              
          

                $totaldata = $this->getData($search, $sortableColumns[$orderby], $order, $s_data);

                $totaldata = $totaldata->count();
                $response = $this->getData($search, $sortableColumns[$orderby], $order, $s_data);
                // $response->whereBetween('devlopments.created_at', [$start_date, $end_date]);

                $response = $response->offset($start)->limit($limit)->orderBy('feature_products.id', 'desc')->get();
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
                    $filePath = 'uploads/product_feature/' . $value->image;
                    $defaultImagePath = 'uploads/lifestyle_gear/default/defaul_banner.png';

                    if (!empty($value->image) && file_exists(public_path($filePath))) {
                        $row['image'] = '<div class="table_img_"><img  src="' . asset($filePath) . '" alt="Image"></div>';
                    } else {
                        $row['image'] = '<div class="table_img_"><img  src="' . asset($defaultImagePath) . '" alt="Image"></div>';
                    }
                              
                    if (Auth::user()->can('master_edit_blog')) {
                        $row['status'] =  ' <label class="switch">
                                                <input class="status-checkbox" type="checkbox" ' . ($value->status == '1' ? 'checked' : '') . ' data-id=' . $value->id . '>
                                                <span class="slider round"></span>
                                            </label>';
                        }else{
                        $row['status'] = '<label class="switch">
                                                <input disabled type="checkbox" ' . ($value->status == '1' ? 'checked' : '') . ' data-id=' . $value->id . '>
                                                <span class="slider round"></span>
                                        </label>';
                                        }
                   
                    $row['created_at'] =  date("d-m-Y", strtotime($value->created_at) );


              
                    $edit = '';
                   

                    $edit = '<a href="" onclick="updateItem(' . $value->id . ')" class="table-actions"  data-bs-toggle="offcanvas" data-bs-target="#addEditModal"><i class="bx bx-edit f-16 me-1 text-green"></i></a>';

                    $view = '';
                    // $view = '<a href="javascript:void(0)" onclick="viewItem('.$value->id.')" data-toggle="tooltip" title="View"><i class="ik ik-eye f-16 text-green mr-1"></i></a> ';

                    //$view = '<a href="'.url('blog/view/'.base64_encode($value->id)).'" title="View"><i class="bx bxs-happy-heart-eyes f-16 text-green mr-1"></i></a> ';

                    $delete = '';

                    $delete = '<a href="javascript:void(0)" data-bs-toggle="offcanvas" title="Delete" onclick="deleteItem(' . $value->id . ')"><i class="bx bx-trash  f-16 text-red "></i></a>';


                    $row['actions'] = '<div class="table-actions">'.$edit.$delete.'</div>';

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
   
   
       
    //store data
    public function store(Request $request) {
        // create 
        $rules = [
            'name' => 'required | string ',   
            
        ];
        $msg = [
            'name.unique' => 'The title has already been taken.',
            'image.mimes' => 'Image  must be a JPG, JPEG, or PNG file.',
            'image.dimensions' => 'Image must be 1080x600 pixels in size.',
        ];

        if (isset($request->id) && $request->id > 0) {
            $rules['name']= 'required|unique:feature_products,name,' . $request->id . ',id,deleted_at,NULL';
            $rules['image'] = 'nullable|mimes:jpg,jpeg,png|dimensions:min_width=1080,min_height=600,max_width=1080,max_height=600';
            $validator = Validator::make($request->all(), $rules,$msg);
        } else {
            $rules['name']= 'required|unique:feature_products,name,0,id,deleted_at,NULL';
            $rules['image'] = 'required|mimes:jpg,jpeg,png|dimensions:min_width=1080,min_height=600,max_width=1080,max_height=600';
            $validator = Validator::make($request->all(), $rules,$msg);
        }

        if ($validator->fails()) {
            $res = array('code' => 201, 'msg' => $validator->messages()->first());
            return json_encode($res);
        }
        // try {
            //if id found then update else insert
            if (isset($request->id) && $request->id > 0) {

                //update
                $item = Feature_Products::findOrFail($request->id);
               
               $item->name = $request->name;
              
                      //if profile image set then upload
                      if ($image = $request->file('image')) {
                        $destination_path = 'uploads/product_feature';
                        $source_path = $image;
                       $file_name = image_upload_public($source_path,$destination_path);
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
                
                $item = new Feature_Products;   
                $item->name = $request->name;
              //if profile image set then upload
                      //if profile image set then upload
                      if ($image = $request->file('image')) {
                        $destination_path = 'uploads/product_feature';
                        $source_path = $image;
                       $file_name = image_upload_public($source_path,$destination_path);
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

        return json_encode($res);
    }
        //get by id
        public function get_by_id(Request $request) {
            try {

                $id=  $request->id;

                $data = array();
                $data['feature_detail'] = $blog_detail =  Feature_Products::select('feature_products.*')->findOrFail($id);
                $res = array('code' => 200, 'data' => $data);    
            } catch (\Exception $e) {
                $res = array('code' => 201, 'msg' => 'Something went wrong! Try again'.$e);
            }
            return json_encode($res);
        }

       
        public function delete(Request $request){
            $id = $request->id;
            try{
                $product_feature = Feature_Products::findOrFail($id);
                $status =  $product_feature->delete();
    
                 if ($status === true) {
                    return response()->json( ['success' => 'Deleted Succesfully', "status"=>$status],200 );
                }else{
                    return response()->json( ['error' => 'Something went wrong', "status"=>$status], 201 );
                }
            }catch (Throwable $e) {
                report($e);
                return response()->json( ['error' => 'Something went wrong'] );
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
                     $item = Feature_Products::find($request->id);
                     //update active/inactive status
                     if (isset($request->type) && $request->type == 'status') {
                         if($request->value == "1"){
                             $item->status = '1';
                         }else{
                             $item->status = '2';
                         }
                     }
                     $item->save();
                     if ($item) {
                        if (isset($request->type) && $request->type == 'status') {
                             if($request->value == "1"){
                            
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