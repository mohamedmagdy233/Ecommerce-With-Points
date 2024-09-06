<header class="header axil-header header-style-5">

    <!-- Start Mainmenu Area  -->
    <div id="axil-sticky-placeholder"></div>
    <div class="axil-mainmenu">
        <div class="container">
            <div class="header-navbar">
                <div class="header-brand">
                    <a href="{{route('main.index')}}" class="logo logo-dark">
                        <img width="100px" height="100px" src="{{isset($setting->logo) ? asset($setting->logo) : asset('assets/upload/no-data.gif')}}" alt="Site Logo">
                    </a>

                </div>
                <div class="header-main-nav">
                    <!-- Start Mainmanu Nav -->
                    <nav class="mainmenu-nav">
                        <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>

                        <ul class="mainmenu">
                            <li><a href="{{route('main.index')}}">الرئيسيه</a></li>
                            <li><a href="#products">المنتجات</a></li>
                            <li><a href="#category">الاقسام</a></li>
                            <li><a href="{{route('main.ShowContact')}}">تواصل معنا</a></li>
                            <li><a href="{{route('main.about')}}">من نحن</a></li>
                        </ul>
                    </nav>
                    <!-- End Mainmanu Nav -->
                </div>
                <div class="header-action">
                    <ul class="action-list">


                        <li class="wishlist">
                            <a href="{{route('wishlist')}}">
                                <i class="flaticon-heart"></i>
                            </a>
                        </li>

                        <li class="shopping-cart">
                            <a href="{{route('showCart')}}" class="cart-dropdown-btn">
                                <span class="cart-count">{{App\Models\Cart::count()}}</span>
                                <i class="flaticon-shopping-cart"></i>
                            </a>
                        </li>
                        <li class="my-account">
                            <a href="javascript:void(0)">
                                <i class="flaticon-person"></i>
                            </a>
                            <div class="my-account-dropdown">

                                @if(Auth('web')->check())

                                    <a class="axil-btn btn-bg-primary" href="{{route('logout')}}">تسجيل خروج</a>

                                @else
                                <div class="login-btn">
                                        <a href="{{route('main.login')}}" class="axil-btn btn-bg-primary">تسجيل
                                            الدخول</a>
                                    </div>
                                <div class="reg-footer text-center">ليس لديك حساب؟<a
                                                href="{{route('main.register')}}"
                                                class="btn-link">انشاء حساب</a></div>

                                @endif
                            </div>
                        </li>
                        <li class="axil-mobile-toggle">
                            <button class="menu-btn mobile-nav-toggler">
                                <i class="flaticon-menu-2"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <script>
        @if(Session::has('success'))
        toastr.success("{{ session('success') }}");
        @endif

        @if(Session::has('error'))
        toastr.error("{{ session('error') }}");
        @endif

        @if(Session::has('info'))
        toastr.info("{{ session('info') }}");
        @endif

        @if(Session::has('warning'))
        toastr.warning("{{ session('warning') }}");
        @endif
    </script>


    <!-- End Mainmenu Area -->
</header>
