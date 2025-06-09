<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\MasterEmailTemplate;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon; 
use Mail;
use App\Models\Employee;
use App\Models\MasterCompanySetting;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    

    use SendsPasswordResetEmails;
    
    public function submitForgetPasswordForm(Request $request)
      {
        $messages = [
            'email.exists' => 'Please enter your registered email',
        ];
        
        $request->validate([
            'email' => 'required|exists:employee_general_info,email,deleted_at,"NULL",status,"1",id,"1"',
        ], $messages);
          
          $email = $request->email;
          
          $user = Employee::where('email',$email)->where('status','1')->first();
         //create token
          $password_broker = app(PasswordBroker::class);
            //create reset password token 
          $token = $password_broker->createToken($user); 
          // print_r($token);
          // die;
          //store in password reset
          //DB::table('password_resets')->where('email', $request->email)->delete();
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
         $company_detail = MasterCompanySetting::select('company_name','company_logo')->first();
        //  echo '-------------'. $company_detail;die;
        $logo = url('uploads/logo') . '/' . $company_detail->company_logo;

        // $logo = url('uploads/company_setting/favi_icon/1720078994_6686529253124.png');
     

       
         $master_email = MasterEmailTemplate::find('2');
                $emailval = $master_email->description;
                $subject = $master_email->title;
                $employee = [
                    '@name' => $user->name,
                    '@url' => url('password/reset/'.$token.'?email='.$email),
                    '@logo' => $logo,
                    '@company' => $company_detail->company_name,
                    
                ];

                foreach ($employee as $key => $value) {
                        $emailval = str_replace($key, $value, $emailval);
                    }
                 // print_r($emailval);die;

                Mail::send([], [], function ($message) use ($emailval, $email, $subject) {
                        $message->to($email)
                                ->subject($subject)
                                ->setBody($emailval, 'text/html');
                                
                    });

                
                 //return redirect(url('password/reset/'.$token.'?email='.$email));
          return back()->with('status', 'We have e-mailed your password reset link!');
      }
}
