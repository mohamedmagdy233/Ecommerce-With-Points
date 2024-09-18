<!doctype html>
<html class="no-js" lang="ar">


@include('user.parts.head')




@include('user.parts.header')


<main class="main-wrapper"><!-- End Header -->

    <!-- Start Breadcrumb Area  -->
    <div class="axil-breadcrumb-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item"><a href="{{route('main.index')}}">الرئيسيه</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active" aria-current="page">التفاصيل</li>
                        </ul>
                        <h1 class="title">الخصوصيه و الشروط والاحكام</h1>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->

    <!-- Start Privacy Policy Area  -->
    <div class="axil-privacy-area axil-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div class="axil-privacy-policy">
                        <span class="policy-published">الخصوصيه</span>
                        <p>{!! isset($setting->privacy) ? $setting->privacy : '' !!}</p>
                        <hr>
                        <hr>
                        <hr>

                        <span class="policy-published">الشروط</span>
                        <p>{!! isset($setting->terms) ? $setting->terms : '' !!}</p>
                        <hr>
                        <hr>
                        <hr>

                        <span class="policy-published">الاحكام</span>
                        <p>{!! isset($setting->faqs) ? $setting->faqs : '' !!}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Privacy Policy Area  -->

</main>


<div class="service-area">
    <div class="container">
        <div class="row row-cols-xl-4 row-cols-sm-2 row-cols-1 row--20">
            <div class="col">
                <div class="service-box service-style-2">
                    <div class="icon">
                        <img src="{{asset('user/assets/images/icons/service1.png')}}" alt="الخدمة">
                    </div>
                    <div class="content">
                        <h6 class="title">توصيل سريع وآمن</h6>
                        <p>أخبر عن خدمتك.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="service-box service-style-2">
                    <div class="icon">
                        <img src="{{asset('user/assets/images/icons/service2.png')}}" alt="الخدمة">
                    </div>
                    <div class="content">
                        <h6 class="title">ضمان استعادة الأموال</h6>
                        <p>خلال 10 أيام.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="service-box service-style-2">
                    <div class="icon">
                        <img src="{{asset('user/assets/images/icons/service3.png')}}" alt="الخدمة">
                    </div>
                    <div class="content">
                        <h6 class="title">سياسة إرجاع خلال 24 ساعة</h6>
                        <p>دون طرح أسئلة.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="service-box service-style-2">
                    <div class="icon">
                        <img src="{{asset('user/assets/images/icons/service4.png')}}" alt="الخدمة">
                    </div>
                    <div class="content">
                        <h6 class="title">دعم بجودة احترافية</h6>
                        <p>دعم مباشر 24/7.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('user.parts.footer')
@include('user.parts.cart')
@include('user.layouts.js')
