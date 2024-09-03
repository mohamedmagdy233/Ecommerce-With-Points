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
                        @foreach($products as $product)
                            <div class="single-slide slick-slide">
                                <div class="axil-product product-style-five">
                                    <div class="thumbnail">
                                        <a href="{{ route('product.details', $product->id) }}">
                                            <img src="{{ asset('storage/'.$product->image) }}" alt="Product Images">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <div class="inner">
                                            <h5 class="title">
                                                <a href="{{ route('product.details', $product->id) }}">#00{{ $product->id }}</a>
                                            </h5>
                                            <div class="product-price-variant">
                                                <span class="price current-price">${{ $product->price }}</span>
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
                        @endforeach
                        <!-- End of the loop -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
