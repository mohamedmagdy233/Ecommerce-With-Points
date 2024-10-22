<footer class="axil-footer-area footer-style-1 footer-dark">
    <!-- Start Footer Top Area  -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <!-- Start Single Widget  -->
                <div class="col-md-3 col-sm-12">
                    <div class="axil-footer-widget">
                        <div class="logo mb--30">
                            <a href="{{route('main.index')}}">
                                <img class="light-logo" src="{{isset($setting->logo) ? asset($setting->logo) : asset('user/assets/images/logo/logo.png')}}"
                                     alt="Logo Images">
                            </a>
                        </div>
                        <div class="inner">
                            <a    href="{{isset($setting->location_url) ? $setting->location_url : '#'}}" style="color :#acacac;" >

                                {{isset($setting->location) ? $setting->location : 'الموقع'}}
                            </a>
                            <div class="social-share">
                                <a href="{{$setting->facebook}}"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{$setting->instagram}}"><i class="fab fa-instagram"></i></a>
                                <a href="{{$setting->twitter}}"><i class="fab fa-twitter"></i></a>
                                <a href="{{$setting->youtube}}"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Widget  -->
                <!-- Start Single Widget  -->
                <div class="col-md-3 col-sm-4">
                    <div class="axil-footer-widget">
                        <h5 class="widget-title">من نحن</h5>
                        <div class="inner">
                            <ul>
                                <li><a href="{{route('main.about')}}">ماذا عنا</a></li>
                                <li><a href="{{route('main.products')}}">عن المنتجات الجديده</a></li>
                                <li><a href="{{route('main.ShowContact')}}">تواصل معنا</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Single Widget  -->
                <!-- Start Single Widget  -->
                <div class="col-md-3 col-sm-4">
                    <div class="axil-footer-widget">
                        <h5 class="widget-title">الحسابات</h5>
                        <div class="inner">
                            <ul>
                                <li><a href="{{route('main.login')}}">تسجيل الدخول</a></li>
                                <li><a href="{{route('main.register')}}">تسجيل جديد </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Single Widget  -->
                <!-- Start Single Widget  -->
                <div class="col-md-3 col-sm-4">
                    <div class="axil-footer-widget">
                        <h5 class="widget-title">الدعم</h5>
                        <div class="inner">
                            <ul>
                                <li><a href="{{route('termsAndPrivacyAndFaqs')}}">الخصوصيه</a></li>
                                <li><a href="{{route('termsAndPrivacyAndFaqs')}}">السياسة</a></li>
                                <li><a href="{{route('termsAndPrivacyAndFaqs')}}">الشروط</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Single Widget  -->
            </div>
        </div>
    </div>
    <!-- End Footer Top Area  -->
    <!-- Start Copyright Area  -->
    <div class="copyright-area copyright-default separator-top ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-7 col-lg-12">
                    <div class="copyright-left d-flex flex-wrap justify-content-xl-start justify-content-center">
                        <ul class="quick-link">
                            <li><a href="{{route('termsAndPrivacyAndFaqs')}}">الخصوصيه</a></li>
                            <li><a href="{{route('termsAndPrivacyAndFaqs')}}">السياسة</a></li>
                        </ul>
                        <ul class="quick-link ">
                            <li> كل الحقوق محفوظة بواسطه  {{config()->get('app.name')}}</li>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Copyright Area  -->
</footer>
