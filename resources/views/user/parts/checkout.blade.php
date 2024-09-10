<!doctype html>
<html class="no-js" lang="ar">

@include('user.parts.head')
@include('user.parts.header')

<main class="main-wrapper">
    <!-- Start Checkout Area  -->
    <div class="axil-checkout-area axil-section-gap">
        <div class="container">
            <!-- Ensure the form has an id 'orderForm' -->
            <form action="{{route('addOrder')}}" method="POST" id="orderForm">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="axil-checkout-billing">
                            <h4 class="title mb--40">تفاصيل الفاتوره</h4>
                            <!-- Billing details -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>الاسم<span>*</span></label>
                                        <input type="text" id="first-name" placeholder="Adam" value="{{ auth('web')->user()->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>رقم الهاتف <span>*</span></label>
                                        <input type="text" id="phone" placeholder="John" value="{{ auth('web')->user()->phone }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>نقاطي <span>*</span></label>
                                        <input type="text" id="points" value="{{ auth('web')->user()->points }}" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>نقاط للاستخدام </label>
                                        <input type="number" id="use_points" name="use_points" required oninput="validatePoints()" min="0" value="0" max="{{ auth('web')->user()->points }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">

                                <div class="form-group">
                                    <label>النقاط المكتسبه<span>*</span></label>
                                    <input type="text" class="mb--15" name="award_points" value="{{ $award_points }}" readonly>
                                </div>

                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>السعر النهائي بعد الخصم</label>
                                        <input type="text" id="total_price" name="total_price" value="{{ $total }}" required readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- Address and Delivery Method -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>طريقه التوصيل</label>
                                        <select name="delivery_type" id="delivery_type" class="form-control" required>
                                            <option value="" disabled selected>اختر</option>
                                            <option value="1"> الاستلام في المحل</option>
                                            <option value="2"> التوصيل للمنزل</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group" id="address" style="display: none;">
                                        <label>العنوان <span>*</span></label>
                                        <input type="text" name="address" class="form-control">
                                    </div>
                                </div>
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
                                        <th style="text-align: justify;">السعر</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($carts as $cart)
                                        <tr class="order-product">
                                            <td>{{ $cart->product->name }} <span class="quantity"> x{{ $cart->quantity }}</span></td>
                                            <td>{{ $cart->product->price }}</td>
                                            <!-- Hidden inputs to store product IDs and quantities -->
                                            <input type="hidden" name="product_ids[]" value="{{ $cart->product->id }}" class="product-id">
                                            <input type="hidden" name="quantities[]" value="{{ $cart->quantity }}" class="quantity">
                                        </tr>
                                    @endforeach
                                    <tr class="order-total">
                                        <td class="order-total-amount" colspan="2">الاجمالي: {{ $total }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Make sure the button does not have a type 'button' to submit the form -->
                            <button type="button" class="axil-btn btn-bg-primary checkout-btn" onclick="submitOrder()">تأكيد الطلب</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Checkout Area  -->
</main>

@include('user.parts.footer')
@include('user.layouts.js')
@include('user.parts.cart')

<script>
    // Price of point from PHP variable
    var priceOfPoint = {{ $setting->price_of_point }};
    var maxPoints = {{ auth('web')->user()->points }};

    // Show/hide address field
    document.getElementById('delivery_type').addEventListener('change', function() {
        var addressInput = document.getElementById('address');
        addressInput.style.display = this.value === '2' ? 'block' : 'none';
    });

    // Validate input points and update total price
    function validatePoints() {
        var usePointsInput = document.getElementById('use_points');
        var usePoints = parseFloat(usePointsInput.value) || 0;

        // Check if points exceed the available points
        if (usePoints > maxPoints) {
            usePointsInput.value = maxPoints;
            usePoints = maxPoints;
        }

        calculateDiscount(usePoints);
    }

    // Calculate discount and update total price
    function calculateDiscount(usePoints) {
        var totalPriceInput = document.getElementById('total_price');
        var totalPrice = parseFloat({{ $total }});

        // Calculate discount
        var discount = usePoints * priceOfPoint;

        // Update total price
        var newTotal = totalPrice - discount;
        newTotal = newTotal > 0 ? newTotal : 0; // Ensure total does not go below zero

        totalPriceInput.value = newTotal.toFixed(2); // Update the total price input field
    }

    // Collect product IDs and quantities
    function submitOrder() {
        // Ensure the form element is correctly selected
        var orderForm = document.getElementById('orderForm');

        // Check if the form exists
        if (orderForm) {
            var productIds = [];
            var quantities = [];

            // Collect product IDs
            document.querySelectorAll('.product-id').forEach(function(element) {
                productIds.push(element.value);
            });

            // Collect quantities
            document.querySelectorAll('.quantity').forEach(function(element) {
                quantities.push(element.value);
            });

            // Optional: Log collected data for debugging
            console.log('Product IDs:', productIds);
            console.log('Quantities:', quantities);

            // Create a FormData object to send via AJAX or form submission
            var formData = new FormData(orderForm);
            formData.append('product_ids', JSON.stringify(productIds));
            formData.append('quantities', JSON.stringify(quantities));

            // Submit the form with the collected data
            orderForm.submit();
        } else {
            console.error('Form element not found');
        }
    }
</script>

</html>
