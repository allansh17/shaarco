<?php

// use ImageResize;

use App\Models\Category;
use App\Models\CompanySetting;
use App\Models\Cart;
use App\Models\SubCategory;
use App\Models\Whislist;
use App\Models\Employee;
use App\Models\MasterCompanySetting;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

function ImageResize($filename, $folder, $new_folder, $w = 200, $h = 200)
{
    $targetPath = public_path() . '/' . $folder . '/' . $filename;
    $uplode_image_path_new = public_path() . '/' . $folder . '/' . $new_folder . '/';
    $img = ImageResize::make($targetPath);
    //echo $img; die;
    $img->orientate();
    $img->resize($w, $h, function ($constraint) {
        $constraint->aspectRatio();
    })->save($uplode_image_path_new . $filename);
}


function frontend_details()
{
    $categories_data = Category::selectRaw('master_categories.id,master_categories.slug,master_categories.image,master_categories.name,count(master_categories.id) as count')
        ->orderBy('master_categories.name', 'ASC')
        ->join('products', 'master_categories.id', '=', 'products.category_id')
        ->whereRaw('master_categories.status="1" AND products.id IS NOT NULL')
        ->where('products.status', '=', '1')
        ->whereNull('products.deleted_at')
        ->groupBy('master_categories.id')
        ->get();

    $companysetting_data = CompanySetting::select('id', 'company_name', 'address', 'email', 'phone', 'facebook', 'instagram', 'twitter', 'linkedin', 'footer_description')
        ->first();

    $user = Auth::guard('local')->user();
    if (!empty($user)) {

        $cart_Count = Cart::where('user_id', $user->id)->count();
    } else {
        if (isset($_COOKIE['cart_session'])) {
            $cart_Count = Cart::where('user_id', $_COOKIE['cart_session'])->count();
        } else {

            $cart_Count = '';
        }
    }



    return array('categories_data' => $categories_data, 'companysetting_data' => $companysetting_data, 'cart_Count' => $cart_Count);
}

function sub_categoryData($cid = '')
{

    $sucategory_data = SubCategory::select('master_sub_categories.id', 'master_sub_categories.slug', 'master_sub_categories.name')
        ->join('products', 'master_sub_categories.id', '=', 'products.sub_category_id')
        ->whereNotNull('products.id')
        ->where('master_sub_categories.category_id', $cid)
        ->where('master_sub_categories.status', '1')
        ->whereNull('master_sub_categories.deleted_at')
        ->orderBy('master_sub_categories.name', 'asc')
        ->groupBy('master_sub_categories.id')
        ->get();

    return array('sucategory_data' => $sucategory_data);
}
function wishlistData($pid = '')
{
    if (Auth::guard('local')->user()) {
        $user = Auth::guard('local')->user();

        $user_id = $user->id;
    } else {
        $user_id = '';
    }

    $wishlist_data = Whislist::where('product_id', $pid)->where('user_id', $user_id)->first();
    if ($wishlist_data) {
        return array('wishlist_data' => $wishlist_data);
    } else {
        return array('wishlist_data' => '');
    }
}

function rating_reviewcount($pid = '')
{

    $rating = 0;
    $review_count = 0;

    $review_data = Review::select('rating', 'review')
        ->where('product_id', $pid)
        ->get();

    if ($review_data->isNotEmpty()) {
        $productRating = $review_data->average('rating');
        $rating += $productRating;
        $review_count += $review_data->count();
    }

    if ($review_count > 0) {
        $avgRating = round($rating / $review_count, 1);
    } else {
        $avgRating = 0;
    }

    return array('avgRating' => $avgRating, 'review_count' => $review_count);
}

function numberToWords(float $number)
{
    $no = floor($number); // Round down to the nearest integer
    $point = round($number - $no, 2) * 100; // Extract the fractional part
    $digits_1 = strlen($no);
    $i = 0;
    $str = array();
    $words = array('0' => '', '1' => 'one', '2' => 'two',
        '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
        '7' => 'seven', '8' => 'eight', '9' => 'nine',
        '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
        '13' => 'thirteen', '14' => 'fourteen',
        '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
        '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
        '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
        '60' => 'sixty', '70' => 'seventy',
        '80' => 'eighty', '90' => 'ninety');
    $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
    while ($i < $digits_1) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += ($divider == 10) ? 1 : 2;

        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $str [] = ($number < 21) ? $words[$number] .
                " " . $digits[$counter] . $plural
                :
                $words[floor($number / 10) * 10]
                . " " . $words[$number % 10] . " "
                . $digits[$counter] . $plural;
        } else {
            $str[] = null;
        }
    }
    $str = array_reverse($str);
    $result = implode(' ', $str);

    $points = ($point) ?
        "" . $words[$point / 10] . " " .
        $words[$point = $point % 10] : '';

    if($points != '') {
        return $result . " Rupees " . $points . " Paise Only";
    } else {
        return $result . " Rupees Only";
    }
}







//time format
function date_time_format($in_time = '', $format = '')
{
    if ($in_time == '' || $format == '') {
        return null;
    } else {
        $in_time = str_replace('/', '-', $in_time);
        return date($format, strtotime($in_time));
    }
}

//For convert number to words
function conver_number_to_words($number)
{
    $no = floor($number);
    $point = round($number - $no, 2) * 100;
    $hundred = null;
    $digits_1 = strlen($no);
    $i = 0;
    $str = array();
    $words = array(
        '0' => '', '1' => 'one', '2' => 'two',
        '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
        '7' => 'seven', '8' => 'eight', '9' => 'nine',
        '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
        '13' => 'thirteen', '14' => 'fourteen',
        '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
        '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
        '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
        '60' => 'sixty', '70' => 'seventy',
        '80' => 'eighty', '90' => 'ninety'
    );
    $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
    while ($i < $digits_1) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += ($divider == 10) ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str[] = ($number < 21) ? $words[$number] .
                " " . $digits[$counter] . $plural . " " . $hundred :
                $words[floor($number / 10) * 10]
                . " " . $words[$number % 10] . " "
                . $digits[$counter] . $plural . " " . $hundred;
        } else
            $str[] = null;
    }
    $str = array_reverse($str);
    $result = implode('', $str);
    $points = ($point) ?
        "." . $words[$point / 10] . " " .
        $words[$point = $point % 10] : '';
    //echo $result . "Dollars  " . $points . " Paise";
    return strtoupper($result . "Dollars");
}
// create full word ordinal of number
function createFullWordOrdinal($number)
{
    $ord1     = array(1 => "first", 2 => "second", 3 => "third", 5 => "fifth", 8 => "eight", 9 => "ninth", 11 => "eleventh", 12 => "twelfth", 13 => "thirteenth", 14 => "fourteenth", 15 => "fifteenth", 16 => "sixteenth", 17 => "seventeenth", 18 => "eighteenth", 19 => "nineteenth");
    $num1     = array("zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eightteen", "nineteen");
    $num10    = array("zero", "ten", "twenty", "thirty", "fourty", "fifty", "sixty", "seventy", "eighty", "ninety");
    $places   = array(2 => "hundred", 3 => "thousand", 6 => "million", 9 => "billion", 12 => "trillion", 15 => "quadrillion", 18 => "quintillion", 21 => "sextillion", 24 => "septillion", 27 => "octillion");

    $number = array_reverse(str_split($number));

    if ($number[0] == 0) {
        if ($number[1] >= 2)
            $out = str_replace("y", "ieth", $num10[$number[1]]);
        else
            $out = $num10[$number[1]] . "th";
    } else if (isset($number[1]) && $number[1] == 1) {
        $out = $ord1[$number[1] . $number[0]];
    } else {
        if (array_key_exists($number[0], $ord1))
            $out = $ord1[$number[0]];
        else
            $out = $num1[$number[0]] . "th";
    }

    if ((isset($number[0]) && $number[0] == 0) || (isset($number[1]) && $number[1] == 1)) {
        $i = 2;
    } else {
        $i = 1;
    }

    while ($i < count($number)) {
        if ($i == 1) {
            $out = $num10[$number[$i]] . " " . $out;
            $i++;
        } else if ($i == 2) {
            $out = $num1[$number[$i]] . " hundred " . $out;
            $i++;
        } else {
            if (isset($number[$i + 2])) {
                $tmp = $num1[$number[$i + 2]] . " hundred ";
                $tmpnum = $number[$i + 1] . $number[$i];
                if ($tmpnum < 20)
                    $tmp .= $num1[$tmpnum] . " " . $places[$i] . " ";
                else
                    $tmp .= $num10[$number[$i + 1]] . " " . $num1[$number[$i]] . " " . $places[$i] . " ";

                $out = $tmp . $out;
                $i += 3;
            } else if (isset($number[$i + 1])) {
                $tmpnum = $number[$i + 1] . $number[$i];
                if ($tmpnum < 20)
                    $out = $num1[$tmpnum] . " " . $places[$i] . " " . $out;
                else
                    $out = $num10[$number[$i + 1]] . " " . $num1[$number[$i]] . " " . $places[$i] . " " . $out;
                $i += 2;
            } else {
                $out = $num1[$number[$i]] . " " . $places[$i] . " " . $out;
                $i++;
            }
        }
    }
    return $out;
}
// Display numbers with ordinal suffix
function ordinal($number)
{
    $ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
    if ((($number % 100) >= 11) && (($number % 100) <= 13))
        return $number . 'th';
    else
        return $number . $ends[$number % 10];
}

// get the image from S3 server and public folder 
function get_file_url($source_file_name)
{
    if (config('constants.storage_type') == 's3') {
        $client = Storage::disk('s3')->getDriver()->getAdapter()->getClient();

        $command = $client->getCommand('GetObject', [
            'Bucket' => 'ghdev-upload',
            'Key' => $source_file_name  // file name in s3 bucket which you want to access
        ]);

        $request = $client->createPresignedRequest($command, '+20 minutes');

        $image = (string) $request->getUri();
        return $image;
    } else {
        // return Storage::url($source_file_name);
        return asset($source_file_name);
    }
}

// upload the image in the s3 folder and public folder
function upload_file($destination_path, $source_path, $mt = '0')
{
    if (config('constants.storage_type') == 's3') {
        $res = Storage::disk('s3')->put(
            $destination_path,
            $source_path
        );
        return $res;
    } else {
        if ($mt == '0') {
            $res = Storage::disk('public')->put($destination_path, $source_path);
            return $res;
        } else {
            $image = time() . '.' . $source_path->getClientOriginalExtension();
            $uplode_image_path = public_path() . '/uploads/' . $destination_path . '/';
            $source_path->move($uplode_image_path, $image);
            return $image;
        }
    }
}

// send web notifications
function send_web_notification($notifications)
{

    $notification_data = array('sender_id' => $notifications->receiver_id, 'message' => $notifications->title);
    $curl = curl_init();
    $socket_url = config('constants.socket_url') . '/send_notification';
    curl_setopt_array($curl, array(
        CURLOPT_URL => $socket_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($notification_data),
        CURLOPT_HTTPHEADER => array(
            // Set here requred headers
            "accept: */*",
            "accept-language: en-US,en;q=0.8",
            "content-type: application/json",
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
}

//create company info hearder
function company_info_header($company, $type = 'normal')
{
    if ($type == 'pdf') {
        $margin_left = "margin-left:15%;";
    } else {
        $margin_left = "";
    }
    return '<div class="company-header" style="' . $margin_left . 'font-size:14px;width: 100%;text-align: center;">
                    <div style="display:inline-block;margin-right:10px;">
                        <img src="' . asset('company_logo/') . '/' . $company->report_logo . '" style="max-height: 90px;display:inline-block"><br>
                        Reg No:: ' . $company->reg_no . '
                    </div>
                    <div style="display:inline-block;">
                        <span style="font-size:27px;font-weight:600;">' . $company->company_name . '</span><br>
                            <b>(' . $company->company_service . ')</b><br>' . $company->address . ' <br>
                                Tel: +' . $company->phone . '<br>
                                Email: ' . $company->email . ' <br>
                        </div>
                  </div>';
}
//upload image 
function image_upload_public($file, $storePath, $imgName = "default")
{
    if ($imgName == 'default') {
        $filename1 = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    } else {
        $filename1 = $imgName;
    }
    $uplode_image_path = public_path() . '/' . $storePath;
    $file->move($uplode_image_path, $filename1);
    return $filename1;
}
function delteFile($filePath)
{
    return \File::delete($filePath);
}


// send notification to android 
function send_android_notification_FCM_new($title, $message, $token, $notification_id = "", $type = "", $redirection_id = "")
{
    if (!is_array($token)) {
        $token = array($token);
    }

    // raju sir 
    $SERVER_API_KEY = "AAAAOoAqk-k:APA91bFMmqzrq8ONogZPVUp5RiQIIP20GHo_4hfCsiQIUUSkp70ngAkF8U0W4LorMpRlqps-JhyojbNrEzUJcyw-DiYOLheoPFCGtT_iXx02ZM5lUeVIepaD0UfBWhF_Q63sXIIrThUz";

    $data = [
        "registration_ids" => $token,
        "notification" => [
            "title" => $title,
            "body" => $message,
            "sound" => "default",
            "message" => $message,
            "largeIcon" => "notification_icon",
            "smallIcon" => "ic_notification",
            "show_in_foreground" => true,
            "content_available" => true,
            "priority" => "high",
            "userInteraction" => false,
        ],
        "data" => [
            "type" => $type,
            "redirection_id" => $redirection_id,
            "notification_id" => $notification_id,
        ],
    ];
    // "<pre>"; print_r($data); die;

    $dataString = json_encode($data);
    //echo  $dataString; die;
    $headers = [
        'Authorization: key=' . $SERVER_API_KEY,
        'Content-Type: application/json',
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    $rest = curl_exec($ch);

    // Close connection
    curl_close($ch);
    return $rest;
}

function get_profile_img($type){
    $user = Employee::find(1);
    if($type == '1'){
        return $user->profile_image; 
    }
    else{
        return $user->name;
    }
}

function company_logo(){
    $company_settings = MasterCompanySetting::find(1);
    
        return $company_settings->company_logo; 
}

function company_setting(){
    $company_settings = MasterCompanySetting::find(1);
    
        return $company_settings; 
}

// Get appropriate icon for brand based on name
function get_brand_icon($brandName) {
    $brandName = strtolower(trim($brandName));
    
    // Icon mapping based on common brand types
    $iconMap = [
        'water' => 'fas fa-tint',
        'pump' => 'fas fa-cog',
        'pressure' => 'fas fa-gauge-high',
        'washer' => 'fas fa-spray-can',
        'cleaning' => 'fas fa-broom',
        'car' => 'fas fa-car',
        'auto' => 'fas fa-wrench',
        'power' => 'fas fa-bolt',
        'electric' => 'fas fa-plug',
        'motor' => 'fas fa-gear',
        'tools' => 'fas fa-tools',
        'industrial' => 'fas fa-industry',
        'tech' => 'fas fa-microchip',
        'machine' => 'fas fa-cogs',
        'equipment' => 'fas fa-hammer',
        'spare' => 'fas fa-puzzle-piece',
        'parts' => 'fas fa-cubes',
        'valve' => 'fas fa-circle-dot',
        'pipe' => 'fas fa-grip-lines-vertical',
        'hose' => 'fas fa-wave-square',
        'filter' => 'fas fa-filter',
        'oil' => 'fas fa-oil-can',
        'engine' => 'fas fa-engine',
        'hydraulic' => 'fas fa-compress-arrows-alt'
    ];
    
    // Check for keywords in brand name
    foreach ($iconMap as $keyword => $icon) {
        if (strpos($brandName, $keyword) !== false) {
            return $icon;
        }
    }
    
    // Default icons based on first letter
    $firstLetter = substr($brandName, 0, 1);
    if (in_array($firstLetter, ['a', 'b', 'c', 'd', 'e'])) {
        return 'fas fa-star';
    } elseif (in_array($firstLetter, ['f', 'g', 'h', 'i', 'j'])) {
        return 'fas fa-crown';
    } elseif (in_array($firstLetter, ['k', 'l', 'm', 'n', 'o'])) {
        return 'fas fa-gem';
    } elseif (in_array($firstLetter, ['p', 'q', 'r', 's', 't'])) {
        return 'fas fa-shield-alt';
    } else {
        return 'fas fa-medal';
    }
}