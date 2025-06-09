 @extends('layouts.main')
@section('title', 'Company Settings')
@section('content')
<style>
    .info-input{
        font-size: 10px;
        top: -1px;
        border-radius: 50%;
        position: relative;
        color: #2f78bfc7;
    }
    .error
    {
        color : red !important;
    }

</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <h3>Company Settings</h3>
            </div>
            <div class="card-body">
                <div class="custom-tab">
                    <!-- <ul class="nav nav-tabs mb-3 w-100" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="company-setting-tab" data-toggle="tab" href="#company_setting_blog" role="tab" aria-controls="company_setting_blog" aria-selected="true">Company Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="t2-tab" data-toggle="tab" href="#t2" role="tab" aria-controls="t2" aria-selected="false">Tab 2</a>
                        </li>
                    </ul> -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="company_setting_blog" role="tabpanel" aria-labelledby="company-setting-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="view-page basicView">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">Basic Details<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="Company basic detail"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.basicForm').removeClass('d-none');$('.basicView').addClass('d-none')">Edit</a></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Company Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 viewCompenyName">{{$companyData->company_name}}</h6>
                                                </div>
                                            </div>
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Address</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 viewCompenyAddress">{{$companyData->address}}</h6>
                                                </div>
                                            </div>
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>E-mail</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 viewCompenyEmail">{{$companyData->email}}</h6>
                                                </div>
                                            </div>
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Phone No.</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 viewCompenyPhone">{{$companyData->phone}}</h6>
                                                </div>
                                            </div>
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Short Description.</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 viewCompenyPhone">{{$companyData->description}}</h6>
                                                </div>
                                            </div>
                                            <!-- <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Website</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 viewCompenyWebsite">{{$companyData->website}}</h6>
                                                </div>
                                            </div> -->
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label class="mb-3">Website Logo</label>
                                                    <div class="form-group">
                                                        <div class="copy_class">
                                                            <img class="company_logo_view img-responsive" src="{{asset('uploads/company_setting/logo')}}/{{$companyData->company_logo}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="mb-3">Favicon</label>
                                                    <div class="form-group">
                                                        <div class="copy_class">
                                                            <img class="company_favi_icon_view img-responsive" src="{{asset('uploads/company_setting/favi_icon')}}/{{$companyData->favi_icon}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-4">
                                                    <label class="mb-3">E-mail Logo</label>
                                                    <div class="form-group">
                                                        <div class="copy_class">
                                                            <img class="company_email_logo_view img-responsive" src="{{asset('uploads/company_setting/email_logo')}}/{{$companyData->email_logo}}">
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-page d-none basicForm">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">Basic Details Update<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="Company basic detail"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.basicView').removeClass('d-none');$('.basicForm').addClass('d-none')">Back</a></h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="javascript:void(0);" id="basicForm">
                                                @csrf
                                                <input type="hidden" name="id" value="1">
                                                <input type="hidden" name="action" value="basic">
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                    <label class="required">Company Name</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" placeholder="Company Name" name="company_name" value="{{$companyData->company_name}}" required="true">
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Address</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" placeholder="Address" name="address" value="{{$companyData->address}}" required="true">
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                    <label class="required">E-mail</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="email" class="form-control" placeholder="E-mail" name="email" value="{{$companyData->email}}" required="true">
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Phone Number</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="number" class="form-control" placeholder="Phone Number" name="phone_number" value="{{$companyData->phone}}" required="true">
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Short Description</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                    <textarea type="text" class="form-control" id="description" rows="2" placeholder="Short Description" name='description'>{{ isset($companyData) ? $companyData->description :''}}</textarea>
                                                    </div>

                                                    
                                                </div>
            
                                          
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Website Logo</label>
                                                    </div>
                                                    <div class="col-md-8 form-group">
                                                        <input type="file" class="file-upload-default form-control"  name="website_logo" accept="image/png, image/jpg, image/jpeg">
                                                        <div class="input-group col-xs-12">
                                                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                                            <span class="input-group-append">
                                                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                            </span>
                                                        </div>
                                                        <small style="position: relative;top: -9px;"> &nbsp;(jpeg, jpg, png)</small>
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Favicon</label>
                                                    </div>
                                                    <div class="col-md-8 form-group">
                                                        <input type="file" class="file-upload-default form-control"  name="favicon" accept="image/png, image/jpg, image/jpeg">
                                                        <div class="input-group col-xs-12">
                                                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                                            <span class="input-group-append">
                                                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                            </span>
                                                        </div>
                                                        <small style="position: relative;top: -9px;"> &nbsp;(jpeg, jpg, png)</small>
                                                    </div>
                                                </div>
                                                <!-- <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">E-mail Logo</label>
                                                    </div>
                                                    <div class="col-md-8 form-group">
                                                        <input type="file" class="file-upload-default form-control"  name="email_logo" accept="image/png, image/jpg, image/jpeg">
                                                        <div class="input-group col-xs-12">
                                                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                                            <span class="input-group-append">
                                                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                            </span>
                                                        </div>
                                                        <small style="position: relative;top: -9px;"> &nbsp;(jpeg, jpg, png)</small>
                                                    </div>
                                                </div> -->
                                                <div class="text-center">
                                                    <a href="JavaScript:void(0)" class="btn btn-primary" onclick="$('#basicForm').submit();">Update</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="view-page invoiceView">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">Invoice Details<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="Invoice Details"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.invoiceForm').removeClass('d-none');$('.invoiceView').addClass('d-none')">Edit</a></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Company Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 invoice_company_name_view">{{$companyData->invoice_company_name}}</h6>
                                                </div>
                                            </div>
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Company Address</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 invoice_company_address_view">{{$companyData->invoice_company_address}}</h6>
                                                </div>
                                            </div>
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Mobile</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 invoice_mobile_view">{{$companyData->invoice_mobile}}</h6>
                                                </div>
                                            </div>
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>GST Number</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 gst_view">{{$companyData->gst_number}}</h6>
                                                </div>
                                            </div>
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Bank Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 bank_name_view">{{$companyData->bank_name}}</h6>
                                                </div>
                                            </div>
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>A/C Number</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 ac_number_view">{{$companyData->ac_number}}</h6>
                                                </div>
                                            </div>
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>A/C Holder Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 ac_holder_name_view">{{$companyData->ac_holder_name}}</h6>
                                                </div>
                                            </div>
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>IFSC</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 ifsc_view">{{$companyData->ifsc}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-page d-none invoiceForm">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">Invoice Details Update<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="Invoice Details"></i></h4>
                                            <h5 class="m-0"><a href="JavaScript:void(0);" onclick="$('.invoiceView').removeClass('d-none');$('.invoiceForm').addClass('d-none')">Back</a></h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="javasrcipt:void(0)" id="invoiceForm">
                                                @csrf
                                                <input type="hidden" name="id" value="1">
                                                <input type="hidden" name="action" value="invoice">
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Company Name</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" placeholder="Company Name" name="invoice_company_name" value="{{$companyData->invoice_company_name}}" required="true">
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Company Address</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" placeholder="Company Address" name="invoice_company_address" value="{{$companyData->invoice_company_address}}" required="true">
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Mobile</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" placeholder="Mobile" name="invoice_mobile" value="{{$companyData->invoice_mobile}}" required="true">
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="">GST Number</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" placeholder="GST Number" name="gst_number" value="{{$companyData->gst_number}}" >
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="">Bank Name</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" placeholder="Bank Name" name="bank_name" value="{{$companyData->bank_name}}">
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="">A/C Number</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" placeholder="A/C Number" name="ac_number" value="{{$companyData->ac_number}}">
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="">A/C Holder Name</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" placeholder="A/C Holder Name" name="ac_holder_name" value="{{$companyData->ac_holder_name}}">
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="">IFSC</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" placeholder="IFSC" name="ifsc" value="{{$companyData->ifsc}}">
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#invoiceForm').submit();">Update</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <div class="view-page socialMediaView">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">Social Links<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="SMTP account details"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.socialMediaForm').removeClass('d-none');$('.socialMediaView').addClass('d-none')">Edit</a></h5>
                                        </div>
                                        <div class="card-body">
                                            
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Facebook</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 viewCompenyFacebook">{{$companyData->facebook}}</h6>
                                                </div>
                                            </div>
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Instagram</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 viewCompenyInstagram">{{$companyData->instagram}}</h6>
                                                </div>
                                            </div>
                                           <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Twitter</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 viewCompenyTwitter">{{$companyData->twitter}}</h6>
                                                </div>
                                            </div>
                                           <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Linkedin</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 viewCompenyLinkedin">{{$companyData->linkedin}}</h6>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="view-page d-none socialMediaForm">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">Social Links Update<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="SMTP account details"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.socialMediaView').removeClass('d-none');$('.socialMediaForm').addClass('d-none')">Back</a></h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="javasrcipt:void(0)" id="socialMediaForm">
                                                @csrf
                                                <input type="hidden" name="id" value="1">
                                                <input type="hidden" name="action" value="links">
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Facebook</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="url" class="form-control" placeholder="facebook Link" name="facebook" value="{{$companyData->facebook}}" required="true">
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Instagram</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="url" class="form-control" placeholder="Instagram Link" name="instagram" value="{{$companyData->instagram}}" required="true">
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Twitter</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="url" class="form-control" placeholder="Twitter Link" name="twitter" value="{{$companyData->twitter}}" required="true">
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Linkedin</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="url" class="form-control" placeholder="Linkedin Link" name="linkedin" value="{{$companyData->linkedin}}" required="true">
                                                    </div>
                                                </div>
                                               
                                                <div class="text-center">
                                                    <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#socialMediaForm').submit();">Update</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <!-- master settings -->

                                <div class="col-md-6">
                                    <div class="view-page masterSettingView">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">Master Settings<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="SMTP account details"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.masterSettingForm').removeClass('d-none');$('.masterSettingView').addClass('d-none')">Edit</a></h5>
                                        </div>
                                        <div class="card-body">
                                            
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Maximum COD Amount</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 viewCompenyCOD">{{$companyData->max_cod_amount}}</h6>
                                                </div>
                                            </div>
                                            <div class="row dialline" style="display:none;">
                                                <div class="col-md-4">
                                                    <label>Footer Description</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 viewCompenyfooter">{{$companyData->footer_description}}</h6>
                                                </div>
                                            </div>
                                       
                                           
                                        </div>
                                    </div>
                                    <div class="view-page d-none masterSettingForm">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">Master Setting Update<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="Master setting details"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.masterSettingView').removeClass('d-none');$('.masterSettingForm').addClass('d-none')">Back</a></h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="javasrcipt:void(0)" id="masterSettingForm">
                                                @csrf
                                                <input type="hidden" name="id" value="1">
                                                <input type="hidden" name="action" value="settings">
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Maximum COD Amount</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="number" class="form-control" placeholder="Maximum COD Amount" name="max_cod_amount" value="{{$companyData->max_cod_amount}}" required="true">
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Footer Description</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                    <textarea type="text" class="form-control" id="footer_description" rows="2" placeholder="Footer Description" name='footer_description'>{{ isset($companyData) ? $companyData->footer_description :''}}</textarea>
                                                    </div>

                                                    
                                                </div>
                                              
                                            
                                               
                                                <div class="text-center">
                                                    <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#masterSettingForm').submit();">Update</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


 <!--smtp details.......................................  -->

                                <!-- <div class="col-md-6">
                                    <div class="view-page smtpView">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">SMTP Details<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="SMTP account details"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.smtpForm').removeClass('d-none');$('.smtpView').addClass('d-none')">Edit</a></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Host Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 host_view">{{$companyData->smtp_hostname}}</h6>
                                                </div>
                                            </div>
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Port</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 port_view">{{$companyData->smtp_port}}</h6>
                                                </div>
                                            </div>
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Username</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 smtp_user_view">{{$companyData->smtp_username}}</h6>
                                                </div>
                                            </div>
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Password</label>
                                                </div>
                                                <div class="col-md-8 view_password_div">
                                                    <h6 class="mb-0 password_v_star">**********</h6>
                                                    <h6 class="mb-0 d-none password_v_password smtp_password_view">{{$companyData->smtp_password}}</h6>
                                                    <i class="fa fa-eye password_v_show"></i><i></i>
                                                </div>
                                            </div>
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>No Reply Email</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 no_reply_email_view">{{$companyData->smtp_no_reply_email}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-page d-none smtpForm">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">SMTP Details Update<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="SMTP account details"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.smtpView').removeClass('d-none');$('.smtpForm').addClass('d-none')">Back</a></h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="javasrcipt:void(0)" id="smtpForm">
                                                @csrf
                                                <input type="hidden" name="id" value="1">
                                                <input type="hidden" name="action" value="smtp">
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Host Name</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                    <input type="text" class="form-control" placeholder="Host Name" name="host_name" value="{{$companyData->smtp_hostname}}" required="true">
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Port</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                    <input type="text" class="form-control" placeholder="Port" name="port" value="{{$companyData->smtp_port}}" required="true">
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Username</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                    <input type="text" class="form-control" placeholder="User Id" name="user_id" value="{{$companyData->smtp_username}}" required="true">
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Password</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group col-xs-12">
                                                            <span class="input-group-append passView">
                                                                <button class="file-upload-browse btn btn-primary" type="button"><i class="fa fa-eye"></i></button>
                                                            </span>
                                                            <input type="password" class="pass_word form-control file-upload-info" name="Password" placeholder="Password" value="{{$companyData->smtp_password}}" required="true">
                                                        </div>
                                                        <div class="errorPasswordSmtp"></div>
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">No Reply Email</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                    <input type="email" class="form-control" placeholder="No Reply E-mail" name="no_reply_email" value="{{$companyData->smtp_no_reply_email}}" required="true">
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#smtpForm').submit();">Update</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> -->
                                <!--  smtp details end...................... -->

                                {{-- <div class="col-md-6" style="display: none;">
                                    <div class="view-page smsView">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">SMS Details<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="SMS account details"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.smsView').addClass('d-none');$('.smsForm').removeClass('d-none');">Edit</a></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Account ID</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 sms_account_view">{{$companyData->sms_account_id}}</h6>
                                                </div>
                                            </div>
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Auth Token</label>
                                                </div>
                                                <div class="col-md-8 view_password_div">
                                                    <h6 class="mb-0 password_v_star">*******************</h6>
                                                    <h6 class="mb-0 d-none password_v_password sms_auth_view">{{$companyData->sms_auth_token}}</h6>
                                                    <i class="fa fa-eye password_v_show"></i><i></i>
                                                </div>
                                            </div>
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Phone No.</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 sms_phone_view">{{$companyData->sms_phone_number}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-page d-none smsForm">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">SMS Details Update<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="SMS account details"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.smsForm').addClass('d-none');$('.smsView').removeClass('d-none');">Back</a></h5>
                                        </div>
                                        <div class="card-body ">
                                            <form action="javascript:void(0)" id="smsForm" >
                                                @csrf
                                                <input type="hidden" name="id" value="1">
                                                <input type="hidden" name="action" value="sms">
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Account ID</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h6 class="mb-0">
                                                            <input type="text" class="form-control" placeholder="Account ID" name="account_id" value="{{$companyData->sms_account_id}}" required="true">
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Auth Token</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group col-xs-12">
                                                            <span class="input-group-append passView">
                                                                <button class="file-upload-browse btn btn-primary" type="button"><i class="fa fa-eye"></i></button>
                                                            </span>
                                                            <input type="password" class="pass_word form-control file-upload-info" name="auth_tokenn" placeholder="Auth Token" value="{{$companyData->sms_auth_token}}" required="true">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Phone No.</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control numberOnly" maxlength="10" placeholder="Phone Number" name="sms_phone" value="{{$companyData->sms_phone_number}}" required="true">
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#smsForm').submit();">Update</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-6" style="display: none;">
                                    <div class="view-page descView">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">Company Description<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="Company descriptin"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.descView').addClass('d-none');$('.descForm').removeClass('d-none');">Edit</a></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Description</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 description_view">{{$companyData->description}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-page d-none descForm">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">Company Description Update<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="Company descriptin"></i></h4>
                                            <h5 class="m-0"><a href="JavaScript:void(0)" onclick="$('.descForm').addClass('d-none');$('.descView').removeClass('d-none');">Back</a></h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="javasrcipt:void();" id="descForm">
                                                @csrf
                                                <input type="hidden" name="id" value="1">
                                                <input type="hidden" name="action" value="description">
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Description</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                    <textarea required="true" class="form-control" placeholder="Description..." name="description" rows="4">{{$companyData->description}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#descForm').submit();">Update</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-6" style="display: none;">
                                    <div class="view-page renewalView">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">Package Renewal Details<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="Email for package renewal, will be sent automatically to the users, prior to set days of plan expiry"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.renewalForm').removeClass('d-none'); $('.renewalView').addClass('d-none')">Edit</a></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Package Renewal Days</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 renewal_view">{{$companyData->package_renewal_day}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-page d-none renewalForm">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">Package Renewal Details Update<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="Email for package renewal, will be sent automatically to the users, prior to set days of plan expiry"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.renewalForm').addClass('d-none'); $('.renewalView').removeClass('d-none')">Back</a></h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="javasrcipt:void();" id="renewalForm">
                                                @csrf
                                                <input type="hidden" name="id" value="1">
                                                <input type="hidden" name="action" value="renewal">
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Package Renewal Days</label>
                                                    </div>
                                                    <div class="col-md-8">
                                               
                                                        <div class="input-group col-xs-12">
                                                            <span class="input-group-append passView">
                                                                <button class="file-upload-browse btn btn-primary" type="button">Days</button>
                                                            </span>
                                                            <input type="text" class="form-control file-upload-info numberOnly" name="package_renewal_days" value="{{$companyData->package_renewal_day}}" placeholder="Package Renewal Days" required="true">
                                                        </div>
                                                    </div>
                
                                                </div>
                                                <div class="text-center">
                                                    <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#renewalForm').submit();">Update</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-6" style="display: none;">
                                    <div class="view-page reportView">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">Monthly Report Date<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="An automated report will be sent to the users on a monthly basis with all the data related to their business listed (showing the number of users contacted, enquired, users visited the site, etc.)	"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.reportView').addClass('d-none'); $('.reportForm').removeClass('d-none');">Edit</a></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>Monthly Report Date</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 report_view">{{$companyData->monthly_report_date}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-page d-none reportForm">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">Monthly Report Date Update<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="An automated report will be sent to the users on a monthly basis with all the data related to their business listed (showing the number of users contacted, enquired, users visited the site, etc.)	"></i></h4>
                                            <h5 class="m-0"><a href="JavaScript:void(0);" onclick="$('.reportView').removeClass('d-none'); $('.reportForm').addClass('d-none');">Back</a></h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="javasrcipt:void();" id="reportForm">
                                                @csrf
                                                <input type="hidden" name="id" value="1">
                                                <input type="hidden" name="action" value="report">
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Monthly Report Date</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select class="form-control" name="monthly_report_date" required="true" style="    height: 38px !important;">
                                                            <option value="">Select Date</option>
                                                            @for($startDay = 1; $startDay < 32 ; $startDay++)
                                                            @if($startDay < 10 )
                                                            <option value="0{{$startDay}}">0{{$startDay}}</option>
                                                            @else
                                                            <option value="{{$startDay}}">{{$startDay}}</option>
                                                            @endif
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#reportForm').submit();">Update</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-6" style="display: none;">
                                    <div class="view-page ipView">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">IP Block Details<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="Number of hits to block an ip"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.ipView').addClass('d-none'); $('.ipForm').removeClass('d-none')">Edit</a></h5>
                                        </div>
                                        <div class="card-body">
                                        <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>IP Block Hit</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="mb-0 ip_view">{{$companyData->ip_block_counts}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-page d-none ipForm">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">IP Block Details Update<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="Number of hits to block an ip"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.ipView').removeClass('d-none'); $('.ipForm').addClass('d-none')">Back</a></h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="javasrcipt:void();" id="ipForm">
                                                @csrf
                                                <input type="hidden" name="id" value="1">
                                                <input type="hidden" name="action" value="ip">
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">IP Block Hit</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" placeholder="IP Block Hit(Count)" class="form-control numberOnly" name="ip_block_hit" value="{{$companyData->ip_block_counts}}" required="true">
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#ipForm').submit();">Update</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-6" style="display: none;">
                                    <div class="view-page pinView">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">Report Download PIN<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="Report download pin"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.pinView').addClass('d-none'); $('.pinForm').removeClass('d-none')">Edit</a></h5>
                                        </div>
                                        <div class="card-body">
                                        <div class="row dialline">
                                                <div class="col-md-4">
                                                    <label>PIN</label>
                                                </div>
                                                <div class="col-md-8 view_password_div">
                                                    <h6 class="mb-0 password_v_star">****</h6>
                                                    <h6 class="mb-0 d-none password_v_password pin_view">{{$companyData->report_pin}}</h6>
                                                    <i class="fa fa-eye password_v_show"></i><i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-page d-none pinForm">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">Report Download PIN Update<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="Report download pin"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.pinView').removeClass('d-none'); $('.pinForm').addClass('d-none')">Back</a></h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="javasrcipt:void();" id="pinForm">
                                                @csrf
                                                <input type="hidden" name="id" value="1">
                                                <input type="hidden" name="action" value="pin">
                                                <div class="row  dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">PIN</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group col-xs-12">
                                                            <span class="input-group-append passView">
                                                                <button class="file-upload-browse btn btn-primary" type="button"><i class="fa fa-eye"></i></button>
                                                            </span>
                                                            <input type="password" class="pass_word form-control file-upload-info numberOnly" name="report_pin" placeholder="Report Download PIN" value="{{$companyData->report_pin}}" maxlength="4" required="true">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#pinForm').submit();">Update</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-6" style="display: none;">
                                    <div class="view-page googleKeyView">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">Google API Configuration<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="Google api key"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.googleKeyView').addClass('d-none'); $('.googleKeyForm').removeClass('d-none')">Edit</a></h5>
                                        </div>
                                        <div class="card-body">
                                        <div class="row  dialline">
                                                <div class="col-md-4">
                                                    <label>Google API Key</label>
                                                </div>
                                                <div class="col-md-8 view_password_div">
                                                    <h6 class="mb-0 password_v_star">*******************</h6>
                                                    <h6 class="mb-0 d-none password_v_password google_key_view">{{$companyData->google_api_key}}</h6>
                                                    <i class="fa fa-eye password_v_show"></i><i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-page d-none googleKeyForm">
                                        <div class="sub-head d-flex align-items-center">
                                            <h4 class="m-0">Google API Configuration Update<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip" title="" data-original-title="Google api key"></i></h4>
                                            <h5 class="m-0"><a href="javascript:void(0)" onclick="$('.googleKeyView').removeClass('d-none'); $('.googleKeyForm').addClass('d-none')">Back</a></h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="javasrcipt:void();" id="googleKeyForm">
                                                @csrf
                                                <input type="hidden" name="id" value="1">
                                                <input type="hidden" name="action" value="google_key">
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label class="required">Google API Key</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="input-group col-xs-12">
                                                            <span class="input-group-append passView">
                                                                <button class="file-upload-browse btn btn-primary" type="button"><i class="fa fa-eye"></i></button>
                                                            </span>
                                                            <input type="password" class="pass_word form-control file-upload-info" name="google_api_key" placeholder="Google Api Key" value="{{$companyData->google_api_key}}" required="true">
                                                        <div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#googleKeyForm').submit();">Update</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="row tab-pane fade" id="t2" role="tabpanel" aria-labelledby="t2-tab">
                            <h1>Tab 2</h1>
                        <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- push external js -->
@push('script')

<script>
    

    $('img').on('error', function(){
        $(this).attr('src', '<?= asset('dist/img/') ?>/Image_not_available.png');
    })
    $('body').find('select[name="monthly_report_date"]').val("<?= $companyData->monthly_report_date ?>");

    $(document).on("click", ".passView", function () {
        var atrr = $(this).parent().find(".pass_word").attr('type');
        if( atrr == 'password')
        {
            $(this).parent().find(".pass_word").attr('type', 'text');
            $(this).parent().find("i").attr('class', 'fa fa-eye-slash');     
        }
        else
        {
            $(this).parent().find(".pass_word").attr('type', 'password');
            $(this).parent().find("i").attr('class', 'fa fa-eye');
        }
       
        // file.trigger('click');
    });

    $(document).on("click", ".password_v_show", function () {
        var atrr = $(this).attr('class');
        if( atrr == 'fa fa-eye password_v_show')
        {
            $(this).parent().find(".password_v_star").addClass('d-none');
            $(this).parent().find(".password_v_password").removeClass('d-none');
            $(this).attr('class', 'fa fa-eye-slash password_v_show');     
        }
        else
        {
            $(this).parent().find(".password_v_password").addClass('d-none');
            $(this).parent().find(".password_v_star").removeClass('d-none');
            $(this).attr('class', 'fa fa-eye password_v_show'); 
        }
       
        // file.trigger('click');
    });


    $(document).on("click", ".file-upload-browse", function () {
        var file = $(this).parent().parent().parent().find('.file-upload-default');
        file.trigger('click');
    });
    $(document).on("change", ".file-upload-default", function () {
        $(this).parent().find('.file-upload-info').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });
    //Validate form input fields
    // this class use for input only a-z, A-Z, 0-9, Whitespace
    $('.AlphabetsOnly').keypress(function (e) {
        var regex = new RegExp(/^[a-zA-Z0-9-\s]+$/);
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) 
        {
            return true;
        }
        else 
        {
            $.notify('Special character not allowed', "error");
            e.preventDefault();
            return false;
        }
    });
    $('.numberOnly').keypress(function (e) {
        var regex = new RegExp(/^[0-9]+$/);
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) 
        {
            return true;
        }
        else 
        {
            $.notify('Allowed numbers only', "error");
            e.preventDefault();
            return false;
        }
    });
    // $('input[type="file"]').change(function(e) {
    //     var fileName = e.target.files[0].type;
    //     if (fileName == 'image/png' || fileName == 'image/jpeg' || fileName == 'image/jpg') 
    //     {
    //         var fileSize = e.target.files[0].size;
    //         // console.log(fileSize/1000000);
    //         if ((fileSize/1000000) <= 10) 
    //         {
    //             // console.log(fileSize/1000000+'mb');
    //         }
    //         else
    //         {
    //             $.notify('File size must be less than 10MB', "error");
    //             $(this).val('');       
    //         }
    //     }
    //     else
    //     {
    //         $.notify('Only jpg,png,jpeg files allowed', "error");
    //         $(this).val('');
    //     }
    // }); 
    //Validate form input fields end

    //clear all errors    
    function clearErrors(){
        $("#editmodal").find(".error").html('');
    }

$.validator.addMethod("extyp", function(value, element) {
    // console.log(element)
    // console.log(value)
    if(!value){
        return true;
    }
    if (!value.match(/\.(jpg|jpeg|png|JPG|PNG|JPEG)$/i)) {
        return false;
    }
    return true;
},'Only formats are allowed: jpeg, jpg, png');
$.validator.addMethod("email_val", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
},'Please enter a valid email address.');
    //update basic Details
    $("#basicForm").validate({
        rules: 
        {
            email : {
                required : true,
                email_val : true
            },
            company_name : {
                required : true,
            },
            address : {
                required : true,
            },
            phone_number : {
                required : true,
                minlength: 10,
                maxlength: 10,
            },
            description : {
                required : true,
                maxlength: 200
            },
            // website : {
            //     required : true,
            // },
            website_logo : {
                extyp : true,
            },
            favicon : {
                extyp : true,
            },
            email_logo : {
                extyp : true,
            },
        },
        messages: {},
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-control').parent().append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
        submitHandler: function(form) 
        {
            // var websiteLogo = URL.createObjectURL($("body").find("input[name='website_logo']")[0].files[0]);
            // setTimeout(function(){
            //     var favicon = URL.createObjectURL($("body").find("input[name='favicon']")[0].files[0]);
            //     setTimeout(function(){
            //         var email_logo = URL.createObjectURL($("body").find("input[name='email_logo']")[0].files[0]);
            //     },1000);
            // },1000);

            $('.loader').css('display','block')
            var formData = new FormData($("#basicForm")[0]);
            $.ajax({
                type: "POST",
                url: "{{url('company/setting/store')}}",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) 
                {
                    //hide loader
                    $('.loader').css('display','none')
                    var response = JSON.parse(data);
                    if (response.code == 200) {
                        //show notification
                        $.notify(response.msg, "success");

                        //set view data 
                        // $(".viewCompenyName").text($("input[name='email']").val());
                        // $(".viewCompenyAddress").text($("input[name='address']").val());
                        // $(".viewCompenyEmail").text($("input[name='email']").val());
                        // $(".viewCompenyPhone").text($("input[name='phone_number']").val());
                        // $(".viewCompenyWebsite").text($("input[name='website']").val());
                        // $(".company_logo_view").attr("src", "");
                        // $(".company_favi_icon_view").attr("src", "");  
                        // $(".company_email_logo_view").attr("src", "");
                        // setTimeout(function(){
                            // $(".company_logo_view").attr("src", websiteLogo);
                            // $(".company_favi_icon_view").attr("src", favicon);  
                            // $(".company_email_logo_view").attr("src", email_logo);    
                        // },2000);
                        //hide form
                        // $('.basicForm').addClass('d-none');
                        // $('.basicView').removeClass('d-none');
                        setTimeout(function(){
                            location.reload();
                        },3000);
                    } 
                    else 
                    {
                        //show notification
                        $.notify(response.msg, "warning");
                    }
                },
            });
            return false;
        }
    });
        //update social media  links
        $("#socialMediaForm").validate({
        rules: 
        {
            
            facebook : {
                required : true,
            },
            instagram : {
                required : true,
            },
            twitter : {
                required : true,
            },
            linkedin : {
                required : true,
            },
        
        },
        messages: {},
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-control').parent().append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
        submitHandler: function(form) 
        {
            // var websiteLogo = URL.createObjectURL($("body").find("input[name='website_logo']")[0].files[0]);
            // setTimeout(function(){
            //     var favicon = URL.createObjectURL($("body").find("input[name='favicon']")[0].files[0]);
            //     setTimeout(function(){
            //         var email_logo = URL.createObjectURL($("body").find("input[name='email_logo']")[0].files[0]);
            //     },1000);
            // },1000);

            $('.loader').css('display','block')
            var formData = new FormData($("#socialMediaForm")[0]);
            $.ajax({
                type: "POST",
                url: "{{url('company/setting/store')}}",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) 
                {
                    //hide loader
                    $('.loader').css('display','none')
                    var response = JSON.parse(data);
                    if (response.code == 200) {
                        //show notification
                        $.notify(response.msg, "success");

                        //set view data 
                        // $(".viewCompenyName").text($("input[name='email']").val());
                        // $(".viewCompenyAddress").text($("input[name='address']").val());
                        // $(".viewCompenyEmail").text($("input[name='email']").val());
                        // $(".viewCompenyPhone").text($("input[name='phone_number']").val());
                        // $(".viewCompenyWebsite").text($("input[name='website']").val());
                        // $(".company_logo_view").attr("src", "");
                        // $(".company_favi_icon_view").attr("src", "");  
                        // $(".company_email_logo_view").attr("src", "");
                        // setTimeout(function(){
                            // $(".company_logo_view").attr("src", websiteLogo);
                            // $(".company_favi_icon_view").attr("src", favicon);  
                            // $(".company_email_logo_view").attr("src", email_logo);    
                        // },2000);
                        //hide form
                        // $('.basicForm').addClass('d-none');
                        // $('.basicView').removeClass('d-none');
                        setTimeout(function(){
                            location.reload();
                        },3000);
                    } 
                    else 
                    {
                        //show notification
                        $.notify(response.msg, "warning");
                    }
                },
            });
            return false;
        }
    });
     //update master settings
     $("#masterSettingForm").validate({
        rules: 
        {
            
            max_cod_amount : {
                required : true,
                min:0,
                max:500000,
            },
            footer_description : {
                required : true,
                maxlength: 200
            },
          
        
        },
        messages: {},
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-control').parent().append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
        submitHandler: function(form) 
        {
            // var websiteLogo = URL.createObjectURL($("body").find("input[name='website_logo']")[0].files[0]);
            // setTimeout(function(){
            //     var favicon = URL.createObjectURL($("body").find("input[name='favicon']")[0].files[0]);
            //     setTimeout(function(){
            //         var email_logo = URL.createObjectURL($("body").find("input[name='email_logo']")[0].files[0]);
            //     },1000);
            // },1000);

            $('.loader').css('display','block')
            var formData = new FormData($("#masterSettingForm")[0]);
            $.ajax({
                type: "POST",
                url: "{{url('company/setting/store')}}",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) 
                {
                    //hide loader
                    $('.loader').css('display','none')
                    var response = JSON.parse(data);
                    if (response.code == 200) {
                        //show notification
                        $.notify(response.msg, "success");

                        //set view data 
                        // $(".viewCompenyName").text($("input[name='email']").val());
                        // $(".viewCompenyAddress").text($("input[name='address']").val());
                        // $(".viewCompenyEmail").text($("input[name='email']").val());
                        // $(".viewCompenyPhone").text($("input[name='phone_number']").val());
                        // $(".viewCompenyWebsite").text($("input[name='website']").val());
                        // $(".company_logo_view").attr("src", "");
                        // $(".company_favi_icon_view").attr("src", "");  
                        // $(".company_email_logo_view").attr("src", "");
                        // setTimeout(function(){
                            // $(".company_logo_view").attr("src", websiteLogo);
                            // $(".company_favi_icon_view").attr("src", favicon);  
                            // $(".company_email_logo_view").attr("src", email_logo);    
                        // },2000);
                        //hide form
                        // $('.basicForm').addClass('d-none');
                        // $('.basicView').removeClass('d-none');
                        setTimeout(function(){
                            location.reload();
                        },3000);
                    } 
                    else 
                    {
                        //show notification
                        $.notify(response.msg, "warning");
                    }
                },
            });
            return false;
        }
    });
    //update Invoice Detailss
    $("#invoiceForm").validate({
        submitHandler: function(form) {
            var formData = new FormData($("#invoiceForm")[0]);
            $.ajax({
                type: "POST",
                url: "{{url('company/setting/store')}}",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () 
                {
                    $('.loader').show();
                },
                success: function(data) 
                {
                    //hide loader
                    $('.loader').hide();
                    var response = JSON.parse(data);
                    if (response.code == 200) {
                        //show notification
                        $.notify(response.msg, "success");

                        //set view data 
                        $(".invoice_company_name_view").text($("input[name='invoice_company_name']").val());
                        $(".invoice_mobile_view").text($("input[name='invoice_mobile']").val());
                        $(".gst_view").text($("input[name='gst_number']").val());
                        $(".bank_name_view").text($("input[name='bank_name']").val());
                        $(".ac_holder_name_view").text($("input[name='ac_holder_name']").val());
                        $(".ac_number_view").text($("input[name='ac_number']").val());
                        $(".invoice_company_address_view").text($("input[name='invoice_company_address']").val());
                        $(".ifsc_view").text($("input[name='ifsc']").val());                        
                        //hide form
                        $('.invoiceForm').addClass('d-none');
                        $('.invoiceView').removeClass('d-none');
                    } 
                    else 
                    {
                        //show notification
                        $.notify(response.msg, "warning");
                    }
                },
            });
            return false;
        }
    });
    //update SMTP
    $('input').on('invalid', function(){
        alert();
    });

    $("#smtpForm").validate({
        // rules: {
        //     Password: "required"
        // },
        // messages:
        // {
        //     Password: "This field is required."
        // },
        // errorElement : 'h6',
        // errorLabelContainer: '.errorPasswordSmtp',
        errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-control').parent().append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
        submitHandler: function(form) {
            $('.loader').css('display','block')
            var formData = new FormData($("#smtpForm")[0]);
            $.ajax({
                type: "POST",
                url: "{{url('company/setting/store')}}",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) 
                {
                    //hide loader
                    $('.loader').css('display','none')
                    var response = JSON.parse(data);
                    if (response.code == 200) {
                        //show notification
                        $.notify(response.msg, "success");

                        //set view data 
                        $(".host_view").text($("input[name='host_name']").val());
                        $(".port_view").text($("input[name='port']").val());
                        $(".smtp_user_view").text($("input[name='user_id']").val());
                        $(".smtp_password_view").text($("input[name='Password']").val());
                        $(".no_reply_email_view").text($("input[name='no_reply_email']").val());  
                        //hide form
                        $('.smtpForm').addClass('d-none');
                        $('.smtpView').removeClass('d-none');
                    } 
                    else 
                    {
                        //show notification
                        $.notify(response.msg, "warning");
                    }
                },
            });
            return false;
        }
    });
    //update SMS
    $("#smsForm").validate({
        submitHandler: function(form){
            $('.loader').css('display','block')
            var formData = new FormData($("#smsForm")[0]);
            $.ajax({
                type: "POST",
                url: "{{url('company/setting/store')}}",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) 
                {
                    //hide loader
                    $('.loader').css('display','none')
                    var response = JSON.parse(data);
                    if (response.code == 200) {
                        //show notification
                        $.notify(response.msg, "success");

                        //set view data 
                        $(".sms_account_view").text($("input[name='account_id']").val());
                        $(".sms_auth_view").text($("input[name='auth_tokenn']").val());
                        $(".sms_phone_view").text($("input[name='sms_phone']").val()); 
                        //hide form
                        $('.smsForm').addClass('d-none');
                        $('.smsView').removeClass('d-none');
                    } 
                    else 
                    {
                        //show notification
                        $.notify(response.msg, "warning");
                    }
                },
            });
            return false;
        }
    });
    $("#descForm").validate({
        submitHandler: function(form){
            $('.loader').css('display','block')
            var formData = new FormData($("#descForm")[0]);
            $.ajax({
                type: "POST",
                url: "{{url('company/setting/store')}}",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) 
                {
                    //hide loader
                    $('.loader').css('display','none')
                    var response = JSON.parse(data);
                    if (response.code == 200) {
                        //show notification
                        $.notify(response.msg, "success");

                        //set view data 
                        $(".description_view").text($("textarea[name='description']").val());
                        //hide form
                        $('.descForm').addClass('d-none');
                        $('.descView').removeClass('d-none');
                    } 
                    else 
                    {
                        //show notification
                        $.notify(response.msg, "warning");
                    }
                },
            });
            return false;
        }
    });
    $("#renewalForm").validate({
        submitHandler: function(form){
            $('.loader').css('display','block')
            var formData = new FormData($("#renewalForm")[0]);
            $.ajax({
                type: "POST",
                url: "{{url('company/setting/store')}}",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) 
                {
                    //hide loader
                    $('.loader').css('display','none')
                    var response = JSON.parse(data);
                    if (response.code == 200) {
                        //show notification
                        $.notify(response.msg, "success");

                        //set view data 
                        $(".renewal_view").text($("input[name='package_renewal_days']").val());
                        //hide form
                        $('.renewalForm').addClass('d-none');
                        $('.renewalView').removeClass('d-none');
                    } 
                    else 
                    {
                        //show notification
                        $.notify(response.msg, "warning");
                    }
                },
            });
            return false;
        }
    });
    $("#reportForm").validate({
        submitHandler: function(form){
            $('.loader').css('display','block')
            var formData = new FormData($("#reportForm")[0]);
            $.ajax({
                type: "POST",
                url: "{{url('company/setting/store')}}",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) 
                {
                    //hide loader
                    $('.loader').css('display','none')
                    var response = JSON.parse(data);
                    if (response.code == 200) {
                        //show notification
                        $.notify(response.msg, "success");

                        //set view data 
                        $(".report_view").text($("select[name='monthly_report_date']").val());
                        //hide form
                        $('.reportForm').addClass('d-none');
                        $('.reportView').removeClass('d-none');
                    } 
                    else 
                    {
                        //show notification
                        $.notify(response.msg, "warning");
                    }
                },
            });
            return false;
        }
    });
    $("#ipForm").validate({
        submitHandler: function(form){
            $('.loader').css('display','block')
            var formData = new FormData($("#ipForm")[0]);
            $.ajax({
                type: "POST",
                url: "{{url('company/setting/store')}}",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) 
                {
                    //hide loader
                    $('.loader').css('display','none')
                    var response = JSON.parse(data);
                    if (response.code == 200) {
                        //show notification
                        $.notify(response.msg, "success");

                        //set view data 
                        $(".ip_view").text($("input[name='ip_block_hit']").val());
                        //hide form
                        $('.ipForm').addClass('d-none');
                        $('.ipView').removeClass('d-none');
                    } 
                    else 
                    {
                        //show notification
                        $.notify(response.msg, "warning");
                    }
                },
            });
            return false;
        }
    });
    $("#pinForm").validate({
        submitHandler: function(form){
            $('.loader').css('display','block')
            var formData = new FormData($("#pinForm")[0]);
            $.ajax({
                type: "POST",
                url: "{{url('company/setting/store')}}",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) 
                {
                    //hide loader
                    $('.loader').css('display','none')
                    var response = JSON.parse(data);
                    if (response.code == 200) {
                        //show notification
                        $.notify(response.msg, "success");

                        //set view data 
                        $(".pin_view").text($("input[name='report_pin']").val());
                        //hide form
                        $('.pinForm').addClass('d-none');
                        $('.pinView').removeClass('d-none');
                    } 
                    else 
                    {
                        //show notification
                        $.notify(response.msg, "warning");
                    }
                },
            });
            return false;
        }
    });
    $("#googleKeyForm").validate({
        submitHandler: function(form){
            $('.loader').css('display','block')
            var formData = new FormData($("#googleKeyForm")[0]);
            $.ajax({
                type: "POST",
                url: "{{url('company/setting/store')}}",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) 
                {
                    //hide loader
                    $('.loader').css('display','none')
                    var response = JSON.parse(data);
                    if (response.code == 200) {
                        //show notification
                        $.notify(response.msg, "success");

                        //set view data 
                        $(".google_key_view").text($("input[name='google_api_key']").val());
                        //hide form
                        $('.googleKeyForm').addClass('d-none');
                        $('.googleKeyView').removeClass('d-none');
                    } 
                    else 
                    {
                        //show notification
                        $.notify(response.msg, "warning");
                    }
                },
            });
            return false;
        }
    });
</script>
@endpush
@endsection
