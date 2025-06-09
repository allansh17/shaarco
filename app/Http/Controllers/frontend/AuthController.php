<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Models\MasterPage;
use App\Models\Banner;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Brands;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Cart;





class AuthController extends Controller
{

    protected $page = 'fronted';

    public function sign_up()
    {
        $categorys = Category::all();
        $brands = Brands::all();

        // dd($categorys);
        //from helper file
        // $frontend_details = frontend_details();

        // $meta_data = MasterPage::select('description', 'meta_title', 'meta_keyword', 'meta_description')
        //     ->where('page_slug', 'sign_up')
        //     ->first();

        // $banner18 = Banner::select('id', 'title', 'image', 'description', 'redirection_path', 'position', 'redirection_type')
        //     ->where('id', '18')
        //     ->first();



        // $data = ['categories' => $frontend_details['categories_data'], 'company_data' => $frontend_details['companysetting_data'],  'cart_Count' => $frontend_details['cart_Count'], 'meta_data' => $meta_data, 'banner18' => $banner18];

        return view($this->page . '.signup', compact('categorys','brands'));
        // return view($this->page . '.sign_up', $data);
    }

    public function sign_upData(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'first_name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|min:10|max:10', // Corrected typo from 'pnone' to 'phone'
            'password' => 'required|confirmed',
        ]);

        // Hash the password after validation
        $validatedData['password'] = Hash::make($request->password);

        // Create the customer record
        Customer::create($validatedData);

        // Redirect with success message
        return redirect()->route('sign_in')->with('success', 'Customer registered successfully.');
    }


    public function phone_unique(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|min:10|max:10',



        ], [
            'phone.required' => 'phone number is required.',
            'phone.min' => 'Please enter at least 10 characters.',
            'phone.max' => 'Please enter no more than 10 characters.',

        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->messages()->first()];

        }

        $phone = $request->input('phone');


        $exists = Customer::where('phone', $phone)->exists();

        return response()->json(!$exists);
    }




    public function register_otppopup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|min:10|max:10',



        ], [
            'phone.required' => 'phone number is required.',
            'phone.min' => 'Please enter at least 10 characters.',
            'phone.max' => 'Please enter no more than 10 characters.',

        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->messages()->first()];

        }

        $phone = $request->phone;

        $existingUser = Customer::where('phone', $phone)->first();
        if ($existingUser) {
            return ["status" => false, "message" => "User with this phone number already exists"];
        }


        // $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $otp = '1234';

        return ["status" => true, 'phone' => $phone, 'otp' => $otp];
    }

    public function sign_in()
    {
        $categorys = Category::all();
     $brands = Brands::all();
        //from helper file
        // $frontend_details = frontend_details();

        // $meta_data = MasterPage::select('description', 'meta_title', 'meta_keyword', 'meta_description')
        //     ->where('page_slug', 'login')
        //     ->first();


        // $banner19 = Banner::select('id', 'title', 'image', 'description', 'redirection_path', 'position', 'redirection_type')
        //     ->where('id', '19')
        //     ->first();


        // if (isset($_COOKIE['login_phone']) && isset($_COOKIE['login_password'])) {
        //     $login_phone = $_COOKIE['login_phone'];
        //     $login_password = $_COOKIE['login_password'];
        //     $is_remember = 'checked';
        // } else {
        //     $login_phone = '';
        //     $login_password = '';
        //     $is_remember = '';
        // }



        // $data = ['categories' => $frontend_details['categories_data'], 'company_data' => $frontend_details['companysetting_data'], 'cart_Count' => $frontend_details['cart_Count'], 'meta_data' => $meta_data, 'banner19' => $banner19, 'login_phone' => $login_phone, 'login_password' => $login_password, 'is_remember' => $is_remember];

        return view($this->page . '.login', compact('categorys','brands'));
    }

    public function log_inData(Request $request)
    {

        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);



        $email = $request->email;
        $password = $request->password;

        $user = Customer::where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with(['failed' => 'Your account is not registered']);
        }

        if (Auth::guard('local')->attempt(['email' => $email, 'password' => $password,'status'=>'1'])) {
            // dd(auth()->guard('local')->user());
            if (isset($_COOKIE['cart_session'])) {

                $sessionproductIds = Cart::select('product_id')
                    ->where('user_id', $_COOKIE['cart_session'])
                    ->groupBy('product_id')
                    ->get();
                if (count($sessionproductIds)) {
                    //if same user_id and same product id then delete first record
                    $productIds = Cart::select('product_id')
                        ->where('user_id', $user->id)
                        ->whereIn('product_id', $sessionproductIds)
                        ->groupBy('product_id')

                        ->get();

                    foreach ($productIds as $productId) {

                        $firstRecordToDelete = Cart::whereRaw('user_id = "' . $user->id . '"')
                            ->where('product_id', $productId->product_id)
                            ->delete();

                    }

                    Cart::where('user_id', $_COOKIE['cart_session'])->update(['user_id' => $user->id]);
                }
            }

            return redirect()->route('index')->with(['status' => 'true', 'message' => 'Login successfully']);
        } else {
            return redirect()->back()->with(['status' => 'false', 'failed' => 'The provided credentials do not match our records']);
        }


        // $validator = Validator::make($request->all(), [
        //     'phone' => 'required|string|min:10|max:10',
        //     'password' => 'required|string|min:8',



        // ], [
        //     'phone.required' => 'phone number is required.',
        //     'phone.min' => 'Please enter at least 10 characters.',
        //     'phone.max' => 'Please enter no more than 10 characters.',
        //     'password.required' => 'password is required.',
        //     'password.min' => 'Please enter at least 8 characters.',

        // ]);

        // if ($validator->fails()) {
        //     return ['status' => false,'message' => $validator->messages()->first()];

        // }


        // $phone = $request->phone;
        // $password = $request->password;
        // $remember_me = $request->remember_me;

        // if (isset($remember_me) && ($remember_me == '1')) {
        //     setcookie('login_phone', $phone, time() + 60 * 60 * 24 * 100);
        //     setcookie('login_password', $password, time() + 60 * 60 * 24 * 100);
        // } else {

        //     setcookie('login_phone', $phone, time() + 1);
        //     setcookie('login_password', $password, time() + 1);
        // }



        // Check if the user exists
        // $user = Customer::where('phone', $phone)->first();

        // if (!$user) {
        //     return response()->json(['status' => 'false', 'message' => 'Your account is not registered']);
        // }



        if (auth()->guard('local')->attempt(['phone' => $phone, 'password' => $password])) {

            if (isset($_COOKIE['cart_session'])) {

                $sessionproductIds = Cart::select('product_id')
                    ->where('user_id', $_COOKIE['cart_session'])
                    ->groupBy('product_id')
                    ->get();
                if (count($sessionproductIds)) {
                    //if same user_id and same product id then delete first record
                    $productIds = Cart::select('product_id')
                        ->where('user_id', $user->id)
                        ->whereIn('product_id', $sessionproductIds)
                        ->groupBy('product_id')

                        ->get();

                    foreach ($productIds as $productId) {

                        $firstRecordToDelete = Cart::whereRaw('user_id = "' . $user->id . '"')
                            ->where('product_id', $productId->product_id)
                            ->delete();

                    }

                    Cart::where('user_id', $_COOKIE['cart_session'])->update(['user_id' => $user->id]);
                }
            }

            return response()->json(['status' => 'true', 'message' => 'Login successfully']);
        } else {
            return response()->json(['status' => 'false', 'message' => 'The provided credentials do not match our records']);
        }
    }

    public function log_out()
    {
// dd('hello');
        Auth::guard('local')->logout();
        return redirect()->route('index')->with(['message' => 'Logout successfully']);
    }
// public function log_out(Request $request)
// {
//     $user = Auth::guard('local')->user();

//     // Check if the user exists and is inactive
//     if ($user && $user->status == 2) { // Assuming 0 is for 'inactive' status
//         Auth::guard('local')->logout();
//         return redirect()->route('index')->with(['message' => 'You have been logged out due to inactivity.']);
//     }

//     // Normal logout process for active users
//     Auth::guard('local')->logout();
//     return redirect()->route('index')->with(['message' => 'Logout successfully']);
// }


    public function log_inotp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|min:10|max:10',

        ], [
            'phone.required' => 'phone number is required.',
            'phone.min' => 'Please enter at least 10 characters.',
            'phone.max' => 'Please enter no more than 10 characters.',


        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->messages()->first()];

        }
        $phone = $request->phone;

        $existingUser = Customer::where('phone', $phone)->first();

        if ($existingUser) {
            $userId = $existingUser->id;

            // $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $otp = '1234';
            $save_otp = Customer::where('id', $userId)->update(['otp' => $otp]);
            if ($save_otp) {
                return ["status" => true, 'phone' => $phone, 'id' => $userId, 'otp' => $otp];
            } else {
                return ["status" => false, "message" => "some error occurred"];
            }
        } else {
            return ["status" => false, "message" => "User not registered"];
        }
    }

    public function log_otpverify(Request $request)
    {

        $phone = $request->phone;


        $otp = $request->otp1 . $request->otp2 . $request->otp3 . $request->otp4;

        // Find the user by ID and phone
        $existingUser = Customer::where('phone', $phone)
            ->first();



        if ($existingUser) {
            if ($otp == $existingUser->otp) {

                auth()->guard('local')->login($existingUser);

                Customer::where('id', $existingUser->id)->update(['otp' => '']);

                if (isset($_COOKIE['cart_session'])) {

                    $sessionproductIds = Cart::select('product_id')
                        ->where('user_id', $_COOKIE['cart_session'])
                        ->groupBy('product_id')
                        ->get();
                    if (count($sessionproductIds)) {
                        //if same user_id and same product id then delete first record
                        $productIds = Cart::select('product_id')
                            ->where('user_id', $existingUser->id)
                            ->whereIn('product_id', $sessionproductIds)
                            ->groupBy('product_id')

                            ->get();

                        foreach ($productIds as $productId) {


                            $firstRecordToDelete = Cart::whereRaw('user_id = "' . $existingUser->id . '"')
                                ->where('product_id', $productId->product_id)
                                ->delete();

                        }

                        Cart::where('user_id', $_COOKIE['cart_session'])->update(['user_id' => $existingUser->id]);
                    }
                }
                return response()->json(['status' => true, 'message' => 'Login successfully']);
            } else {
                return response()->json(['status' => false, 'message' => 'Please enter valid OTP']);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'User not registered']);
        }
    }



    public function register_otpverify(Request $request)
    {


        $otp_old = $request->otp;


        $phone = $request->phone;
        $otp = $request->otp1 . $request->otp2 . $request->otp3 . $request->otp4;

        if ($otp_old == $otp) {

            $name = $request->name;
            $email = $request->email;
            $phone = $request->phone;
            $gender = $request->gender;
            $password = $request->password;

            $user = new Customer;
            $user->name = $name;
            $user->email = $email;
            $user->phone = $phone;
            $user->password = Hash::make($password);
            $user->gender = $gender;
            $user->status = '1';

            $signup = $user->save();

            if ($signup) {

                auth()->guard('local')->login($user);

                if (isset($_COOKIE['cart_session'])) {

                    $sessionproductIds = Cart::select('product_id')
                        ->where('user_id', $_COOKIE['cart_session'])
                        ->groupBy('product_id')
                        ->get();
                    if (count($sessionproductIds)) {
                        //if same user_id and same product id then delete first record
                        $productIds = Cart::select('product_id')
                            ->where('user_id', $user->id)
                            ->whereIn('product_id', $sessionproductIds)
                            ->groupBy('product_id')

                            ->get();

                        foreach ($productIds as $productId) {

                            $firstRecordToDelete = Cart::where('user_id = "' . $user->id . '"')
                                ->where('product_id', $productId->product_id)
                                ->delete();



                        }

                        Cart::where('user_id', $_COOKIE['cart_session'])->update(['user_id' => $user->id]);
                    }
                }


                return response()->json(['status' => 'true', 'message' => 'Profile created successfully']);
            } else {
                return ["status" => false, "message" => "Oops! Something went wrong try again"];
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Please enter valid OTP']);
        }
    }

    public function forgot_password(request $request)
    {
        $phone = $request->phone_forgot;
        // $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $otp = '1234';

        $existingUser = Customer::where('phone', $phone)
            ->first();
        if ($existingUser) {
            Customer::where('id', $existingUser->id)->update(['otp' => $otp]);

            return response()->json(['status' => true, 'phone' => $phone]);
        } else {
            return response()->json(['status' => false, 'message' => 'The provided Phone number is not registered. Please sign up to create an account.']);
        }
    }

    public function forgot_otpverify(Request $request)
    {

        $phone = $request->forgot_phone;
        $existingUser = Customer::where('phone', $phone)
            ->first();
        if ($existingUser) {

            $otp = $request->forgototp1 . $request->forgototp2 . $request->forgototp3 . $request->forgototp4;

            if ($otp == $existingUser->otp) {
                return response()->json(['status' => true, 'phone' => $phone]);
            } else {
                return response()->json(['status' => false, 'message' => 'Please enter valid OTP']);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'The provided Phone number is not registered. Please sign up to create an account.']);
        }
    }

    public function change_password(Request $request)
    {

        $phone = $request->change_phone;
        $password = Hash::make($request->new_password);

        // Check if the user exists
        $user = Customer::where('phone', $phone)->first();

        if ($user) {



            $update = Customer::where('id', $user->id)->update(['password' => $password]);

            if ($update) {
                Customer::where('id', $user->id)->update(['otp' => '']);


                return response()->json(['status' => 'true', 'message' => 'Login successfully']);
            } else {
                return response()->json(['status' => 'false', 'message' => 'The provided credentials do not match our records']);
            }
        } else {
            return response()->json(['status' => 'false', 'message' => 'Your account is not registered']);
        }
    }
}
