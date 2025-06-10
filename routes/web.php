<?php

use App\Models\FaqCategory;
use App\Http\Controllers\MasterRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MasterPageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Admin\companySettings;
use App\Http\Controllers\Api\CronJobController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\frontend\AuthController;
// use App\Http\Controllers\fontend\FrontendController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProductFeaturesController;
use App\Http\Controllers\frontend\FrontendController;
//Category Master Start 
use App\Http\Controllers\Auth\ResetPasswordController;
//code by gk
//Report Controllers
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\MasterEmailTemplateController;
use App\Http\Controllers\frontend\ProductDataController;
use App\Http\Controllers\frontend\Auth\UserloginController;
use App\Http\Controllers\Admin\Report\ReportStaffController;
use App\Http\Controllers\Admin\Report\ReportCustomerController;

//Category Master Start End
/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
 */


Route::get('/phpinfo', function () {
    return phpinfo();
});

Route::post('/update-status', [InquiryController::class, 'updateStatus'])->name('update.status');

// web.php
Route::get('/getProductsByCategory', [ProductController::class, 'getProductsByCategory'])->name('getProductsByCategory');


Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/productdetails/{id}', [HomeController::class, 'productdetails'])->name('productdetails');

Route::get('/product-list', [HomeController::class, 'products'])->name('products');
Route::get('/product-list/{id}', [HomeController::class, 'getproducts'])->name('getproducts');
Route::get('/enquire_now', [HomeController::class, 'enquirenow'])->name('enquire_now');
Route::post('/enquire_now', [HomeController::class, 'enquiresubmit'])->name('enquire_now');

Route::get('/about-us', [HomeController::class, 'aboutus'])->name('about-us');
Route::get('/contact_us', [HomeController::class, 'contactus'])->name('contact_us');

Route::post('/submit-contact', [ContactController::class, 'submitContact'])->name('contactsubmit');
// routes/web.php
Route::get('/searchproduct', [ProductController::class, 'searchproduct'])->name('searchproduct');

// Route::get('/category/{id}', [HomeController::class, 'filterByCategory'])->name('categoryfilter');


// Route::get('productdetails', [HomeController::class, 'productdetails'])->name('productdetails');


// Route::get('/stc_products/index', [HomeController::class, 'index']);
Route::get('callartisan', function () {
    Artisan::call('passport:install');
});


// Route::get('user/login', [UserloginController::class, 'user_login'])->name('user_login');
// Route::get('user/signup', [UserloginController::class, 'user_signup'])->name('user_signup');
Route::get('forgot_password', [UserloginController::class, 'forgot_password'])->name('forgot_password');




Route::get('broadcast_notification', [CronJobController::class, 'broadcast_notification']);

// Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('admin/login', [LoginController::class, 'login']);
Route::get('password/forget', [LoginController::class, 'showForgotForm'])->name('password.forget');
//Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('password/email', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('sendPushNotification', [DashboardController::class, 'sendPushNotification']);

Route::group(['middleware' => 'auth'], function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('dashboard/customer-chart', [DashboardController::class, 'customerChart'])->name('customerChart');
    Route::post('dashboard/service-chart', [DashboardController::class, 'serviceChart'])->name('serviceChart');
    Route::post('dashboard/supply-chart', [DashboardController::class, 'supplyChart'])->name('supplyChart');
    Route::post('dashboard.chart_productsales', [DashboardController::class, 'chart_productsales'])->name('dashboard.chart_productsales');
    Route::post('orderstatisticschart', [DashboardController::class, 'orderstatisticschart'])->name('orderstatisticschart');
    Route::post('fetchDatatotalrevenue', [DashboardController::class, 'fetchDatatotalrevenue'])->name('fetchDatatotalrevenue');
    Route::post('growthcharts', [DashboardController::class, 'growthcharts'])->name('growthcharts');
    Route::post('incomecharts', [DashboardController::class, 'incomecharts'])->name('incomecharts');

    // logout route
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/clear-cache', [HomeController::class, 'clearCache']);
    Route::post('get-notifications', [HomeController::class, 'get_notification_by_id']);
    Route::post('update-notifications', [HomeController::class, 'update_notification']);
    Route::get('/all-notifications', [HomeController::class, 'ViewAllNotification']);
    Route::post('/get-all-notifications', [HomeController::class, 'get_all_notifications']);
    Route::post('/mark-as-read-notification', [HomeController::class, 'update_status']);
    Route::post('notification-delete', [HomeController::class, 'delete_notification'])->name('notification.delete');

    /* routes by umrao start */



    Route::group(['middleware' => 'can:customer_master'], function () {
        Route::get('customer', [CustomerController::class, 'index']);
        Route::get('customer/list', [CustomerController::class, 'index']);
        Route::post('customer/store', [CustomerController::class, 'store']);
        Route::post('customer/add_address', [CustomerController::class, 'address']);
        Route::post('customer/delete-address', [CustomerController::class, 'delete_address']);
        Route::post('customer/update_pass', [CustomerController::class, 'password_update']);
        Route::post('customer/delete', [CustomerController::class, 'delete'])->name('delete.customer');
        Route::get('customer/view/{id}', [CustomerController::class, 'view']);
        Route::get('customer/orderview/{id}', [CustomerController::class, 'view1']);
    });

    Route::group(['middleware' => 'can:customer_add'], function () {
        Route::get('customer/create', [CustomerController::class, 'create']);
    });

    Route::group(['middleware' => 'can:customer_edit'], function () {
        Route::post('customer/get_by_id', [CustomerController::class, 'get_by_id']);
        Route::post('customer/get_by_id_pass', [CustomerController::class, 'get_by_id_pass']);
        Route::post('customer/update_status', [CustomerController::class, 'update_status'])->name('customer.status');
    });

    Route::group(['middleware' => 'can:customer_view'], function () {
        Route::get('customer/export', [CustomerController::class, 'export'])->name('customer.export');
    });


    // Route for handling product management start ----sarwan 
    Route::get('product', [ProductController::class, 'index']);
    Route::get('product/list', [ProductController::class, 'index']);
    Route::post('product/store', [ProductController::class, 'store']);
    Route::get('product/img_remove', [ProductController::class, 'img_remove']);
    Route::get('product/slider_img_remove', [ProductController::class, 'slider_img_remove']);
    Route::get('product/listing_img_remove', [ProductController::class, 'listing_img_remove']);

    Route::post('product/delete', [ProductController::class, 'delete'])->name('delete.product');
    Route::post('product/delete-image/{id}', [ProductController::class, 'deleteImage'])->name('product_delete_image');
    Route::POST('upload_ck_image', [ProductController::class, 'upload_ck_image'])->name('upload_ck_image');
    Route::get('product/create', [ProductController::class, 'create']);
    Route::get('product/edit/{id}', [ProductController::class, 'get_by_id']);
    Route::post('product/update_status', [ProductController::class, 'update_status'])->name('product.status');
    Route::get('product/view/{id}', [ProductController::class, 'view']);
    Route::get('UploadFile', [ProductController::class, 'UploadFile']);
    // Route::get('/get-subcategories/{id}', [ProductController::class, 'getSubcategories'])->name('get-subcategories');

    Route::get('/get-subcategories', [ProductController::class, 'getSubcategories']);
    // Route::get('/get-categories-by-brand/{id}', [ProductController::class, 'getCategoriesByBrand'])->name('get.categories.by.brand');
   Route::get('/get-categories-by-brand', [ProductController::class, 'getCategoriesByBrand'])->name('get.categories.by.brand');



    // Route for handling product management end ----
    // Route for brands management start----->
    Route::get('brands', [BrandsController::class, 'index']);
    Route::get('brands/list', [BrandsController::class, 'list']);
    Route::post('brands/store', [BrandsController::class, 'store']);
    Route::post('brands/delete', [BrandsController::class, 'delete'])->name('delete.brands');
    Route::post('brands/update_status', [BrandsController::class, 'update_status']);
    Route::post('brands/get_by_id', [BrandsController::class, 'get_by_id']);

    // Route for brands management end----->
    // Route for category management start----->
    Route::get('category', [CategoryController::class, 'index']);
    Route::get('category/list', [CategoryController::class, 'list']);
    Route::post('category/store', [CategoryController::class, 'store']);
    Route::post('category/delete', [CategoryController::class, 'delete'])->name('delete.category');
    Route::post('category/update_status', [CategoryController::class, 'update_status']);
    Route::post('category/get_by_id', [CategoryController::class, 'get_by_id']);

    // Route for category management end----->


    // Route for Subcategory management start----->
    Route::get('subcategory', [SubCategoryController::class, 'index']);
    Route::get('subcategory/list', [SubCategoryController::class, 'list']);
    Route::post('subcategory/store', [SubCategoryController::class, 'store']);
    Route::post('subcategory/delete', [SubCategoryController::class, 'delete'])->name('delete.subcategory');
    Route::post('subcategory/update_status', [SubCategoryController::class, 'update_status']);
    Route::post('subcategory/get_by_id', [SubCategoryController::class, 'get_by_id']);
    


    // Route for Subcategory management end----->



    Route::group(['middleware' => 'can:master_payment'], function () {
        Route::get('payment', [PaymentController::class, 'index']);
        Route::get('payment/list', [PaymentController::class, 'payment_list']);
        Route::get('payment/downloadinvoice/{id}', [PaymentController::class, 'download_payment_invoice'])->name('payment.download_invoice');
    });



    /** Route BY sarwan For Order **/

    Route::get('order', [OrderController::class, 'index']);
    Route::get('order/list', [OrderController::class, 'index']);
    Route::post('order/store', [OrderController::class, 'store']);
    Route::post('order/delete', [OrderController::class, 'delete'])->name('delete.order');
    Route::post('order/get_address', [OrderController::class, 'get_address'])->name('get_address.order');
    Route::post('order/get_product', [OrderController::class, 'get_product'])->name('get_product.order');
    Route::post('order/product_detail', [OrderController::class, 'product_detail'])->name('product_detail.order');
    Route::get('order/create', [OrderController::class, 'create']);
    Route::post('order/coupon_code', [OrderController::class, 'coupon_code'])->name('coupon_code.order');
    Route::get('order/edit/{id}', [OrderController::class, 'get_by_id']);
    Route::post('order/update_status', [OrderController::class, 'update_status'])->name('order.payment_status');
    Route::post('order/order_status', [OrderController::class, 'update_status1'])->name('order.order_status');
    Route::post('order/order_status1', [OrderController::class, 'update_status2'])->name('order.order_status1');
    Route::post('order/product_status', [OrderController::class, 'order_status'])->name('order.product_status');
    Route::post('order/status', [OrderController::class, 'status_update'])->name('order.status');
    Route::get('order/view/{id}', [OrderController::class, 'view']);
    Route::get('order/downloadinvoice/{id}', [OrderController::class, 'download_order_invoice'])->name('order.download_invoice');

    // end -------

    Route::get('inquiry', [InquiryController::class, 'index']);
    Route::get('inquiry/list', [InquiryController::class, 'index']);
    Route::post('inquiry/store', [InquiryController::class, 'store']);
    Route::post('inquiry/delete', [InquiryController::class, 'delete'])->name('delete.inquiry');
    Route::post('inquiry/get_address', [InquiryController::class, 'get_address'])->name('get_address.inquiry');
    Route::post('inquiry/get_product', [InquiryController::class, 'get_product'])->name('get_product.inquiry');
    Route::post('inquiry/product_detail', [InquiryController::class, 'product_detail'])->name('product_detail.inquiry');
    Route::get('inquiry/create', [InquiryController::class, 'create']);
    Route::post('inquiry/coupon_code', [InquiryController::class, 'coupon_code'])->name('coupon_code.inquiry');
    Route::get('inquiry/edit/{id}', [InquiryController::class, 'get_by_id']);
    Route::post('inquiry/update_status', [InquiryController::class, 'update_status'])->name('inquiry.payment_status');
    Route::post('inquiry/inquiry_status', [InquiryController::class, 'update_status1'])->name('inquiry.inquiry_status');
    Route::post('inquiry/inquiry_status1', [InquiryController::class, 'update_status2'])->name('inquiry.inquiry_status1');
    Route::post('inquiry/product_status', [InquiryController::class, 'inquiry_status'])->name('inquiry.product_status');
    Route::post('inquiry/status', [InquiryController::class, 'status_update'])->name('inquiry.status');
    Route::get('inquiry/view/{id}', [InquiryController::class, 'view']);
    Route::get('inquiry/downloadinvoice/{id}', [InquiryController::class, 'download_inquiry_invoice'])->name('inquiry.download_invoice');


    // routes for handling news && blogs start -------
    Route::get('blog', [BlogController::class, 'index']);
    Route::get('blog/list', [BlogController::class, 'index']);
    Route::post('blog/delete', [BlogController::class, 'delete'])->name('delete.blog');
    Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create');;
    Route::post('blog/store', [BlogController::class, 'store']);
    Route::get('blog/edit/{id}', [BlogController::class, 'get_by_id']);
    Route::post('blog/update_status', [BlogController::class, 'update_status'])->name('blog.status');
    Route::get('blog/view/{id}', [BlogController::class, 'view']);



    // routes for handling news && blogs end -------



    // routes for handling slider start -------sarwan 
    Route::get('slider', [SliderController::class, 'index']);
    Route::get('slider/list', [SliderController::class, 'index']);
    Route::post('slider/store', [SliderController::class, 'store']);
    Route::post('slider/delete', [SliderController::class, 'delete'])->name('delete.slider');
    Route::get('slider/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('slider/get_by_id', [SliderController::class, 'get_by_id'])->name('view.slider');
    Route::post('slider/update_status', [SliderController::class, 'update_status'])->name('slider.status');
    Route::get('slider/view/{id}', [SliderController::class, 'get_by_id']);

    // routes for handling slider end -------

     // routes for ad slider start -------
    Route::get('ad', [AdController::class, 'index']);
    Route::get('ad/list', [AdController::class, 'index']);
    Route::post('ad/store', [AdController::class, 'store']);
    Route::post('ad/delete', [AdController::class, 'delete'])->name('delete.ad');
    Route::get('ad/create', [AdController::class, 'create'])->name('ad.create');
    Route::post('ad/get_by_id', [AdController::class, 'get_by_id'])->name('view.ad');
    Route::post('ad/update_status', [AdController::class, 'update_status'])->name('ad.status');
    Route::get('ad/view/{id}', [AdController::class, 'get_by_id']);

  // routes for ad end -------


    // Route for Feature Products start----->
    Route::get('product_feature', [ProductFeaturesController::class, 'index']);
    Route::get('product_feature/list', [ProductFeaturesController::class, 'index']);
    Route::post('product_feature/store', [ProductFeaturesController::class, 'store']);
    Route::post('product_feature/delete', [ProductFeaturesController::class, 'delete'])->name('delete.product_feature');
    Route::post('product_feature/update_status', [ProductFeaturesController::class, 'update_status'])->name('product_feature.status');
    Route::post('product_feature/get_by_id', [ProductFeaturesController::class, 'get_by_id']);




    Route::group(['middleware' => 'can:master_manage_banner'], function () {
        Route::get('banner', [BannerController::class, 'index']);
        Route::get('banner/list', [BannerController::class, 'index']);
        Route::post('banner/store', [BannerController::class, 'store']);
        Route::post('banner/delete', [BannerController::class, 'delete'])->name('delete.banner');
    });

    Route::group(['middleware' => 'can:master_add_banners'], function () {
        Route::get('banner/create', [BannerController::class, 'create']);
    });

    Route::group(['middleware' => 'can:master_edit_banner'], function () {
        Route::get('banner/edit/{id}', [BannerController::class, 'get_by_id']);
        Route::post('banner/update_status', [BannerController::class, 'update_status'])->name('banner.status');
    });

    Route::group(['middleware' => 'can:master_view_banner'], function () {

        Route::get('banner/view/{id}', [BannerController::class, 'view']);
    });


    Route::group(['middleware' => 'can:master_manage_brands'], function () {
        Route::get('brand', [BrandController::class, 'index']);
        Route::get('brand/list', [BrandController::class, 'list']);
        Route::post('brand/store', [BrandController::class, 'store']);
        Route::post('brand/delete', [BrandController::class, 'delete'])->name('delete.brand');
        Route::post('brand/update_status', [BrandController::class, 'update_status']);
        Route::post('brand/get_by_id', [BrandController::class, 'get_by_id']);
    });







    /* Master Role route */

    Route::group(['middleware' => 'can:master_manage_role'], function () {
        Route::get('masters/roles', [MasterRole::class, 'index']);
        Route::get('masters/roles/list', [MasterRole::class, 'list']);
        Route::post('masters/role/store', [MasterRole::class, 'store']);
        Route::post('masters/role/update_status', [MasterRole::class, 'update_status']);
        Route::post('masters/role/get_by_id', [MasterRole::class, 'get_by_id']);
        Route::get('masters/roles/permissions/{id}', [MasterRole::class, 'get_permission_by_id']);
        Route::post('masters/role/updatePermissions', [MasterRole::class, 'updatePermissions']);
        Route::post('masters/role/update_module_access', [MasterRole::class, 'update_module_access']);
    });


    //code by gk

    Route::get('report-management/customers', [ReportCustomerController::class, 'index'])->name('report.customer');
    Route::get('report-management/customers/list', [ReportCustomerController::class, 'index'])->name('report.customer.list');
    Route::get('report-management/customers/export', [ReportCustomerController::class, 'export'])->name('report.customer.export');


    // routes for static page management start sarwan ------->
    Route::get('masters/static_pages', [MasterPageController::class, 'index']);
    Route::get('masters/static_pages/list', [MasterPageController::class, 'list']);
    Route::post('masters/static_pages/store', [MasterPageController::class, 'store']);
    Route::post('masters/static_pages/update_status', [MasterPageController::class, 'update_status']);
    Route::post('masters/static_pages/get_by_id', [MasterPageController::class, 'get_by_id']);
    // routes for static page management end sarwan ------->
    Route::group(['middleware' => 'can:manage_setting'], function () {
        Route::get('company/setting', [companySettings::class, 'index']);
        Route::post('company/setting/store', [companySettings::class, 'store']);
    });
});
Route::group(['middleware' => 'can:staff_report'], function () {
    Route::get('report-management/staff', [ReportStaffController::class, 'index'])->name('report.staff');
    Route::get('report-management/staff/list', [ReportStaffController::class, 'index'])->name('report.staff.list');
    Route::get('report-management/staff/export', [ReportStaffController::class, 'export'])->name('report.staff.export');
});
Route::post('/fetch-subcategories', [SubCategoryController::class, 'fetchSubcategories'])->name('fetch.subcategories');
// Route::post('/fetch-categories', [CategoryController::class, 'fetchcategories'])->name('fetch.categories');
Route::post('/fetch-categories', [CategoryController::class, 'fetchCategories'])->name('fetch.categories');
Route::post('/fetch-brands', [CategoryController::class, 'fetchBrands'])->name('fetch.brands');













Route::group(['middleware' => 'can:master_manage_help_support'], function () {
    Route::get('support', [SupportController::class, 'index']);
    Route::get('support/list', [SupportController::class, 'list']);
    Route::post('support/get_by_id', [SupportController::class, 'get_by_id']);
    Route::post('support/store', [SupportController::class, 'store']);
});

Route::group(['middleware' => 'can:master_quotation'], function () {

    Route::get('quotation', [QuotationController::class, 'index']);
    Route::get('quotation/list', [QuotationController::class, 'list']);
    Route::post('quotation/get_by_id', [QuotationController::class, 'get_by_id']);
    Route::post('quotation/store', [QuotationController::class, 'store']);
});



//route for supplier

//profile route
Route::get('employee/profile/{id}', [EmployeeController::class, 'edit']);
Route::get('form', [EmployeeController::class, 'Form']);
Route::post('employee/profile/update', [EmployeeController::class, 'update']);
Route::post('employee/profile/profile_image_update', [EmployeeController::class, 'profile_image_update']);
Route::get('change/password/{id}', [EmployeeController::class, 'change_password']);
Route::post('change/password/update', [EmployeeController::class, 'update']);


/* routes by vk end */
// dashboard route  




//only those have manage_user permission will get access
Route::group(['middleware' => 'can:manage_user'], function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/user/get-list', [UserController::class, 'getUserList']);
    Route::get('/user/create', [UserController::class, 'create']);
    Route::post('/user/create', [UserController::class, 'store'])->name('create-user');
    Route::get('/user/{id}', [UserController::class, 'edit']);
    Route::post('/user/update', [UserController::class, 'update']);
    Route::get('/user/delete/{id}', [UserController::class, 'delete']);
});

//only those have manage_role permission will get access
Route::group(['middleware' => 'can:manage_role|manage_user'], function () {
    Route::get('/roles', [RolesController::class, 'index']);
    Route::get('/role/get-list', [RolesController::class, 'getRoleList']);
    Route::post('/role/create', [RolesController::class, 'create']);
    Route::get('/role/edit/{id}', [RolesController::class, 'edit']);
    Route::post('/role/update', [RolesController::class, 'update']);
    Route::get('/role/delete/{id}', [RolesController::class, 'delete']);
});


//only those have manage_permission permission will get access
Route::group(['middleware' => 'can:manage_permission|manage_user'], function () {
    Route::get('/permission', [PermissionController::class, 'index']);
    Route::get('/permission/get-list', [PermissionController::class, 'getPermissionList']);
    Route::post('/permission/create', [PermissionController::class, 'create']);
    Route::get('/permission/update', [PermissionController::class, 'update']);
    Route::get('/permission/delete/{id}', [PermissionController::class, 'delete']);
});

// get permissions
Route::get('get-role-permissions-badge', [PermissionController::class, 'getPermissionBadgeByRole']);


// permission examples
Route::get('/permission-example', function () {
    return view('permission-example');
});


Route::get('/login-1', function () {
    return view('pages.login');
});

Route::get('pages/{url}', [companySettings::class, 'localTerm']);







//-----------------frontend routes-----------------------------------------//
// Route::get('/', [FrontendController::class, 'index'])->name('/');
Route::post('featured_products', [FrontendController::class, 'featured_products'])->name('featured_products');
Route::get('categories', [FrontendController::class, 'categories'])->name('categories');

Route::get('product/{slug}', [ProductDataController::class, 'list_products'])->name('list.products');
Route::post('products/datalist', [ProductDataController::class, 'products_datalist'])->name('products.datalist');

Route::get('products/{slug}', [ProductDataController::class, 'details_products'])->name('details.products');
Route::post('rating_review', [ProductDataController::class, 'rating_review'])->name('rating_review');

Route::get('aboutUs', [FrontendController::class, 'about_us'])->name('about_us');
// Route::get('contactUs', [FrontendController::class, 'contact_us'])->name('contact_us');
Route::get('refundPolicy', [FrontendController::class, 'refund_policy'])->name('refund_policy');
Route::get('shippingPolicy', [FrontendController::class, 'shipping_policy'])->name('shipping_policy');
Route::get('privacyPolicy', [FrontendController::class, 'privacy_policy'])->name('privacy_policy');
Route::get('faq', [FrontendController::class, 'faq'])->name('faq');
Route::get('freequote', [FrontendController::class, 'free_quote'])->name('free_quote');
Route::get('termscondition', [FrontendController::class, 'terms_condition'])->name('terms_condition');

Route::post('free_quotesave', [FrontendController::class, 'free_quotesave'])->name('free_quotesave');
Route::post('contact_ussave', [FrontendController::class, 'contact_ussave'])->name('contact_ussave');

Route::get('signup', [AuthController::class, 'sign_up'])->name('sign_up');
Route::post('phone_unique', [AuthController::class, 'phone_unique'])->name('phone.unique');
Route::post('sign_upData', [AuthController::class, 'sign_upData'])->name('sign_upData');
Route::post('register_otppopup', [AuthController::class, 'register_otppopup'])->name('register_otppopup');
Route::post('register_otpverify', [AuthController::class, 'register_otpverify'])->name('register_otpverify');




Route::get('login', [AuthController::class, 'sign_in'])->name('sign_in');
Route::post('log_inData', [AuthController::class, 'log_inData'])->name('log_inData');
Route::post('log_inotp', [AuthController::class, 'log_inotp'])->name('log_inotp');
Route::post('log_otpverify', [AuthController::class, 'log_otpverify'])->name('log_otpverify');

Route::post('forgot_password', [AuthController::class, 'forgot_password'])->name('forgot_password');
Route::post('forgot_otpverify', [AuthController::class, 'forgot_otpverify'])->name('forgot_otpverify');
Route::post('change_password', [AuthController::class, 'change_password'])->name('change_password');

Route::get('logouts', [AuthController::class, 'log_out'])->name('log_out');

Route::post('add_tocart/{productId}', [FrontendController::class, 'add_tocart'])->name('add_tocart');

Route::get('remove_tocart', [FrontendController::class, 'remove_tocart'])->name('remove_tocart');
// Route::post('remove_tocart/{id}', [FrontendController::class, 'remove_tocart'])->name('remove_tocart');


// Route::post('remove_tocart', [FrontendController::class, 'remove_tocart'])->name('remove_tocart');
Route::get('cart-page', [FrontendController::class, 'add_cartpage'])->name('cart-page');
// routes/
Route::get('/get-cart-data', [FrontendController::class, 'getCartData'])->name('get.cart.data');
Route::post('/save-inquiry', [FrontendController::class, 'saveInquiry'])->name('save.inquiry');
Route::post('/update-quantity', [FrontendController::class, 'updateQuantity']);

// Route::get('emptyCart', [FrontendController::class, 'empty_cart'])->name('empty_cart');




Route::get('becomeChannerPartner', [FrontendController::class, 'become_channerpartner'])->name('become_channerpartner');
Route::post('become_channel', [FrontendController::class, 'become_channel'])->name('become_channel');
Route::post('become_channelData', [FrontendController::class, 'become_channelData'])->name('become_channelData');

Route::get('projectCustomer', [FrontendController::class, 'project_customer'])->name('project_customer');
Route::post('project_customerdata', [FrontendController::class, 'project_customerdata'])->name('project_customerdata');


//login routes
Route::post('add_towhislist', [FrontendController::class, 'add_towhislist'])->name('add_towhislist');

Route::group(['middleware' => 'auth.user'], function () {

    Route::get('wishlist', [FrontendController::class, 'wishlist_page'])->name('wishlist_page');
    Route::post('remove_toWishlist', [FrontendController::class, 'remove_toWishlist'])->name('remove_toWishlist');
    Route::get('profile', [FrontendController::class, 'profile'])->name('profile');
    Route::post('update_profile', [FrontendController::class, 'update_profile'])->name('update_profile');

    Route::get('address', [FrontendController::class, 'address'])->name('address');
    Route::get('newAddress', [FrontendController::class, 'newAddress'])->name('newAddress');
    Route::post('new_addressData', [FrontendController::class, 'new_addressData'])->name('new_addressData');
    Route::post('removeToaddress', [FrontendController::class, 'removeToaddress'])->name('removeToaddress');
    Route::get('editAddress/{id}', [FrontendController::class, 'editAddress'])->name('editAddress');
    Route::post('edit_addressData', [FrontendController::class, 'edit_addressData'])->name('edit_addressData');
    Route::post('update_password', [FrontendController::class, 'update_password'])->name('update_password');
    Route::get('orders', [FrontendController::class, 'orders'])->name('orders');


    Route::get('checkoutPage', [FrontendController::class, 'checkoutPage'])->name('checkoutPage');
    Route::post('remove_deliveryaddress', [FrontendController::class, 'remove_deliveryaddress'])->name('remove_deliveryaddress');
    Route::post('new_deliveryaddress', [FrontendController::class, 'new_deliveryaddress'])->name('new_deliveryaddress');
    Route::post('edit_deliveryaddress', [FrontendController::class, 'edit_deliveryaddress'])->name('edit_deliveryaddress');
    Route::post('edit_deliveryaddressData', [FrontendController::class, 'edit_deliveryaddressData'])->name('edit_deliveryaddressData');
    // Route::post('billing_addressData', [FrontendController::class, 'billing_addressData'])->name('billing_addressData');
    Route::post('chekout_order', [FrontendController::class, 'chekout_order'])->name('chekout_order');
    Route::get('paymentsuccessful', [FrontendController::class, 'payment_successful'])->name('payment_successful');
    Route::get('paymentfailed', [FrontendController::class, 'payment_failed'])->name('payment_failed');
    Route::get('orderdetails/{slug}/{id}', [FrontendController::class, 'order_details'])->name('order_details');



    Route::post('razorpay_link', [FrontendController::class, 'razorpay_link'])->name('razorpay_link');


    Route::get('buynowPage', [FrontendController::class, 'buy_nowPage'])->name('buy_nowPage');

    Route::post('apply_couponcode', [FrontendController::class, 'apply_couponcode'])->name('apply_couponcode');
    Route::get('downloadinvoice/{slug}', [FrontendController::class, 'download_invoice'])->name('download_invoice');
});

Route::post('buy_now', [FrontendController::class, 'buy_now'])->name('buy_now');
Route::post('checkout', [FrontendController::class, 'checkout'])->name('checkout');
Route::post('update_cartqty', [FrontendController::class, 'update_cartqty'])->name('update_cartqty');

Route::post('search_product', [ProductDataController::class, 'search_product'])->name('search_product');
Route::post('search_productpage', [ProductDataController::class, 'search_productpage'])->name('search_productpage');
Route::get('productSearch/{slug}', [ProductDataController::class, 'productSearch'])->name('productSearch');
Route::post('productssearchData', [ProductDataController::class, 'products_searchData'])->name('products.searchData');

Route::post('phone_uniquedealer', [FrontendController::class, 'phone_uniquedealer'])->name('phone.uniquedealer');

Route::get('phonepe', [FrontendController::class, 'phonePe']);
Route::any('phonepe-response', [FrontendController::class, 'response'])->name('response');
