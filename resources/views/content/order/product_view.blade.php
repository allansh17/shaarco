@extends('layouts/contentNavbarLayout')
@section('title', 'View Order Details')
@section('content')

<div class="card">
    <div class="card-header justify-content-between d-flex">
        <h3>{{ __('View Order Details') }}</h3>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ url('order') }}">
                <i class='bx bx-list-ul'></i> List of Orders
            </a>
        </div>
    </div>
</div>

<section id="order-details">
    <div class="order-detail-row">
        <div class="row">
            <div class="col-md-8">
                <div class="order-left">
                    <div class="order-id d-flex align-items-start justify-content-between">
                        <div class="">
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0">Order Id:{{ $order->id }}</h6>
                                <!-- <span class="">Delivered</span> -->
                            </div>
                            @php
                            $timestamp = strtotime($order->created_at);
                            $formattedDate = date('jS M, Y \a\t g:i a', $timestamp);
                            @endphp
                            <p class="mb-0">Order on {{ $formattedDate }}</p>
                        </div>

                        <div class="d-flex">
                            <!-- <div class="invoice_down" style="margin-right:16px;margin-top: 3px;">
                                <a href="{{ url('order/downloadinvoice/' . base64_encode($order->id)) }}"
                                    class="text-decoration-none invoice" style="font-size: 12px;"><i
                                        class="fa fa-download" aria-hidden="true"></i> Invoice </a>
                            </div> -->

                            @php
                            // Get the first product order
                            $status = $order->order_status;

                            @endphp

                            <div class="dropdown">
                                <select o_id="{{$order->id}}" class="all_order_satus" style=" border: 1px solid #D4DFEA;padding: 3px 2px 3px;
                                    border-radius: 3px;  margin-top: 3px;  font-size: 14px;" id="all_order_satus" class="form-group">
                                    <option value="0" {{$status=='0' ? 'selected':''}}>Pending</option>
                                    <!-- <option value="1" {{$status=='1' ? 'selected':''}}>Confirmed</option> -->
                                    <option value="2" {{$status=='2' ? 'selected':''}}>Shipped</option>
                                    <!-- <option value="3" {{$status=='3' ? 'selected':''}}>Intransit</option> -->
                                    <option value="4" {{$status=='4' ? 'selected':''}}>Delivered</option>
                                    <option value="5" {{$status=='5' ? 'selected':''}}>Cancelled</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <hr class=" opacity-100 ">
                    <div class="table-responsive">
                        <table border="1" class="product table">
                            <tbody>
                                <div class="d-flex align-items-center opacity-100">
                                    <h6 class="mb-0">Products Details</h6>
                                </div>
                                @foreach ($product_order as $p_order)
                                @php
                                // echo "<pre>";
                                // print_r($p_order);
                                $product = $p_order->product;
                                $product_image = $p_order->product_image;

                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-right">
                                            <div class="prod-img">

                                                <img src="{{ url('/uploads/product/product_image/' . $product_image) }}" alt="">

                                            </div>
                                            <div class="prod-cont row justify-content">
                                                <div class="col-md-4">
                                                    <h6 class="mb-0"><span>Name: </span></h6>
                                                    <p class="mb-0">{{ $p_order->name }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <h6 class="mb-0"><span>Category Name: </span></h6>
                                                    <p class="mb-0">{{ $p_order->category_name }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <h6 class="mb-0"><span>SKU: </span></h6>
                                                    <p class="mb-0">{{ $p_order->sku }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <h6 class="mb-0"><span>Quantity: </span></h6>
                                                    <p class="mb-0">{{$p_order->qty}}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <h6 class="mb-0"><span>Brand Name: </span></h6>
                                                    <p class="mb-0">{{ $p_order->brand_name }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <h6 class="mb-0"><span>Origin: </span></h6>
                                                    <p class="mb-0">{{ $p_order->origin }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <h6 class="mb-0"><span>Product Code: </span></h6>
                                                    <p class="mb-0">{{ $p_order->code }}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <h6 class="mb-0"><span>Measurements: </span></h6>
                                                    <p class="mb-0">{{ $p_order->measurements }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- <td>
                                        <div>
                                            <h6 class="mb-0" style="font-size: 12px">Taxable </br> Amount </h6>
                                            <p>₹{{ $p_order->mrp}}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="cgst-gst">
                                            <div class="cgst-1">
                                                <h6>CGST</h6>
                                                <p>{{ isset($p_order->cgst) ? $p_order->cgst : '0' }} %</p>
                                            </div>
                                            <div class="cgst-1">
                                                <h6>SGST</h6>
                                                <p>{{ isset($p_order->sgst) ? $p_order->sgst : '0' }} %</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="for_mrp">
                                            <h6 style="font-size: 12px">M.R.P:</h6>
                                            <p>₹@php echo ($p_order->cutoff_price); @endphp</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="for_discount">
                                            <h6 style="font-size: 12px">Discount:</h6>
                                            <p>{{ $p_order->discount_percentage }}%</p>
                                        </div>

                                    </td>
                                    <td>
                                        <div class="for_qty">
                                            <h6 style="font-size: 12px">Qty:</h6>
                                            <p>{{ $p_order->qty }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="">
                                            <h6 style="font-size: 12px">Price:</h6>
                                            <h6>₹{{ $p_order->sub_total_price }}</h6>

                                            <div class="date-pikker">
                                                <input style="display:none;margin-top: 10px" type="date"
                                                    class="deliver_date{{ $p_order->id }}" value=""
                                                    id="{{ 'pdelivery' . $p_order->id }}">
                                            </div>
                                        </div>
                                    </td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="payment-head">
                    <div class="payment-meth d-flex align-items-start justify-content-between">

                    </div>

                    <hr class="mb-4 opacity-100 ">

                    <h5>Order Message</h5>
                    <div class="mrp d-flex justify-content-between">
                        <!-- <p class="mb-0">MRP</p> -->
                        <span>{{ $order->message }}</span>
                    </div>
                    <!-- <div class="dom d-flex justify-content-between">
                            <p class="mb-0">Discount (Coupon)</p>
                            <span>₹{{ $order->discount }}</span>
                        </div>
                        <div class="sc d-flex justify-content-between">
                            <p class="mb-0">Shipping Charges</p>
                            <span>
                                {{ $order->shipping_charges == 0 ? 'Free' : $order->shipping_charges }}
                            </span>
                        </div> -->
                    <!-- <div class="dcd d-flex justify-content-between">
                                    <p class="mb-0">Discount <span>(Coupon - DEMO254)</span></p>
                                    <span>₹{{ $order->discount }}</span>
                                </div> -->

                    <!-- <hr class=" opacity-100 solid"> -->
                    <!-- <div class="cgst d-flex justify-content-between">
                                    <p class="mb-0">CGST </p>
                                    <span>₹{{ isset($order->cgst) ? $order->cgst : '0.00' }}</span>
                                </div>
                                <div class="gst d-flex justify-content-between">
                                    <p class="mb-0">SGST </p>
                                    <span>₹{{ isset($order->sgst) ? $order->sgst : '0.00' }}</span>
                                </div>
                                <hr class=" opacity-100 solid"> -->

                    <!-- <div class="tota d-flex align-items-start justify-content-between">
                            <div class="">
                                <h6>Total</h6>
                                <p class="mb-0">* Inclusive of all Taxes</p>
                            </div>
                            <h6>₹{{$order->total_amount}}</h6>
                        </div> -->
                </div>

                {{-- <div class="user-time" style="display:none;">
                        <h6>Order Timeline</h6>
                        <div class="time-line">
                            <div class="time-line-gap">
                                <div class=" time-oc d-flex align-items-start">
                                    <div class="left">

                                    </div>
                                    <div class="right">
                                        <span class="date">20 October</span>
                                    </div>
                                </div>
                                <div class="time-detail d-flex align-items-start">
                                    <div class="left">
                                        <p class="mb-0">5:09 pm</p>
                                    </div>
                                    <div class="right">
                                        <p class="mb-0">This order was Order Confirmed.</p>
                                    </div>
                                </div>
                                <div class="time-detail d-flex align-items-start">
                                    <div class="left">
                                        <p class="mb-0">7:11am</p>
                                    </div>
                                    <div class="right">
                                        <p class="mb-0">Your Order has been placed.</p>
                                        <h6>Items</h6>
                                        <p class="mb-0">JK Super Cement - OPC (53)</p>
                                        <p class="sku mb-0"><span>SKU:</span> CEPPCGACC0002</p>
                                        <h6>Service</h6>
                                        <p class="mb-0">Manual</p>
                                    </div>
                                </div>
                                <div class="time-oc d-flex align-items-start">
                                    <div class="left">

                                    </div>
                                    <div class="right">
                                        <span class="date f-margin">21 October</span>
                                    </div>
                                </div>
                                <div class="time-detail d-flex align-items-start">
                                    <div class="left">
                                        <p class="mb-0">7:11am</p>
                                    </div>
                                    <div class="right">
                                        <p class="mb-0">Item yet to be delivered.</p>
                                    </div>
                                </div>
                                <div class="time-detail d-flex align-items-start">
                                    <div class="left">
                                        <p class="mb-0">7:11am</p>
                                    </div>
                                    <div class="right">
                                        <p class="mb-0">Delivery Expected By Sun 22th Oct</p>
                                        <address>Item yet to be delivered. Expected by Sun, 22th Oct</address>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}


            </div>
            <div class="col-md-4">
                <div class="sticky-top">
                    <div class="order-customer">
                        <h6 class="cust mb-3">Customer details</h6>
                        <div class="d-flex justify-content-start align-items-center mb-4">
                            <div class="avatar me-2">
                                <img src="{{ !empty($order->profileImage) ? asset('uploads/customer_profile_img/' . $order->profileImage) : asset('uploads/default_image/default.png') }}" class="rounded-circle">
                            </div>
                            <div class="flex-column">
                                <a href="{{ url('customer/view/' . ($order->customer_id)) }}" class="text-body text-nowrap">
                                    <h6 class="mb-0">{{ $order->name }}</h6>
                                </a>
                                <small class="text-muted">Customer ID: {{$order->user_id }}</small><br>
                                <small class="text-muted">Customer Name: {{ucfirst($order->first_name) }} {{ ucfirst($order->last_name) }}</small><br>
                                <small class="text-muted">Customer Type: {{ucfirst($order->user_type) }}</small>
                            </div>
                        </div>
                        <!-- <div class="d-flex justify-content-start align-items-center mb-4">
                            <span class="avatar rounded-circle bg-label-success me-2 d-flex align-items-center justify-content-center"><i class="bx bx-cart-alt bx-sm lh-sm"></i></span>
                            <h6 class="text-body text-nowrap mb-0">{{$total_order}}</h6>
                        </div> -->
                        <hr>
                        <h6 class="mt-3">Contact information</h6>
                        <a href="mailto:{{ $order->email }}" class="text-decoration-none mt-3">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M21.6974 15.8335C21.6974 17.8602 20.0488 19.5062 18.0247 19.5062H5.97513C3.95102 19.5062 2.30238 17.8601 2.30238 15.8335V8.16652C2.30193 7.51333 2.47691 6.872 2.80905 6.30956L8.68849 12.189C9.5681 13.0712 10.746 13.5573 12.0011 13.5573C13.2537 13.5573 14.4316 13.0712 15.3112 12.189L21.1907 6.30956C21.5228 6.87199 21.6978 7.51332 21.6973 8.16652V15.8335H21.6974ZM18.0246 4.49381H5.97513C5.13925 4.49381 4.36764 4.7767 3.75039 5.24738L9.68899 11.1885C10.3037 11.8006 11.1241 12.1402 12.0011 12.1402C12.8756 12.1402 13.6961 11.8006 14.3107 11.1885L20.2493 5.24738C19.6321 4.7767 18.8606 4.49381 18.0246 4.49381ZM18.0246 3.07669H5.97513C3.16914 3.07669 0.885254 5.36058 0.885254 8.16656V15.8335C0.885254 18.6421 3.16914 20.9234 5.97513 20.9234H18.0246C20.8306 20.9234 23.1145 18.6421 23.1145 15.8335V8.16652C23.1145 5.36053 20.8306 3.07669 18.0246 3.07669Z"
                                    fill="#888888" />
                            </svg>
                            {{ $order->email }}
                        </a>
                        <a href="tel:{{ $order->phone }}" class="text-decoration-none mt-3">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.84008 9.856C7.63083 13.7544 10.8126 16.8438 14.7621 18.519L14.7741 18.524L15.5381 18.864C16.01 19.0744 16.5399 19.1161 17.0389 18.9818C17.5379 18.8476 17.9754 18.5458 18.2781 18.127L19.5521 16.364C19.5895 16.3121 19.6056 16.2478 19.5971 16.1843C19.5885 16.1209 19.5559 16.0631 19.5061 16.023L17.2821 14.228C17.2559 14.2068 17.2257 14.1911 17.1933 14.1818C17.1609 14.1726 17.1269 14.17 17.0935 14.1742C17.06 14.1784 17.0278 14.1893 16.9987 14.2063C16.9696 14.2233 16.9442 14.246 16.9241 14.273L16.0581 15.442C15.9561 15.5798 15.8099 15.6785 15.6439 15.7216C15.478 15.7647 15.3023 15.7497 15.1461 15.679C12.1871 14.3386 9.81652 11.9679 8.47608 9.009C8.40538 8.85279 8.39035 8.67708 8.43347 8.51113C8.47659 8.34519 8.57528 8.19903 8.71308 8.097L9.88008 7.23C9.90719 7.20996 9.92998 7.18464 9.94705 7.15556C9.96413 7.12649 9.97515 7.09426 9.97945 7.06081C9.98374 7.02737 9.98123 6.9934 9.97206 6.96095C9.96289 6.9285 9.94725 6.89825 9.92608 6.872L8.13208 4.648C8.09194 4.59813 8.03419 4.56556 7.97075 4.557C7.90731 4.54844 7.843 4.56455 7.79108 4.602L6.01808 5.882C5.59647 6.18611 5.29318 6.62682 5.15974 7.12923C5.0263 7.63165 5.07094 8.16477 5.28608 8.638L5.84008 9.855V9.856ZM14.1701 19.897C9.87918 18.075 6.42268 14.7173 4.47708 10.481L4.47508 10.479L3.92108 9.259C3.5625 8.47044 3.48798 7.58205 3.7102 6.74477C3.93242 5.90749 4.43766 5.17297 5.14008 4.666L6.91308 3.386C7.27621 3.12392 7.72599 3.01103 8.16984 3.07055C8.61369 3.13008 9.01784 3.3575 9.29908 3.706L11.0941 5.931C11.2422 6.11457 11.3517 6.3262 11.416 6.55316C11.4802 6.78012 11.498 7.01773 11.4681 7.25171C11.4382 7.4857 11.3613 7.71122 11.242 7.91474C11.1228 8.11826 10.9636 8.29556 10.7741 8.436L10.1041 8.932C11.2369 11.1283 13.0257 12.9172 15.2221 14.05L15.7191 13.38C15.8595 13.1906 16.0368 13.0316 16.2402 12.9124C16.4436 12.7932 16.669 12.7164 16.9029 12.6865C17.1368 12.6566 17.3743 12.6743 17.6011 12.7385C17.828 12.8027 18.0395 12.912 18.2231 13.06L20.4481 14.855C20.7969 15.1363 21.0245 15.5406 21.084 15.9847C21.1435 16.4288 21.0305 16.8788 20.7681 17.242L19.4941 19.006C18.9898 19.7039 18.2607 20.2071 17.4292 20.4309C16.5977 20.6547 15.7146 20.5855 14.9281 20.235L14.1701 19.897Z"
                                    fill="#888888" />
                            </svg>

                            {{ $order->phone }}
                        </a>
                        <!-- <hr>
                            <h6 class="gs-num mt-4 pb-1 mb-2">GST Number</h6>
                            @if (isset($order->gst_no) && !empty($order->gst_no))
                                <p class="gs-num-p">{{ $order->gst_no }}</p>
                            @else
                                <p class="mb-0">N/A</p>
                            @endif
                            <hr>
                            <h6 class="pt-1">Order instructions</h6>
                            @if (isset($order->order_instructions) && !empty($order->order_instructions))
                                <p class="mb-0">{{ $order->order_instructions }}
                                </p>
                            @else
                                <p class="mb-0">N/A</p>
                            @endif -->

                    </div>
                    <!-- <div class="order-shipping">

                            <h6>Shipping address</h6>
                            @if (isset($shipping_address) && !empty($shipping_address))
                                <p class="mb-1">{{ $shipping_address->full_name }}</p>

                                <address class="mb-1">
                                    {{ $shipping_address->address . ',' . $shipping_address->city . ',' . $shipping_address->state . ',' . $shipping_address->pin_code }}
                                </address>
                                <span>{{ $shipping_address->mobile_number }}</span>
                            @else
                                <address class="mb-1">N/A</address>
                            @endif
                            <hr class="mb-4">
                            <h6>Billing address</h6>
                            @if (isset($billing_address) && !empty($billing_address))
                                <p class="mb-1">{{ $billing_address->full_name }}</p>
                                <address class="mb-1">
                                    {{ $billing_address->address . ',' . $billing_address->city . ',' . $billing_address->state . ',' . $billing_address->pin_code }}
                                </address>
                                <span>{{ $billing_address->mobile_number }}</span>
                            @else
                                <address class="mb-1">N/A </address>
                            @endif


                        </div> -->
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">

        <form action="" method="POST" id="addEditForm1">
            @csrf

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="">



                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group mb-3">
                                        <label for="dispatchDate">Dispatch Date</label>
                                        <input type="date" class="form-control" id="dispatchDate" name="dispatchDate">
                                    </div>
                                </div>
                                {{-- <div class="form-group mb-3">
                                        <label for="dispatchNo">Dispatch No.</label>
                                        <input type="text" class="form-control" id="dispatchNo" name="dispatchNo">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="dispatchedFrom">Dispatched From</label>
                                        <input type="text" class="form-control" id="dispatchedFrom" name="dispatchedFrom">
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="form-group mb-3">
                                        <label for="exactDestination">Exact Destination</label>
                                        <input type="text" class="form-control" id="exactDestination" name="exactDestination">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="vehicleNumber">Vehicle Number</label>
                                        <input type="text" class="form-control" id="vehicleNumber" name="vehicleNumber">
                                    </div> --}}
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="deliveryDate">Delivery Date</label>
                                        <input type="date" class="form-control" id="deliveryDate" name="deliveryDate">
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="form-group mb-3">
                                        <label for="notes">Notes</label>
                                        <textarea class="form-control" id="note" name="note"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn close btn-secondary" id='close_btn' data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
                    </div>
                </div>

        </form>
    </div>
    </div>


</section>






<style>
    #order-details .order-left {
        border-radius: 10px;
        border: 1px solid #D9D9D9;
        background: #FFF;
        padding: 20px 20px 16px;
    }

    #order-details {
        margin: 26px 0;
    }

    #order-details .order-left .order-id h6 {
        font-size: 18px;
        color: #000;
        font-weight: 600;
    }

    #order-details .order-left .order-id span {
        font-size: 11px;
        color: #fff;
        background-color: #41BA4D;
        padding: 2px 8px;
        border-radius: 3px;
        margin-left: 10px;
    }

    #order-details .order-left .order-id p {
        font-size: 12px;
        color: #444444;
        margin-top: 3px;
    }

    #order-details .order-left a.invoice {
        border-radius: 3px;
        background: #FFB700;
        color: #000;
        font-size: 11px;
        padding: 6px 12px;
    }

    #order-details .order-left .dropdown .btn {
        border-radius: 3px;
        border: 1px solid #D0D0D0;
        background: #FFF;
        color: #000;
        font-size: 11px;
        font-weight: 400;
        padding: 6px 12px;
        margin-left: 16px;
    }

    #order-details .order-left .dropdown .btn .down-arrow {
        margin-left: 10px;
    }

    #order-details .order-left .dropdown .dropdown-menu {
        inset: 4px auto auto -42px !important;
        border: 1px solid #D0D0D0;
        width: 100%;
        border-radius: 4px;

    }

    #order-details .order-left .dropdown .dropdown-menu:after,
    .dropdown-menu::after {
        display: none;
    }

    #order-details .order-left .dropdown .dropdown-menu li {
        padding: 3px 0;
    }

    #order-details .order-left .dropdown .dropdown-menu a {
        color: #000;
        font-size: 11px;
        padding: 0px 10px;
    }

    #order-details .order-left hr {
        border: 0;
        border-bottom: dashed 2px #B7C7D7;
        margin: 18px 0 14px 0;
    }

    #order-details .order-left .product-gap {
        display: grid;
        row-gap: 12px;
    }

    #order-details .order-left .product {
        border: 1px solid #D4DFEA;
        background: #FFF;
    }

    #order-details .order-left .product td {
        padding: 4px 5px;
    }

    #order-details .order-left .product .prod-img {
        border-radius: 5px;
        border: 1px solid #DFDEDE;
        background: #FFF;
        min-width: 65px;
        width: 65px;
        height: 65px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #order-details .order-left .product .prod-img img {
        max-width: 100%;
        object-fit: contain;
    }

    #order-details .order-left .product .prod-cont h6 {
        font-size: 14px;
        color: #000;
    }

    #order-details .order-left .product tr td {
        vertical-align: top;
    }

    #order-details .order-left .product tr td p {
        color: #777777;
    }

    #order-details .order-left .product .text-end h6 {
        font-size: 14px;
    }

    #order-details .order-left .product .prod-cont {
        margin-left: 8px;
    }

    #order-details .order-left .product .prod-cont p {
        font-size: 13px;
        color: #52555B;
    }

    #order-details .order-left .product .prod-cont p span {
        color: #444444;
    }

    #order-details .order-left .product .prod-cont .by-cci {
        font-size: 13px;
        color: #444444;
    }

    #order-details .order-left .product .prod-cont .by-cci span {
        color: #021945;
        text-transform: uppercase;
        font-weight: 500;
    }

    #order-details .order-left .product .prod-cont .by-cci span {
        color: #021945;
        text-transform: uppercase;
        font-weight: 500;
    }

    #order-details .order-left .product .cacl {
        column-gap: 50px;
    }

    #order-details .order-left .product .cacl span {
        color: #777777;
        font-size: 14px;
    }

    #order-details .order-left .product .cacl h6 {
        color: #000;
        font-size: 16px;
        font-weight: 500;
        display: flex;
        justify-content: end;
    }

    #order-details .order-left .product .cacl .dropdown .btn {
        background: #F3F3F3;
        padding: 5px 8px;
    }

    #order-details .order-left .product .cacl .dropdown .dropdown-menu {
        inset: 0px auto auto -69px !important;
    }

    #order-details .payment-head {
        border-radius: 10px;
        border: 1px solid #D9D9D9;
        background: #FFF;
        padding: 20px 18px 30px 18px;
        margin-top: 14px;
    }

    #order-details .payment-meth img {
        width: 24px;
        height: 24px;
    }

    #order-details .payment-meth h6 {
        color: #000;
        font-size: 16px;
        font-weight: 500;
    }

    #order-details .payment-meth p {
        color: #666666;
        font-size: 14px;
        margin-left: 6px;
    }

    #order-details h5 {
        color: #000;
        font-size: 20px;
        font-weight: 600;
    }

    #order-details .mrp p,
    .dom p,
    .sc p,
    .dcd p,
    .cgst p,
    .gst p {
        color: #000;
        font-size: 15px;
    }

    #order-details .mrp,
    .dom,
    .sc,
    .dcd,
    .cgst,
    .gst {
        margin-bottom: 10px;
    }

    #order-details .dcd p span {
        color: rgba(0, 0, 0, 0.5);
    }

    #order-details .mrp span,
    .sc span,
    .cgst span,
    .gst span {
        color: #666666;
        font-size: 15px;
    }

    #order-details .dom span {
        color: #27AE60;
    }

    #order-details .dcd span {
        color: #FA1304;
    }

    #order-details hr {
        border: 0;
        border-bottom: dashed 2px #B7C7D7;
        margin: 18px 0 14px 0;
    }

    #order-details .solid {
        border: 0;
        height: 1px;
        background-color: #D9D9D9;
        margin: 16px 0;
    }

    #order-details .tota h6 {
        font-size: 15px;
        color: #000;
        font-weight: 600;
        margin-bottom: 0;
    }

    #order-details .tota p {
        font-size: 12px;
        color: #666666;
    }

    #order-details .user-time {
        margin-top: 20px;
    }

    #order-details .user-time h6 {
        font-size: 20px;
        color: #000;
        font-weight: 600;
    }

    .text-end {
        text-align: right;
    }

    .text-end .date-pikker input {
        padding: 4px 6px;
        font-size: 10px;
        background: #EFEFEF;
        border: 1px solid #D4DFEA;
    }


    #order-details .user-time .time-line {
        border-radius: 10px;
        border: 1.2px solid #D9D9D9;
        background: #FFF;
        padding: 30px 30px;
    }

    #order-details .user-time .time-line .time-line-gap {
        display: grid;
        row-gap: 16px;
        position: relative;
    }

    #order-details .user-time .time-line .time-line-gap:before {
        content: "";
        position: absolute;
        width: 2px;
        height: calc(100% - 40px);
        bottom: 0;
        left: 5px;
        background-color: #C4C4C4;

    }

    #order-details .user-time .time-line .time-oc .right .date {
        font-size: 13px;
        color: #666666;
        margin-bottom: 20px;
    }

    #order-details .user-time .time-line .left {
        min-width: 100px;
    }

    #order-details .user-time .time-line .time-detail {
        position: relative;
    }

    #order-details .user-time .time-line .time-detail:before {
        content: "";
        position: absolute;
        width: 12px;
        height: 12px;
        background-color: #000;
        border-radius: 50%;
        border: solid 2px #C4C4C4;
        top: 3px;
    }

    #order-details .user-time .time-line .time-detail .left p {
        font-size: 13px;
        color: #000000;
        margin-left: 24px;
    }

    #order-details .user-time .time-line .time-detail .right p {
        font-size: 14px;
        color: #333333;
    }

    #order-details .user-time .time-line .time-detail .right address {
        font-size: 13px;
        color: #666666;
        margin-top: 4px;
    }

    #order-details .user-time .time-line .time-detail .right .sku {
        font-size: 13px;
        color: #52555B;
    }

    #order-details .user-time .time-line .time-detail .right .sku span {
        color: #444444;
    }

    #order-details .user-time .time-line .time-detail .right h6 {
        font-size: 14px;
        color: #000;
        font-weight: 600;
        margin: 16px 0 6px 0;

    }


    #order-details .cgst-gst {
        text-align: right;
        display: grid;
        row-gap: 2px;
    }

    #order-details .cgst-gst h6 {
        font-size: 12px !important;
        margin-bottom: 2px;
        color: #000 !important;
    }

    #order-details .cgst-gst p {
        font-size: 12px;
        margin-bottom: 0px;
        color: #777777;
        white-space: nowrap;
    }


    #order-details .sticky-top {
        top: 72px;
    }

    #order-details .order-customer {
        border-radius: 10px;
        border: 1px solid #D9D9D9;
        background: #FFF;
        padding: 30px 20px;
    }

    #order-details .order-customer h6 {
        font-size: 18px;
        color: #000;
        font-weight: 500;
    }

    #order-details .order-customer .cust {
        margin-bottom: 0;
        font-weight: 500;
    }

    #order-details .order-customer .dr-abhi {
        font-size: 14px;
        color: #FFB700;
    }

    #order-details .order-customer a {
        display: block;
        font-size: 14px;
        color: #000;
    }

    #order-details .order-customer a svg {
        margin-right: 8px;
    }

    #order-details .order-customer hr {
        border: 0;
        height: 1px;
        background-color: #B7C7D7;
        opacity: 1;
    }

    #order-details .order-customer .gs-num-p {
        font-size: 16px;
        color: #000;
    }

    #order-details .order-customer p {
        font-size: 14px;
        color: #666666;
    }

    #order-details .order-shipping {
        border-radius: 10px;
        border: 1px solid #D9D9D9;
        background: #FFF;
        padding: 24px 18px 18px;
        margin-top: 18px;
    }

    #order-details .order-shipping h6 {
        font-size: 18px;
        color: #000;
        margin-bottom: 16px;
        font-weight: 500;
    }

    #order-details .order-shipping p {
        font-size: 16px;
        color: #000;
    }

    #order-details .order-shipping address {
        font-size: 14px;
        color: #666666;
    }

    #order-details .order-shipping span {
        font-size: 14px;
        color: #000;
    }

    #order-details .order-shipping hr {
        border: 0;
        height: 1px;
        background-color: #B7C7D7;
        opacity: 1;
    }
</style>

@endsection

@push('scripts')
<script>
    $('.close').on('click', function() {
        $('#myModal').modal('hide');
    })

    $(document).ready(function() {

        $("#all_order_satus").change(function() {
            var o_id = $(this).attr("o_id");
            var o_value = $(this).val();

            Swal.fire({
                title: 'Change Order Status',
                text: 'Are you sure you want to change status?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (o_value == 1) {
                        $('#myModal').modal('hiden');
                        $("#addEditForm1")[0].reset();

                        $('#saveChangesBtn').on('click', function() {
                            $("#addEditForm1").validate({
                                rules: {


                                    dispatchDate: {
                                        required: true,
                                        //regex: true
                                    },

                                    deliveryDate: {
                                        required: true,
                                        //regex: true
                                    },
                                    note: {
                                        required: true,
                                        //regex: true
                                    },


                                },
                                messages: {},


                                errorElement: 'span',
                                errorPlacement: function(error,
                                    element) {
                                    error.addClass(
                                        'invalid-feedback');
                                    element.closest(
                                            '.form-control')
                                        .parent().append(error);
                                },
                                highlight: function(element,
                                    errorClass, validClass) {
                                    $(element).addClass(
                                        'is-invalid');
                                },
                                unhighlight: function(element,
                                    errorClass, validClass) {
                                    $(element).removeClass(
                                        'is-invalid');
                                },
                                submitHandler: function(form) {
                                    //form.submit();
                                    var formData = new FormData($("#addEditForm1")[0]);
                                    // alert(formData);
                                   
                                    formData.append('id', o_id);
                                    formData.append('status', o_value);
                                    var urlp = "{{ route('order.order_status') }}";

                                    $.ajax({
                                        type: "POST",
                                        enctype: 'multipart/form-data',
                                        url: urlp,
                                         headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        data: formData,
                                        mimeType: "multipart/form-data",
                                        contentType: false,
                                        cache: false,
                                        processData: false,
                                        beforeSend: function() {

                                        },
                                        success: function(data) {
                                            var response = JSON.parse(data);
                                            toastr.success(response.msg)
                                            setTimeout(() => {
                                                window.location.reload();
                                            }, 3000);
                                        },
                                        error: function(xhr, status, error) {
                                            // Handle errors if any
                                            console.error(xhr.responseText);
                                        }
                                    });
                                    return false;
                                }



                            });

                        });

                    } else {
                        $("#o_delivery").hide();

                        $.ajax({
                            type: "POST",
                            url: "{{ route('order.order_status') }}",
                            data: {
                                id: o_id,
                                status: o_value,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                var response = JSON.parse(data);
                                toastr.success(response.msg)
                                window.location.reload();

                            },
                        });


                    }



                }
            });



        });


    });
</script>
@endpush
