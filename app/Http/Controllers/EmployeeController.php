<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Models\MasterState;
use App\Models\MasterCity;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Auth, Session;
class EmployeeController extends Controller
{


    public function __construct() {
        $this->middleware('auth');
    }
    public function Form() {
        return view('form');
    }

    //change password
    public function change_password($id) {
        return view('Admin/employee/change_password',compact('id'));
    }

    //update  employee data
    public function update(Request $request) {

        $check_password = $request->segment(2);
        // echo $check_password;die;

        //check for request is for password
        if ($check_password == 'password') {
            // set validation rules 
            $validator = Validator::make($request->all(), [
                        'old_password' => 'required ',
                        'new_password' => 'required_with:confirm_password|same:confirm_password| min:8 | max:16',
            ]);
        } elseif ($check_password == 'profile') { //check for request is from profile
            // set validation rules 
            $validator = Validator::make($request->all(), [
                        'name' => 'required | string ',
                        'profile_image' => 'mimes:jpeg,png,jpg',
                        'id' => 'required',
                        'email' => 'required|unique:employee_general_info,email,' . $request->id . ',id,deleted_at,NULL'
            ]);
        } 

        //check validation
        if ($validator->fails()) {
            $res = array('code' => 201, 'msg' => $validator->messages()->first());
            return json_encode($res);
        }

        try {
            // store employee information
            $user = Employee::leftjoin('employee_has_roles', 'employee_general_info.id', '=', 'employee_has_roles.employee_id')->find($request->id);
          
            //check for request is for password
            if ($check_password == 'password') {
                //check for employee type
                if (Hash::check($request->old_password, $user->password)) {
                    if($request->old_password == $request->new_password){
                        $res = array('code' => 201, 'msg' => "Old password and New password must not be same.");
                        return json_encode($res);
                    }
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    $res = array('code' => 200, 'msg' => "Password updated successfully");
                    return json_encode($res);
                } else {
                    $res = array('code' => 201, 'msg' => "Old password doesn't match");
                    return json_encode($res);
                }

                //}
            }
            //if request is from profile
            if ($check_password == 'profile') {
                $user->name = $request->name;
                $user->phone = str_replace(' ', '', $request->phone);
                if($request->id =='1'){
                    $user->email = $request->email;
                }else{
                    $user->gender = $request->gender;
                    $user->dob = date_time_format($request->dob, 'Y-m-d');
                    $user->address = $request->address;
                    $user->city = $request->city;
                    $user->state = $request->state;
                    $user->pincode = $request->pincode;

                }
                //if profile image set then upload
                if ($profile_image = $request->file('profile_image')) {
                    $destination_path = 'employee_images';
                    $source_path = $profile_image;
                    $file_name = upload_file($destination_path, $source_path);
                    $user->profile_image = $file_name;
                }
                $user->save();
            }
            if ($user) {
                if ($check_password != 'password') {
                    $res = array('code' => 200, 'msg' => "Profile updated successfully!");
                } else {
                    $res = array('code' => 200, 'msg' => config('constants.password_update'));
                }
            } else {
                //return redirect('employees')->with('error', 'Failed to create new employee! Try again.');
                $res = array('code' => 201, 'msg' => config('constants.failed_message'));
            }
        } catch (\Exception $e) {

            $bug = $e->getMessage();
            //return redirect()->back()->with('error', $bug);
            $res = array('code' => 201, 'msg' => '111' . $bug . config('constants.went_wrong_msg'));
            //$res = array('code' => 201, 'msg' => $bug);
        }
        return json_encode($res);
    }
    
    // display user view page 
    public function edit($id, Request $request) {

        $pro_type = $request->segment(2);

        // try {
            $user = Employee::select('employee_general_info.*', Db::raw('date_format(employee_general_info.dob,"%m-%d-%Y") as dob_s'))->with('roles', 'permissions')->find($id);

          
            if ($user) {


                $user_role = $user->roles->first();

                $roles = Role::where('id', '!=', 1)->pluck('name', 'id');


                
                $role_name = '';
                if (isset($user_role) && !empty($user_role)) {
                    $role_name = $user_role->name;
                }
                if ($pro_type == 'profile') {
                    return view('Admin/employee/profile', compact('user', 'role_name', 'roles'));
                } else {
                    return view('Admin/employee/view', compact('user', 'role_name', 'roles'));
                }
            } else {
                return redirect('404');
            }
        // } catch (\Exception $e) {

        //     $bug = $e->getMessage();
        //     return redirect()->back()->with('error', $bug);
        // }
    }
    
    //uploadImages
    public function profile_image_update(Request $request) {
        //dd($request->hasfile('files'));
        // set validation rules 
        $validator = Validator::make($request->all(), [
                    'id' => 'required',
                    'files' => 'required|mimes:jpeg,png,jpg'
        ]);

        //check validation
        if ($validator->fails()) {
            //return redirect()->back()->withInput()->with('error', $validator->messages());
            $res = array('code' => 201, 'msg' => $validator->messages()->first());
            return json_encode($res);
        }
        try {
            $user = Employee::find($request->id);

            if ($request->hasfile('files')) {
                if ($image = $request->file('files')) {
                    $image_name = image_upload_public($request->file('files'), 'uploads/admin_profile_img');
                    $user->profile_image = $image_name;
                    $user->save();
                }
            }
            $res = array(
                'code' => 200,
                'msg' => 'Profile Image Updated Successfully',
                'image' => url("uploads/admin_profile_img/$image_name")
            );
            
        } catch (Exception $ex) {
            $res = array('code' => 201, 'msg' => config('constants.went_wrong_msg'));
        }

        return json_encode($res);
    }
    public function get_city_list(Request $request) {
        try {
            $data = array();
            // if(Auth::user()->id != 1  && Session::get('access_cities')->access_city_list != null && Session::get('access_cities')->access_city_list != '0' )
            // {
            //     $cityIdList = explode('|',Session::get('access_cities')->access_city_list);    
            //     $data['cityList'] = MasterCity::with('state')->wherehas('state',function($query) use($request){
            //         $query->where('id', '=', $request->id);
            //     })->where('is_active', '=', '1')->whereIn('id', $cityIdList)->get();
            // }
            // else
            // {
                $data['cityList'] = MasterCity::with('state')->wherehas('state',function($query) use($request){
                    $query->where('id', '=', $request->id);
                })->where('is_active', '=', '1')->get();
            // }  
            
            $res = array('code' => 200, 'msg' => 'Success' , 'data'=>$data);
        } 
        catch (\Exception $e) 
        {
            $res = array('code' => 201, 'msg' => 'Something went wrong! Try again'.$e);
        }
        return json_encode($res);
    }

}
