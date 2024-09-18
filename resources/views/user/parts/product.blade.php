
<div class="axil-product-area bg-color-white axil-section-gap pb--0 " id="products">
    <div class="container">
        <div class="product-area pb--20">
            <div class="axil-isotope-wrapper">
                <div class="product-isotope-heading">
                    <div class="section-title-wrapper">
                        <span class="title-highlighter highlighter-primary"><i class="far fa-shopping-basket"></i>منتجاتنا</span>
                        <a href="{{route('allProducts')}}" class="title highlighter-primary">منتجات جديده </a>
                    </div>
                </div>
                <div class="row row--15 isotope-list">

                    @forelse($products as $product)

                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb--30 product music">
                            <div class="axil-product product-style-one">
                                <div class="thumbnail">
                                    <a href="{{route('product.details', $product->id)}}">
                                        <img data-sal="fade" data-sal-delay="100" data-sal-duration="1500" src="{{asset('storage/'.$product->image)}}" alt="Product Images">
                                    </a>
                                    <div class="product-hover-action">
                                        <ul class="cart-action">
                                            <li class="select-option"><a href="{{route('addOneProductToCart', $product->id)}}">اضف الى السلة</a></li>
                                            <span class="col-1"> </span>
                                            @auth('web')
                                                @if(\App\Models\Fav::where('customer_id', Auth::user('web')->id)->where('product_id', $product->id)->exists())

                                                    <div class="product-variation quantity-variant-wrapper">

                                                        <a href="javascript:void(0);" class="add-to-wishlist" data-id="{{ $product->id }}">
                                                            <i class="fas fa-heart fa-3x" style="color: red;"></i>
                                                        </a>

                                                    </div>
                                                @else
                                                    <div class="product-variation quantity-variant-wrapper">
                                                        <a href="javascript:void(0);" class="add-to-wishlist" data-id="{{ $product->id }}">
                                                            <i class="far fa-heart fa-3x"></i>
                                                        </a>
                                                    </div>
                                                @endif



                                            @endauth
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="inner">
                                        <h5 class="title"><a href="{{route('product.details', $product->id)}} ">{{ $product->name }} <span class="verified-icon"><i class="fas fa-badge-check"></i></span></a></h5>
                                        <div class="product-price-variant">
                                            <span class="price current-price">{{$product->price}}</span>
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
</div>

<style>
    .axil-categorie-area .categrie-product img {
        height: 150px; /* adjust the height value as needed */
        object-fit: cover;
        width: 100%;
    }

    .axil-product-area .axil-product img {
        height: 150px; /* adjust the height value as needed */
        object-fit: cover;
        width: 100%;
    }

    .axil-categorie-area .categrie-product img {
        height: 20vh; /* adjust the height value as needed */
        object-fit: cover;
        width: 100%;
    }

    .axil-product-area .axil-product img {
        height: 20vh; /* adjust the height value as needed */
        object-fit: cover;
        width: 100%;
    }
</style>
