<div class="axil-best-seller-product-area bg-color-white axil-section-gap pb--0">
    <div class="container">
        <div class="product-area pb--50">
            <div class="section-title-wrapper">
                <span class="title-highlighter highlighter-secondary"><i class="fas fa-certificate"></i> </i>الاكثر مبيعا</span>
                <h2 class="title">المنتجات الاكثر مبيعا</h2>
            </div>
            <div class="new-arrivals-product-activation-2 slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide product-slide-mobile">
                @forelse($bestSellers as $bestSeller)
                    <div class="slick-single-layout">
                        <div class="axil-product product-style-six">
                            <div class="thumbnail">
                                <a href="{{ route('product.details', $bestSeller->product_id) }}">
                                    <img data-sal="fade" data-sal-delay="200" data-sal-duration="1500" src="{{  asset('storage/' . json_decode($bestSeller->product->media->first()->image, true)[0]) }}" alt="Product Images">
                                </a>
                                <span class="product-price">{{$bestSeller->product->price}} {{$setting->currency}}</span> <!-- Price badge over image -->
                            </div>
                            <div class="product-content">
                                <div class="inner">
                                    <h5 class="title"><a href="{{ route('product.details', $bestSeller->product_id) }}">#00{{$bestSeller->product_id}}</a></h5>
                                    <div class="product-hover-action">
                                        <ul class="cart-action">
                                            <li class="select-option"><a class="btn btn-add-cart" href="{{ route('addOneProductToCart', $bestSeller->product_id) }}">اضف الى السلة</a></li>
                                            @auth('web')
                                                <li class="wishlist-action">
                                                    <a href="javascript:void(0);" class="add-to-wishlist" data-id="{{ $bestSeller->product_id }}">
                                                        <i class="{{ \App\Models\Fav::where('customer_id', Auth::user('web')->id)->where('product_id', $bestSeller->id)->exists() ? 'fas fa-heart' : 'far fa-heart' }}" style="{{ \App\Models\Fav::where('customer_id', Auth::user('web')->id)->where('product_id', $bestSeller->id)->exists() ? 'color: red;' : '' }}"></i>
                                                    </a>
                                                </li>
                                            @endauth
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                    <p class="text-center  font-weight-bold has-medium-font-size" > لا يوجد منتجات</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
    .axil-product {
        height: 350px;
        display: flex;
        flex-direction: column;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
        overflow: hidden;
    }

    .axil-product:hover {
        transform: translateY(-5px);
    }

    .axil-product .thumbnail {
        position: relative;
        flex: 2;
        overflow: hidden;
        border-bottom: 1px solid #f0f0f0;
    }

    .axil-product .thumbnail img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .axil-product .product-price {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: rgba(0, 0, 0, 0.7);
        color: #fff;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 14px;
    }

    .axil-product .product-content {
        flex: 1;
        padding: 15px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .axil-product .title {
        font-size: 16px;
        margin-bottom: 10px;
        text-align: center;
    }

    .btn.btn-add-cart {
        background-color: #007bff;
        color: white;
        padding: 8px 12px;
        border-radius: 5px;
        text-align: center;
        font-weight: bold;
        text-decoration: none;
        display: block;
        transition: background-color 0.3s;
    }

    .btn.btn-add-cart:hover {
        background-color: #0056b3;
    }

    .wishlist-action i {
        font-size: 18px;
        cursor: pointer;
    }

    .cart-action {
        display: flex;
        justify-content: center;
        gap: 15px;
        padding-top: 10px;
    }
</style>
