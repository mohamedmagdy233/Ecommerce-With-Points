<html class="no-js" lang="ar">

@include('user.parts.head')
<style>
    .product-action-wrapper {
        display: flex;
        align-items: center; /* Aligns items vertically */
        justify-content: start; /* Aligns items to the left */
        margin-top: 20px;
    }

    .quantity-variant-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-right: 20px; /* Adds space between quantity selector and button */
    }

    .pro-qty {
        display: flex;
        align-items: center;
    }

    .pro-qty input[type="text"] {
        width: 50px;
        height: 40px;
        text-align: center;
        border: 1px solid #ddd;
        margin: 0 5px;
        font-size: 16px;
    }

    .pro-qty button {
        width: 40px;
        height: 40px;
        background-color: #f0f0f0;
        border: 1px solid #ddd;
        cursor: pointer;
        font-size: 18px;
        line-height: 1;
        padding: 0;
    }

    .pro-qty button:hover {
        background-color: #ddd;
    }

    .axil-btn.btn-bg-primary {
        padding: 12px 24px; /* Adjust padding for button size */
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
    }

    .product-action-wrapper {
        display: flex;
        align-items: center; /* Align items vertically */
        justify-content: start; /* Align items to the left */
        gap: 15px; /* Add space between the button and quantity selector */
        margin-top: 20px;
    }

    .quantity-variant-wrapper {
        display: flex;
        flex-direction: column;
        align-items: flex-start; /* Align quantity section to the start */
        margin-right: 20px; /* Adds space between quantity selector and button */
    }

    .pro-qty {
        display: flex;
        align-items: center;
    }

    .pro-qty input[type="text"] {
        width: 50px;
        height: 40px;
        text-align: center;
        border: 1px solid #ddd;
        margin: 0 5px;
        font-size: 16px;
    }

    .pro-qty button {
        width: 40px;
        height: 40px;
        background-color: #f0f0f0;
        border: 1px solid #ddd;
        cursor: pointer;
        font-size: 18px;
        line-height: 1;
        padding: 0;
    }

    .pro-qty button:hover {
        background-color: #ddd;
    }

    .axil-btn.btn-bg-primary {
        padding: 12px 24px; /* Adjust padding for button size */
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px; /* Adds space between the quantity selector and button */
    }


</style>


@include('user.parts.header')

<main class="main-wrapper">


    <!-- Start Shop Area  -->
    <div class="axil-single-product-area bg-color-white">
        <div class="single-product-thumb axil-section-gap pb--30 pb_sm--20">
            <div class="container">
                <div class="row row--50">
                    <div class="col-lg-6 mb--40">
                        <div class="h-100">
                            <div class="position-sticky sticky-top">
                                <div class="single-product-thumbnail axil-product text-center">
                                    <div class="thumbnail">
                                        <img src="{{asset('storage/'.$productDetails->image)}}" alt="Product Images"
                                             class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb--40">
                        <div class="h-100">
                            <div class="position-sticky sticky-top">
                                <div class="single-product-content nft-single-product-content">
                                    <div class="inner">
                                        <h2 class="product-title">{{$productDetails->name}}</h2>
                                        <div class="price-amount price-offer-amount">
                                            <span class="price current-price">جمالي : {{$productDetails->price}}</span>
                                        </div>
                                        <div
                                            class="product-action-wrapper d-flex align-items-center justify-content-start mt-3">
                                            <form action="{{route('addToCart')}}" method="post"
                                                  class="d-flex align-items-center">
                                                @csrf
                                                <!-- Product Quantity -->
                                                <div class="product-variation quantity-variant-wrapper mr-3">
                                                    <input type="hidden" name="product_id"
                                                           value="{{ $productDetails->id }}">
                                                    <div class="pro-qty item-quantity">
                                                        <input type="number" data-id="{{ $productDetails->id }}"
                                                               class="quantity-input" name="quantity" id="quantity-of-product"
                                                               value="1">
                                                    </div>
                                                </div>
                                                <!-- Start Product Action -->
                                                <button type="submit" class="btn btn-primary btn-sm ml-3">
                                                    <i class="fas fa-cart-plus"></i> أضف إلى السلة
                                                </button>
                                            </form>

                                            @auth('web')
                                                @if(\App\Models\Fav::where('customer_id', Auth::user('web')->id)->where('product_id', $productDetails->id)->exists())
                                                    <div class="ml-3">
                                                        <a href="javascript:void(0);" class="add-to-wishlist"
                                                           data-id="{{ $productDetails->id }}">
                                                            <i class="fas fa-heart" style="color: red;"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="ml-3">
                                                        <a href="javascript:void(0);" class="add-to-wishlist"
                                                           data-id="{{ $productDetails->id }}">
                                                            <i class="far fa-heart"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>

                                        <div class="woocommerce-tabs wc-tabs-wrapper bg-vista-white nft-info-tabs mt-4">
                                            <div class="container">
                                                <ul class="nav tabs" id="myTab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <a class="active" id="description-tab" data-bs-toggle="tab"
                                                           href="#description" role="tab" aria-controls="description"
                                                           aria-selected="true">الوصف</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="description"
                                                         role="tabpanel" aria-labelledby="description-tab">
                                                        <div class="product-additional-info">
                                                            <p class="mb--15"><strong>عن المنتج</strong></p>
                                                            <p>{{$productDetails->description}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end woocommerce-tabs -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End .single-product-thumb -->
    </div>
    <!-- End Shop Area  -->

    <!-- Start Recently Viewed Product Area  -->
    <div class="axil-product-area bg-color-white axil-section-gap pb--0">
        <div class="container">
            <div class="product-area pb--20">
                <div class="axil-isotope-wrapper">
                    <div class="product-isotope-heading">
                        <div class="section-title-wrapper">
                            <span class="title-highlighter highlighter-primary"><i class="far fa-shopping-basket"></i>المشابهه</span>
                            <h2 class="title">منتجات مشابهه</h2>
                        </div>

                    </div>
                    <div class="row row--15 isotope-list">

                        @foreach($relatedProducts as $relatedProduct)

                            <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb--30 product music">
                                <div class="axil-product product-style-one">
                                    <div class="thumbnail text-center">
                                        <a href="{{route('product.details', $relatedProduct->id)}}">
                                            <img data-sal-delay="400" data-sal-duration="1500"
                                                 src="{{asset('storage/'.$relatedProduct->image)}}" alt="Product Images"
                                                 class="img-fluid">
                                        </a>
                                        <div class="product-hover-action">


                                                <!-- Start Product Action -->
                                                <ul class="product-action list-unstyled mb-0 d-flex justify-content-center">
                                                    <li class="add-to-cart">
                                                        <a href="{{route('addOneProductToCart', $relatedProduct->id)}}"
                                                               style="background-color: red;    font-size: large; border-color: red;"
                                                               class="add-to-cart-link btn btn-danger btn-sm"
                                                               >أضف إلى السلة
                                                            </a>
                                                    </li>
                                                </ul>

                                        </div>
                                    </div>
                                    <div class="product-content text-center">
                                        <div class="inner">
                                            <h5 class="title"><a
                                                    href="{{route('product.details', $relatedProduct->id)}}">
                                                    #00{{$relatedProduct->id}}
                                                    <span class="verified-icon"><i
                                                            class="fas fa-badge-check"></i></span></a>
                                            </h5>
                                            <div class="product-price-variant">
                                                <span class="price current-price">{{$relatedProduct->price}}</span>
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
    </div>
</main>


@include('user.parts.footer')
@include('user.parts.cart')
@include('user.layouts.js')

<script>
    document.querySelectorAll('.qty-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            var input = this.parentNode.querySelector('input[type="text"]');
            var currentValue = parseInt(input.value, 10);
            if (this.classList.contains('inc')) {
                input.value = currentValue + 1;
            } else if (this.classList.contains('dec') && currentValue > 1) {
                input.value = currentValue - 1;
            }
        });
    });
</script>


