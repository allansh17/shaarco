@include('frontend.layouts.header')



    <!-- Contact us section start -->

    <section class="contact-us-banner text-white">
        <div class="container">
            <!-- {!!$banner12->description!!} -->
            <div class="d-flex align-items-center">
                <hr class="m-0 border-0 bg-white opacity-100">
                <h5 class="mb-0 ms-3">Get in Touch</h5>
            </div>
            <h1 class="fw-light mt-4">Have A Project In Mind? <strong class="fw-semibold"> Let's Talk.</strong></h1>
        </div>
    </section>

    <!-- Contact us section End -->



    <!-- Contact us location section Start -->


    <section class="about-info mb-5">
        <div class="container">
            <div class="adde">
                <div class="adde-row">
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="location loc-1 d-flex adde-line position-relative">
                                <div class="">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63603 3.63604C7.32387 1.94822 9.61305 1 12 1C14.387 1 16.6761 1.94822 18.3639 3.63604C20.0517 5.32387 21 7.61305 21 10Z"
                                            stroke="#2E2E2E" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M12 12.9999C13.6569 12.9999 15 11.6568 15 10C15 8.34314 13.6569 7 12 7C10.3431 7 9 8.34314 9 10C9 11.6568 10.3431 12.9999 12 12.9999Z"
                                            stroke="#F6B61B" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>

                                </div>
                                <div class="cont ms-3">
                                    <h6 class="fw-semibold">Location :</h6>
                                    <p class="mb-0">{{$company_data->address}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="location loc-2 d-flex adde-line position-relative">
                                <div class="">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4.00086 4H20.0009C21.1008 4 22.0008 4.9 22.0008 6V18C22.0008 19.1 21.1008 20 20.0009 20H4.00086C2.90085 20 2.00085 19.1 2.00085 18V6C2.00085 4.9 2.90085 4 4.00086 4Z"
                                            stroke="#2E2E2E" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M22.0008 6L12.0009 13L2.00085 6" stroke="#F6B61B" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>


                                </div>
                                <div class="cont ms-3">
                                    <h6 class="fw-semibold">Email Address :</h6>
                                    <a href="{{'mailto:'.$company_data->email}}"
                                        class="text-decoration-none">{{$company_data->email}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="location d-flex">
                                <div class="">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_149_737)">
                                            <mask id="mask0_149_737" style="mask-type:luminance"
                                                maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                                                <path d="M24 0H0V24H24V0Z" fill="white" />
                                            </mask>
                                            <g mask="url(#mask0_149_737)">
                                                <path d="M23.0007 7V1H17.0007" stroke="#F6B61B" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M15.999 7.99999L22.9991 1" stroke="#F6B61B" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M21.9999 16.9201V19.9201C22.001 20.1986 21.9441 20.4742 21.8324 20.7294C21.7209 20.9846 21.5573 21.2137 21.352 21.4019C21.1468 21.5902 20.9045 21.7336 20.6407 21.8228C20.3769 21.912 20.0973 21.9452 19.8199 21.9201C16.7428 21.5857 13.787 20.5342 11.1899 18.8501C8.77375 17.3147 6.72526 15.2662 5.18993 12.8501C3.49991 10.2413 2.44817 7.27109 2.11993 4.18009C2.09495 3.90356 2.12781 3.62486 2.21644 3.36172C2.30506 3.09859 2.44751 2.85678 2.63469 2.65172C2.82189 2.44665 3.04974 2.2828 3.30372 2.17062C3.55771 2.05843 3.83227 2.00036 4.10993 2.0001H7.10993C7.59524 1.99532 8.06573 2.16717 8.4337 2.48363C8.80167 2.80008 9.04201 3.23955 9.10993 3.7201C9.23655 4.68016 9.47138 5.62282 9.80993 6.5301C9.94447 6.88802 9.97359 7.27701 9.89383 7.65097C9.81408 8.02494 9.6288 8.36821 9.35993 8.6401L8.08993 9.91009C9.51348 12.4136 11.5864 14.4865 14.09 15.9101L15.36 14.6401C15.6318 14.3712 15.9751 14.186 16.349 14.1062C16.723 14.0265 17.112 14.0555 17.47 14.19C18.3772 14.5287 19.3198 14.7635 20.28 14.8901C20.7657 14.9587 21.2093 15.2033 21.5265 15.5776C21.8436 15.9519 22.0121 16.4296 21.9999 16.9201Z"
                                                    stroke="#2E2E2E" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </g>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_149_737">
                                                <rect width="24" height="24" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>


                                </div>
                                <div class="cont ms-3">
                                    <h6 class="fw-semibold">Phone No :</h6>
                                    <a href="{{'tel:'.$company_data->phone}}" class="text-decoration-none">{{$company_data->phone}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact us location section End -->






    <!-- Contact info section Start -->

    <section class="contact-info mb-5">
        <div class="container">
            <div class="contact-info-txt">
                <h2 class="fw-semibold mb-2">Contact info</h2>
                {!!$banner13->description!!}
            </div>
            <div class="contact-info-row p-4">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="img position-relative">
                            <span class="top-r"></span>
                            <span class="left-r"></span>
                            @if($banner13->image)
                            <img src="{{ asset('uploads/banner_image/'.$banner13->image)}}" alt="" class="w-100">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form mx-3">
                            <h5 class="mt-2 mb-0  fw-semibold">For Free quote request, fill our quick form.</h5>
                           
                            <form id="contactUs"method="post"   class="mt-3 pt-3">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Your Name*</label>
                                            <input type="text" class="form-control" id="" name="name" aria-describedby=""
                                                placeholder="Full name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="" aria-describedby=""
                                                placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Select Product*</label>
                                                <select class="form-control" name="product_id">
                                                    <option value="">Choose product</option>
                                                    @foreach($product_data as $pd)
                                                    <option value="{{$pd->id}}">{{$pd->name}}</option>
                                                    @endforeach
                                                    
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Quantity *</label>
                                            <input type="text" class="form-control" name="qty" id="qty" aria-describedby=""
                                                placeholder="Enter Quantity">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Phone*</label>
                                            <input type="text" class="form-control" name="phone" id="" aria-describedby=""
                                                placeholder="Enter Your Contact Number">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Message *</label>
                                            <textarea type="text" class="form-control" name="message" id="" rows="4"
                                                aria-describedby="" placeholder="Your Message Here"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button
                                        class="submitForm button-design border-0 d-flex fw-semibold text-decoration-none mt-4 px-5 py-2 position-relative">
                                        Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Contact info section End -->

    @push('script')



@endpush
    @include('frontend.layouts.footer')
    <script>
    $(document).ready(function() {
       
       

        //---------- on form validate ajax--------------------------//
        $("#contactUs").validate({

            rules: {

                name: {
                    required: true,
                },
                product_id: {
                    required: true,

                },
                qty: {
                    required: true,

                },
                phone: {
                    required: true,
                    maxlength:10,
                    minlength:10,
                    digits: true,
                },
                message: {
                    required: true,
                    maxlength:500,

                }
                

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
                //form.submit();

                var formData = new FormData($("#contactUs")[0]);
                var url_up = "{{ route('contact_ussave') }}";


                $.ajax({
                    type: "POST",
                    url: url_up,
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#contactUs").find('.submitForm').attr("disabled", true);
                        $('.loader').show();

                    },
                    success: function(data) {
                        $("#contactUs").find('.submitForm').attr("disabled", false);
                        $('.loader').hide();
                        if (data.status === true) {
                            
                           

                            $("#contactUs")[0].reset();
                            $('.messagesuccess').text(data.message);
                            $('.alert-success').removeClass('d-none').addClass('d-block');
                            setTimeout(function() {
                                // window.location.reload();
                                $('.alert-success').fadeOut(1000);
                                $('.alert-success').removeClass('d-block').addClass('d-none');
                            }, 5000);

                           

                        } else {

                            $('.alert-danger').removeClass('d-none').addClass('d-block');
                            $('.messagedanger').text(data.message)
                            setTimeout(function() {
                                // window.location.reload();
                                $('.alert-danger').fadeOut(1000);
                                $('.alert-danger').removeClass('d-block').addClass('d-none');
                            }, 2000);
                        }


                    },
                });
                // return false;
            }
        });
    });
</script>
