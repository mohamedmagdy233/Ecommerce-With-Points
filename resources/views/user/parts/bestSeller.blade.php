<div class="axil-best-seller-product-area bg-color-white axil-section-gap pb--0">
    <div class="container">
        <div class="product-area pb--50">
            <div class="section-title-wrapper">
                <h2 class="title">الاكثر مبيعا</h2>
            </div>
            <div class="new-arrivals-product-activation-2 slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide product-slide-mobile">

                @foreach($bestSellers as $bestSeller)

                    <div class="slick-single-layout">
                        <div class="axil-product product-style-six">
                            <div class="thumbnail">
                                <a href="{{route('product.details',$bestSeller->product_id)}}">
                                    <img data-sal="fade" data-sal-delay="200" data-sal-duration="1500" src="{{asset('storage/'.$bestSeller->product->image)}}" alt="Product Images">
                                </a>

                            </div>
                            <div class="product-content">
                                <div class="inner">
                                    <div class="product-price-variant">
                                        <span class="price current-price" STYLE="color: #0a0c0d">${{$bestSeller->product->price}}</span>
                                    </div>
                                    <h5 class="title"><a href="{{route('product.details', $bestSeller->product_id)}}">#00{{$bestSeller->product_id}}</a></h5>
                                    <div class="product-hover-action">
                                        <ul class="cart-action">
                                            <li class="select-option"><a href="{{route('addToCart', $bestSeller->product_id)}}">اضف الى السلة</a></li>

                                            @auth('web')
                                                @if(\App\Models\Fav::where('customer_id', Auth::user('web')->id)->where('product_id', $bestSeller->id)->exists())

                                                    <div class="product-variation quantity-variant-wrapper">

                                                        <a href="javascript:void(0);" class="add-to-wishlist" data-id="{{ $bestSeller->product_id }}">
                                                            <i class="fas fa-heart" style="color: red;"></i>
                                                        </a>

                                                    </div>
                                                @else
                                                    <div class="product-variation quantity-variant-wrapper">
                                                        <a href="javascript:void(0);" class="add-to-wishlist" data-id="{{ $bestSeller->product_id }}">
                                                            <i class="far fa-heart"></i>
                                                        </a>
                                                    </div>
                                                @endif



                                            @endauth
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                @endforeach


            </div>
        </div>
    </div>
</div>
