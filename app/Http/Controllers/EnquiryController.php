<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Brands;
use App\Models\Product;
use App\Models\MasterPage;
use App\Models\ListingImages;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Enquiry;


use Illuminate\Http\Request;
use DB;

class EnquiryController extends Controller
{ 
    
public function enquirenow(){
 $categorys = Category::all();

    return view('stc_products/enquire_now',compact('categorys'));
}

   
    
    //get data from database for dat table --------------------------------------------------------- End

    //Load Datatable or list view file  --------------------------------------------------------- Start
    public function enquiresubmit(Request $request)
    {
        dd('hello');
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric|max:11',
            'message' => 'required|string',
        ]);

        // Save the data into the enquiry table
        Enquiry::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'message' => $request->input('message'),
        ]);

        // Redirect with a success message
        return redirect()->back()->with('success', 'تم إرسال الاستفسار بنجاح!');
    }    //Load Datatable or list view file --------------------------------------------------------- End

   
    // add address end 

    // function for update customer password --->

    

    
}
