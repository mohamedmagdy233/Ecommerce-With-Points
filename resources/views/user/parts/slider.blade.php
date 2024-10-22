<div class="axil-main-slider-area main-slider-style-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6">
                <div class="main-slider-content">
                    <span class="subtitle"><i class="fas fa-fire"></i> تجربة تسوق</span>
                    <h4> نقدم لكم تجربة تسوق إلكتروني مميزة تجمع بين الجودة العالية والأسعار التنافسية. نسعى دائمًا لتوفير مجموعة متنوعة من المنتجات التي تلبي جميع احتياجاتكم، من الأزياء والإكسسوارات إلى الأجهزة الإلكترونية ومنتجات العناية الشخصية.

                        استمتعوا بتجربة تسوق فريدة وخصومات حصرية عند التسوق معنا. اكتشفوا أحدث العروض والمنتجات الآن!</h4>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="main-slider-large-thumb">
                    <div class="slider-thumb-activation-two axil-slick-dots">
                        <!-- Start of the loop -->
                        @forelse($products as $product)
                            <div class="single-slide slick-slide">
                                <div class="axil-product product-style-five" style="height: 350px;"> <!-- Add a fixed height here -->
                                    <div class="thumbnail">
                                        <a href="{{ route('product.details', $product->id) }}">
                                            @foreach($product->media as $media)
                                                @if(!empty($media->image))
                                                    @foreach(json_decode($media->image, true) as $imagePath)
                                                        <div class="card-details ms-1 me-1">
                                                            <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $product->name }}">
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="card-details ms-1 me-1">
                                                        <img src="{{ asset('assets/upload/no-data.gif') }}" alt="No Image Available">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <div class="inner">
                                            <h5 class="title">
                                                <a href="{{ route('product.details', $product->id) }}">{{ $product->name }}</a>
                                            </h5>
                                            <div class="product-price-variant">
                                                <span class="price current-price">{{ $product->price }}{{$setting->currency}}</span>
                                            </div>
                                            <ul class="cart-action">
                                                <li class="select-option">
                                                    <a href="{{ route('product.details', $product->id) }}">اشتري الان</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty

                             <p>لا يوجد منتجات</p>

                        @endforelse
                        <!-- End of the loop -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .axil-product {
        height: 350px; /* Add a fixed height here */
        display: flex;
        flex-direction: column;
    }

    .axil-product .thumbnail {
        flex: 1;
    }

    .axil-product .product-content {
        flex: 1;
    }
    .slick-dots li button {
        background-color: #ff497c !important; /* Change this to your desired color */
        border: 2px solid #ff497c; /* Set the same color for the border */

    }

    .slick-dots li.slick-active button {
        background-color: #ff497c !important; /* Change this to the active dot color */
        border: 2px solid #ff497c; /* Active dot border */
    }

</style>
