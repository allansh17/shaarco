<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <!-- ! Hide app brand if navbar-full -->
    <div class="app-brand demo">
        <a href="{{url('/')}}" class="app-brand-link">
            <span class="app-brand-logo demo">
                {{-- @include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)']) --}}
                <span class="app-brand-logo demo">
                    <img src="{{ asset('uploads/logo/1731045529_672da89998316.jpeg') }}" alt="Logo" width="50%">
                </span>
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">{{config('variables.templateName')}}</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    @php
    $currentUrl = $_SERVER['REQUEST_URI'];

    @endphp

    <ul class="menu-inner py-1 ps ps--active-y">
        <li class="menu-item {{ $_SERVER['REQUEST_URI'] == '/dashboard' ? 'active' : '' }}">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>
        <!-- <li class="menu-item " id="master_id">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div>Master Management</div>
            </a>


            <ul class="menu-sub">
                <li class="menu-item {{ $_SERVER['REQUEST_URI'] == '/block' ? 'active' : '' }}">
                    <a href="/block" class="menu-link">
                        <div>Block Management</div>
                    </a>
                </li>


                <li class="menu-item {{ $_SERVER['REQUEST_URI'] == '/coupon' ? 'active' : '' }}">
                    <a href="/coupon" class="menu-link">
                        {{-- <i class='menu-icon bx bx-envelope' ></i> --}}
                        <div>Coupon Management</div>
                    </a>
                </li>



                <li class="menu-item {{ $_SERVER['REQUEST_URI'] == '/masters/emailtemplate' ? 'active' : '' }}">
                    <a href="/masters/emailtemplate" class="menu-link">
                        {{-- <i class='menu-icon bx bx-envelope' ></i> --}}
                        <div>Email Template</div>
                    </a>
                </li>

                <li class="menu-item  {{ $_SERVER['REQUEST_URI'] == '/faqscategory' ? 'active' : '' }}">
                    <a href="/faqscategory" class="menu-link">
                        <div>FAQ's Category</div>
                    </a>
                </li>

                <li class="menu-item  {{ $_SERVER['REQUEST_URI'] == '/faqs' ? 'active' : '' }}">
                    <a href="/faqs" class="menu-link">
                        <div>FAQ's Management</div>
                    </a>
                </li>



                <li class="menu-item  {{ $_SERVER['REQUEST_URI'] == '/lifestyle' ? 'active' : '' }}">
                    <a href="/lifestyle" class="menu-link">
                        <div>LifeStyle Gear</div>
                    </a>
                </li>


            </ul>
        </li> -->


        <li class="menu-item {{ request()->is('customer') || request()->is('customer/view/*') ? 'active' : '' }}">
            <a href="/customer" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div>User Management</div>
            </a>
        </li>
        <li class="menu-item {{ $_SERVER['REQUEST_URI'] == '/category' ? 'active' : '' }}">
            <a href="/category" class="menu-link">
                <i class='menu-icon bx bx-category'></i>
                <div>Category Management</div>
            </a>
        </li>
        <li class="menu-item {{ $_SERVER['REQUEST_URI'] == '/subcategory' ? 'active' : '' }}">
            <a href="/subcategory" class="menu-link">
                <i class="menu-icon bx bx-layer"></i>
                <div>SubCategory Management</div>
            </a>
        </li>
        <li class="menu-item {{ $_SERVER['REQUEST_URI'] == '/brands' ? 'active' : '' }}">
            <a href="/brands" class="menu-link">
                <i class="menu-icon bx bx-store"></i>
                <div>Brands Management</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('product') || request()->is('product/create') || request()->is('product/edit/*') ? 'active' : '' }}">
            <a href="/product" class="menu-link">
                <i class='menu-icon bx bx-camera'></i>
                <div>Product Management</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('order') || request()->is('order/view/*') ? 'active' : '' }}">
            <a href="/order" class="menu-link">
                <i class='menu-icon bx bx-cart-alt'></i>
                <div>Order Management</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('inquiry') || request()->is('inquiry/view/*') ? 'active' : '' }}">
            <a href="/inquiry" class="menu-link">
            <i class="menu-icon bx bx-shopping-bag"></i>
                <div>Inquiry Management</div>
            </a>
        </li> 
        <li class="menu-item {{ $_SERVER['REQUEST_URI'] == '/slider' ? 'active' : '' }}">
            <a href="/slider" class="menu-link">
                <i class='menu-icon bx bx-slider'></i>
                <div>Banner Management</div>
            </a>
        </li>
       
        <li class="menu-item {{ $_SERVER['REQUEST_URI'] == '/ad' ? 'active' : '' }}">
            <a href="/ad" class="menu-link">
            <i class='menu-icon bx bxl-blogger'></i>
                <div>Ad Management</div>
            </a>
        </li>

        <li class="menu-item {{ $_SERVER['REQUEST_URI'] == '/masters/static_pages' ? 'active' : '' }}">
            <a href="/masters/static_pages" class="menu-link">
                <i class='menu-icon bx bx-paste'></i>
                <div>Page Management</div>
            </a>
        </li>


        <!-- <li class="menu-item {{ $_SERVER['REQUEST_URI'] == '/product_feature' ? 'active' : '' }}">
            <a href="/product_feature" class="menu-link">
                <i class='menu-icon bx bx-note'></i>
                <div>Product Features</div>
            </a>
        </li> -->
        <!-- <li class="menu-item {{ $_SERVER['REQUEST_URI'] == '/blog' ? 'active' : '' }}">
            <a href="/blog" class="menu-link">
                <i class='menu-icon bx bxl-blogger'></i>
                <div>Blog Management</div>
            </a>
        </li> -->
        <li class="menu-item {{ $_SERVER['REQUEST_URI'] == '/company/setting' ? 'active' : '' }}">
            <a href="/company/setting" class="menu-link">
                <i class='menu-icon bx bx-cog'></i>
                <div>Settings</div>
            </a>
        </li>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 243px; right: 4px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 47px;"></div>
        </div>
    </ul>
</aside>