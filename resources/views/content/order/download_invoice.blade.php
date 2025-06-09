<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>

<body>





    <table style="border: solid 1px #000; width: 100%; border-collapse: collapse;" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width: 60%;">
                <table style="width: 100%; border-collapse: collapse;" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="border-bottom: solid 1px #000; padding: 4px 4px 2px 4px; ">
                            <b style="text-transform: uppercase; font-size: 16px;">M/S. Jai Bajrang Steels</b><br>
                            <div style="font-size: 14px;">Office Address. <span>G-2</span> , <span>8-devi
                                    Niketan</span>.</div>
                            <div style="font-size: 14px;"><span>Sardar Patel Marg</span> , <span>c-scheme</span>.</div>
                            <div style="font-size: 14px;">jaipur (Rajasthan) - 302001</div>
                            <div style="font-size: 14px;">M.No. <span>91584-54784</span> , <span>9954879521</span></div>
                            <div style="font-size: 14px;">Godown. : <span>F 662,Road No,54875</span>.</div>
                            <div style="font-size: 14px;">Vki Area. : <span>jaipur,Rajasthan -303702</span></div>
                            <div style="font-size: 14px;">GSTIN/UIN.: <span>08AAGFJ7513B1ZN</span> .</div>
                            <div style="font-size: 14px;">State Name . : <span>Rajasthan</span>, Code : <span>08</span>
                            </div>
                            <div style="font-size: 14px;">E-Mail . : <span>jaibajrangsteels@gmail.com</span></div>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: solid 1px #000; padding: 2px 4px;">
                            <div style="font-size: 14px;">Consignee (Ship to)</div>
                            <b style="text-transform: uppercase; font-size: 16px;"> @if ($customer_addressdata)
                                {{ $customer_addressdata->full_name }}
                                @endif</b><br>
                            <div style="font-size: 14px;"><span></span><span> @if ($customer_addressdata)
                                    {{ $customer_addressdata->address }}
                                    @endif</span> ,
                                <!-- <span>Plot</span>. -->
                            </div>
                            <!-- <div style="font-size: 14px;"><span>No.9</span> , <span>Ground Floor Sardar Patel Marg
                                    Jaipur 302001</span>.</div> -->
                            <table style="border-collapse: collapse;" cellpadding="0" cellspacing="0">
                                @if($order_data->gst_no)
                                <tr>
                                    <td style="font-size: 14px; width: 100px;">GSTIN/UIN</td>
                                    <td style="font-size: 14px;">:{{$order_data->gst_no}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td style="font-size: 14px; width: 100px;">PAN/IT No</td>
                                    <td style="font-size: 14px;">: -</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px; width: 100px;">State Name</td>
                                    <td style="font-size: 14px;">:  {{$customer_addressdata->state ?? ''}} , code : <span>{{$customer_addressdata->pin_code ?? ''}}</span></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px; width: 100px;">Contact</td>
                                    <td style="font-size: 14px;">:  @if ($customer_addressdata)
                                        {{ $customer_addressdata->mobile_number }}
                                        @endif
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 2px 4px;">
                            <div style="font-size: 14px;">Buyer (Bill to)</div>
                            <b style="text-transform: uppercase; font-size: 16px;">@if ($customer_billingaddressdata)
                                {{ $customer_billingaddressdata->full_name }}
                                @endif</b><br>
                            <div style="font-size: 14px;"><span> @if ($customer_billingaddressdata)
                                    {{ $customer_billingaddressdata->address }}
                                    @endif</span>
                            </div>
                            <!-- <div style="font-size: 14px;"><span>No.9</span> , <span>Ground Floor Sardar Patel Marg
                                    Jaipur 302001</span>.</div> -->
                            <table style="border-collapse: collapse;" cellpadding="0" cellspacing="0">
                                @if($order_data->gst_no)
                                <tr>
                                    <td style="font-size: 14px; width: 100px;">GSTIN/UIN</td>
                                    <td style="font-size: 14px;">:{{$order_data->gst_no}}</td>
                                </tr>
                                @endif
                                <!-- <tr>
                                    <td style="font-size: 14px; width: 100px;">PAN/IT No</td>
                                    <td style="font-size: 14px;">: AAANH55HH</td>
                                </tr> -->
                                <tr>
                                    <td style="font-size: 14px; width: 100px;">State Name</td>
                                    <td style="font-size: 14px;">:{{$customer_billingaddressdata->state ?? ''}} , code : <span>{{$customer_billingaddressdata->pin_code ?? ''}}</span></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px; width: 100px;">Place of Supply</td>
                                    <td style="font-size: 14px;">: {{$customer_billingaddressdata->state ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px; width: 100px;">Contact</td>
                                    <td style="font-size: 14px;">:  @if ($customer_billingaddressdata)
                                        {{ $customer_billingaddressdata->mobile_number }}
                                        @endif
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>


                </table>
            </td>
            <td style="width: 40%; border-left: solid 1px #000; vertical-align: top;">
                <table style="width: 100%; border-collapse: collapse;" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style=" padding: 0 4px; font-size: 14px; border-bottom: solid 1px #000; border-right: solid 1px #000; width: 50%; height: 35px;">
                            Invoice No.
                            <div>
                                @php 
                                $invoice_number = str_pad($order_data->id, 5, '0', STR_PAD_LEFT);
                                @endphp<b>{{$invoice_number}}</b></div>
                        </td>
                        <td style="font-size: 14px; border-bottom: solid 1px #000; height: 35px; padding: 0 4px;">Date
                            <div><b> {{ \Carbon\Carbon::parse($order_data->created_at)->format('jS M, Y') }}</b></div>
                        </td>
                    </tr>
                    {{-- <tr>
                        <td style=" padding: 0 4px; font-size: 14px; border-bottom: solid 1px #000; border-right: solid 1px #000; height: 35px; vertical-align: top;">
                            Delivery Note
                        </td>
                        <td style=" padding: 0 4px; font-size: 14px; border-bottom: solid 1px #000; height: 35px; vertical-align: top;">
                            Mode/Terms of Payment <b>@if($order_data->payment_type=='0') Offline @else 'Online' @endif</b>
                        </td>
                    </tr> --}}
                    <tr>
                        <td style="padding: 0 4px; font-size: 14px; border-bottom: solid 1px #000; border-right: solid 1px #000; height: 35px; vertical-align: top;">
                            Delivery Note<div>{{ $company->customer_order_delivery_note }}</div>
                        </td>
                        <td style="padding: 0 4px; font-size: 14px; border-bottom: solid 1px #000; height: 35px; vertical-align: top;">
                            Mode/Terms of Payment 
                            @if($order_data->payment_type=='0')
                                Offline
                            @else
                                Online
                                <div>TXN:-<b> {{ $order_data->txn_id }}</b></div>
                            @endif
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="padding: 0 4px; font-size: 14px; border-bottom: solid 1px #000; border-right: solid 1px #000; height: 35px;">
                            Reference No. & Date.
                            <div>
                                @php
                                $formattedDate = $order_data->created_at->format('Y-m');

                                @endphp
                                <b>{{$formattedDate}}/5555 dt. {{ \Carbon\Carbon::parse($order_data->created_at)->format('jS M, Y') }}</b></div>
                        </td>
                        <td style="padding: 0 4px; font-size: 14px; border-bottom: solid 1px #000; height: 35px; vertical-align: top;">
                            Other Reference
                        </td>
                    </tr>
                    <tr>
                        <td style=" padding: 0 4px; font-size: 14px; border-bottom: solid 1px #000; border-right: solid 1px #000; height: 35px; vertical-align: top;">
                            Dispatch Date <div><b> {{ \Carbon\Carbon::parse($order_data->dispatched_date)->format('jS M, Y') }}</b></div>
                        </td>
                        <td style=" padding: 0 4px; font-size: 14px; border-bottom: solid 1px #000; height: 35px; vertical-align: top;">
                            Dispatch Doc No.<div><b> {{ $order_data->dispatch_number }}</b></div>
                            
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 4px; font-size: 14px; border-bottom: solid 1px #000; border-right: solid 1px #000; height: 35px; vertical-align: top;">
                            Vehicle No.<div><b> {{ $order_data->vehicle_number }}</b></div>
                        </td>
                        <td style="padding: 0 4px; font-size: 14px; border-bottom: solid 1px #000; height: 35px; vertical-align: top;">
                            Exact Destination<div><b> {{ $order_data->exact_destination }}</b></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style=" padding: 0 4px; font-size: 14px; vertical-align: top; border-bottom: solid 1px #000; height: 35px;">Dispatched From
                            <div><b> {{ $order_data->dispatched_from }}</b></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-size: 14px; padding: 0 4px;">Terms of Delivery<div> {{ $company->terms }}</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table style="width: 100%;  border-top: solid 1px #000; border-bottom: solid 1px #000; border-collapse: collapse;" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="padding: 0 4px; font-size: 12px; color: #000; height: 20px; border-bottom: solid 1px #000; border-right: solid 1px #000 ; text-align: center; vertical-align: center; width: 5% ;">
                            SI NO.</td>
                        <td style="padding: 0 4px; font-size: 12px; color: #000; border-bottom: solid 1px #000; border-right: solid 1px #000 ; text-align: center; vertical-align: center; width:30%;">
                            Name</td>
                        <td style="padding: 0 4px; font-size: 12px; color: #000; border-bottom: solid 1px #000; border-right: solid 1px #000 ; text-align: center; width: 10%; vertical-align: center;">
                            HSN</td>
                        <td style="padding: 0 4px; font-size: 12px; color: #000; border-bottom: solid 1px #000; border-right: solid 1px #000 ; text-align: center; width: 10%; vertical-align: center;">
                            Taxable Amount</td>
                        <td style="padding: 0 4px; font-size: 12px; color: #000; border-bottom: solid 1px #000; border-right: solid 1px #000 ; text-align: center; vertical-align: center; width: 5%;">
                            CGST.%</td>
                        <td style="padding: 0 4px; font-size: 12px; color: #000; border-bottom: solid 1px #000; border-right: solid 1px #000 ; text-align: center; vertical-align: center; width: 5%;">
                             SGST.%</td>
                        <td style="padding: 0 4px; font-size: 12px; color: #000; border-bottom: solid 1px #000; border-right: solid 1px #000 ; text-align: center; vertical-align: center; width: 10%;">
                            MRP</td>
                        <td style="padding: 0 4px; font-size: 12px; color: #000; border-bottom: solid 1px #000; border-right: solid 1px #000 ; text-align: center; vertical-align: center; width: 5%;">
                            Disc.%</td>
                        <td style="padding: 0 4px; font-size: 12px; color: #000; border-bottom: solid 1px #000; border-right: solid 1px #000 ; text-align: center; vertical-align: center; width: 10%;">
                            Discount Price</td>
                        <td style="padding: 0 4px; font-size: 12px; color: #000; border-bottom: solid 1px #000; border-right: solid 1px #000 ; text-align: center; vertical-align: center; width: 10%;">
                            Qty</td>
                        <td style="padding: 0 4px; font-size: 12px; color: #000; border-bottom: solid 1px #000; border-right: solid 1px #000 ; text-align: center; vertical-align: center; width: 5%;">
                            per</td>
                        <td style="padding: 0 4px; font-size: 12px; color: #000; border-bottom: solid 1px #000; text-align: center; vertical-align: center; width: 20%">
                            Amount</td>
                    </tr>
                    @php

                    $productOrders = $order_data->productorders;
                    // echo '<pre>';
                    // print_r($order_data);

                    // die;
                    $i=1;
                    @endphp
                    @foreach($productOrders as $porder)
                    @php
                    $product = $porder->products;


                    @endphp
                    <tr>
                        <td style="padding: 0 4px; border-right: solid 1px #000 ; font-size: 14px; text-align: center; height: 18px;">{{$i}}
                        </td>
                        <td style="padding: 0 4px; border-right: solid 1px #000 ; font-size: 14px;"><b> {{$product->name}}</b>
                        </td>
                        <td style="padding: 0 4px; border-right: solid 1px #000 ; font-size: 14px; text-align: right;"> {{$product->sku}}</td>
                        <td style="padding: 0 4px; border-right: solid 1px #000 ; font-size: 14px; text-align: right;"> {{$porder->price}}</td>
                        <td style="padding: 0 4px; border-right: solid 1px #000 ; font-size: 14px; text-align: right;">{{ $porder->cgst}}</td>
                        <td style="padding: 0 4px; border-right: solid 1px #000 ; font-size: 14px; text-align: right;">{{ $porder->sgst}}</td>
                        <td style="padding: 0 4px; border-right: solid 1px #000 ; font-size: 14px; text-align: right;">{{ $porder->total_price}}</td>
                        <td style="padding: 0 4px; border-right: solid 1px #000 ; font-size: 14px; text-align: right;">{{ $product->discount_percentage}}</td>
                        <td style="padding: 0 4px; border-right: solid 1px #000 ; font-size: 14px; text-align: right;">{{ $porder->cutoff_price - $porder->price }}</td>
                        <td style="padding: 0 4px; border-right: solid 1px #000 ; font-size: 14px; text-align: right;"><b>{{$porder->qty}}</b>
                        </td> 
                        <td style="padding: 0 4px; border-right: solid 1px #000 ; font-size: 14px; text-align: right;"><b>{{ $porder->sub_total_price}}</b></td>
                       
                       
                    
                    @php
                    $i++;
                    @endphp

                    @endforeach
                    <td style=" padding: 0 4px; text-align: right;"><b>{{ $order_data->mrp}}</b></td>
                </tr>
                    <tr>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: center; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                            Discount (coupon)</td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                            <b></b>
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: center; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: center; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                        </td>
                        <td style="text-align: right; vertical-align: bottom; padding: 0 4px; border-top: solid 1px #000 ;"><span style="font-family: DejaVu Sans;">&#x20B9;</span><b>
                            {{ $order_data ? $order_data->discount : '' }}</b></td>
                    </tr>
                    <tr>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: center; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                            Shipping charges</td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                            <b></b>
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                            <b></b>
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: center; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                        </td>
                        <td style="text-align: right; vertical-align: bottom; padding: 0 4px; border-top: solid 1px #000 ;">
                            <b>
                                @if($order_data->shipping_charges == 0)
                                    Free
                                @else
                                    {{$order_data->shipping_charges}}
                                @endif
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: center; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                            Total</td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                            <b></b>
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: center; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                        </td>
                        <td style="border-right: solid 1px #000 ; padding: 0 4px; border-top: solid 1px #000 ; font-size: 14px; text-align: right; vertical-align: bottom;">
                        </td>
                        <td style="text-align: right; vertical-align: bottom; padding: 0 4px; border-top: solid 1px #000 ;">
                            <span style="font-family: DejaVu Sans;">&#x20B9;</span>
                            <b>
                                {{ number_format($order_data->total_amount, 2) }}
                            </b>
                        </td>
                        
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="border-bottom: solid 1px #000; font-size: 12px; padding: 0 0 4px 4px; ">
                Amount Chargeable (in Words)
                <div style="font-size: 14px;">
                    @php

                    $words = numberToWords($order_data->total_amount);
                    @endphp
                    <b> Indian Rupees {{ucwords($words)}}</b>
                </div>
            </td>
            <td style="border-bottom: solid 1px #000; font-size: 12px; text-align: right; vertical-align: top;">
                E. & O.E
            </td>
        </tr>

        <!-- <tr>
            <td colspan="2">
                <table style="width: 100%; font-size: 14px; border-collapse: collapse;" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="width: 60%; text-align: center;border-bottom: solid 1px #000; vertical-align: top; ">
                            HSN/SAC
                        </td>
                        <td style=" border-left: solid 1px #000 ; border-bottom: solid 1px #000; text-align: center;">
                            Taxable <br> Value
                        </td>
                        <td style=" border-left: solid 1px #000 ; border-bottom: solid 1px #000; text-align: center;">
                            <table style="width: 100%; border-collapse: collapse;" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td colspan="2" style="border-bottom: solid 1px #000;">CGST</td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; border-right: solid 1px #000; width: 40%;">Rate</td>
                                    <td style="text-align: center; width: 60%;">Amount</td>
                                </tr>
                            </table>
                        </td>
                        <td style=" border-left: solid 1px #000 ; border-bottom: solid 1px #000; text-align: center;">
                            <table style="width: 100%; border-collapse: collapse;" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td colspan="2" style="border-bottom: solid 1px #000;">SGST/UTGST</td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; border-right: solid 1px #000; width: 40%;">Rate</td>
                                    <td style="text-align: center; width: 60%;">Amount</td>
                                </tr>
                            </table>
                        </td>
                        <td style=" border-left: solid 1px #000 ; border-bottom: solid 1px #000; text-align: center;">
                            Taxable <br> Value
                        </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: solid 1px #000 ; ">Total</td>


                        <td style=" border-left: solid 1px #000 ; border-bottom: solid 1px #000; text-align: right;">
                            72142090
                        </td>
                        <td style=" border-left: solid 1px #000 ; border-bottom: solid 1px #000; text-align: right;">
                            <table style="width: 100%; border-collapse: collapse;" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="text-align: right; border-right: solid 1px #000; width: 40%;">9%</td>
                                    <td style="text-align: right; width: 60%;">2455</td>
                                </tr>
                            </table>
                        </td>
                        <td style=" border-left: solid 1px #000 ; border-bottom: solid 1px #000; text-align: right;">
                            <table style="width: 100%; border-collapse: collapse;" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="text-align: right; border-right: solid 1px #000; width: 40%;">9%</td>
                                    <td style="text-align: right; width: 60%;">2455</td>
                                </tr>
                            </table>
                        </td>
                        <td style=" border-left: solid 1px #000 ; border-bottom: solid 1px #000; text-align: right;">
                            72142090
                        </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: solid 1px #000 ; text-align: right; "><b>Total</b></td>


                        <td style=" border-left: solid 1px #000 ; border-bottom: solid 1px #000; text-align: right;">
                            <b>72142090</b>
                        </td>
                        <td style=" border-left: solid 1px #000 ; border-bottom: solid 1px #000; text-align: right;">
                            <table style="width: 100%; border-collapse: collapse;" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="text-align: right; border-right: solid 1px #000; width: 40%;"></td>
                                    <td style="text-align: right; width: 60%;"><b>2455</b></td>
                                </tr>
                            </table>
                        </td>
                        <td style=" border-left: solid 1px #000 ; border-bottom: solid 1px #000; text-align: right;">
                            <table style="width: 100%; border-collapse: collapse;" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="text-align: right; border-right: solid 1px #000; width: 40%;"></td>
                                    <td style="text-align: right; width: 60%;"><b>2455</b></td>
                                </tr>
                            </table>
                        </td>
                        <td style=" border-left: solid 1px #000 ; border-bottom: solid 1px #000; text-align: right;">
                            <b>72142090</b>
                        </td>
                    </tr>

                </table>
            </td>
        </tr> -->

        <tr>
            <td colspan="2">
                <table style="width: 100%; font-size: 14px;" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="font-size: 12px; padding: 4px 0 2px 4px;" colspan="2">
                            <!-- Tax Amount (in Words) : <b style="font-size: 14px;">Indian Rupees Fifteen Thousand, Three
                                Hundred Thirty-Five Only</b> -->
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;"></td>
                        <td style="width: 50%;">Company's Bank Details</td>
                    </tr>
                    <tr>
                        <td>
                            <table style="width: 100%;" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="width: 120px; padding-left: 4px;">
                                        Company's PAN
                                    </td>
                                    <td>
                                        <b>: AAGFJ7513B</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-decoration: underline; padding-left: 4px;">
                                        Declaration
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding-left: 4px;">
                                       We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        &nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding-left: 4px;">
                                        NOTE:
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding-left: 4px;">
                                        1) interest will be applicable @24% Per Anum as per payment Term & condition.
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table style="width: 100%; border-collapse: collapse;" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="width: 130px;">Bank Name </td>
                                    <td><b>: State Bank of India</b></td>
                                </tr>
                                <tr>
                                    <td>A/c NO. </td>
                                    <td><b>: 33536188647</b></td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Branch & IFS Code </td>
                                    <td><b>: SME BRANCH,CHURCH RD,JAIPUR & SBIN0004080</b></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-top: solid 1px #000; border-left: solid 1px #000; text-align: right;">
                                        <b>for M/S. JAI BAJRANG STEELS</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: right; font-size: 12px; border-left: solid 1px #000;">&nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: right; font-size: 12px; border-left: solid 1px #000;">&nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: right; font-size: 12px; border-left: solid 1px #000;">&nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: right; font-size: 12px; border-left: solid 1px #000;">
                                        Authorised Signatory</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: right; font-size: 12px; border-left: solid 1px #000;">&nbsp;
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>



</body>

</html>