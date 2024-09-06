<div class="cart-dropdown" id="cart-dropdown">
    <div class="cart-content-wrap">
        <div class="cart-header">
            <h2 class="header-title">سله الشراء</h2>
            <button class="cart-close sidebar-close"><i class="fas fa-times"></i></button>
        </div>
        <div class="cart-body">
            <form action="{{ route('addOrder') }}" method="post">
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
                                    <span class="currency-symbol"></span>{{ $product->price }}
                                </div>
                                <div class="pro-qty item-quantity">
                                    <label for="quantity-{{ $product->id }}"></label>
                                    <input type="number" name="quantity[{{ $product->id }}]" value="{{ $cart->quantity }}" min="1">
                                    <input type="hidden" name="product_ids[]" value="{{ $product->id }}">
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
                    <input type="submit" style="margin-right: 165px;" value="اطلب المنتجات الان">
                </div>
            </form>
    </div>
</div>

</div>

