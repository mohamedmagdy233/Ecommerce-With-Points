<html class="no-js" lang="ar">


@include('user.parts.head')

@include('user.parts.header')


<main class="main-wrapper"><!-- End Header -->


    <!-- Start Wishlist Area  -->
    <div class="axil-wishlist-area axil-section-gap">
        <div class="container">
            <div class="product-table-heading">
                <h4 class="title">المفضله</h4>
            </div>
            <div class="table-responsive">
                <table class="table axil-product-table axil-wishlist-table">
                    <thead>
                    <tr>
                        <th scope="col" class="product-remove"></th>
                        <th scope="col" class="product-thumbnail">المنتج</th>
                        <th scope="col" class="product-title"></th>
                        <th scope="col" class="product-price">السعر</th>
                        <th scope="col" class="product-stock-status">الفئه</th>
                        <th scope="col" class="product-add-cart"></th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($products as $product)
                        <tr id="product-row-{{ $product->id }}">
                            <td class="product-remove">
                                <a href="javascript:void(0);" class="remove-from-wishlist" data-id="{{ $product->id }}">
                                    <i class="fal fa-times"></i>
                                </a>
                            </td>
                            <td class="product-thumbnail"><a href="{{route('product.details',$product->id)}}"><img
                                        src="{{asset('storage/'.$product->image)}}" alt="Digital Product"></a></td>
                            <td class="product-title"><a
                                    href="{{route('product.details',$product->id)}}">{{ $product->name }}</a></td>
                            <td class="product-price" data-title="Price"><span
                                    class="currency-symbol">$</span>{{ $product->price }}</td>
                            <td class="product-stock-status" data-title="Status">{{$product->category->name}}</td>
                            <td class="product-add-cart"><a href="{{route('addOneProductToCart',$product->id)}}"
                                                            class="axil-btn btn-outline">اضف للسلة</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">لا يوجد منتجات في المفضلة</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- End Wishlist Area  -->

@include('user.layouts.js')
@include('user.parts.cart')
@include('user.parts.footer')
<script>
    $(document).ready(function () {
        $('.remove-from-wishlist').on('click', function (e) {
            e.preventDefault();
            var productId = $(this).data('id');
            var $row = $('#product-row-' + productId); // Target the specific row

            $.ajax({
                url: "{{ route('addToFav', '') }}/" + productId, // Update with correct route
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId
                },
                success: function (data) {
                    if (data.status === 201) {
                        toastr.success('Success', "تم الحذف من المفضلة");
                        $row.fadeOut(400, function () {
                            $(this).remove();
                        });
                    } else {
                        toastr.warning('Error', "لم يتم العثور على المنتج في المفضلة");
                    }
                },
                error: function () {
                    toastr.error('Error', 'حدث خطأ أثناء الحذف من المفضلة');
                }
            });
        });
    });
</script>



