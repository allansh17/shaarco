@extends('layouts.stc_product.header')
@section('content')

<div class="breadcrumb_card">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}"><svg width="20" height="20" viewBox="0 0 20 20"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.875 16.2498V12.4998C11.875 12.334 11.8092 12.1751 11.6919 12.0579C11.5747 11.9406 11.4158 11.8748 11.25 11.8748H8.75C8.58424 11.8748 8.42527 11.9406 8.30806 12.0579C8.19085 12.1751 8.125 12.334 8.125 12.4998V16.2498C8.125 16.4156 8.05915 16.5745 7.94194 16.6917C7.82473 16.809 7.66576 16.8748 7.5 16.8748H3.75C3.58424 16.8748 3.42527 16.809 3.30806 16.6917C3.19085 16.5745 3.125 16.4156 3.125 16.2498V9.02324C3.1264 8.93674 3.14509 8.8514 3.17998 8.77224C3.21486 8.69308 3.26523 8.6217 3.32812 8.5623L9.57812 2.88261C9.69334 2.77721 9.84384 2.71875 10 2.71875C10.1562 2.71875 10.3067 2.77721 10.4219 2.88261L16.6719 8.5623C16.7348 8.6217 16.7851 8.69308 16.82 8.77224C16.8549 8.8514 16.8736 8.93674 16.875 9.02324V16.2498C16.875 16.4156 16.8092 16.5745 16.6919 16.6917C16.5747 16.809 16.4158 16.8748 16.25 16.8748H12.5C12.3342 16.8748 12.1753 16.809 12.0581 16.6917C11.9408 16.5745 11.875 16.4156 11.875 16.2498Z"
                                stroke="#5F6C72" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        بيت</a></li>
                <li class="breadcrumb-item active" aria-current="page">معلومات عنا</li>
            </ol>
        </nav>
    </div>
</div>


<div class="about_hero">
    <div class="container">

        <div class="row">
            @foreach ($aboutus as $about)
                <div class="col-md-6">
                    <div class="about_hero_text">
                        <h5 class="btn_hero_ab">من نحن</h5>
                        <h1>شركة شعار للتجارة
                        </h1>
                        <p id="editor">{{$about->description}}</p>
                        <p id="editor">{{$about->desc2}}</p>
                        {{-- <ul>
                            <li>خدمة عملاء رائعة على مدار 24 ساعة طوال أيام الأسبوع.</li>
                            <li>شركة شعار للتجارة</li>
                            <li>شركة شعار للتجارة</li>
                            <li>شركة شعار للتجارة</li>
                        </ul> --}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about_hero_img">
                        <img src="{{ asset('uploads/page/' . $about->image) }}" alt="About Image" style="width: 500px; height: 450px; object-fit: cover;">
                        {{-- <img src="{{asset('uploads/page/' . $about->image)}}" alt="" width="100%" height="50%"/> --}}
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>

<div class="about_counter">
    <div class="container">
        <div class="row">
            <div class="four col-md-3 col-sm-6 col-6">
                <div class="counter-box colored"> <span class="counter_non">24/7</span>
                    <p>يدعم</p>
                </div>
            </div>
            <div class="four col-md-3 col-sm-6 col-6">
                <div class="counter-box"> <span class="counter">2500</span>
                    <p>ثق في العميل</p>
                </div>
            </div>
            <div class="four col-md-3 col-sm-6 col-6">
                <div class="counter-box"> <span class="counter">26</span>
                    <p>سنوات من الخبرة</p>
                </div>
            </div>
            <div class="four col-md-3 col-sm-6 col-6">
                <div class="counter-box"> <span class="counter">2000</span>
                    <p>نوع المنتج</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="about_summery">
    <div class="container">
        <div class="summery_hedding">
            <h3>لماذا تختارنا</h3>
            <h2>ما الذي يميزنا</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="summery_card">
                    <h4>الابتكار والصيانة على أعلى مستوى</h4>
                    <p>لدينا طاقم من المهندسين المتخصصين في صيانة منتجاتنا حيث توفر شركتنا قطع الغيار لكل ما نبيعه. الأشياء الموجودة في ضماننا وخارج ضماننا. 
                        نقوم بتوفير قطع الغيار لجميع أنواع غسالات الضغط وملحقاتها.</p>
                    <div class="summery_card_img">
                        <img src="{{asset('stc_css/images/summery_card_img1.png')}}" alt="" />
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summery_card">
                    <h4>الثقة والنزاهة</h4>
                    <p>نحن نقدم أعلى جودة من المنتجات لعملائنا، وخدمة العملاء لدينا ذات جودة ممتازة، ولا ينبغي لأي عميل أن يترك غير سعيد.</p>
                    <div class="summery_card_img">
                        <img src="{{asset('stc_css/images/summery_card_img2.png')}}" alt="" />
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summery_card">
                    <h4>نوعية ممتازة</h4>
                    <p>جميع منتجاتنا ذات جودة عالية، حيث أن شركتنا لا تتعامل مع منتجات ذات جودة دون المستوى.</p>
                    <div class="summery_card_img">
                        <img src="{{asset('stc_css/images/summery_card_img3.png')}}" alt="" />
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="about_vision">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                {{-- <div class="vision_card vision_dark">
                    <h3>رؤية</h3>
                    <p>يُعد نص Lorem Ipsum ببساطة نصًا شكليًا (بمعنى غير حقيقي) يستخدم في صناعة الطباعة والتنضيد. وقد ظل
                        نص Lorem Ipsum النص الشكلي القياسي لهذه الصناعة منذ القرن السادس عشر، عندما قام طابع مجهول بأخذ
                        مجموعة من الحروف وخلطها لصنع كتاب عينات الحروف.

                        يُعد نص Lorem Ipsum ببساطة نصًا شكليًا (بمعنى غير حقيقي) يستخدم في صناعة الطباعة والتنضيد. وقد
                        ظل نص Lorem Ipsum النص الشكلي القياسي لهذه الصناعة منذ القرن السادس عشر، عندما قام طابع مجهول
                        بأخذ مجموعة من الحروف وخلطها لصنع كتاب عينات الحروف.</p>
                </div> --}}
            </div>
            <div class="col-sm-6">
                {{-- <div class="vision_card vision_light">
                    <h3>مهمة</h3>
                    <p>يُعد نص Lorem Ipsum ببساطة نصًا شكليًا (بمعنى غير حقيقي) يستخدم في صناعة الطباعة والتنضيد. وقد ظل
                        نص Lorem Ipsum النص الشكلي القياسي لهذه الصناعة منذ القرن السادس عشر، عندما قام طابع مجهول بأخذ
                        مجموعة من الحروف وخلطها لصنع كتاب عينات الحروف.

                        يُعد نص Lorem Ipsum ببساطة نصًا شكليًا (بمعنى غير حقيقي) يستخدم في صناعة الطباعة والتنضيد. وقد
                        ظل نص Lorem Ipsum النص الشكلي القياسي لهذه الصناعة منذ القرن السادس عشر، عندما قام طابع مجهول
                        بأخذ مجموعة من الحروف وخلطها لصنع كتاب عينات الحروف.</p>
                </div> --}}
            </div>
        </div>
    </div>

</div>

@endsection