@extends('layouts/contentNavbarLayout')
@section('title', 'Company Settings')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header justify-content-between">
                <h3>Company Settings</h3>
            </div>
            <div class="card-body">
                <div class="custom-tab">
                    <div class="tab-content p-0" id="myTabContent">
                        <div class="tab-pane fade show active" id="company_setting_blog" role="tabpanel"
                            aria-labelledby="company-setting-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="view-page basicView">
                                        <div class="sub-head d-flex align-items-center justify-content-between">
                                            <h5 class="m-0">Basic Details<i class="p-1 fa fa-info-circle info-input"
                                                    data-bs-toggle="tooltip" title=""
                                                    data-original-title="Company basic detail"></i></h5>
                                            <h6 class="m-0"><a href="javascript:void(0)"
                                                    onclick="$('.basicForm').removeClass('d-none');$('.basicView').addClass('d-none')">Edit</a>
                                            </h6>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group mb-3">
                                                    <div class="row dialline">
                                                        <div class="col-md-4">
                                                            <label>Company Name</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <h6 class="mb-0 viewCompenyName">
                                                                {{$companyData->company_name}}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mb-3">
                                                    <div class="row dialline">
                                                        <div class="col-md-4">
                                                            <label>Address</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <h6 class="mb-0 viewCompenyAddress">
                                                                {{$companyData->address}}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mb-3">
                                                    <div class="row dialline">
                                                        <div class="col-md-4">
                                                            <label>E-mail</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <h6 class="mb-0 viewCompenyEmail">{{$companyData->email}}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mb-3">
                                                    <div class="row dialline">
                                                        <div class="col-md-4">
                                                            <label>Phone No.</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <h6 class="mb-0 viewCompenyPhone">{{$companyData->phone}}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mb-3">
                                                    <div class="row dialline">
                                                        <div class="col-md-4">
                                                            <label>Short Description.</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <h6 class="mb-0 viewCompenyPhone">
                                                                {{$companyData->description}}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class=" upload_logo form-group mb-3">
                                                    <div class="row dialline">
                                                        <div class="col-md-4">
                                                            <label class="mb-2">Website Logo</label>
                                                            <div class="form-group">
                                                                <div
                                                                    class="copy_class d-flex align-items-center justify-content-center">
                                                                    <img class="company_logo_view img-responsive"
                                                                        src="{{asset('uploads/logo')}}/{{$companyData->company_logo}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="mb-2">Favicon</label>
                                                            <div class="form-group">
                                                                <div
                                                                    class="copy_class d-flex align-items-center justify-content-center">
                                                                    <img class="company_favi_icon_view img-responsive"
                                                                        src="{{asset('uploads/company_setting/favi_icon')}}/{{$companyData->favi_icon}}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-page d-none basicForm">
                                        <div class="sub-head d-flex align-items-center justify-content-between">
                                            <h5 class="m-0">Basic Details Update<i
                                                    class="p-1 fa fa-info-circle info-input" data-toggle="tooltip"
                                                    title="" data-original-title="Company basic detail"></i></h5>
                                            <h6 class="m-0"><a href="javascript:void(0)"
                                                    onclick="$('.basicView').removeClass('d-none');$('.basicForm').addClass('d-none')">Back</a>
                                            </h6>
                                        </div>
                                        <form action="javascript:void(0);" id="basicForm">
                                            @csrf
                                            <input type="hidden" name="id" value="1">
                                            <input type="hidden" name="action" value="basic">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="mb-3 fv-plugins-icon-container">
                                                        <label class="form-label" for="company_name">Company Name
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="company_name"
                                                            placeholder="Company Name" name="company_name"
                                                            value="{{$companyData->company_name}}">
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="mb-3 fv-plugins-icon-container">
                                                        <label class="form-label" for="phone_number">Phone Number
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="phone_number"
                                                            placeholder="Phone Number" name="phone_number"
                                                            value="{{$companyData->phone}}">
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="mb-3 fv-plugins-icon-container">
                                                        <label class="form-label" for="email">E-mail <span
                                                                class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" id="email"
                                                            placeholder="E-mail" name="email"
                                                            value="{{$companyData->email}}">
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="row"> --}}


                                            <div class="col-sm-12">
                                                <div class="mb-3 fv-plugins-icon-container">
                                                    <label class="form-label" for="address">Address <span
                                                            class="text-danger">*</span></label>
                                                    <textarea type="text" class="form-control" id="address"
                                                        placeholder="Address" name="address"
                                                        value="">{{ isset($companyData) ? $companyData->address :''}}</textarea>
                                                    <div
                                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="mb-3 fv-plugins-icon-container">
                                                    <label class="form-label" for="description">Short Description
                                                        <span class="text-danger">*</span></label>
                                                    <textarea class="form-control" id="description" rows="2"
                                                        placeholder="Short Description" name="description"
                                                        required>{{ isset($companyData) ? $companyData->description :''}}</textarea>
                                                    <div
                                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- </div> --}}
                                            {{-- <div class="row"> --}}
                                            <div class="col-md-12">
                                                <div class="upload_logo form-group mb-3">


                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">Website Logo <span
                                                                        class="text-danger">*</span></label>
                                                                <div class="mb-2">
                                                                    <input type="file" class="form-control"
                                                                        name="website_logo"
                                                                        accept="image/png, image/jpg, image/jpeg">
                                                                </div>
                                                                <div
                                                                    class="copy_class d-flex align-items-center justify-content-center">
                                                                    <img class="company_logo_view img-responsive"
                                                                        src="{{asset('uploads/logo')}}/{{$companyData->company_logo}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">Favicon <span
                                                                        class="text-danger">*</span></label>
                                                                <div class="mb-2">
                                                                    <input type="file" class="form-control"
                                                                        name="favicon"
                                                                        accept="image/png, image/jpg, image/jpeg">
                                                                </div>
                                                                <div
                                                                    class="copy_class d-flex align-items-center justify-content-center">
                                                                    <img class="company_favi_icon_view img-responsive"
                                                                        src="{{asset('uploads/company_setting/favi_icon')}}/{{$companyData->favi_icon}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- </div> --}}
                                            <div class="col-12 d-flex justify-content-end">
                                                <input class="btn btn-primary pull-right submit_button " type="submit"
                                                    name="Save" value="Update">
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- social links start----sarwan    --}}
                                <div class="col-md-6">
                                    <div class="view-page socialMediaView">
                                        <div class="sub-head d-flex align-items-center justify-content-between">
                                            <h5 class="m-0">Social Links<i class="p-1 fa fa-info-circle info-input"
                                                    data-toggle="tooltip" title=""
                                                    data-original-title="SMTP account details"></i></h5>
                                            <h6 class="m-0"><a href="javascript:void(0)"
                                                    onclick="$('.socialMediaForm').removeClass('d-none');$('.socialMediaView').addClass('d-none')">Edit</a>
                                            </h6>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label>Facebook</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <a href="{{$companyData->facebook}}" target="_blank"
                                                            class="mb-0 viewCompenyFacebook">Link</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row dialline mt-2">
                                                    <div class="col-md-4">
                                                        <label>Instagram</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <a href="{{$companyData->instagram}}" target="_blank"
                                                            class="mb-0 viewCompenyFacebook">Link</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row dialline mt-2">
                                                    <div class="col-md-4">
                                                        <label>TikTok</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <a href="{{$companyData->twitter}}" target="_blank"
                                                            class="mb-0 viewCompenyFacebook">Link</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row dialline mt-2">
                                                    <div class="col-md-4">
                                                        <label>Youtube</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <a href="{{$companyData->linkedin}}" target="_blank"
                                                            class="mb-0 viewCompenyFacebook">Link</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="view-page d-none socialMediaForm">
                                        <div class="sub-head d-flex align-items-center justify-content-between">
                                            <h5 class="m-0">Social Links Update<i
                                                    class="p-1 fa fa-info-circle info-input" data-toggle="tooltip"
                                                    title="" data-original-title="SMTP account details"></i></h5>
                                            <h6 class="m-0"><a href="javascript:void(0)"
                                                    onclick="$('.socialMediaView').removeClass('d-none');$('.socialMediaForm').addClass('d-none')">Back</a>
                                            </h6>
                                        </div>
                                        <form action="javascript:void(0);" id="socialMediaForm">
                                            @csrf
                                            <input type="hidden" name="id" value="1">
                                            <input type="hidden" name="action" value="links">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="mb-3 fv-plugins-icon-container">
                                                        <label class="form-label" for="facebook">Facebook <span
                                                                class="text-danger">*</span></label>
                                                        <input type="url" class="form-control" id="facebook"
                                                            placeholder="Facebook Link" name="facebook"
                                                            value="{{$companyData->facebook}}">
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="mb-3 fv-plugins-icon-container">
                                                        <label class="form-label" for="instagram">Instagram <span
                                                                class="text-danger">*</span></label>
                                                        <input type="url" class="form-control" id="instagram"
                                                            placeholder="Instagram Link" name="instagram"
                                                            value="{{$companyData->instagram}}">
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="mb-3 fv-plugins-icon-container">
                                                        <label class="form-label" for="twitter">TikTok <span
                                                                class="text-danger">*</span></label>
                                                        <input type="url" class="form-control" id="twitter"
                                                            placeholder="Twitter Link" name="twitter"
                                                            value="{{$companyData->twitter}}">
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="mb-3 fv-plugins-icon-container">
                                                        <label class="form-label" for="linkedin">Youtube <span
                                                                class="text-danger">*</span></label>
                                                        <input type="url" class="form-control" id="linkedin"
                                                            placeholder="Linkedin Link" name="linkedin"
                                                            value="{{$companyData->linkedin}}">
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <input class="btn btn-primary pull-right submit_button " type="submit"
                                                    name="Save" value="Update">
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- social links end sarwan  --}}
                                {{-- invoice details start sarwan  --}}
                                {{-- <div class="col-md-6">
                                    <div class="view-page invoiceView">
                                        <div class="sub-head d-flex align-items-center justify-content-between">
                                            <h5 class="m-0">Invoice Details<i class="p-1 fa fa-info-circle info-input"
                                                    data-toggle="tooltip" title=""
                                                    data-original-title="Invoice Details"></i></h5>
                                            <h6 class="m-0"><a href="javascript:void(0)"
                                                    onclick="$('.invoiceForm').removeClass('d-none');$('.invoiceView').addClass('d-none')">Edit</a>
                                            </h6>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label>Company Name</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h6 class="mb-0 invoice_company_name_view">
                                                            {{$companyData->invoice_company_name}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row dialline mt-3">
                                                    <div class="col-md-4">
                                                        <label>Billing Address</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h6 class="mb-0 invoice_company_address_view">
                                                            {{$companyData->invoice_company_address}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row dialline mt-3">
                                                    <div class="col-md-4">
                                                        <label>MICR</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h6 class="mb-0 invoice_mobile_view">
                                                            {{$companyData->invoice_micr}}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row dialline mt-3">
                                                    <div class="col-md-4">
                                                        <label>GST Number</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h6 class="mb-0 gst_view">{{$companyData->gst_number}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row dialline mt-3">
                                                    <div class="col-md-4">
                                                        <label>Bank Name</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h6 class="mb-0 bank_name_view">{{$companyData->bank_name}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row dialline mt-3">
                                                    <div class="col-md-4">
                                                        <label>A/C Number</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h6 class="mb-0 ac_number_view">{{$companyData->ac_number}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row dialline mt-3">
                                                    <div class="col-md-4">
                                                        <label>A/C Holder Name</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h6 class="mb-0 ac_holder_name_view">
                                                            {{$companyData->ac_holder_name}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row dialline mt-3">
                                                    <div class="col-md-4">
                                                        <label>IFSC</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h6 class="mb-0 ifsc_view">{{$companyData->ifsc}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row dialline mt-3">
                                                    <div class="col-md-4">
                                                        <label>Terms & Conditions</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <textarea
                                                            class="mb-0 ifsc_view w-100">{{$companyData->terms}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="view-page d-none invoiceForm">
                                        <div class="sub-head d-flex align-items-center justify-content-between">
                                            <h5 class="m-0">Invoice Details Update<i
                                                    class="p-1 fa fa-info-circle info-input" data-toggle="tooltip"
                                                    title="" data-original-title="Invoice Details"></i></h5>
                                            <h6 class="m-0"><a href="JavaScript:void(0);"
                                                    onclick="$('.invoiceView').removeClass('d-none');$('.invoiceForm').addClass('d-none')">Back</a>
                                            </h6>
                                        </div>
                                        <form action="javascript:void(0);" id="invoiceForm">
                                            @csrf
                                            <input type="hidden" name="id" value="1">
                                            <input type="hidden" name="action" value="invoice">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="mb-3 fv-plugins-icon-container">
                                                        <label class="form-label" for="invoice_company_name">Company
                                                            Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            id="invoice_company_name" placeholder="Company Name"
                                                            name="invoice_company_name"
                                                            value="{{$companyData->invoice_company_name}}">
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="mb-3 fv-plugins-icon-container">
                                                        <label class="form-label" for="invoice_company_address">Billing
                                                            Address <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            id="invoice_company_address" placeholder="Company Address"
                                                            name="invoice_company_address"
                                                            value="{{$companyData->invoice_company_address}}">
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="mb-3 fv-plugins-icon-container">
                                                        <label class="form-label" for="MICR">MICR <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="invoice_micr"
                                                            placeholder="MICR" name="invoice_micr"
                                                            value="{{$companyData->invoice_micr}}">
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="mb-3 fv-plugins-icon-container">
                                                        <label class="form-label" for="gst_number">GST
                                                            Number</label>
                                                        <input type="text" class="form-control" id="gst_number"
                                                            placeholder="GST Number" name="gst_number"
                                                            value="{{$companyData->gst_number}}">
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="mb-3 fv-plugins-icon-container">
                                                        <label class="form-label" for="bank_name">Bank Name</label>
                                                        <input type="text" class="form-control" id="bank_name"
                                                            placeholder="Bank Name" name="bank_name"
                                                            value="{{$companyData->bank_name}}">
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="mb-3 fv-plugins-icon-container">
                                                        <label class="form-label" for="ac_number">A/C Number</label>
                                                        <input type="number" class="form-control" id="ac_number"
                                                            placeholder="A/C Number" name="ac_number"
                                                            value="{{$companyData->ac_number}}">
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="mb-3 fv-plugins-icon-container">
                                                        <label class="form-label" for="ac_holder_name">A/C Holder
                                                            Name</label>
                                                        <input type="text" class="form-control" id="ac_holder_name"
                                                            placeholder="A/C Holder Name" name="ac_holder_name"
                                                            value="{{$companyData->ac_holder_name}}">
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="mb-3 fv-plugins-icon-container">
                                                        <label class="form-label" for="ifsc">IFSC</label>
                                                        <input type="text" class="form-control" id="ifsc"
                                                            placeholder="IFSC" name="ifsc"
                                                            value="{{$companyData->ifsc}}">
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="mb-3 fv-plugins-icon-container">
                                                        <label class="form-label" for="Terms & Conditions">Terms &
                                                            Conditions</label>
                                                        <textarea type="text" class="form-control" id="ifsc"
                                                            placeholder="Terms & Conditions" name="terms"
                                                            value="{{$companyData->terms}}">{{$companyData->terms}}</TEXtarea>
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <input class="btn btn-primary pull-right submit_button " type="submit"
                                                    name="Save" value="Update">
                                            </div>
                                        </form>
                                    </div>
                                </div> --}}
                                {{-- invoice details END sarwan  --}}

                                <!-- smtp details SARWAN-->
                                <div class="col-md-6">
                                    <div class="view-page smtpView d-block">
                                        <div class="sub-head d-flex align-items-center justify-content-between">
                                            <h5 class="m-0">SMTP Details<i class="p-1 fa fa-info-circle info-input"
                                                    data-toggle="tooltip" title=""
                                                    data-original-title="SMTP account details"></i></h5>
                                            <h6 class="m-0"><a href="javascript:void(0)"
                                                    onclick="$('.smtpForm').removeClass('d-none');$('.smtpView').addClass('d-none')">Edit</a>
                                            </h6>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row dialline">
                                                    <div class="col-md-4">
                                                        <label>Host Name</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h6 class="mb-0 host_view">
                                                            {{isset($companyData)? $companyData->smtp_hostname:''}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row dialline mt-3">
                                                    <div class="col-md-4">
                                                        <label>Port</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h6 class="mb-0 port_view">
                                                            {{isset($companyData)? $companyData->smtp_port:''}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row dialline mt-3">
                                                    <div class="col-md-4">
                                                        <label>Username</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h6 class="mb-0 smtp_user_view">
                                                            {{isset($companyData)? $companyData->smtp_username:''}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row dialline mt-3">
                                                    <div class="col-md-4">
                                                        <label>Password</label>
                                                    </div>
                                                    <div class="col-md-8 view_password_div">
                                                        <h6 class="mb-0 password_v_star">**********</h6>
                                                        <h6 class="mb-0 d-none password_v_password smtp_password_view">
                                                            B2531db}1m@4</h6>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row dialline mt-3">
                                                    <div class="col-md-4">
                                                        <label>No Reply Email</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h6 class="mb-0 no_reply_email_view">noreply@orbitnapp.com</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="view-page smtpForm d-none">
                                        <div class="sub-head d-flex align-items-center justify-content-between">
                                            <h5 class="m-0">SMTP Details Update<i
                                                    class="p-1 fa fa-info-circle info-input" data-toggle="tooltip"
                                                    title="" data-original-title="SMTP account details"></i></h5>
                                            <h6 class="m-0"><a href="javascript:void(0)"
                                                    onclick="$('.smtpView').removeClass('d-none');$('.smtpForm').addClass('d-none')">Back</a>
                                            </h6>
                                        </div>
                                        <form action="javascript:void(0);" id="smtpForm">
                                            @csrf
                                            <input type="hidden" name="id" value="1">
                                            <input type="hidden" name="action" value="smtp">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="mb-3 fv-plugins-icon-container">
                                                        <label class="form-label" for="host_name">Host Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="host_name"
                                                            placeholder="Host Name" name="host_name"
                                                            value="{{isset($companyData)? $companyData->smtp_hostname:''}}">
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="mb-3 fv-plugins-icon-container">
                                                        <label class="form-label" for="port">Port <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="port"
                                                            placeholder="Port" name="port"
                                                            value="{{isset($companyData)? $companyData->smtp_port:''}}">
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="mb-3 fv-plugins-icon-container">
                                                        <label class="form-label" for="user_id">Username <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="user_id"
                                                            placeholder="User Id" name="user_id"
                                                            value="{{isset($companyData)? $companyData->smtp_username:''}}">
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="mb-3 col-sm-12 form-password-toggle fv-plugins-icon-container">
                                                    <label class="form-label" for="newPassword">Password</label>
                                                    <div class="input-group input-group-merge has-validation">
                                                        <input class="form-control" type="password" id="password"
                                                            name="password" placeholder="············"
                                                            value="{{isset($companyData)? $companyData->smtp_password:''}}">
                                                        <span class="input-group-text cursor-pointer"><i
                                                                class="bx bx-hide"></i></span>
                                                    </div>
                                                    <div
                                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="mb-3 fv-plugins-icon-container">
                                                        <label class="form-label" for="no_reply_email">No Reply
                                                            Email <span class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" id="no_reply_email"
                                                            placeholder="No Reply E-mail" name="no_reply_email"
                                                            value="{{isset($companyData)? $companyData->smtp_no_reply_email:''}}"
                                                            required>
                                                        <div
                                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <input class="btn btn-primary pull-right submit_button " type="submit"
                                                    name="Save" value="Update">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!--smtp details end.......................................  -->

                                {{-- 
                <div class="col-md-6" style="display: none;">
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
                                <h6 class="mb-0 d-none password_v_password sms_auth_view">
                                    {{$companyData->sms_auth_token}}</h6>
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
                        <h4 class="m-0">SMS Details Update<i class="p-1 fa fa-info-circle info-input"
                                data-toggle="tooltip" title="" data-original-title="SMS account details"></i></h4>
                        <h5 class="m-0"><a href="javascript:void(0)"
                                onclick="$('.smsForm').addClass('d-none');$('.smsView').removeClass('d-none');">Back</a>
                        </h5>
                    </div>
                    <div class="card-body ">
                        <form action="javascript:void(0)" id="smsForm">
                            @csrf
                            <input type="hidden" name="id" value="1">
                            <input type="hidden" name="action" value="sms">
                            <div class="row dialline">
                                <div class="col-md-4">
                                    <label class="required">Account ID</label>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="mb-0">
                                        <input type="text" class="form-control" placeholder="Account ID"
                                            name="account_id" value="{{$companyData->sms_account_id}}" required="true">
                                </div>
                            </div>
                            <div class="row dialline">
                                <div class="col-md-4">
                                    <label class="required">Auth Token</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group col-xs-12">
                                        <span class="input-group-append passView">
                                            <button class="file-upload-browse btn btn-primary" type="button"><i
                                                    class="fa fa-eye"></i></button>
                                        </span>
                                        <input type="password" class="pass_word form-control file-upload-info"
                                            name="auth_tokenn" placeholder="Auth Token"
                                            value="{{$companyData->sms_auth_token}}" required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="row dialline">
                                <div class="col-md-4">
                                    <label class="required">Phone No.</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control numberOnly" maxlength="10"
                                        placeholder="Phone Number" name="sms_phone"
                                        value="{{$companyData->sms_phone_number}}" required="true">
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="javascript:void(0)" class="btn btn-primary"
                                    onclick="$('#smsForm').submit();">Update</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            --}}
            {{-- 
                <div class="col-md-6" style="display: none;">
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
        <h4 class="m-0">Company Description Update<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip"
                title="" data-original-title="Company descriptin"></i></h4>
        <h5 class="m-0"><a href="JavaScript:void(0)"
                onclick="$('.descForm').addClass('d-none');$('.descView').removeClass('d-none');">Back</a></h5>
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
                    <textarea required="true" class="form-control" placeholder="Description..." name="description"
                        rows="4">{{$companyData->description}}</textarea>
                </div>
            </div>
            <div class="text-center">
                <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#descForm').submit();">Update</a>
            </div>
        </form>
    </div>
</div>
</div>
--}}
{{-- 
                <div class="col-md-6" style="display: none;">
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
        <h4 class="m-0">Package Renewal Details Update<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip"
                title=""
                data-original-title="Email for package renewal, will be sent automatically to the users, prior to set days of plan expiry"></i>
        </h4>
        <h5 class="m-0"><a href="javascript:void(0)"
                onclick="$('.renewalForm').addClass('d-none'); $('.renewalView').removeClass('d-none')">Back</a></h5>
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
                        <input type="text" class="form-control file-upload-info numberOnly" name="package_renewal_days"
                            value="{{$companyData->package_renewal_day}}" placeholder="Package Renewal Days"
                            required="true">
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#renewalForm').submit();">Update</a>
            </div>
        </form>
    </div>
</div>
</div>
--}}
{{-- 
                <div class="col-md-6" style="display: none;">
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
        <h4 class="m-0">Monthly Report Date Update<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip"
                title=""
                data-original-title="An automated report will be sent to the users on a monthly basis with all the data related to their business listed (showing the number of users contacted, enquired, users visited the site, etc.)	"></i>
        </h4>
        <h5 class="m-0"><a href="JavaScript:void(0);"
                onclick="$('.reportView').removeClass('d-none'); $('.reportForm').addClass('d-none');">Back</a></h5>
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
                    <select class="form-control" name="monthly_report_date" required="true"
                        style="    height: 38px !important;">
                        <option value="">Select Date</option>
                        @for($startDay = 1; $startDay < 32 ; $startDay++) @if($startDay < 10 ) <option
                            value="0{{$startDay}}">0{{$startDay}}</option>
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
</div>
--}}
{{-- 
                <div class="col-md-6" style="display: none;">
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
        <h4 class="m-0">IP Block Details Update<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip"
                title="" data-original-title="Number of hits to block an ip"></i></h4>
        <h5 class="m-0"><a href="javascript:void(0)"
                onclick="$('.ipView').removeClass('d-none'); $('.ipForm').addClass('d-none')">Back</a></h5>
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
                    <input type="text" placeholder="IP Block Hit(Count)" class="form-control numberOnly"
                        name="ip_block_hit" value="{{$companyData->ip_block_counts}}" required="true">
                </div>
            </div>
            <div class="text-center">
                <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#ipForm').submit();">Update</a>
            </div>
        </form>
    </div>
</div>
</div>
--}}
{{-- 
                <div class="col-md-6" style="display: none;">
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
        <h4 class="m-0">Report Download PIN Update<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip"
                title="" data-original-title="Report download pin"></i></h4>
        <h5 class="m-0"><a href="javascript:void(0)"
                onclick="$('.pinView').removeClass('d-none'); $('.pinForm').addClass('d-none')">Back</a></h5>
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
                            <button class="file-upload-browse btn btn-primary" type="button"><i
                                    class="fa fa-eye"></i></button>
                        </span>
                        <input type="password" class="pass_word form-control file-upload-info numberOnly"
                            name="report_pin" placeholder="Report Download PIN" value="{{$companyData->report_pin}}"
                            maxlength="4" required="true">
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#pinForm').submit();">Update</a>
            </div>
        </form>
    </div>
</div>
</div>
--}}
{{-- 
                <div class="col-md-6" style="display: none;">
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
                               <h6 class="mb-0 d-none password_v_password google_key_view">{{$companyData->google_api_key}}
</h6>
<i class="fa fa-eye password_v_show"></i><i></i>
</div>
</div>
</div>
</div>
<div class="view-page d-none googleKeyForm">
    <div class="sub-head d-flex align-items-center">
        <h4 class="m-0">Google API Configuration Update<i class="p-1 fa fa-info-circle info-input" data-toggle="tooltip"
                title="" data-original-title="Google api key"></i></h4>
        <h5 class="m-0"><a href="javascript:void(0)"
                onclick="$('.googleKeyView').removeClass('d-none'); $('.googleKeyForm').addClass('d-none')">Back</a>
        </h5>
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
                            <button class="file-upload-browse btn btn-primary" type="button"><i
                                    class="fa fa-eye"></i></button>
                        </span>
                        <input type="password" class="pass_word form-control file-upload-info" name="google_api_key"
                            placeholder="Google Api Key" value="{{$companyData->google_api_key}}" required="true">
                        <div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="javascript:void(0)" class="btn btn-primary"
                            onclick="$('#googleKeyForm').submit();">Update</a>
                    </div>
        </form>
    </div>
</div>
</div>
--}}
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
@push('scripts')

<script>
$('img').on('error', function() {
    $(this).attr('src', '<?= asset('dist/img/') ?>/Image_not_available.png');
})
$('body').find('select[name="monthly_report_date"]').val("<?= $companyData->monthly_report_date ?>");






$(document).on("click", ".file-upload-browse", function() {
    var file = $(this).parent().parent().parent().find('.file-upload-default');
    file.trigger('click');
});
$(document).on("change", ".file-upload-default", function() {
    $(this).parent().find('.file-upload-info').val($(this).val().replace(/C:\\fakepath\\/i, ''));
});
//Validate form input fields
// this class use for input only a-z, A-Z, 0-9, Whitespace
$('.AlphabetsOnly').keypress(function(e) {
    var regex = new RegExp(/^[a-zA-Z0-9-\s]+$/);
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    } else {
        $.notify('Special character not allowed', "error");
        e.preventDefault();
        return false;
    }
});
$('.numberOnly').keypress(function(e) {
    var regex = new RegExp(/^[0-9]+$/);
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    } else {
        $.notify('Allowed numbers only', "error");
        e.preventDefault();
        return false;
    }
});

//Validate form input fields end

//clear all errors    
function clearErrors() {
    $("#editmodal").find(".error").html('');
}

$.validator.addMethod("extyp", function(value, element) {
    // console.log(element)
    // console.log(value)
    if (!value) {
        return true;
    }
    if (!value.match(/\.(jpg|jpeg|png|svg|JPG|PNG|JPEG)$/i)) {
        return false;
    }
    return true;
}, 'Only formats are allowed: jpeg,svg, jpg, png');
$.validator.addMethod("email_val", function(value, element) {
    return this.optional(element) || value == value.match(
        /^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/);
}, 'Please enter a valid email address.');
//update basic Details
$("#basicForm").validate({
    rules: {
        email: {
            required: true,
            email_val: true
        },
        company_name: {
            required: true,
        },
        address: {
            required: true,
        },
        phone_number: {
            required: true,
            minlength: 10,

        },
        description: {
            required: true,
        },
        // website : {
        //     required : true,
        // },
        website_logo: {
            extyp: true,
        },
        favicon: {
            extyp: true,
        },
        email_logo: {
            extyp: true,
        },
    },
    messages: {
        email: {
            required: 'Please enter your email',
        },
        phone_number: {
            minlength: 'Phone number should be of at least 10 digit',
            maxlength: 'Please enter valid phone number',
        }
    },
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
        $('.submit_button').prop('disabled', true);
        $('.loader').css('display', 'block')

        var formData = new FormData($("#basicForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{url('company/setting/store')}}",
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                //hide loader
                $('.loader').css('display', 'none')
                var response = JSON.parse(data);
                if (response.code == 200) {
                    //show notification
                    toastr.success(response.msg);

                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                } else {
                    //show notification
                    toastr.error(response.msg);
                }
            },
        });
        return false;
    }
});
//update social media  links
$("#socialMediaForm").validate({
    rules: {

        facebook: {
            required: true,
        },
        instagram: {
            required: true,
        },
        twitter: {
            required: true,
        },
        linkedin: {
            required: true,
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
    submitHandler: function(form) {
        $('.submit_button').prop('disabled', true);
        $('.loader').css('display', 'block')
        var formData = new FormData($("#socialMediaForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{url('company/setting/store')}}",
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                //hide loader
                $('.loader').css('display', 'none')
                var response = JSON.parse(data);
                if (response.code == 200) {
                    //show notification
                    toastr.success(response.msg);
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                } else {
                    //show notification
                    toastr.error(response.msg);
                }
            },
        });
        return false;
    }
});


// smtp details ----->
$("#smtpForm").validate({
    rules: {
        host_name: {
            required: true,
        },
        port: {
            required: true,
        },
        user_id: {
            required: true,
        },
        password: {
            required: true,
        },
        no_reply_email: {
            required: true,
        },

    },
    messages: {

    },
    errorElement: 'h6',
    errorLabelContainer: '.errorPasswordSmtp',
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
        $('.submit_button').prop('disabled', true);
        $('.loader').css('display', 'block')
        var formData = new FormData($("#smtpForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{url('company/setting/store')}}",
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                //hide loader
                $('.loader').css('display', 'none')
                var response = JSON.parse(data);
                if (response.code == 200) {
                    //show notification
                    toastr.success(response.msg);
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                } else {
                    //show notification
                    toastr.error(response.msg);
                }
            },
        });
        return false;
    }
});

// smtp details end -----------sarwan





//update master settings
$("#masterSettingForm").validate({
    rules: {

        max_cod_amount: {
            required: true,
            min: 0,
            max: 500000,
        },
        footer_description: {
            required: true,
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
    submitHandler: function(form) {
        // var websiteLogo = URL.createObjectURL($("body").find("input[name='website_logo']")[0].files[0]);
        // setTimeout(function(){
        //     var favicon = URL.createObjectURL($("body").find("input[name='favicon']")[0].files[0]);
        //     setTimeout(function(){
        //         var email_logo = URL.createObjectURL($("body").find("input[name='email_logo']")[0].files[0]);
        //     },1000);
        // },1000);

        $('.loader').css('display', 'block')
        var formData = new FormData($("#masterSettingForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{url('company/setting/store')}}",
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                //hide loader
                $('.loader').css('display', 'none')
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
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                } else {
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

    rules: {
        invoice_company_name: {
            required: true,
        },
        invoice_company_address: {
            required: true,
        },
        bank_name: {
            required: true,
        },
        branch: {
            required: true,
        },
        invoice_micr: {
            required: true,
        },
        ifsc: {
            required: true,
        },
        ac_holder_name: {
            required: true,
        },
        ac_number: {
            required: true,
            minlength: 9,
            maxlength: 18,
        },
        gst_number: {
            required: true,
        },

        terms: {
            required: true,
        },

    },
    messages: {
        email: {
            required: 'Please enter your email',
        },
        phone_number: {
            minlength: 'Phone number should be of at least 10 digit',
            maxlength: 'Please enter valid phone number',
        }
    },
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
        $('.submit_button').prop('disabled', true);
        var formData = new FormData($("#invoiceForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{url('company/setting/store')}}",
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.loader').show();
            },
            success: function(data) {
                //hide loader
                $('.loader').hide();
                var response = JSON.parse(data);
                if (response.code == 200) {
                    //show notification
                    toastr.success(response.msg);

                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                } else {
                    //show notification
                    toastr.error(response.msg);
                }
            },
        });
        return false;
    }
});



//update SMS
$("#smsForm").validate({
    submitHandler: function(form) {
        $('.loader').css('display', 'block')
        var formData = new FormData($("#smsForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{url('company/setting/store')}}",
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                //hide loader
                $('.loader').css('display', 'none')
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
                } else {
                    //show notification
                    $.notify(response.msg, "warning");
                }
            },
        });
        return false;
    }
});
$("#descForm").validate({
    submitHandler: function(form) {
        $('.loader').css('display', 'block')
        var formData = new FormData($("#descForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{url('company/setting/store')}}",
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                //hide loader
                $('.loader').css('display', 'none')
                var response = JSON.parse(data);
                if (response.code == 200) {
                    //show notification
                    $.notify(response.msg, "success");

                    //set view data 
                    $(".description_view").text($("textarea[name='description']").val());
                    //hide form
                    $('.descForm').addClass('d-none');
                    $('.descView').removeClass('d-none');
                } else {
                    //show notification
                    $.notify(response.msg, "warning");
                }
            },
        });
        return false;
    }
});
$("#renewalForm").validate({
    submitHandler: function(form) {
        $('.loader').css('display', 'block')
        var formData = new FormData($("#renewalForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{url('company/setting/store')}}",
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                //hide loader
                $('.loader').css('display', 'none')
                var response = JSON.parse(data);
                if (response.code == 200) {
                    //show notification
                    $.notify(response.msg, "success");

                    //set view data 
                    $(".renewal_view").text($("input[name='package_renewal_days']").val());
                    //hide form
                    $('.renewalForm').addClass('d-none');
                    $('.renewalView').removeClass('d-none');
                } else {
                    //show notification
                    $.notify(response.msg, "warning");
                }
            },
        });
        return false;
    }
});
$("#reportForm").validate({
    submitHandler: function(form) {
        $('.loader').css('display', 'block')
        var formData = new FormData($("#reportForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{url('company/setting/store')}}",
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                //hide loader
                $('.loader').css('display', 'none')
                var response = JSON.parse(data);
                if (response.code == 200) {
                    //show notification
                    $.notify(response.msg, "success");

                    //set view data 
                    $(".report_view").text($("select[name='monthly_report_date']").val());
                    //hide form
                    $('.reportForm').addClass('d-none');
                    $('.reportView').removeClass('d-none');
                } else {
                    //show notification
                    $.notify(response.msg, "warning");
                }
            },
        });
        return false;
    }
});
$("#ipForm").validate({
    submitHandler: function(form) {
        $('.loader').css('display', 'block')
        var formData = new FormData($("#ipForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{url('company/setting/store')}}",
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                //hide loader
                $('.loader').css('display', 'none')
                var response = JSON.parse(data);
                if (response.code == 200) {
                    //show notification
                    $.notify(response.msg, "success");

                    //set view data 
                    $(".ip_view").text($("input[name='ip_block_hit']").val());
                    //hide form
                    $('.ipForm').addClass('d-none');
                    $('.ipView').removeClass('d-none');
                } else {
                    //show notification
                    $.notify(response.msg, "warning");
                }
            },
        });
        return false;
    }
});
$("#pinForm").validate({
    submitHandler: function(form) {
        $('.loader').css('display', 'block')
        var formData = new FormData($("#pinForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{url('company/setting/store')}}",
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                //hide loader
                $('.loader').css('display', 'none')
                var response = JSON.parse(data);
                if (response.code == 200) {
                    //show notification
                    $.notify(response.msg, "success");

                    //set view data 
                    $(".pin_view").text($("input[name='report_pin']").val());
                    //hide form
                    $('.pinForm').addClass('d-none');
                    $('.pinView').removeClass('d-none');
                } else {
                    //show notification
                    $.notify(response.msg, "warning");
                }
            },
        });
        return false;
    }
});
$("#googleKeyForm").validate({
    submitHandler: function(form) {
        $('.loader').css('display', 'block')
        var formData = new FormData($("#googleKeyForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{url('company/setting/store')}}",
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                //hide loader
                $('.loader').css('display', 'none')
                var response = JSON.parse(data);
                if (response.code == 200) {
                    //show notification
                    $.notify(response.msg, "success");

                    //set view data 
                    $(".google_key_view").text($("input[name='google_api_key']").val());
                    //hide form
                    $('.googleKeyForm').addClass('d-none');
                    $('.googleKeyView').removeClass('d-none');
                } else {
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