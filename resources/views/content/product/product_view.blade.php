@extends('layouts.main')
@section('title', 'View Customer Details')
@section('content')

<div class="card">
    <div class="card-header justify-content-between d-flex">
        <h3>{{ __('View Customer Details')}}</h3>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ url('customer') }}">
                <i class="ik ik-list"></i> List of Customer
            </a>
        </div>
    </div>
</div>

<section id="user-details">
    <div class="user-details-row">
        <div class="row">
            <div class="col-md-8">
                <div class="user-detail-left ">
                    <div class="user-head p-3 d-flex align-items-center">
                        <div class="user-head-img">
                            <img src="{{url('uploads/user_default.jpg')}}" alt="" />
                        </div>
                        <div class="user-head-con">
                            <h6 class="">{{$customer_detail->name}}</h6>
                            <a href="mailto:{{$customer_detail->email}}">{{$customer_detail->email}}</a>
                        </div>
                    </div>
                    <div class="left-row d-flex">

                        <div class="total-order">
                            <p class="total-head text-center mb-0">Total Order</p>
                            <div class="d-flex">
                                <div class="w50">
                                    <p>Online</p>
                                    <div class="d-flex align-items-end">
                                        <h6 class="mb-0">{{count($onlineorder)}}</h6>
                                        <span>order</span>
                                    </div>
                                </div>
                                <div class="w50">
                                    <p>Offline </p>
                                    <div class="d-flex align-items-end">
                                        <h6 class="mb-0">{{count($offlineorder)}}</h6>
                                        <span>order</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="total-amount">
                            <p class="total-head text-center mb-0">Order Amount</p>
                            <div class="d-flex">
                                <div class="w50">
                                    <p>Online</p>
                                    <h6 class="mb-0">₹{{$sumonlineorder}}
                                    </h6>
                                </div>
                                <div class="w50">
                                    <p>Offline </p>

                                    <h6 class="mb-0">₹{{$sumofflineorder}}

                                    </h6>
                                </div>
                            </div>
                        </div>

                        <div class="total-review d-flex align-items-center">
                            <div class="">
                                <p class="total-head text-center ">Total Review</p>
                                <h6 class="mb-0">{{count($review)}}</h6>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="user-tab-list">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-nav">
                            <ul class="nav nav-tabs">
                                <li role="presentation">
                                    <a href="#one" aria-controls="one" class="active" role="tab" data-toggle="tab">Total
                                        Orders</a>
                                </li>
                                <li role="presentation">
                                    <a href="#two" aria-controls="two" role="tab" data-toggle="tab">Addresses</a>
                                </li>
                                <li role="presentation">
                                    <a href="#three" aria-controls="three" role="tab" data-toggle="tab">Review</a>
                                </li>
                                <li role="presentation">
                                    <a href="#four" aria-controls="four" role="tab" data-toggle="tab">Payment
                                        History</a>
                                </li>
                            </ul>
                        </div>

                        <!-------------------- Order Tab ------------------------>

                        <div class="panel-body">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active show" id="one">
                                    @if(count($order)>0)
                                    @foreach($order as $order)
                                    <div class="user-order-id">
                                        <div class="order-head d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <h6>Order Id: {{$order->id}}</h6>
                                                <p class="mb-0">Placed on {{ \Carbon\Carbon::parse($order->created_at)->format('jS M, Y') }}</p>
                                            </div>
                                            <span>₹{{$order->total_amount}}</span>
                                        </div>
                                        <hr>
                                        @php 
                                        $productOrders = $order->productOrders;
                                        @endphp
                                        <div class="utsc-grid">
                                            @foreach($productOrders as $porder)
                                            @php 
                                            $product = isset($porder->product) ? $porder->product : ''; 
                                            $product_image = isset($product->productimage) ? $product->productimage : '';
                                            //echo  $product_image;
                                            if(isset($product_image->images)){
                                                $product_images=$product_image->images;
                                            }
                                            else{
                                                $product_images='';
                                            }
                                            @endphp
                                            @if(isset($porder->product))
                                            <div class="utsc d-flex align-items-start">
                                                <div class="utsc-img">
                                                <img src="{{ url('uploads/product_images/medium/'.$product_images) }}" alt="">
                                                </div>
                                                <div class="utsc-cont">
                                                    <h6 class="mb-0">{{ $product->name }} </h6>
                                                    {{-- <p><span>SKU:</span> {{ $product->sku}}</p> --}}
                                                    <div class="pris d-flex align-items-center">
                                                        <p class="mb-0">₹{{$porder->total_price}}</p>
                                                        <span></span>
                                                        <p class="mb-0">Qty:{{$porder->qty}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <p style="margin-top: 20px; margin-bottom: 0px; margin-left: -10px;">No data found</p>
                                    @endif
                                </div>

                                <!-------------------- End Order Tab ------------------------>

                                <!-- Address Tab  -->

                                <div role="tabpanel" class="tab-pane fade" id="two">
                                @if(count($address_details)>0)
                                    @foreach($address_details as $address)
                                    <div class="user-jon">
                                        <div class="jon-h d-flex align-items-center">
                                            <h6 class="mb-0">{{$address->full_name}}</h6>
                                            <span>@if($address->type=='1')Home @else Work @endif</span>
                                        </div>
                                        <address>{{$address->address,$address->city,$address->state,$address->pin_code}}</address>
                                        <p class="d-flex align-items-center mb-0">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.86677 8.21338C6.35906 11.4621 9.01053 14.0366 12.3018 15.4325L12.3118 15.4367L12.9484 15.7201C13.3417 15.8954 13.7833 15.9301 14.1991 15.8183C14.6149 15.7064 14.9796 15.4549 15.2318 15.1059L16.2934 13.6367C16.3246 13.5935 16.3381 13.5399 16.3309 13.487C16.3238 13.4341 16.2967 13.386 16.2551 13.3526L14.4018 11.8567C14.38 11.839 14.3548 11.8259 14.3278 11.8182C14.3008 11.8105 14.2725 11.8084 14.2446 11.8119C14.2167 11.8154 14.1899 11.8245 14.1656 11.8386C14.1413 11.8528 14.1202 11.8717 14.1034 11.8942L13.3818 12.8684C13.2968 12.9832 13.1749 13.0655 13.0367 13.1014C12.8984 13.1373 12.7519 13.1248 12.6218 13.0659C10.156 11.9488 8.18047 9.97334 7.06344 7.50755C7.00453 7.37738 6.992 7.23095 7.02793 7.09266C7.06387 6.95437 7.1461 6.83257 7.26094 6.74755L8.23344 6.02505C8.25603 6.00835 8.27502 5.98725 8.28925 5.96302C8.30348 5.93879 8.31266 5.91193 8.31625 5.88406C8.31983 5.85619 8.31773 5.82788 8.31009 5.80084C8.30245 5.7738 8.28941 5.74859 8.27177 5.72672L6.77677 3.87338C6.74332 3.83183 6.6952 3.80468 6.64233 3.79755C6.58946 3.79042 6.53587 3.80384 6.4926 3.83505L5.0151 4.90172C4.66377 5.15514 4.41102 5.5224 4.29982 5.94108C4.18862 6.35976 4.22582 6.80403 4.4051 7.19838L4.86677 8.21255V8.21338ZM11.8084 16.5809C8.23269 15.0626 5.35227 12.2645 3.73094 8.73422L3.72927 8.73255L3.2676 7.71588C2.96879 7.05875 2.90669 6.31842 3.09188 5.62069C3.27706 4.92296 3.69809 4.31086 4.28344 3.88838L5.76094 2.82172C6.06354 2.60332 6.43836 2.50924 6.80824 2.55884C7.17812 2.60845 7.5149 2.79797 7.74927 3.08838L9.2451 4.94255C9.36855 5.09553 9.45979 5.27188 9.51335 5.46102C9.5669 5.65015 9.58167 5.84816 9.55676 6.04315C9.53185 6.23813 9.46778 6.42607 9.3684 6.59567C9.26902 6.76526 9.13637 6.91302 8.97844 7.03005L8.4201 7.44338C9.36409 9.27367 10.8548 10.7644 12.6851 11.7084L13.0993 11.1501C13.2163 10.9922 13.364 10.8597 13.5335 10.7604C13.7031 10.6611 13.8909 10.5971 14.0858 10.5722C14.2807 10.5472 14.4786 10.562 14.6676 10.6155C14.8567 10.6689 15.033 10.7601 15.1859 10.8834L17.0401 12.3792C17.3308 12.6136 17.5204 12.9506 17.57 13.3206C17.6196 13.6907 17.5254 14.0657 17.3068 14.3684L16.2451 15.8384C15.8249 16.42 15.2173 16.8393 14.5244 17.0258C13.8315 17.2123 13.0955 17.1546 12.4401 16.8626L11.8084 16.5809Z" fill="black" />
                                            </svg>

                                            {{$address->mobile_number}}
                                        </p>
                                    </div>
                                    @endforeach
                                    @else
                                    <p style="margin-top: 20px; margin-bottom: 0px; margin-left: -10px;">No data found</p>
                                    @endif
                                </div>
                 <!------------------------END Address Tab------------------------------>

                      <!-----------------Review  Tab -------------------------> 

                                <div role="tabpanel" class="tab-pane fade" id="three">
                                    @if(count($review)>0)
                                    <div class="review-quality-gap">
                                       @foreach($review as $review)
                                        <div class="review-quality">
                                            <div class="rate align-items-center">
                                                <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.8118 4.49188C11.1942 4.20263 10.9896 3.5931 10.5101 3.5931H7.78877C7.56951 3.5931 7.37584 3.45026 7.31108 3.24079L6.47769 0.545133C6.33246 0.0753764 5.66754 0.0753773 5.52231 0.545133L4.68892 3.24079C4.62416 3.45026 4.43048 3.5931 4.21123 3.5931H1.47486C0.996934 3.5931 0.791399 4.19938 1.17079 4.49002L3.4243 6.21638C3.59007 6.34337 3.65946 6.56001 3.59832 6.75968L2.75701 9.5074C2.61458 9.97258 3.15298 10.3466 3.53917 10.0507L5.69593 8.39846C5.87535 8.26101 6.12465 8.26101 6.30407 8.39846L8.45501 10.0462C8.84175 10.3425 9.38067 9.96709 9.23677 9.50164L8.38355 6.74185C8.3214 6.5408 8.39178 6.32235 8.55962 6.1954L10.8118 4.49188Z" fill="white" />
                                                </svg>
                                                <span>{{$review->rating}}</span>
                                            </div>
                                            <p class="mb-0">{{$review->review}}</p>
                                            <div class="m-29 d-flex align-items-center ">
                                                <span class="ureview-name">{{$review->name}}</span>
                                                <hr class="">
                                                @php 
                                                $dateString = $review->created_at;
                                                $dateTime = new DateTime($dateString);
                                                $formattedDate = $dateTime->format('jS F, Y');
                                                @endphp
                                                <span class="ureview-date">{{$formattedDate}} </span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                        @else
                                    <p style="margin-top: 20px; margin-bottom: 0px; margin-left: -10px;">No data found</p>
                                    @endif
                                </div>

                     <!----------------------- End Review ----------------------->

                                <div role="tabpanel" class="tab-pane fade" id="four">
                                    <div class="payment-history-gap">
                                    @if(count($payment_history)>0)
                                        @foreach($payment_history as $ph)
                                        <div class="payment-history d-flex align-items-start justify-content-between">
                                            <div class="name">
                                                <h6>{{$ph->name}}</h6>
                                                <span>{{ \Carbon\Carbon::parse($ph->created_at)->format('jS M, Y') }}</span>
                                            </div>
                                            <div class="status text-right">
                                                <h6>₹{{$ph->total_amount}}</h6>
                                                @if($ph->payment_status=='0')
                                                <span class="failed">Failed</span>
                                                @else
                                                  <span class="failed">Success</span>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                    <p style="margin-top: 20px; margin-bottom: 0px; margin-left: -10px;">No data found</p>
                                    @endif
                                        <!-- <div class="payment-history d-flex align-items-start justify-content-between">
                                            <div class="name">
                                                <h6>Robin Jonnson</h6>
                                                <span>28 Sep, 07:38 PM</span>
                                            </div>
                                            <div class="status text-right">
                                                <h6>₹1000.25</h6>
                                                <span class="success">Success</span>
                                            </div>
                                        </div> -->
                                        <!-- <div class="payment-history d-flex align-items-start justify-content-between">
                                            <div class="name">
                                                <h6>Robin Jonnson</h6>
                                                <span>28 Sep, 07:38 PM</span>
                                            </div>
                                            <div class="status text-right">
                                                <h6>₹1000.25</h6>
                                                <span class="failed">Failed</span>
                                            </div>
                                        </div> -->
                                        <!-- <div class="payment-history d-flex align-items-start justify-content-between">
                                            <div class="name">
                                                <h6>Robin Jonnson</h6>
                                                <span>28 Sep, 07:38 PM</span>
                                            </div>
                                            <div class="status text-right">
                                                <h6>₹1000.25</h6>
                                                <span class="success">Success</span>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>




            <div class="col-md-4">
                <div class="user-detail-right py-4 px-3">
                    <div class="cont-info">
                        <h5>Contact information</h5>
                        <div class="cont-grid">
                            <a href="mailto:exclusive@gmail.com" class="d-block">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21.6975 15.8335C21.6975 17.8602 20.0489 19.5062 18.0248 19.5062H5.97525C3.95114 19.5062 2.3025 17.8601 2.3025 15.8335V8.16652C2.30205 7.51333 2.47704 6.87201 2.80917 6.30957L8.68861 12.189C9.56822 13.0712 10.7461 13.5573 12.0013 13.5573C13.2538 13.5573 14.4317 13.0712 15.3113 12.189L21.1908 6.30957C21.5229 6.872 21.6979 7.51333 21.6975 8.16652V15.8335H21.6975ZM18.0248 4.49382H5.97525C5.13938 4.49382 4.36777 4.77671 3.75052 5.24738L9.68911 11.1885C10.3038 11.8006 11.1242 12.1402 12.0013 12.1402C12.8757 12.1402 13.6962 11.8006 14.3108 11.1885L20.2494 5.24738C19.6322 4.77671 18.8607 4.49382 18.0248 4.49382ZM18.0248 3.07669H5.97525C3.16927 3.07669 0.885376 5.36058 0.885376 8.16657V15.8335C0.885376 18.6421 3.16927 20.9234 5.97525 20.9234H18.0248C20.8307 20.9234 23.1146 18.6421 23.1146 15.8335V8.16652C23.1146 5.36053 20.8307 3.07669 18.0248 3.07669Z" fill="#888888" />
                                </svg>
                                {{$customer_detail->email}}
                            </a>
                            <a href="tel:08048211856" class="d-block">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.84002 9.856C7.63077 13.7544 10.8125 16.8438 14.762 18.519L14.774 18.524L15.538 18.864C16.0099 19.0744 16.5399 19.1161 17.0388 18.9818C17.5378 18.8476 17.9754 18.5458 18.278 18.127L19.552 16.364C19.5895 16.3121 19.6056 16.2478 19.597 16.1843C19.5885 16.1209 19.5559 16.0631 19.506 16.023L17.282 14.228C17.2558 14.2068 17.2256 14.1911 17.1932 14.1818C17.1608 14.1726 17.1269 14.17 17.0934 14.1742C17.06 14.1784 17.0277 14.1893 16.9986 14.2063C16.9695 14.2233 16.9441 14.246 16.924 14.273L16.058 15.442C15.956 15.5798 15.8098 15.6785 15.6439 15.7216C15.4779 15.7647 15.3022 15.7497 15.146 15.679C12.1871 14.3386 9.81646 11.9679 8.47602 9.009C8.40532 8.85279 8.39028 8.67708 8.43341 8.51113C8.47653 8.34518 8.57522 8.19902 8.71302 8.097L9.88002 7.23C9.90713 7.20996 9.92991 7.18464 9.94699 7.15556C9.96407 7.12648 9.97509 7.09426 9.97938 7.06081C9.98368 7.02737 9.98117 6.9934 9.972 6.96095C9.96283 6.9285 9.94718 6.89824 9.92601 6.872L8.13202 4.648C8.09187 4.59813 8.03413 4.56556 7.97069 4.557C7.90724 4.54844 7.84294 4.56455 7.79102 4.602L6.01802 5.882C5.59641 6.18611 5.29312 6.62682 5.15968 7.12923C5.02623 7.63165 5.07088 8.16477 5.28601 8.638L5.84002 9.855V9.856ZM14.17 19.897C9.87912 18.075 6.42262 14.7173 4.47702 10.481L4.47502 10.479L3.92102 9.259C3.56244 8.47043 3.48792 7.58204 3.71014 6.74477C3.93236 5.90749 4.43759 5.17297 5.14002 4.666L6.91302 3.386C7.27614 3.12392 7.72593 3.01102 8.16978 3.07055C8.61363 3.13008 9.01777 3.3575 9.29902 3.706L11.094 5.931C11.2421 6.11457 11.3516 6.3262 11.4159 6.55316C11.4802 6.78012 11.4979 7.01773 11.468 7.25171C11.4381 7.4857 11.3612 7.71122 11.242 7.91474C11.1227 8.11825 10.9635 8.29556 10.774 8.436L10.104 8.932C11.2368 11.1283 13.0257 12.9172 15.222 14.05L15.719 13.38C15.8595 13.1906 16.0367 13.0316 16.2401 12.9124C16.4436 12.7932 16.669 12.7164 16.9028 12.6865C17.1367 12.6566 17.3742 12.6743 17.6011 12.7385C17.8279 12.8027 18.0395 12.912 18.223 13.06L20.448 14.855C20.7968 15.1363 21.0244 15.5406 21.0839 15.9847C21.1435 16.4288 21.0304 16.8788 20.768 17.242L19.494 19.006C18.9897 19.7039 18.2606 20.207 17.4291 20.4308C16.5977 20.6546 15.7145 20.5855 14.928 20.235L14.17 19.897Z" fill="#888888" />
                                </svg>
                                {{$customer_detail->phone}}
                            </a>
                            <!-- <p class="mb-0">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.66669 2.66667V5.16667" stroke="#888888" stroke-width="1.5"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M13.3333 2.66667V5.16667" stroke="#888888" stroke-width="1.5"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M17.5 8.08333V15.1667C17.5 17.6667 16.25 19.3333 13.3333 19.3333H6.66667C3.75 19.3333 2.5 17.6667 2.5 15.1667V8.08333C2.5 5.58333 3.75 3.91667 6.66667 3.91667H13.3333C16.25 3.91667 17.5 5.58333 17.5 8.08333Z"
                                        stroke="#888888" stroke-width="1.5" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.66669 10.1667H13.3334" stroke="#888888" stroke-width="1.5"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.66669 14.3333H10" stroke="#888888" stroke-width="1.5"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                DOB - 20 Oct 2023
                            </p> -->
                            <p class="mb-0">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1_33)">
                                        <path d="M19.9892 0.725937C19.9801 0.654062 19.9642 0.584896 19.938 0.52C19.9371 0.518438 19.9371 0.516146 19.9367 0.514115C19.9367 0.513698 19.9363 0.513281 19.9359 0.512917C19.907 0.444531 19.8676 0.3825 19.823 0.324896C19.812 0.311302 19.8012 0.297812 19.7896 0.285052C19.742 0.231302 19.6904 0.181667 19.6303 0.141198C19.6287 0.139948 19.6267 0.139583 19.6251 0.138333C19.567 0.100104 19.503 0.0711979 19.4358 0.0484375C19.4192 0.0425 19.4029 0.0374479 19.3858 0.0329687C19.3154 0.0138542 19.243 0 19.1667 0H13.3333C12.8733 0 12.5 0.373333 12.5 0.833333C12.5 1.29333 12.8733 1.66667 13.3333 1.66667H17.1545L12.1808 6.64042C10.8545 5.57969 9.22161 5 7.5 5C3.36469 5 0 8.36469 0 12.5C0 16.6353 3.36469 20 7.5 20C11.6353 20 15 16.6353 15 12.5C15 10.7792 14.4208 9.14672 13.3592 7.81922L18.3333 2.84505V6.66667C18.3333 7.12667 18.7067 7.5 19.1667 7.5C19.6267 7.5 20 7.12667 20 6.66667V0.833333C20 0.815833 19.9959 0.799167 19.9949 0.782083C19.9936 0.763293 19.9917 0.744602 19.9892 0.725937ZM7.5 18.3333C4.28323 18.3333 1.66667 15.7168 1.66667 12.5C1.66667 9.28323 4.28323 6.66667 7.5 6.66667C9.0574 6.66667 10.5237 7.27292 11.6262 8.37156C12.727 9.4763 13.3333 10.9426 13.3333 12.5C13.3333 15.7168 10.7168 18.3333 7.5 18.3333Z" fill="#888888" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1_33">
                                            <rect width="20" height="20" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                @if($customer_detail->gender=='1')
                                Male
                                @else
                                Female
                                @endif
                            </p>
                        </div>
                    </div>
                    <hr class="border-0 opacity-100 my-4">
                    <div class="defalt-add">
                        <h5>Default address</h5>
                        <div class="defalt-grid">
                            <p class="mb-0">{{isset($address_default)?$address_default->full_name:''}}</p>
                            <address class="mb-0">{{isset($address_default)? $address_default->address : '',isset($address_default) ? $address_default->city:'',isset($address_default)?$address_default->state:'',isset($address_default)?$address_default->pin_code:''}} </address>
                            <span>{{isset($address_default) ? $address_default->mobile_number : ''}}</span>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</section>


<style>
    #user-details .user-detail-left {
        border-radius: 16px;
        border: 0;
        background: #FFF;
        box-shadow: 0 2px 5px 0 rgb(0 0 0 / 6%);
    }

    #user-details .user-head {
        column-gap: 16px;
    }

    #user-details .user-head .user-head-img {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        overflow: hidden;
    }

    #user-details .user-head .user-head-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    #user-details .user-head .user-head-con h6 {
        font-size: 18px;
        color: #000;
        margin-bottom: 3px;
        font-weight: 500;
    }

    #user-details .user-head .user-head-con a {
        font-size: 13px;
        color: #737373;
    }

    #user-details .left-row {
        border-radius: 0px 0px 10px 10px;
        background: #FAF7EF;
    }

    #user-details .left-row .total-order {
        width: 33.99%;
    }
    #user-details .total-amount {
        width: 46%;
    }
    #user-details .total-review {
        width: 20%;
    }

    #user-details .left-row .total-review {
        padding-left: 24px;
    }

    #user-details .left-row .total-order .w50,
    .total-amount .w50 {
        width: 50%;
        margin-left: 26px;
        padding: 8px 0 10px 0;
    }

    #user-details .left-row .total-order .total-head,
    .total-amount .total-head {
        color: #000;
        font-size: 14px;
        border-bottom: solid 1px #D9D9D9;
        padding: 11px 0;
    }

    #user-details .left-row .total-order p,
    .total-amount p {
        color: #666666;
        font-size: 12px;
        margin-bottom: 4px;
    }

    #user-details .left-row .total-order h6,
    .total-amount h6,
    .total-review h6 {
        color: #000;
        font-size: 16px;
        margin-right: 4px;
        font-weight: 600;
    }

    #user-details .left-row .total-order span {
        color: #666666;
        font-size: 10px;
    }

    #user-details .left-row .total-amount {
        border-left: solid 1px #D9D9D9;
        border-right: solid 1px #D9D9D9;
    }

    #user-details .left-row .total-review p {
        color: #666666;
        font-size: 14px;
        margin-bottom: 4px;
    }

    #user-details .user-tab-list {
        border: 0;
        background: #FFF;
        margin-top: 15px;
        padding: 20px 0;box-shadow: 0 2px 5px 0 rgb(0 0 0 / 6%);
    border-radius: 4px;
    }

    #user-details .user-tab-list .panel-heading .nav li a {
        color: #131C2F;
        font-size: 14px;padding: 10px;
    }

    #user-details .user-tab-list .panel-heading .nav li .active {
        color: #EDB400;
        position: relative;
    }

    #user-details .user-tab-list .panel-heading .nav li .active::before {
        content: "";
        position: absolute;
        width: 100%;
        bottom: 2px;left: 0;
        height: 2px;
        background-color: #EDB400;

    }
    .card .card-header { border-bottom: 0;}

    #user-details .user-tab-list .panel-heading .nav-tabs {
        padding: 0 0px;
        background: transparent;
        border-bottom: solid 1px #D9D9DA;
        padding-bottom: 6px;
        margin-bottom: 0;

    }

    #user-details .user-tab-list .panel-body .tab-pane {
        padding: 0 22px;

    }

    #user-details .user-tab-list .panel-body .user-order-id .order-head h6 {
        font-size: 18px;
        color: #000;
        font-weight: 600;
        margin-bottom: 2px;
    }

    #user-details .user-tab-list .panel-body .user-order-id {
        border-radius: 8px;
        border: 1px solid #D4DFEA;
        background: #FFF;
        Padding: 18px 20px;
        margin-top: 18px;
    }

    #user-details .user-tab-list .panel-body .user-order-id .order-head p {
        font-size: 13px;
        color: #444444;
    }

    #user-details .user-tab-list .panel-body .user-order-id .order-head span {
        font-size: 14px;
        color: #000;
        font-weight: 500;
    }

    #user-details .user-tab-list .panel-body .user-order-id hr {
        border: 0;
        border-bottom: dashed 1px #B7C7D7;
        margin: 16px 0 20px 0;
    }

    #user-details .user-tab-list .panel-body .user-order-id .utsc .utsc-img {
        width: 60px;
        height: 60px;
        border-radius: 5px;
        border: 1px solid #DFDEDE;
        background: #FFF;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #user-details .user-tab-list .panel-body .user-order-id .utsc .utsc-img img {
        width: 35px;
    }

    #user-details .user-tab-list .panel-body .user-order-id .utsc .utsc-cont h6 {
        font-size: 16px;
        color: #000;
        font-weight: 500;
    }

    #user-details .user-tab-list .panel-body .user-order-id .utsc .utsc-cont p {
        font-size: 13px;
        color: #52555B;
        margin: 2px 0 2px 0;
    }

    #user-details .user-tab-list .panel-body .user-order-id .utsc .utsc-cont {
        margin-left: 18px;
    }

    #user-details .user-tab-list .panel-body .user-order-id .utsc .utsc-cont p span {
        color: #444444;
    }

    #user-details .user-tab-list .panel-body .user-order-id .utsc .utsc-cont .pris p {
        color: #000;
        font-size: 14px;
        font-weight: 500;
        margin-top: 0;
    }

    #user-details .user-tab-list .panel-body .user-order-id .utsc .utsc-cont .pris span {
        background-color: #D8E2EA;
        width: 1px;
        height: 14px;
        margin: 0 12px;
    }

    #user-details .user-tab-list .panel-body .user-jon {
        border: 1px solid #D4DFEA;
        background: #FFF;
        padding: 24px 20px;
        margin-top: 18px;
        border-radius: 8px;
    }

    #user-details .user-tab-list .panel-body .user-jon .jon-h h6 {
        color: #000;
        font-size: 18px;
        font-weight: 600;

    }

    #user-details .user-tab-list .panel-body .user-jon .jon-h span {
        border-radius: 3px;
        border: 1px solid #FFB700;
        background: #FFFAEE;
        color: #FFB700;
        font-size: 13px;
        padding: 2px 10px;
        margin-left: 30px
    }

    #user-details .user-tab-list .panel-body .user-jon address {
        color: #666666;
        font-size: 15px;
        margin: 8px 0;
    }

    #user-details .user-tab-list .panel-body .user-jon address {
        color: #000;
        font-size: 15px;
    }

    #user-details .user-tab-list .panel-body .review-quality-gap {
        display: grid;
        row-gap: 16px;
        margin-top: 18px;
    }

    #user-details .user-tab-list .panel-body .review-quality {
        border-radius: 8px;
        border: 1px solid #DFDEDE;
        background: #FFF;
        padding: 14px;
    }

    #user-details .user-tab-list .panel-body .review-quality .rate {
        background-color: #00D566;
        display: inline;
        border-radius: 4px;
        padding: 3px 6px;
    }

    #user-details .user-tab-list .panel-body .review-quality .rate span {
        color: #fff;
        font-size: 12px;
        font-weight: 300;
    }

    #user-details .user-tab-list .panel-body .review-quality p {
        color: #000;
        font-size: 15px;
        margin-top: 8px;
    }

    #user-details .user-tab-list .panel-body .review-quality .m-29 {
        margin-top: 10px;
    }

    #user-details .user-tab-list .panel-body .review-quality span {
        color: #7D8998;
        font-size: 12px;
    }

    #user-details .user-tab-list .panel-body .review-quality hr {
        background-color: #7D8998;
        margin: 0 6px;
        height: 10px;
        width: 1px;
    }


    #user-details .user-tab-list .panel-body .payment-history-gap {}

    #user-details .payment-history {
        border-bottom: 1px solid #DFDEDE;
        background: #FFF;
        padding: 16px 0 8px;
    }

    #user-details .payment-history .name h6 {
        font-size: 16px;
        font-weight: 500;
        color: #000;
        margin-bottom: 2px;
    }

    #user-details .payment-history .name span {
        color: #7D8998;
        font-size: 12px;
    }

    #user-details .payment-history .status h6 {
        font-size: 14px;
        font-weight: 500;
        color: #000;
        margin-bottom: 2px;
    }

    #user-details .payment-history .status .failed {
        color: red;
        font-size: 12px;
        font-weight: 500;
    }

    #user-details .payment-history .status .success {
        color: green;
        font-size: 12px;
        font-weight: 500;
    }
    .user-details-row {
    margin-top: 15px;}


    #user-details .user-detail-right {
        border: 0;
        background: #FFF;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 6%);
    border-radius: 16px;
    }

    #user-details .user-detail-right hr {
        background: #B7C7D7;
        height: 1px;
    }

    #user-details .user-detail-right .cont-info h5 {
        color: #000;
        margin-bottom: 22px;
        font-weight: 500;
        font-size: 18px;
    }

    #user-details .user-detail-right .defalt-add h5 {
        margin-bottom: 16px;
        color: #000;
        font-weight: 500;
        font-size: 18px;
    }

    #user-details .user-detail-right .cont-info a,
    .cont-info p,
    .defalt-add p,
    .defalt-add span {
        color: #000;
    }

    #user-details .user-detail-right .cont-info a,
    .cont-info p {
        font-size: 14px;
    }

    #user-details .user-detail-right .cont-info a svg,
    .cont-info p svg {
        margin-right: 8px;
    }

    #user-details .user-detail-right .defalt-add p {
        font-size: 16px;
    }

    #user-details .user-detail-right .defalt-add span {
        font-size: 14px;
    }

    #user-details .user-detail-right .defalt-add address {
        font-size: 14px;
        color: #666666;
    }

    #user-details .user-detail-right .cont-info .cont-grid {
        display: grid;
        row-gap: 22px;
    }

    #user-details .user-detail-right .defalt-add .defalt-grid {
        display: grid;
        row-gap: 6px;
    }

    .utsc-grid {
        display: grid;
        row-gap: 12px;
    }
</style>







@endsection
