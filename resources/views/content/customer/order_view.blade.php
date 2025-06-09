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





<section id="order-details">
    <div class="order-detail-row">
        <div class="row">
            <div class="col-md-8">
                <div class="order-left">
                    <div class="order-id d-flex align-items-start justify-content-between">
                        <div class="">
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0">Order Id: 55146</h6>
                                <span class="">Delivered</span>
                            </div>
                            <p class="mb-0">Placed on 5th Oct, 2023 at 9:08 am</p>
                        </div>

                        <div class="d-flex">
                            <a href="" class="text-decoration-none invoice">Invoice </a>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="about-us"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    More actions
                                    <i class="down-arrow">
                                        <svg width="8" height="5" viewBox="0 0 8 5" fill="none">
                                            <path
                                                d="M3.99979 4.5C3.87403 4.5 3.74828 4.45198 3.6524 4.35615L0.635163 1.33888C0.443227 1.14694 0.443227 0.835752 0.635163 0.643894C0.827021 0.452035 1.13815 0.452035 1.3301 0.643894L3.99979 3.31374L6.6695 0.643987C6.86143 0.452129 7.17253 0.452129 7.36437 0.643987C7.5564 0.835845 7.5564 1.14704 7.36437 1.33897L4.34718 4.35624C4.25125 4.45209 4.12551 4.5 3.99979 4.5Z"
                                                fill="#000026" />
                                        </svg>
                                    </i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="about-us">
                                    <li><a href="#">Our Story</a></li>
                                    <li><a href="#">Our Team</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <hr class=" opacity-100 ">

                    <div class="product-gap">

                        <div class="product d-flex align-items-start justify-content-between">
                            <div class="d-flex">
                                <div class="prod-img">
                                    <img src="https://infra-admin.orbitnapp.com/uploads/product_images/small/1697449559_652d0657955af.png"
                                        alt="">
                                </div>
                                <div class="prod-cont">
                                    <h6 class="mb-0">Ultratech Super Cement</h6>
                                    <p class="mb-0"><span>SKU:</span> CEPPCGACC0002</p>
                                    <p class="by-cci mb-0">by <span>cci</span></p>
                                </div>
                            </div>
                            <div class="d-flex cacl">
                                <div class="d-flex">
                                    <span>₹960</span>
                                    <span class="mx-2">x</span>
                                    <span>2</span>
                                </div>
                                <div class="text-end">
                                    <h6>₹1920</h6>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="about-us"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Delivered
                                            <i class="down-arrow">
                                                <svg width="8" height="5" viewBox="0 0 8 5" fill="none">
                                                    <path
                                                        d="M3.99979 4.5C3.87403 4.5 3.74828 4.45198 3.6524 4.35615L0.635163 1.33888C0.443227 1.14694 0.443227 0.835752 0.635163 0.643894C0.827021 0.452035 1.13815 0.452035 1.3301 0.643894L3.99979 3.31374L6.6695 0.643987C6.86143 0.452129 7.17253 0.452129 7.36437 0.643987C7.5564 0.835845 7.5564 1.14704 7.36437 1.33897L4.34718 4.35624C4.25125 4.45209 4.12551 4.5 3.99979 4.5Z"
                                                        fill="#000026" />
                                                </svg>
                                            </i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="about-us">
                                            <li><a href="#">Delivered 1</a></li>
                                            <li><a href="#">Delivered 2</a></li>
                                            <li><a href="#">Delivered 3</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product d-flex align-items-start justify-content-between">
                            <div class="d-flex">
                                <div class="prod-img">
                                    <img src="https://infra-admin.orbitnapp.com/uploads/product_images/small/1697449559_652d0657955af.png"
                                        alt="">
                                </div>
                                <div class="prod-cont">
                                    <h6 class="mb-0">Ultratech Super Cement</h6>
                                    <p class="mb-0"><span>SKU:</span> CEPPCGACC0002</p>
                                    <p class="by-cci mb-0">by <span>cci</span></p>
                                </div>
                            </div>
                            <div class="d-flex cacl">
                                <div class="d-flex">
                                    <span>₹960</span>
                                    <span class="mx-2">x</span>
                                    <span>2</span>
                                </div>
                                <div class="text-end">
                                    <h6>₹1920</h6>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="about-us"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Delivered
                                            <i class="down-arrow">
                                                <svg width="8" height="5" viewBox="0 0 8 5" fill="none">
                                                    <path
                                                        d="M3.99979 4.5C3.87403 4.5 3.74828 4.45198 3.6524 4.35615L0.635163 1.33888C0.443227 1.14694 0.443227 0.835752 0.635163 0.643894C0.827021 0.452035 1.13815 0.452035 1.3301 0.643894L3.99979 3.31374L6.6695 0.643987C6.86143 0.452129 7.17253 0.452129 7.36437 0.643987C7.5564 0.835845 7.5564 1.14704 7.36437 1.33897L4.34718 4.35624C4.25125 4.45209 4.12551 4.5 3.99979 4.5Z"
                                                        fill="#000026" />
                                                </svg>
                                            </i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="about-us">
                                            <li><a href="#">Delivered 1</a></li>
                                            <li><a href="#">Delivered 2</a></li>
                                            <li><a href="#">Delivered 3</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product d-flex align-items-start justify-content-between">
                            <div class="d-flex">
                                <div class="prod-img">
                                    <img src="https://infra-admin.orbitnapp.com/uploads/product_images/small/1697449559_652d0657955af.png"
                                        alt="">
                                </div>
                                <div class="prod-cont">
                                    <h6 class="mb-0">Ultratech Super Cement</h6>
                                    <p class="mb-0"><span>SKU:</span> CEPPCGACC0002</p>
                                    <p class="by-cci mb-0">by <span>cci</span></p>
                                </div>
                            </div>
                            <div class="d-flex cacl">
                                <div class="d-flex">
                                    <span>₹960</span>
                                    <span class="mx-2">x</span>
                                    <span>2</span>
                                </div>
                                <div class="text-end">
                                    <h6>₹1920</h6>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="about-us"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Delivered
                                            <i class="down-arrow">
                                                <svg width="8" height="5" viewBox="0 0 8 5" fill="none">
                                                    <path
                                                        d="M3.99979 4.5C3.87403 4.5 3.74828 4.45198 3.6524 4.35615L0.635163 1.33888C0.443227 1.14694 0.443227 0.835752 0.635163 0.643894C0.827021 0.452035 1.13815 0.452035 1.3301 0.643894L3.99979 3.31374L6.6695 0.643987C6.86143 0.452129 7.17253 0.452129 7.36437 0.643987C7.5564 0.835845 7.5564 1.14704 7.36437 1.33897L4.34718 4.35624C4.25125 4.45209 4.12551 4.5 3.99979 4.5Z"
                                                        fill="#000026" />
                                                </svg>
                                            </i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="about-us">
                                            <li><a href="#">Delivered 1</a></li>
                                            <li><a href="#">Delivered 2</a></li>
                                            <li><a href="#">Delivered 3</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="payment-head">
                    <div class="payment-meth d-flex align-items-start justify-content-between">
                        <div class="">
                            <h6 class="mb-1">Payment Method</h6>
                            <div class="d-flex align-items-center">
                                <img src="https://infra-admin.orbitnapp.com/uploads/product_images/small/1697449559_652d0657955af.png"
                                    alt="">
                                <p class="mb-0">Razorpay</p>
                            </div>
                        </div>
                        <div class="">
                            <h6 class="mb-1">Delivered On</h6>
                            <p class="mb-0">5th Oct 2023</p>
                        </div>
                    </div>

                    <hr class="mb-4 opacity-100 ">

                    <h5>Order Summary</h5>
                    <div class="mrp d-flex justify-content-between">
                        <p class="mb-0">MRP</p>
                        <span>₹801</span>
                    </div>
                    <div class="dom d-flex justify-content-between">
                        <p class="mb-0">Discount on MRP</p>
                        <span>₹101</span>
                    </div>
                    <div class="sc d-flex justify-content-between">
                        <p class="mb-0">Shipping Charges</p>
                        <span>Free</span>
                    </div>
                    <div class="dcd d-flex justify-content-between">
                        <p class="mb-0">Discount <span>(Coupon - DEMO254)</span></p>
                        <span>₹200</span>
                    </div>

                    <hr class=" opacity-100 solid">
                    <div class="cgst d-flex justify-content-between">
                        <p class="mb-0">CGST <span>(9%) </span></p>
                        <span>₹72.09</span>
                    </div>
                    <div class="gst d-flex justify-content-between">
                        <p class="mb-0">GST <span>(9%) </span></p>
                        <span>₹72.09</span>
                    </div>
                    <hr class=" opacity-100 solid">

                    <div class="tota d-flex align-items-start justify-content-between">
                        <div class="">
                            <h6>Total</h6>
                            <p class="mb-0">* Inclusive of all Taxes</p>
                        </div>
                        <h6>₹844.18</h6>
                    </div>
                </div>

                <div class="user-time">
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
                </div>


            </div>
            <div class="col-md-4">
                <div class="sticky-top">
                <div class="order-customer">
                    <h6 class="cust">Customer</h6>
                    <a href="" class="text-decoration-none dr-abhi mt-1">Dr Abhijeet Pathak</a>
                    <hr>
                    <h6 class="mt-3">Contact information</h6>
                    <a href="mailto:exclusive@gmail.com" class="text-decoration-none mt-3">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M21.6974 15.8335C21.6974 17.8602 20.0488 19.5062 18.0247 19.5062H5.97513C3.95102 19.5062 2.30238 17.8601 2.30238 15.8335V8.16652C2.30193 7.51333 2.47691 6.872 2.80905 6.30956L8.68849 12.189C9.5681 13.0712 10.746 13.5573 12.0011 13.5573C13.2537 13.5573 14.4316 13.0712 15.3112 12.189L21.1907 6.30956C21.5228 6.87199 21.6978 7.51332 21.6973 8.16652V15.8335H21.6974ZM18.0246 4.49381H5.97513C5.13925 4.49381 4.36764 4.7767 3.75039 5.24738L9.68899 11.1885C10.3037 11.8006 11.1241 12.1402 12.0011 12.1402C12.8756 12.1402 13.6961 11.8006 14.3107 11.1885L20.2493 5.24738C19.6321 4.7767 18.8606 4.49381 18.0246 4.49381ZM18.0246 3.07669H5.97513C3.16914 3.07669 0.885254 5.36058 0.885254 8.16656V15.8335C0.885254 18.6421 3.16914 20.9234 5.97513 20.9234H18.0246C20.8306 20.9234 23.1145 18.6421 23.1145 15.8335V8.16652C23.1145 5.36053 20.8306 3.07669 18.0246 3.07669Z"
                                fill="#888888" />
                        </svg>
                        exclusive@gmail.com
                    </a>
                    <a href="tel:08048211856" class="text-decoration-none mt-3">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M5.84008 9.856C7.63083 13.7544 10.8126 16.8438 14.7621 18.519L14.7741 18.524L15.5381 18.864C16.01 19.0744 16.5399 19.1161 17.0389 18.9818C17.5379 18.8476 17.9754 18.5458 18.2781 18.127L19.5521 16.364C19.5895 16.3121 19.6056 16.2478 19.5971 16.1843C19.5885 16.1209 19.5559 16.0631 19.5061 16.023L17.2821 14.228C17.2559 14.2068 17.2257 14.1911 17.1933 14.1818C17.1609 14.1726 17.1269 14.17 17.0935 14.1742C17.06 14.1784 17.0278 14.1893 16.9987 14.2063C16.9696 14.2233 16.9442 14.246 16.9241 14.273L16.0581 15.442C15.9561 15.5798 15.8099 15.6785 15.6439 15.7216C15.478 15.7647 15.3023 15.7497 15.1461 15.679C12.1871 14.3386 9.81652 11.9679 8.47608 9.009C8.40538 8.85279 8.39035 8.67708 8.43347 8.51113C8.47659 8.34519 8.57528 8.19903 8.71308 8.097L9.88008 7.23C9.90719 7.20996 9.92998 7.18464 9.94705 7.15556C9.96413 7.12649 9.97515 7.09426 9.97945 7.06081C9.98374 7.02737 9.98123 6.9934 9.97206 6.96095C9.96289 6.9285 9.94725 6.89825 9.92608 6.872L8.13208 4.648C8.09194 4.59813 8.03419 4.56556 7.97075 4.557C7.90731 4.54844 7.843 4.56455 7.79108 4.602L6.01808 5.882C5.59647 6.18611 5.29318 6.62682 5.15974 7.12923C5.0263 7.63165 5.07094 8.16477 5.28608 8.638L5.84008 9.855V9.856ZM14.1701 19.897C9.87918 18.075 6.42268 14.7173 4.47708 10.481L4.47508 10.479L3.92108 9.259C3.5625 8.47044 3.48798 7.58205 3.7102 6.74477C3.93242 5.90749 4.43766 5.17297 5.14008 4.666L6.91308 3.386C7.27621 3.12392 7.72599 3.01103 8.16984 3.07055C8.61369 3.13008 9.01784 3.3575 9.29908 3.706L11.0941 5.931C11.2422 6.11457 11.3517 6.3262 11.416 6.55316C11.4802 6.78012 11.498 7.01773 11.4681 7.25171C11.4382 7.4857 11.3613 7.71122 11.242 7.91474C11.1228 8.11826 10.9636 8.29556 10.7741 8.436L10.1041 8.932C11.2369 11.1283 13.0257 12.9172 15.2221 14.05L15.7191 13.38C15.8595 13.1906 16.0368 13.0316 16.2402 12.9124C16.4436 12.7932 16.669 12.7164 16.9029 12.6865C17.1368 12.6566 17.3743 12.6743 17.6011 12.7385C17.828 12.8027 18.0395 12.912 18.2231 13.06L20.4481 14.855C20.7969 15.1363 21.0245 15.5406 21.084 15.9847C21.1435 16.4288 21.0305 16.8788 20.7681 17.242L19.4941 19.006C18.9898 19.7039 18.2607 20.2071 17.4292 20.4309C16.5977 20.6547 15.7146 20.5855 14.9281 20.235L14.1701 19.897Z"
                                fill="#888888" />
                        </svg>

                        08048211856
                    </a>
                    <hr>
                    <h6 class="gs-num mt-4 pb-1 mb-2">GST Number</h6>
                    <p class="gs-num-p">04DS2132SDE87</p>
                    <hr>
                    <h6 class="pt-1">Order instructions</h6>
                    <p class="mb-0">Lorem ipsum is a placeholder text used in publishing and graphic design. It's a
                        short paragraph
                    </p>

                </div>
                <div class="order-shipping">
                    <h6>Shipping address</h6>
                    <p class="mb-1">Jon Dav </p>
                    <address class="mb-1">5 Brentwood Place, Monroe Township, NJ 08831, USA</address>
                    <span>+1234567890</span>
                    <hr class="mb-4">
                    <h6>Billing address</h6>
                    <p class="mb-1">Jon Dav </p>
                    <address class="mb-1">5 Brentwood Place, Monroe Township, NJ 08831, USA</address>
                    <span>+1234567890</span>

                </div>
                </div>
            </div>
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
    margin-bottom: 26px;
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
    border-radius: 8px;
    border: 1px solid #D4DFEA;
    background: #FFF;
    padding: 16px 12px 16px 15px;
}

#order-details .order-left .product .prod-img {
    border-radius: 5px;
    border: 1px solid #DFDEDE;
    background: #FFF;
    width: 65px;
    height: 65px;
    display: flex;
    align-items: center;
    justify-content: center;
}

#order-details .order-left .product .prod-img img {
    width: 40px;
}

#order-details .order-left .product .prod-cont h6 {
    font-size: 15px;
    color: #000;
}

#order-details .order-left .product .prod-cont {
    margin-left: 16px;
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
    column-gap: 80px;
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
    margin-top:20px;
}
#order-details .user-time h6 {
    font-size: 20px;
    color: #000;
    font-weight: 600;
}
#order-details .user-time .time-line {
    border-radius: 10px;
    border: 1.2px solid #D9D9D9;
    background: #FFF;
    padding: 30px 30px;
}
#order-details .user-time .time-line .time-line-gap{
    display: grid;
    row-gap: 16px;
    position: relative;
}
#order-details .user-time .time-line .time-line-gap:before{
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
    margin-bottom:20px;
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