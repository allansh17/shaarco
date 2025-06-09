<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\MasterCompanySetting;
use DB;


class companySettings extends Controller {
    public function index() {
        // echo phpinfo(); die();
        $companyData = MasterCompanySetting::find(1); 
        return view('Admin/setting_company/settings', compact('companyData'));
    }
    //store data
    public function store(Request $request) {
        //validation rule  accroding to id set or not  
        // try 
        // {
            //if id found then update else insert
            //update basic Details
            if (isset($request->id) && $request->id > 0 && $request->action == 'basic') 
            {
                $validator = Validator::make($request->all(), [
                    'company_name' => 'required',
                    'address' => 'required',
                    'email' => 'required|email',
                    'phone_number' => 'required',
                    // 'website' => 'required|url',
                    'website_logo' => 'mimes:png,svg,jpeg,jpg',
                    'favicon' => 'mimes:png,jpeg,jpg',
                    // 'email_logo' => 'mimes:png,jpeg,jpg',
                ]);
                if ($validator->fails()) 
                {
                    $res = array('code' => 201, 'msg' => $validator->messages()->first());
                    return json_encode($res);
                } 
                //update
                $update = MasterCompanySetting::find($request->id);
                $update->company_name = $request->company_name;
                $update->email = $request->email;
                $update->phone = $request->phone_number;
                $update->description = $request->description;
                // $update->website = $request->website;
                $update->address = $request->address;
                //if category image set then upload
                if ($image = $request->file('website_logo')) {
                    $oldLogo = $update->company_logo;
                    delteFile(public_path('uploads/logo').'/'.$oldLogo);
                    $image_destination_path = 'uploads/logo';
                    $image_name1 = image_upload_public($image , $image_destination_path );
                    $update->company_logo = $image_name1;
                }
                //if category image set then upload
                if ($image = $request->file('favicon')) {
                    $oldFavi_icon = $update->favi_icon;
                    $image_destination_path = 'uploads/company_setting/favi_icon';
                    $image_name = image_upload_public($image , $image_destination_path );
                    $update->favi_icon = $image_name;
                    delteFile(public_path('uploads/company_setting/favi_icon').'/'.$oldFavi_icon);
                }
                 //if category image set then upload
                //  if ($image = $request->file('email_logo')) {
                //     $oldEmail_logo = $update->email_logo;
                //     $image_destination_path = 'uploads/company_setting/email_logo';
                //     $image_name2 = image_upload_public($image , $image_destination_path );
                //     $update->email_logo = $image_name2;
                //     delteFile(public_path('uploads/company_setting/email_logo').'/'.$oldEmail_logo);
                    
                // }
                $update->save();
                if ($update) 
                {
                    // return $oldEmail_logo;
                    $res = array('code' => 200, 'msg' => 'Record updated successfully.', 'data'=>$update);
                } 
                else 
                {
                    $res = array('code' => 201, 'msg' => 'Failed! Try again');
                }
            } 
            //update Social Media Link
            else if (isset($request->id) && $request->id > 0 && $request->action == 'links') 
            {
                $validator = Validator::make($request->all(), [
                    'facebook' => 'required|url',
                    'instagram' => 'required|url',
                    'twitter' => 'required|url',
                    'linkedin' => 'required|url',
                    // 'blog_url' => 'required|url'
                ]);
                if ($validator->fails()) 
                {
                    $res = array('code' => 201, 'msg' => $validator->messages()->first());
                    return json_encode($res);
                } 
                //update
                $update = MasterCompanySetting::find($request->id);
                $update->facebook = $request->facebook;
                $update->instagram = $request->instagram;
                $update->twitter = $request->twitter;
                $update->linkedin = $request->linkedin;
                // $update->dialmenow_blog_url = $request->blog_url;
                $update->save();
                if ($update) 
                {
                    $res = array('code' => 200, 'msg' => 'Record updated successfully.');
                } 
                else 
                {
                    $res = array('code' => 201, 'msg' => 'Failed! Try again');
                }
            }
             //update Master Settings
             else if (isset($request->id) && $request->id > 0 && $request->action == 'settings') 
             {
                 $validator = Validator::make($request->all(), [
                     'max_cod_amount' => 'required',
                     'footer_description' => 'required',
                   
                 ]);
                 if ($validator->fails()) 
                 {
                     $res = array('code' => 201, 'msg' => $validator->messages()->first());
                     return json_encode($res);
                 } 
                 //update
                 $update = MasterCompanySetting::find($request->id);
                 $update->max_cod_amount = $request->max_cod_amount;
                 $update->footer_description = $request->footer_description;
                 $update->shipping_charges = $request->shipping_charges;
                 $update->save();
                 if ($update) 
                 {
                     $res = array('code' => 200, 'msg' => 'Record updated successfully.');
                 } 
                 else 
                 {
                     $res = array('code' => 201, 'msg' => 'Failed! Try again');
                 }
             }
            else if (isset($request->id) && $request->id > 0 && $request->action == 'invoice') 
            {
                $validator = Validator::make($request->all(), [
                    'invoice_company_name' => 'required',
                    'invoice_company_address' => 'required',
                    'invoice_micr' => 'required',
                    'gst_number' => 'required',
                    'bank_name' => 'required',
                    'ac_holder_name' => 'required',
                    'ac_number' => 'required',
                    'ifsc' => 'required',
                    'terms' => 'required'
                ]);
                if ($validator->fails()) 
                {
                    $res = array('code' => 201, 'msg' => $validator->messages()->first());
                    return json_encode($res);
                } 
                //update
                $update = MasterCompanySetting::find($request->id);
                $update->invoice_company_name = $request->invoice_company_name;
                $update->invoice_company_address = $request->invoice_company_address;
                $update->invoice_micr = $request->invoice_micr;
                $update->gst_number = $request->gst_number;
                $update->bank_name = $request->bank_name;
                $update->ac_number = $request->ac_number;
                $update->ac_holder_name = $request->ac_holder_name;
                $update->ifsc = $request->ifsc;
                $update->terms = $request->terms;
                $update->save();
                if ($update) 
                {
                    $res = array('code' => 200, 'msg' => 'Record updated successfully.');
                } 
                else 
                {
                    $res = array('code' => 201, 'msg' => 'Failed! Try again');
                }
            }
            //update SMTP Details
            else if (isset($request->id) && $request->id > 0 && $request->action == 'smtp') 
            {
                $validator = Validator::make($request->all(), [
                    'host_name' => 'required',
                    'port' => 'required',
                    'user_id' => 'required',
                    'password' => 'required',
                    'no_reply_email' => 'required|email'
                ]);
                if ($validator->fails()) 
                {
                    $res = array('code' => 201, 'msg' => $validator->messages()->first());
                    return json_encode($res);
                } 
                //update
                $update = MasterCompanySetting::find($request->id);
                $update->smtp_hostname = $request->host_name;
                $update->smtp_port = $request->port;
                $update->smtp_username = $request->user_id;
                $update->smtp_password = $request->password;
                $update->smtp_no_reply_email = $request->no_reply_email;
                $update->save();
                // die();
                if ($update) 
                {
                    $res = array('code' => 200, 'msg' => 'Record updated successfully.');
                } 
                else 
                {
                    $res = array('code' => 201, 'msg' => 'Failed! Try again');
                }
            }
            //update SMS Details
            else if (isset($request->id) && $request->id > 0 && $request->action == 'sms') 
            {
                $validator = Validator::make($request->all(), [
                    'account_id' => 'required',
                    'auth_tokenn' => 'required',
                    'sms_phone' => 'required|digits:10'
                ]);
                if ($validator->fails()) 
                {
                    $res = array('code' => 201, 'msg' => $validator->messages()->first());
                    return json_encode($res);
                } 
                //update
                $update = MasterCompanySetting::find($request->id);
                $update->sms_account_id = $request->account_id;
                $update->sms_auth_token = $request->auth_tokenn;
                $update->sms_phone_number = $request->sms_phone;
                $update->save();
                if ($update) 
                {
                    $res = array('code' => 200, 'msg' => 'Record updated successfully.');
                } 
                else 
                {
                    $res = array('code' => 201, 'msg' => 'Failed! Try again');
                }
            } 
            //update Company Description
            else if (isset($request->id) && $request->id > 0 && $request->action == 'description') 
            {
                $validator = Validator::make($request->all(), [
                    'description' => 'required'
                ]);
                if ($validator->fails()) 
                {
                    
                    $res = array('code' => 201, 'msg' => $validator->messages()->first());
                    return json_encode($res);
                } 
                // return 
                if(str_word_count($request->description) > 10000)
                {
                    $res = array('code' => 201, 'msg' => "Enter max 10000 words");
                    return json_encode($res);
                }
                //update
                $update = MasterCompanySetting::find($request->id);
                $update->description = $request->description;
                $update->save();
                if ($update) 
                {
                    $res = array('code' => 200, 'msg' => 'Record updated successfully.');
                } 
                else 
                {
                    $res = array('code' => 201, 'msg' => 'Failed! Try again');
                }
            } 
            //update package renewal days
            else if (isset($request->id) && $request->id > 0 && $request->action == 'renewal') 
            {
                $validator = Validator::make($request->all(), [
                    'package_renewal_days' => 'required|numeric'
                ]);
                if ($validator->fails()) 
                {
                    $res = array('code' => 201, 'msg' => $validator->messages()->first());
                    return json_encode($res);
                } 
                //update
                $update = MasterCompanySetting::find($request->id);
                $update->package_renewal_day = $request->package_renewal_days;
                $update->save();
                if ($update) 
                {
                    $res = array('code' => 200, 'msg' => 'Record updated successfully.');
                } 
                else 
                {
                    $res = array('code' => 201, 'msg' => 'Failed! Try again');
                }
            }
            //update Monthly Report Date
            else if (isset($request->id) && $request->id > 0 && $request->action == 'report') 
            {
                $validator = Validator::make($request->all(), [
                    'monthly_report_date' => 'required|numeric'
                ]);
                if ($validator->fails()) 
                {
                    $res = array('code' => 201, 'msg' => $validator->messages()->first());
                    return json_encode($res);
                } 
                //update
                $update = MasterCompanySetting::find($request->id);
                $update->monthly_report_date = $request->monthly_report_date;
                $update->save();
                if ($update) 
                {
                    $res = array('code' => 200, 'msg' => 'Record updated successfully.');
                } 
                else 
                {
                    $res = array('code' => 201, 'msg' => 'Failed! Try again');
                }
            }
            //Update Ip Block Hit Count
            else if (isset($request->id) && $request->id > 0 && $request->action == 'ip') 
            {
                $validator = Validator::make($request->all(), [
                    'ip_block_hit' => 'required|numeric'
                ]);
                if ($validator->fails()) 
                {
                    $res = array('code' => 201, 'msg' => $validator->messages()->first());
                    return json_encode($res);
                } 
                //update
                $update = MasterCompanySetting::find($request->id);
                $update->ip_block_counts = $request->ip_block_hit;
                $update->save();
                if ($update) 
                {
                    $res = array('code' => 200, 'msg' => 'Record updated successfully.');
                } 
                else 
                {
                    $res = array('code' => 201, 'msg' => 'Failed! Try again');
                }
            } 
            //Update Pin For Report Download
            else if (isset($request->id) && $request->id > 0 && $request->action == 'pin') 
            {
                $validator = Validator::make($request->all(), [
                    'report_pin' => 'required|digits:4'
                ]);
                if ($validator->fails()) 
                {
                    $res = array('code' => 201, 'msg' => $validator->messages()->first());
                    return json_encode($res);
                } 
                //update
                $update = MasterCompanySetting::find($request->id);
                $update->report_pin = $request->report_pin;
                $update->save();
                if ($update) 
                {
                    $res = array('code' => 200, 'msg' => 'Record updated successfully.');
                } 
                else 
                {
                    $res = array('code' => 201, 'msg' => 'Failed! Try again');
                }
            }
            //Update Google Auth Details
            else if (isset($request->id) && $request->id > 0 && $request->action == 'google_key') 
            {
                $validator = Validator::make($request->all(), [
                    'google_api_key' => 'required'
                ]);
                if ($validator->fails()) 
                {
                    $res = array('code' => 201, 'msg' => $validator->messages()->first());
                    return json_encode($res);
                } 
                //update
                $update = MasterCompanySetting::find($request->id);
                $update->google_api_key = $request->google_api_key;
                $update->save();
                if ($update) 
                {
                    $res = array('code' => 200, 'msg' => 'Record updated successfully.');
                } 
                else 
                {
                    $res = array('code' => 201, 'msg' => 'Failed! Try again');
                }
            }
            //Show error on invalid action
            else
            {
                $res = array('code' => 201, 'msg' => 'Failed! Try again');
            }
        // } 
        // catch (\Exception $e) 
        // {
        //     $bug = $e->getMessage();
        //     $res = array('code' => 201, 'msg' => 'Something went wrong Try again');
        // }
        return json_encode($res);
    }

    public function localTerm($url)
    {
        if ($url) {
         $data = DB::table('master_pages')->select('description')->where('page_slug',$url)->first();
         return view('admin.company_settings.localterm', compact('data'));
      }
    }
}
