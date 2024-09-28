<div class="cart-dropdown" id="cart-dropdown">
    <div class="cart-content-wrap">
        <div class="cart-header">
            <h2 class="header-title">سله الشراء</h2>
            <a id="home" style="padding: 10px;" href="{{route('main.index')}}" class="cart-close sidebar-close"><i class="fas fa-home"></i></a>
            <button class="cart-close sidebar-close"><i class="fas fa-times"></i></button>
        </div>
        <div class="cart-body">
{{--            <form action="{{ route('addOrder') }}" method="post">--}}
                @csrf
                <ul class="cart-item-list">
                    @foreach($carts as $cart)
                        @php
                            $product = $cart->product;
                        @endphp
                        <li class="cart-item" id="product-row-{{ $product->id }}">
                            <div class="item-img">
                                <a href="{{ route('product.details', $product->id) }}">
                                    <img src="{{ isset($product->image) ? asset('storage/'.$product->image) : asset('user/assets/images/product/electric/product-01.png') }}" alt="{{ $product->name }}">
                                </a>
                                <button class="close-btn" data-id="{{ $product->id }}"><i class="fas fa-times"></i></button>
                            </div>

                            <div class="item-content">
                                <h3 class="item-title"><a href="{{ route('product.details', $product->id) }}">{{ $product->name }}</a></h3>
                                <div class="item-price">
                                    <span class="currency-symbol"></span>{{ $product->price }}{{$setting->currency}}
                                </div>

                                <div class="item-quantity">
                                    <label for="quantity-{{ $product->id }}"></label>

                                    <!-- Minus button -->
                                    <button type="button" class="qty-btn minus-btn" data-id="{{ $product->id }}">-</button>

                                    <!-- Quantity input -->
                                    <input type="number" id="quantity-{{ $product->id }}" name="quantity" value="1" min="1" class="quantity-input">

                                    <!-- Plus button -->
                                    <button type="button" class="qty-btn plus-btn" data-id="{{ $product->id }}">+</button>
                                </div>



                            </div>
                        </li>
                    @endforeach
                </ul>

            <div class="cart-footer">
                <h3 class="cart-subtotal">
                    <span class="subtotal-title">الاجمالي:</span>
                    <span class="subtotal-amount">{{ $total }}</span>
                </h3>
                <div class="row justify-content-center">
                    <div class="col-auto">
                        @if(count($carts) == 0)
                            <a href="{{ route('main.index') }}" class="btn btn-bg-secondary">
                                العودة للصفحة الرئيسية
                            </a>
                        @else
                        <a href="{{route('showCheckout')}}" class="btn btn-bg-secondary">
                            اطلب المنتجات الان
                        </a>
                        @endif

                    </div>
                </div>
            </div>
    </div>
</div>

</div>


<style>


    .cart-footer {
        padding: 20px;
        background-color: #f7f7f7;
        border: 1px solid #ddd;
        border-radius: 5px;
    }


    .cart-subtotal {
        margin-bottom: 10px;
    }

    .subtotal-title {
        font-weight: bold;
        margin-right: 10px;
    }

    .subtotal-amount {
        font-size: 18px;
        font-weight: bold;
        color: #333;
    }

    .btn-bg-secondary {
        background-color: #808080; /* change the background color */
        border-color: #808080; /* change the border color */
        color: #ffffff; /* change the text color */
        padding: 10px 20px; /* adjust the padding */
        border-radius: 5px; /* add a rounded corner */
        font-size: 16px; /* adjust the font size */
    }

    .btn-bg-secondary:hover {
        background-color: #666666; /* change the background color on hover */
        border-color: #666666; /* change the border color on hover */
    }
</style>
{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--<script>--}}
{{--    $(document).ready(function() {--}}
{{--        $('.plus-btn').click(function() {--}}
{{--            var productId = $(this).data('id');--}}
{{--            var inputField = $('#quantity-' + productId);--}}
{{--            var currentQuantity = parseInt(inputField.val());--}}
{{--            inputField.val(currentQuantity + 1);--}}
{{--            updateQuantity(productId, currentQuantity + 1);--}}
{{--        });--}}

{{--        $('.minus-btn').click(function() {--}}
{{--            var productId = $(this).data('id');--}}
{{--            var inputField = $('#quantity-' + productId);--}}
{{--            var currentQuantity = parseInt(inputField.val());--}}
{{--            if (currentQuantity > 1) {--}}
{{--                inputField.val(currentQuantity - 1);--}}
{{--                updateQuantity(productId, currentQuantity - 1);--}}
{{--            }--}}
{{--        });--}}

{{--        function updateQuantity(productId, quantity) {--}}
{{--            $.ajax({--}}
{{--                url: '{{ route("updateQuantityOfCart") }}',--}}
{{--                type: 'POST',--}}
{{--                data: {--}}
{{--                    _token: '{{ csrf_token() }}',--}}
{{--                    product_id: productId,--}}
{{--                    quantity: quantity--}}
{{--                },--}}
{{--                success: function(response) {--}}
{{--                    if (response.status === 200) {--}}
{{--                        toastr.success('تم التحديث بنجاح', 'Success');--}}
{{--                    } else if (response.status === 201) {--}}
{{--                        toastr.warning('Success', "حدث خطأ");--}}
{{--                    }--}}
{{--                },--}}
{{--                error: function(xhr) {--}}
{{--                    toastr.error('Error', 'حدث خطأ');--}}

{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on('click', '.minus-btn', function() {
        let input = $(this).next('.quantity-input');
        let value = parseInt(input.val());
        let productId = $(this).data('id');

        if (value > parseInt(input.attr('min'))) {
            value--;
            input.val(value);
            updateQuantity(productId, value); // Call AJAX function to update quantity
        }
    });

    $(document).on('click', '.plus-btn', function() {
        let input = $(this).prev('.quantity-input');
        let value = parseInt(input.val());
        let productId = $(this).data('id');

        value++;
        input.val(value);
        updateQuantity(productId, value); // Call AJAX function to update quantity
    });

    function updateQuantity(productId, quantity) {
        $.ajax({
            url: '{{ route("updateQuantityOfCart") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                quantity: quantity
            },
            success: function(response) {
                if (response.status === 200) {
                    toastr.success('تم التحديث بنجاح', 'Success');
                    // Optionally update the cart total, assuming it's part of the response
                    $('.subtotal-amount').text(response.total);
                } else {
                    toastr.warning('حدث خطأ', 'Warning');
                }
            },
            error: function(xhr) {
                toastr.error('حدث خطأ', 'Error');
            }
        });
    }
</script>

