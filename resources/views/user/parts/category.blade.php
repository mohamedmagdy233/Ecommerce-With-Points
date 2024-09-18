<div class="axil-categorie-area bg-color-white axil-section-gap pb--0" id="category">
    <div class="container">
        <div class="product-area pb--50">
            <div class="section-title-wrapper">
                <span class="title-highlighter highlighter-secondary"><i class="far fa-shopping-basket"></i>التصيفات</span>
                <h2 class="title">تصفح حسب الفئة</h2>
            </div>

            <div class="categrie-product-activation-3 slick-layout-wrapper--15 axil-slick-arrow  arrow-top-slide">

                @forelse($categories as $category)

                    <div class="slick-single-layout slick-slide">
                        <div class="categrie-product categrie-product-3" data-sal="zoom-out" data-sal-delay="100" data-sal-duration="500">
                            <a href="{{route('productsByCategory', $category->id)}}">
                                <img class="img-fluid" src="{{asset('storage/'.$category->image)}}" alt="category images">
                                <h6 class="cat-title">{{$category->name}}</h6>
                            </a>
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
    .axil-categorie-area .categrie-product img {
        height: 150px; /* adjust the height value as needed */
        object-fit: cover;
        width: 100%;
    }


    .axil-categorie-area .categrie-product img {
        height: 20vh; /* adjust the height value as needed */
        object-fit: cover;
        width: 100%;
    }
</style>
