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
                            <li class="axil-breadcrumb-item active" aria-current="page">تواصل معنا</li>
                        </ul>
                        <h1 class="title">تواصل معنا</h1>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Start Contact Area  -->
    <div class="axil-contact-page-area axil-section-gap">
        <div class="container">
            <div class="axil-contact-page">
                <div class="row row--30">
                    <div class="col-lg-8">
                        <div class="contact-form">
                            <h3 class="title mb--10">نحن نحب أن نسمع منك.</h3>
                            <p>إذا كان لديك منتجات رائعة تصنعها أو تتطلع إلى العمل معنا، فأرسل لنا رسالة.</p>

                            <form id="contact-form" method="POST" action="{{route('main.storeContact')}}"
                                 >
                                @csrf
                                <div class="row row--10">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="contact-name">الاسم <span>*</span></label>
                                            <input type="text" name="name" id="contact-name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="contact-phone">الهاتف <span>*</span></label>
                                            <input type="text" name="phone" id="contact-phone">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="contact-email">البريد الالكتروني <span>*</span></label>
                                            <input type="email" name="email" id="contact-email">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-message">الرسالة</label>
                                            <textarea name="message" id="message" cols="1" rows="2"></textarea>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="form-group mb--0">
                                            <input type="submit" id="submit" class="axil-btn btn-bg-primary"
                                                   value="ارسال">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4">

                    </div>
                </div>

            </div>
        </div>

        <!-- End Contact Area  -->


        <div class="service-area">
            <div class="container">
                <div class="row row-cols-xl-4 row-cols-sm-2 row-cols-1 row--20">
                    <div class="col">
                        <div class="service-box service-style-2">
                            <div class="icon">
                                <img src="{{asset('user/assets/images/icons/service1.png')}}" alt="Service">
                            </div>
                            <div class="content">
                                <h6 class="title"> توصيل امان</h6>
                                <p>لمده 24 ساعة.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="service-box service-style-2">
                            <div class="icon">
                                <img src="{{asset('user/assets/images/icons/service2.png')}}" alt="Service">
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
                                <img src="{{asset('user/assets/images/icons/service3.png')}}" alt="Service">
                            </div>
                            <div class="content">
                                <h6 class="title">سياسة الإرجاع خلال 24 ساعة</h6>
                                <p> من خلال 24 ساعة</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="service-box service-style-2">
                            <div class="icon">
                                <img src="{{asset('user/assets/images/icons/service4.png')}}" alt="Service">
                            </div>
                            <div class="content">
                                <h6 class="title">دعم الجودة الاحترافية</h6>
                                <p>دعم مباشر على مدار 24/7.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</main>

@include('user.parts.footer')


@include('user.parts.cart')
@include('user.layouts.js')

</html>





