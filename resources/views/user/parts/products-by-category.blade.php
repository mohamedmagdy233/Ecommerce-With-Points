<!doctype html>
<html class="no-js" lang="ar">


@include('user.layouts.head')




@include('user.layouts.header')



<main class="main-wrapper">



    <div class="axil-breadcrumb-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item"><a href="{{route('main.index')}}">الرئيسيه</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active" aria-current="page">المنتجات</li>
                        </ul>
                        <h1 class="title">اكتشف المنتجات</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4">
                    <div class="inner">
                        <img
                            alt="Image"
                            width="100px"
                            height="100px"
                            onclick="window.open(this.src)"
                            style="margin-right: 453px;"
                            class="avatar rounded-circle right-aligned"
                            src="{{ asset('storage/' . $category->image) }}"
                        >


                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="axil-shop-area axil-section-gap bg-color-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="axil-shop-top">
                    </div>
                </div>
            </div>
                <div class="row row--15">
                    @foreach($products as $product)
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="axil-product product-style-one has-color-pick mt--40">
                            <div class="thumbnail">
                                <a href="{{route('product.details', $product->id)}}">
                                    <img src="{{asset('storage/'.$product->image)}}" alt="Product Images">
                                </a>
 >
                                <div class="product-hover-action">
                                    <ul class="cart-action">
                                        <li class="wishlist"><a href="{{route('addToFav', $product->id)}}"><i class="far fa-heart"></i></a></li>
                                        <li class="select-option"><a href="{{route('addToCart', $product->id)}}"><i class="fas fa-shopping-bag"></i></a></li>
                                        <li class="quickview"><a href="{{route('product.details', $product->id)}}" data-bs-toggle="modal" data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="inner">
                                    <h5 class="title"><a href="{{route('product.details', $product->id)}}">{{$product->name}}</a></h5>
                                    <div class="product-price-variant">
                                        <span class="price current-price">${{$product->price}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>



        </div>
    </div>
    <!-- Start Axil Newsletter Area  -->
    <div class="axil-newsletter-area axil-section-gap pt--0">
        <div class="container">
            <div class="etrade-newsletter-wrapper bg_image bg_image--5">
                <div class="newsletter-content">
                    <span class="title-highlighter highlighter-primary2"><i class="fas fa-envelope-open"></i>اخر التحديثات</span>
                    <h2 class="title mb--40 mb_sm--30">اشترك في النشرة البريدية</h2>
                    <div class="input-group newsletter-form">
                        <div class="position-relative newsletter-inner mb--15">
                            <input placeholder="example@gmail.com" type="text">
                        </div>
                        <button type="submit" class="axil-btn mb--15">اشترك</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>









@include('user.layouts.footer')

</html>
