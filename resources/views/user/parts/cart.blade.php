<div class="cart-dropdown" id="cart-dropdown">
    <div class="cart-content-wrap">
        <div class="cart-header">
            <h2 class="header-title">سله الشراء</h2>
            <button class="cart-close sidebar-close"><i class="fas fa-times"></i></button>
        </div>
        <div class="cart-body">
            <ul class="cart-item-list">
                @foreach($carts as $cart)
                    @php
                        $product = $cart->product;
                    @endphp
                    <li class="cart-item">
                        <div class="item-img">
                            <a href="{{ route('product.details', $product->id) }}">
                                <img src="{{ isset($product->image) ? asset('storage/'.$product->image) : asset('user/assets/images/product/electric/product-01.png') }}" alt="{{ $product->name }}">
                            </a>
{{--                            <button class=--}}{{----}}{{--"close-btn"><i class="fas fa-times"></i></button>--}}

                            <a href="javascript:void(0);" class="close-btn" data-id="{{ $product->id }}">
                                <i class="fal fa-times"></i>
                            </a>
                        </div>
                        <div class="item-content">
                            <h3 class="item-title"><a href="{{ route('product.details', $product->id) }}">{{ $product->name }}</a></h3>
                            <div class="item-price"><span class="currency-symbol"></span>{{ $product->price }}</div>
                            <div class="pro-qty item-quantity">
                                <input type="number" class="quantity-input" value="{{ $cart->quantity }}">
                            </div>
                        </div>
                    </li>
                @endforeach

            </ul>
        </div>
        <div class="cart-footer">
            <h3 class="cart-subtotal">
                <span class="subtotal-title">Subtotal:</span>
                <span class="subtotal-amount">$610.00</span>
            </h3>
            <div class="group-btn">
                <a href="cart.html" class="axil-btn btn-bg-primary viewcart-btn">View Cart</a>
                <a href="checkout.html" class="axil-btn btn-bg-secondary checkout-btn">Checkout</a>
            </div>
        </div>
    </div>
</div>

