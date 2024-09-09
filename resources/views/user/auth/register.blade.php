<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    @include('user.parts.head')
    <style>
        .bg_image--10 {
            background-image: url({{asset('user/assets/images/banner/banner-9.jpg')}});
        }
    </style>


</head>

<body>
<div class="axil-signin-area">

    <!-- Start Header -->
    <div class="signin-header">
        <div class="row align-items-center">
            <div class="col-md-6">

            </div>
            <div class="col-md-6">
                <div class="singin-header-btn">
                    <a href="{{route('main.login')}}" class="axil-btn btn-bg-secondary sign-up-btn">تسجيل الدخول</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header -->

    <div class="row">
        <div class="col-xl-4 col-lg-6">
            <div class="axil-signin-banner bg_image bg_image--10">
                <h3 class="title">مرحبا نحن نقدم افضل المنتجات</h3>
            </div>
        </div>
        <div class="col-lg-6 offset-xl-2">
            <div class="axil-signin-form-wrap">
                <div class="axil-signin-form">
                    <h3 class="title">انشاء حساب</h3>
                    <p class="b2 mb--55">املي الحقول التاليه</p>
                    <form class="singin-form" method="post" action="{{route('registerNewCustomer')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ request()->query('user_id') }}">

                        <div class="form-group">
                            <label>الاسم </label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        <div class="form-group">
                            <label>رقم الهاتف</label>
                            <input type="text" class="form-control" name="phone">
                        </div>

                        <div class="form-group">
                            <label>العنوان</label>
                            <input type="text" class="form-control" name="address">
                        </div>

                        <div class="form-group">
                            <label>كلمة المرور</label>
                            <input type="password" class="form-control" name="password">
                        </div>

                        <div class="form-group">
                            <label>تاكيد كلمة المرور</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="axil-btn btn-bg-primary submit-btn" value="انشاء حساب">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
