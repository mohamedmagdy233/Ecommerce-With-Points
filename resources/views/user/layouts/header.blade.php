<header class="header axil-header header-style-5">

    <!-- Start Mainmenu Area  -->
    <div id="axil-sticky-placeholder"></div>
    <div class="axil-mainmenu">
        <div class="container">
            <div class="header-navbar">
                <div class="header-brand">
                    <a href="index.html" class="logo logo-dark">
                        <img src="{{asset('user/assets/images/logo/logo.png')}}" alt="Site Logo">
                    </a>
                    <a href="index.html" class="logo logo-light">
                        <img src="{{asset('user/assets/images/logo/logo-light.png')}}" alt="Site Logo">
                    </a>
                </div>
                <div class="header-main-nav">
                    <!-- Start Mainmanu Nav -->
                    <nav class="mainmenu-nav">
                        <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>
                        <div class="mobile-nav-brand">
                            <a href="index.html" class="logo">
                                <img src="{{asset('user/assets/images/logo/logo.png')}}" alt="Site Logo">
                            </a>
                        </div>
                        <ul class="mainmenu">
                            <li class="menu-item-has-children">
                                <a href="#">Home</a>
                                <ul class="axil-submenu">
                                    <li><a href="index-1.html">Home - Electronics</a></li>
                                    <li><a href="index-2.html">Home - NFT</a></li>
                                    <li><a href="index-3.html">Home - Fashion</a></li>
                                    <li><a href="index-4.html">Home - Jewellery</a></li>
                                    <li><a href="index-5.html">Home - Furniture</a></li>
                                    <li><a href="index-7.html">Home - Multipurpose</a></li>
                                    <li><a href="https://new.axilthemes.com/demo/template/etrade-rtl/">RTL Version</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Shop</a>
                                <ul class="axil-submenu">
                                    <li><a href="shop-sidebar.html">Shop With Sidebar</a></li>
                                    <li><a href="shop.html">Shop no Sidebar</a></li>
                                    <li><a href="single-product.html">Product Variation 1</a></li>
                                    <li><a href="single-product-2.html">Product Variation 2</a></li>
                                    <li><a href="single-product-3.html">Product Variation 3</a></li>
                                    <li><a href="single-product-4.html">Product Variation 4</a></li>
                                    <li><a href="single-product-5.html">Product Variation 5</a></li>
                                    <li><a href="single-product-6.html">Product Variation 6</a></li>
                                    <li><a href="single-product-7.html">Product Variation 7</a></li>
                                    <li><a href="single-product-8.html">Product Variation 8</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Pages</a>
                                <ul class="axil-submenu">
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="my-account.html">Account</a></li>
                                    <li><a href="sign-up.html">Sign Up</a></li>
                                    <li><a href="sign-in.html">Sign In</a></li>
                                    <li><a href="forgot-password.html">Forgot Password</a></li>
                                    <li><a href="reset-password.html">Reset Password</a></li>
                                    <li><a href="privacy-policy.html">Privacy Policy</a></li>
                                    <li><a href="coming-soon.html">Coming Soon</a></li>
                                    <li><a href="404.html">404 Error</a></li>
                                    <li><a href="typography.html">Typography</a></li>
                                </ul>
                            </li>
                            <li><a href="about-us.html">About</a></li>
                            <li class="menu-item-has-children">
                                <a href="#">Blog</a>
                                <ul class="axil-submenu">
                                    <li><a href="blog.html">Blog List</a></li>
                                    <li><a href="blog-grid.html">Blog Grid</a></li>
                                    <li><a href="blog-details.html">Standard Post</a></li>
                                    <li><a href="blog-gallery.html">Gallery Post</a></li>
                                    <li><a href="blog-video.html">Video Post</a></li>
                                    <li><a href="blog-audio.html">Audio Post</a></li>
                                    <li><a href="blog-quote.html">Quote Post</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </nav>
                    <!-- End Mainmanu Nav -->
                </div>
                <div class="header-action">
                    <ul class="action-list">


                        <li class="wishlist">
                            <a href="wishlist.html">
                                <i class="flaticon-heart"></i>
                            </a>
                        </li>
                        <li class="shopping-cart">
                            <a href="#" class="cart-dropdown-btn">
                                <span class="cart-count">3</span>
                                <i class="flaticon-shopping-cart"></i>
                            </a>
                        </li>
                        <li class="my-account">
                            <a href="javascript:void(0)">
                                <i class="flaticon-person"></i>
                            </a>
                            <div class="my-account-dropdown">
                                <ul>
                                    <li>
                                        <a href="my-account.html">My Account</a>
                                    </li>


                                </ul>
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
    <!-- End Mainmenu Area -->
</header>
