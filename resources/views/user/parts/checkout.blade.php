<!doctype html>
<html class="no-js" lang="ar">


@include('user.parts.head')



@include('user.parts.header')


<main class="main-wrapper"><!-- End Header -->



    <!-- Start Checkout Area  -->
    <div class="axil-checkout-area axil-section-gap">
        <div class="container">
            <form action="#">
                <div class="row">
                    <div class="col-lg-6">

                        <div class="axil-checkout-billing">
                            <h4 class="title mb--40">تفاصيل الفاتوره</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>الاسم<span>*</span></label>
                                        <input type="text" id="first-name" placeholder="Adam" value="{{auth('web')->user()->name}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>رقم الهاتف <span>*</span></label>
                                        <input type="text" id="phone" placeholder="John" value="{{auth('web')->user()->phone}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>العنوان</label>
                                <input type="text" id="company-name" value="{{  auth('web')->user()->address}}">
                            </div>
                            <div class="form-group">
                                <label>Street Address <span>*</span></label>
                                <input type="text" id="address1" class="mb--15" placeholder="House number and street name">
                                <input type="text" id="address2" placeholder="Apartment, suite, unit, etc. (optonal)">
                            </div>
                            <div class="form-group">
                                <label>Town/ City <span>*</span></label>
                                <input type="text" id="town">
                            </div>
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" id="country">
                            </div>
                            <div class="form-group">
                                <label>Phone <span>*</span></label>
                                <input type="tel" id="phone">
                            </div>
                            <div class="form-group">
                                <label>Email Address <span>*</span></label>
                                <input type="email" id="email">
                            </div>
                            <div class="form-group input-group">
                                <input type="checkbox" id="checkbox1" name="account-create">
                                <label for="checkbox1">Create an account</label>
                            </div>
                            <div class="form-group different-shippng">
                                <div class="toggle-bar">
                                    <a href="javascript:void(0)" class="toggle-btn">
                                        <input type="checkbox" id="checkbox2" name="diffrent-ship">
                                        <label for="checkbox2">Ship to a different address?</label>
                                    </a>
                                </div>
                                <div class="toggle-open">
                                    <div class="form-group">
                                        <label>Country/ Region <span>*</span></label>
                                        <select id="Region">
                                            <option value="3">Australia</option>
                                            <option value="4">England</option>
                                            <option value="6">New Zealand</option>
                                            <option value="5">Switzerland</option>
                                            <option value="1">United Kindom (UK)</option>
                                            <option value="2">United States (USA)</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Street Address <span>*</span></label>
                                        <input type="text" id="address1" class="mb--15" placeholder="House number and street name">
                                        <input type="text" id="address2" placeholder="Apartment, suite, unit, etc. (optonal)">
                                    </div>
                                    <div class="form-group">
                                        <label>Town/ City <span>*</span></label>
                                        <input type="text" id="town">
                                    </div>
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" id="country">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone <span>*</span></label>
                                        <input type="tel" id="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Other Notes (optional)</label>
                                <textarea id="notes" rows="2" placeholder="Notes about your order, e.g. speacial notes for delivery."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="axil-order-summery order-checkout-summery">
                            <h5 class="title mb--20">الطلبات الخاصه بك</h5>
                            <div class="summery-table-wrap">
                                <table class="table summery-table">
                                    <thead>
                                    <tr>
                                        <th>اسم المنتج</th>
                                        <th>السعر</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($carts as $cart)

                                        <tr class="order-product">
                                            <td>{{ $cart->product->name }}<span class="quantity">x{{ $cart->quantity}}</span></td>
                                            <td>{{ $cart->product->price }}</td>
                                        </tr>
                                        @endforeach

                                    <tr class="order-total">
                                        <td>الاجمالي</td>
                                        <td class="order-total-amount">{{ $total }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <button type="submit" class="axil-btn btn-bg-primary checkout-btn">تأكيد الطلب</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Checkout Area  -->

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

@include('user.parts.footer')
@include('user.layouts.js')
@include('user.parts.cart')

</html>
