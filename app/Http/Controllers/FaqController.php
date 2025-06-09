<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Faq;
use App\Models\Faq_Category;
use DataTables, Auth;

class FaqController extends Controller
{
    public function __construct(Request $request)
    {
        $this->model = new Faq();
        $this->sortableColumns = ['id', 'question', 'type', 'status', 'created_at'];
    }

    public function index()
    {
        $Faq_Category_WithFaqs = Faq_Category::join('faqs','faqs.category','=','faqs_category.id')->groupBy('faqs_category.id')->get();
        $All_Faq_Categories = Faq_Category::where('status','1')->orderBy('name','asc')->get();
        return view('content/faq/list', compact('Faq_Category_WithFaqs', 'All_Faq_Categories'));
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
        $search_data['type'] = $request->input('type');

        $search_data['question'] = $request->input('question');

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

            $row['question'] = ucfirst($value->question);
            
            $row['type'] = ucfirst($value->category_name);

            
            $val = '';
            if (auth()->user()->can('master_edit_faqs')) {
                $val .= '<label class="switch">
                                    <input class="status-checkbox" type="checkbox" ' . ($value->status == '1' ? 'checked' : '') . ' data-id=' . $value->id . '>
                                    <span class="slider round"></span>
                            </label>';
            } else {
                $val .= '<label class="switch">
                                    <input disabled type="checkbox" ' . ($value->status == '1' ? 'checked' : '') . ' data-id=' . $value->id . '>
                                    <span class="slider round"></span>
                            </label>';
            }
            $row['status'] = $val;
            // $row['order_sort'] = $value->order_sort;
            $row['created_at'] = date('d-m-Y', strtotime($value->created_at));



            $status = '';
            $status .= '<div class="table-actions">';

            if (Auth::user()->can('master_edit_faqs')) {
                $status = '<a href="" onclick="updateItem(' . $value->id . ')"   data-bs-toggle="offcanvas" data-bs-target="#addEditModal"><i class="bx bx-edit f-16 me-1 text-green"></i></a>';
                // $status .= '<a href="javascript:void(0)" data-toggle="tooltip" title="Edit" onclick="updateItem(' . $value->id . ')"><i class="bx bx-edit f-16 mr-15 text-green me-1"></i></a>';
            }

            if (Auth::user()->can('master_view_faqss')) {
                // $status = '<a href="" onclick="viewItem(' . $value->id . ')" class="table-actions"  data-bs-toggle="offcanvas" data-bs-target="#viewModal"><i class="bx bxs-happy-heart-eyes f-16 text-green"></i></a>';
                $status .= '<a href="javascript:void(0)" onclick="viewItem(' . $value->id . ')"   data-bs-toggle="offcanvas" data-bs-target="#viewModal"><i class="bx bxs-happy-heart-eyes f-16 text-green"></i></a> ';
            }

            if (Auth::user()->can('master_delete_faqs')) {
                $status .= '<a href="javascript:void(0)" data-toggle="offcanvas" title="Delete" onclick="deleteItem(' . $value->id . ')"><i class="bx bx-trash  f-16 text-red "></i></a>';
            }


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
        $q = Faq::select('faqs.*', 'faqs_category.name as category_name')
            ->where('faqs.id', '!=', '0')
            ->join('faqs_category', 'faqs_category.id', 'faqs.category');

        $orderby = $orderby ?: 'created_at';
        $order = $order ?: 'desc';

        if ($search && !empty($search)) {
            $q->where(function ($query) use ($search) {
                $query->where('faqs.question', 'LIKE', '%' . $search . '%');
            });
        }
        if (isset($request['status']) && !empty($request['status'])) {
            $q->where(function ($query) use ($request) {
                $query->where('faqs.status', $request['status']);
            });
        }

        if (isset($request['type']) && $request['type'] != '') {
            $q->where(function ($query) use ($request) {
                $query->where('category', $request['type']);
            });
        }

        if (isset($request['question']) && !empty($request['question'])) {
            $search_all = $request['question'];
            $q->where(function ($query) use ($search_all) {
                $query->where('faqs.question', 'LIKE', '%' . $search_all . '%')
                    ->orWhere('faqs.answer', 'LIKE', '%' . $search_all . '%');
            });
        }
        $response = $q->orderBy($orderby, $order);
        return $response;
    }


    //store data
    public function store(Request $request)
    {
        $rules = [
            'question' => 'required | string ',
             'answer' => 'required | string ',

        ];
        $msg = ['question.unique' => 'The question has already been taken.'];

        if (isset($request->id) && $request->id > 0) {
            $rules['question'] = 'required|unique:faqs,question,' . $request->id . ',id,deleted_at,NULL';
            $validator = Validator::make($request->all(), $rules, $msg);
        } else {
            $rules['question'] = 'required|unique:faqs,question,0,id,deleted_at,NULL';
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
                $item = Faq::find($request->id);
                $item->category = $request->type;
                $item->question = $request->question;
                // $item->order_sort = $request->sort;
                $item->answer = $request->answer;



                $item->save();
                if ($item) {
                    $res = array('code' => 200, 'msg' => 'Updated successfully');
                } else {
                    $res = array('code' => 201, 'msg' => 'Failed! Try again');
                }
            } else {
                //store
                $item = new Faq;
                $item->category = $request->type;
                $item->question = $request->question;
                // $item->order_sort = $request->sort;
                $item->answer = $request->answer;

                $item->status = '1';



                $item->save();
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
            $item = Faq::select('faqs.*', 'faqs_category.name as category_name')->join('faqs_category', 'faqs.category', '=', 'faqs_category.id')->find($request->id);
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
            $banner = Faq::findOrFail($id);
            $status =  $banner->delete();

            if ($status === true) {
                return response()->json(['success' => 'Faq deleted successfully', "status" => $status], 200);
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
                $item = Faq::find($request->id);
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
