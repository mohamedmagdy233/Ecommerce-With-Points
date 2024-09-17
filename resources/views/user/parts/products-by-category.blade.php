<!doctype html>
<html class="no-js" lang="ar">


@include('user.parts.head')




@include('user.parts.header')


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
                                    <img style=" height: 156px;" src="{{asset('storage/'.$product->image)}}" alt="Product Images">
                                </a>

                                <div class="product-hover-action">
                                    <ul class="cart-action">
                                        @auth('web')
                                            <li class="wishlist">
                                                <a href="javascript:void(0);" class="add-to-wishlist"
                                                   data-id="{{ $product->id }}">
                                                    <i class="far fa-heart"></i>
                                                </a>
                                            </li>
                                        @endauth

                                        <li class="select-option"><a href="{{route('addOneProductToCart', $product->id)}}"><i
                                                        class="fas fa-shopping-bag"></i></a></li>
                                        <li class="quickview"><a href="{{route('product.details', $product->id)}}"
                                                                 data-bs-toggle="modal"
                                                                 data-bs-target="#quick-view-modal"><i
                                                        class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <div class="inner">
                                    <h5 class="title"><a
                                                href="{{route('product.details', $product->id)}}">{{$product->name}}</a>
                                    </h5>
                                    <div class="product-price-variant">
                                        <span class="price current-price">{{$product->price}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>


        </div>


        @include('user.parts.footer')
        @include('user.parts.cart')
        @include('user.layouts.js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</html>
