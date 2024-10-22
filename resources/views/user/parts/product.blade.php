<div class="axil-product-area bg-color-white axil-section-gap pb--0" id="products">
    <div class="container">
        <div class="product-area pb--20">
            <div class="axil-isotope-wrapper">
                <div class="product-isotope-heading">
                    <div class="section-title-wrapper">
                        <span class="title-highlighter highlighter-primary">
                            <i class="far fa-shopping-basket"></i> منتجاتنا
                        </span>
                        <a href="{{ route('allProducts') }}" class="title highlighter-primary">منتجات جديدة</a>
                    </div>
                </div>
                <div class="row row--15 isotope-list">
                    @forelse($products as $product)
                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb--30 product music">
                            <div class="axil-product product-style-one">
                                <div class="thumbnail">
                                    <a href="{{ route('product.details', $product->id) }}">
                                        <!-- عرض الصور من جدول media -->
                                        <div class="owl-carousel owl-theme">
                                            @foreach($product->media as $media)
                                                @php
                                                    $images = json_decode($media->image, true); // تحويل JSON إلى مصفوفة
                                                @endphp

                                                @if(is_array($images))
                                                    @foreach($images as $imagePath)
                                                        <div class="item">
                                                            <img data-sal="fade" data-sal-delay="100" data-sal-duration="1500"
                                                                 src="{{ asset('storage/' . $imagePath) }}" alt="{{ $product->name }}">
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </div>
                                    </a>
                                    <div class="product-hover-action">
                                        <ul class="cart-action">
                                            <li class="select-option">
                                                <a href="{{ route('addOneProductToCart', $product->id) }}">اضف الى السلة</a>
                                            </li>
                                            <span class="col-1"></span>
                                            @auth('web')
                                                @if(\App\Models\Fav::where('customer_id', Auth::user('web')->id)->where('product_id', $product->id)->exists())
                                                    <a href="javascript:void(0);" class="add-to-wishlist" data-id="{{ $product->id }}">
                                                        <i class="fas fa-heart fa-3x" style="color: red;"></i>
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0);" class="add-to-wishlist" data-id="{{ $product->id }}">
                                                        <i class="far fa-heart fa-3x"></i>
                                                    </a>
                                                @endif
                                            @endauth
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="inner d-flex justify-content-between align-items-center">
                                        <h5 class="title mb-0">
                                            <a href="{{ route('product.details', $product->id) }}">
                                                {{ $product->name }}
                                            </a>
                                        </h5>
                                        <div class="product-price-variant">
                                            <span class="price current-price">{{ $product->price }} {{ $setting->currency }}</span>
                                        </div>
                                    </div>
                                    {{ Str::limit($product->description, 30, '...') }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center font-weight-bold has-medium-font-size">لا يوجد منتجات</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS لتعديل الـ Carousel  -->
<style>
    .axil-product img {
        height: 150px;
        object-fit: cover;
        width: 100%;
    }

    .owl-carousel .item {
        padding: 5px;
    }

    .owl-carousel .item img {
        width: 100%;
        height: auto;
        border-radius: 8px;
    }
</style>

<!-- سكربت لتفعيل الـ Carousel -->
<script>
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            items: 1,
            loop: true,
            margin: 10,
            nav: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true
        });
    });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
