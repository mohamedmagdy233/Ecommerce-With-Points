<style>
    .my-account-dropdown {

        font-size: 1.2rem; /* Increase font size for better readability */
        padding: 10px 15px; /* Adjust padding for more substantial buttons */
    }

    .my-account:hover .my-account-dropdown {
        display: block;
    }
    /* Initially set the background color */
    .axil-mainmenu {
        background-color:#FEBD69;
        transition: background-color 0.3s ease, top 0.3s ease;
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 9999;
    }

    /* When scrolling down, hide the navbar */
    .navbar-hidden {
        top: -100px; /* Adjust this value to move the navbar off the screen */
    }

    /* When scrolling up or at the top, show the navbar */
    .navbar-visible {
        top: 0;
        background-color: rgb(255, 172, 196); /* Keep your original color or adjust */
    }

    <script>
     let lastScrollTop = 0;
    const navbar = document.querySelector('.axil-mainmenu');

    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop) {
    // Scroll down - hide the navbar
    navbar.classList.add('navbar-hidden');
    navbar.classList.remove('navbar-visible');
    } else {
      // Scroll up - show the navbar
      navbar.classList.add('navbar-visible');
          navbar.classList.remove('navbar-hidden');
      }
        lastScrollTop = scrollTop;
    });
    </script>



</style>
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
                            <li><a href="{{route('allProducts')}}">المنتجات</a></li>
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
                                <span class="cart-count">{{auth('web')->user() !== null ? App\Models\Cart::where('customer_id', auth('web')->user()->id)->count() : 0}}</span>
                                <i class="flaticon-shopping-cart"></i>
                            </a>
                        </li>
                        <li class="my-account">
                            <a href="javascript:void(0)">
                                <i class="flaticon-person"></i>
                            </a>
                            <div class="my-account-dropdown p-4 shadow-lg bg-white rounded" style="min-width: 220px;">
                                @if(Auth('web')->check())

                                    <a class="btn btn-secondary btn-lg w-100 mb-3" href="{{ route('editProfile') }}">
                                        <i class="fas fa-user-edit"></i> تعديل حسابي
                                    </a>
                                    <a class="btn btn-primary btn-lg w-100 mb-3" href="{{ route('my.orders') }}">
                                        <i class="fas fa-box"></i> طلباتي
                                    </a>
                                    <a class="btn btn-secondary btn-lg w-100 mb-3" href="{{ route('transfer.points.customer') }}">
                                        <i class="fas fa-exchange-alt"></i> تحويل نقاط
                                    </a>
                                    <a class="btn btn-primary btn-lg w-100 mb-3" href="{{ route('my.points') }}">
                                        <i class="fas fa-coins"></i> نقاطي
                                    </a>

                                    <a class="btn btn-secondary btn-lg w-100 mb-3" href="{{ route('referral.customers') }}">
                                        <i class="fas fa-users"></i> العملاء المرتبطين
                                    </a>



                                    <a class="btn btn-primary btn-lg w-100 mb-3" href="{{ route('transfer.wastes') }}">
                                        <i class="fas fa-recycle"></i> تحويل نفايات
                                    </a>
{{--                                    <a class="btn btn-primary btn-lg w-100 mb-3" href="{{ route('myQrCode') }}">--}}
{{--                                        <i class="fas fa-qrcode"></i>   الماسح الضوئي--}}
{{--                                    </a>--}}

                                    <a class="btn btn-secondary btn-lg w-100 mb-3" href="{{ route('logout') }}">
                                        <i class="fas fa-sign-out-alt"></i> تسجيل خروج
                                    </a>
                                @else
                                    <div class="login-btn mb-3">
                                        <a href="{{ route('main.login') }}" class="btn btn-primary btn-lg w-100">
                                            <i class="fas fa-sign-in-alt"></i> تسجيل الدخول
                                        </a>
                                    </div>
                                    <div class="reg-footer text-center">
                                        ليس لديك حساب؟
                                        <a href="{{ route('main.register') }}" class="btn btn-link">
                                            <i class="fas fa-user-plus"></i> انشاء حساب
                                        </a>
                                    </div>
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
