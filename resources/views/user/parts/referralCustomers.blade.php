<!doctype html>
<html class="no-js" lang="ar">


@include('user.parts.head')




@include('user.parts.header')


<main class="main-wrapper"><!-- End Header -->


</main>
<!-- Start Wishlist Area  -->
<div class="axil-wishlist-area axil-section-gap">
    <div class="container">
        <div class="product-table-heading">
            <h4 class="title">العملاء المرتبطين</h4>
        </div>
        <div class="table-responsive">
            <table class="table axil-product-table axil-wishlist-table">
                <thead>
                <tr>
                    <th scope="col" class="text-center">اسم العميل</th>
                    <th scope="col" class="text-center">رقم الهاتف </th>
                    <th scope="col" class="text-center">العنوان</th>
                </tr>
                </thead>
                <tbody>

                @foreach($relatedCustomers as $relatedCustomer)
                    <tr id="product-row-{{ $relatedCustomer->id }}">

                        <td class="text-center">{{$relatedCustomer->name}}</td>
                        <td class="text-center">{{$relatedCustomer->phone}}</td>
                        <td class="text-center">{{$relatedCustomer->address}}</td>

                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- End Wishlist Area  -->

@include('user.parts.footer')
@include('user.layouts.js')
@include('user.parts.cart')
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


</html>
