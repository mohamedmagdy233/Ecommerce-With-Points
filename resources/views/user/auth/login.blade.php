<html lang="ar" dir="rtl">
<head>

    @include('user.parts.head')

</head>


<body>
<div class="axil-signin-area">

    <!-- Start Header -->
    <div class="signin-header">
        <div class="row align-items-center">
            <div class="col-sm-4">
                <a href="{{url('/')}}" class="site-logo"><img src="{{asset('user/assets/images/logo/logo.png')}}"
                                                              alt="logo"></a>
            </div>
            <div class="col-sm-8">
                <div class="singin-header-btn">
                    <a href="{{route('main.register')}}" class="axil-btn btn-bg-secondary sign-up-btn">انشاء حساب</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header -->

    <div class="row">
        <div class="col-xl-4 col-lg-6">
            <div class="axil-signin-banner bg_image bg_image--9">
                <h3 class="title">مرحبا نحن نقدم افضل المنتجات</h3>
            </div>
        </div>
        <div class="col-lg-6 offset-xl-2">
            <div class="axil-signin-form-wrap">
                <div class="axil-signin-form">
                    <h3 class="title">تسجيل الدخول</h3>
                    <p class="b2 mb--55">املي الحقول التاليه</p>
                    <form class="singin-form" method="post" action="{{route('login')}}" enctype="multipart/form-data">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label>رقم الهاتف</label>
                            <input type="text" class="form-control" name="phone">
                        </div>
                        <div class="form-group">
                            <label>كلمة المرور</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between">
                            <input type="submit" class="axil-btn btn-bg-primary submit-btn" value="تسجيل الدخول">
                            <a href="forgot-password.html" class="forgot-btn">نسيت كلمه المرور</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

</html>
