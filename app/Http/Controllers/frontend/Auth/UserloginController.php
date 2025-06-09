<?php

namespace App\Http\Controllers\frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Models\MasterPage;
use App\Models\Banner;
use App\Models\Customer;


use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Cart;





class UserloginController extends Controller
{
   // public function user_login()
   // {
   //    return view("fronted.login");
   // }
   
   // public function user_signup()
   // {
   //    return view("fronted.signup");
   // }
   public function forgot_password()
   {
      return view('fronted.forgot_password');
   }
}
