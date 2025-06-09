<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-6 col-6">
                <div class="footer_links">
                    <h3>روابط سريعة</h3>
                    <ul>
                        <li><a href="{{ route('products') }}">منتجات</a></li>
                        <!--  <li><a href="{{ route('index') }}">منتجات جديدة</a></li>
                        <li><a href="{{ route('index') }}">الأكثر مبيعا</a></li> -->
                        <li><a href="{{ route('contact_us') }}">اتصل بنا</a></li>
                        <li><a href="{{ route('about-us') }}">معلومات عنا</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6 col-6">
                <div class="footer_links">

                    <h3>الفئة الأعلى</h3>
                   
                   
                    @foreach ($brands as $brand)
                        <ul>
                            <li>
                                <a href="{{ route('getproducts', ['id' => $brand->id]) }}">
                                      {{ $brand->name }}
                                </a>
                            </li>
                        </ul>
                    @endforeach

                </div>
            </div>

            <div class="col-lg-4 col-sm-12 col-12">
                <div class="footer_about">
                    <div class="logo_footer">
                        <a href="{{ route('index') }}">
                            <img src="{{ asset('stc_css/images/Logo.svg') }}" alt="logo">
                        </a>
                    </div>
                    <p>دعم العملاء:</p>
                    <div class="phone_foot" style="    display: inline-flex;align-items: anchor-center;">
                        <i class="fa-brands fa-whatsapp" style="margin-left: 15px; color: #dde1de;"></i>
                        &nbsp;&nbsp;
                        <div><a href="tel:00970592350011">00970592350011</a> 
                            <a href="tel:00970592350011">00972524012039</a></div>
                        
                    </div>
                    <p>Hesba St., Nablus, West Bank, Palestine</p>
                    <div class="phone_foot" style="    display: inline-flex;align-items: anchor-center;">
                        <i class="fa-solid fa-envelope" style="margin-left: 15px; color: #ddd;"></i>&nbsp;&nbsp;
                        <div>
                            <p style="display: flex; align-items: baseline;"><a href="mailto:allansh17@hotmail.com">allansh17@hotmail.com</a>&nbsp;&nbsp;- مبيعات التجزئة </p>
                            <p style="display: flex; align-items: baseline;"><a href="mailto:magic-washer11@hotmail.com">magic-washer11@hotmail.com</a>&nbsp;&nbsp;- البيع بالجملة</p>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer_bottom">
        <p>تم تطويره بواسطة © 2025. تصميم مطوق </p>

    </div>
</footer>
