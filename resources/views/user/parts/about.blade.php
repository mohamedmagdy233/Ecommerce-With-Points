<!doctype html>
<html class="no-js" lang="ar">


@include('user.parts.head')




@include('user.parts.header')


<main class="main-wrapper">
    <!-- Start Breadcrumb Area  -->
    <div class="axil-breadcrumb-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item"><a href="{{route('main.index')}}">الرئيسيه</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active" aria-current="page">من نحن</li>
                        </ul>
                        <h1 class="title">عن المتجر</h1>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->

    <!-- Start About Area  -->
    <div class="axil-about-area about-style-1 axil-section-gap ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-4 col-lg-6">
                    <div class="about-thumbnail">
                        <div class="thumbnail">
                            <img src="{{asset('user/assets/images/about/about-01.jpg')}}" alt="About Us">
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-6">
                    <div class="about-content content-right">
                        <span class="title-highlighter highlighter-primary2"> <i class="far fa-shopping-basket"></i>عن المتجر</span>
                        <h3 class="title">يتضمن التسوق عبر الإنترنت شراء الأشياء عبر الإنترنت.</h3>
                        <span class="text-heading">يمكن أن يساعدك alesforce B2C Commerce في إنشاء تجارب تجارية رقمية موحدة وذكية - سواء عبر الإنترنت أو في المتجر.</span>
                        <div class="row">
                            <div class="col-xl-6">
                                <p>قم بتمكين فرق المبيعات لديك من خلال حلول مصممة خصيصًا للصناعة والتي تدعم الشركات
                                    المصنعة أثناء انتقالها إلى الرقمنة، والتكيف مع الأسواق والعملاء المتغيرين بشكل أسرع
                                    من خلال إنشاء أعمال جديدة.</p>
                            </div>
                            <div class="col-xl-6">
                                <p class="mb--0">توفر خدمة Salesforce B2B Commerce للمشترين تجربة التسوق عبر الإنترنت
                                    السلسة والذاتية الخدمة مع جميع خدمات B2B</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About Area  -->


</main>


<div class="service-area">
    <div class="container">
        <div class="row row-cols-xl-4 row-cols-sm-2 row-cols-1 row--20">
            <div class="col">
                <div class="service-box service-style-2">
                    <div class="icon">
                        <img src="{{asset('user/assets/images/icons/service1.png')}}" alt="Service">
                    </div>
                    <div class="content">
                        <h6 class="title">Fast &amp; Secure Delivery</h6>
                        <p>Tell about your service.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="service-box service-style-2">
                    <div class="icon">
                        <img src="{{asset('user/assets/images/icons/service2.png')}}" alt="Service">
                    </div>
                    <div class="content">
                        <h6 class="title">Money Back Guarantee</h6>
                        <p>Within 10 days.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="service-box service-style-2">
                    <div class="icon">
                        <img src="{{asset('user/assets/images/icons/service3.png')}}" alt="Service">
                    </div>
                    <div class="content">
                        <h6 class="title">24 Hour Return Policy</h6>
                        <p>No question ask.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="service-box service-style-2">
                    <div class="icon">
                        <img src="{{asset('user/assets/images/icons/service4.png')}}" alt="Service">
                    </div>
                    <div class="content">
                        <h6 class="title">Pro Quality Support</h6>
                        <p>24/7 Live support.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('user.parts.footer')
@include('user.parts.cart')
@include('user.layouts.js')
