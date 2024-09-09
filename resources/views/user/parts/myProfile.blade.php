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
                            <li class="axil-breadcrumb-item"><a href="{{ route('main.index') }}">الرئيسيه</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active" aria-current="page">حسابي</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->

    <!-- Start My Account Area  -->
    <div class="axil-dashboard-area axil-section-gap">
        <div class="container">
            <div class="axil-dashboard-warp">
                <div class="axil-dashboard-author">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="title mb-0">اهلا {{ auth()->user()->name }}</h5>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-4">
                        <!-- Optional Sidebar for Account Navigation -->
                    </div>
                    <div class="col-xl-9 col-md-8">
                        <div class="tab-content">
                            <div class="tab-pane fade show active">
                                <div class="col-lg-9">
                                    <div class="axil-dashboard-account">
                                        <form class="account-details-form" method="post" action="{{route('customer.updateProfile')}}">
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>الاسم </label>
                                                        <input type="text" class="form-control" name="name" value="{{  auth()->user()->name }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>رقم الهاتف</label>
                                                        <input type="text" class="form-control" name="phone" value="{{ auth()->user()->phone }}">
                                                    </div>
                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>العنوان</label>
                                                        <input type="text" class="form-control" name="address" value="{{ auth()->user()->address }}" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>كلمه السر الجديده </label>
                                                        <input type="text" class="form-control" name="password" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>تاكيد كلمه السر الجديده</label>
                                                        <input type="text" class="form-control" name="password_confirmation" >
                                                    </div>
                                                </div>
                                                <div class="form-group mb--0">
                                                    <input type="submit" class="axil-btn" value="حفظ">
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End My Account Area  -->
</main>

@include('user.parts.footer')
@include('user.parts.cart')
@include('user.layouts.js')

</html>
