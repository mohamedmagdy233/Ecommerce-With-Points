<!doctype html>
<html class="no-js" lang="ar">


@include('user.parts.head')
<style>
    .custom-copy-button {
        display: inline-block;
        padding: 6px 12px;
        font-size: 14px;
        color: #fff;
        background-color: #007bff; /* Custom button background color */
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease; /* Smooth transition for hover effect */
    }

    .custom-copy-button:hover {
        background-color: #0056b3; /* Darker shade on hover */
    }

    .custom-copy-button:focus {
        outline: none; /* Remove default focus outline */
        box-shadow: 0 0 4px rgba(0, 123, 255, 0.5); /* Custom focus shadow */
    }
</style>




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
                    <th scope="col" class="text-center">الرابط الخاص بيه </th>
{{--                    <th scope="col" class="text-center">العنوان</th>--}}
                </tr>
                </thead>
                <tbody>

                @foreach($relatedCustomers as $relatedCustomer)
                    <tr id="product-row-{{ $relatedCustomer->id }}">
                        <td class="text-center">{{$relatedCustomer->name}}</td>
                        <td class="text-center">{{$relatedCustomer->phone}}</td>
                        <td class="text-center">
                            <button class="custom-copy-button ml-2" onclick="copyToClipboard('{{ url('/') . '/register?user_id=' . $relatedCustomer->id }}')">
                                نسخ الرابط
                            </button>
                        </td>
{{--                        <td class="text-center">{{$relatedCustomer->address}}</td>--}}
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
<script>
    function copyToClipboard(text) {
        // Create a temporary input element to hold the text
        var tempInput = document.createElement("input");
        tempInput.value = text;
        document.body.appendChild(tempInput);

        // Select the text and copy it
        tempInput.select();
        tempInput.setSelectionRange(0, 99999); // For mobile devices
        document.execCommand("copy");

        // Remove the temporary input element
        document.body.removeChild(tempInput);

        // Show an alert or notification to the user
        alert("تم نسخ الرابط إلى الحافظة!");
    }
</script>




</html>
