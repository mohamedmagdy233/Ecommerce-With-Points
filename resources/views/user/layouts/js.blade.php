<!-- Modernizer JS -->
<script src="{{asset('user/assets/js/vendor/modernizr.min.js')}}"></script>
<!-- jQuery JS -->
<script src="{{asset('user/assets/js/vendor/jquery.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('user/assets/js/vendor/popper.min.js')}}"></script>
<script src="{{asset('user/assets/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('user/assets/js/vendor/slick.min.js')}}"></script>
<script src="{{asset('user/assets/js/vendor/js.cookie.js')}}"></script>
<!-- <script src="assets/js/vendor/jquery.style.switcher.js"></script> -->
<script src="{{asset('user/assets/js/vendor/jquery-ui.min.js')}}"></script>
<script src="{{asset('user/assets/js/vendor/jquery.ui.touch-punch.min.js')}}"></script>
<script src="{{asset('user/assets/js/vendor/jquery.countdown.min.js')}}"></script>
<script src="{{asset('user/assets/js/vendor/sal.js')}}"></script>
<script src="{{asset('user/assets/js/vendor/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('user/assets/js/vendor/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('user/assets/js/vendor/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('user/assets/js/vendor/counterup.js')}}"></script>
<script src="{{asset('user/assets/js/vendor/waypoints.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<!-- Main JS -->
<script src="{{asset('user/assets/js/rtl-main.js')}}"></script>


<script>
    $(document).ready(function() {
        $('.add-to-wishlist').on('click', function(e) {
            e.preventDefault();
            var $icon = $(this).find('i');
            var productId = $(this).data('id');

            $.ajax({
                url: "{{ route('addToFav', '') }}/" + productId,
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId
                },
                success: function(data) {
                    if (data.status === 200) {
                        toastr.success('Success', "تم الاضافة للمفضلة");

                        // Change icon to filled heart and red color
                        $icon.removeClass('far fa-heart').addClass('fas fa-heart').css('color', 'red');
                    } else {
                        toastr.warning('Success', "تم الحذف من المفضلة");

                        // Change icon to empty heart and default color
                        $icon.removeClass('fas fa-heart').addClass('far fa-heart').css('color', '');
                    }
                },
                error: function() {
                    toastr.error('Error', 'حدث خطأ');
                }
            });
        });
    });
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
    $(document).ready(function() {
        $('.close-btn').on('click', function(e) {
            e.preventDefault();
            var productId = $(this).data('id');
            var $row = $('#product-row-' + productId); // Target the specific row

            $.ajax({
                url: "{{ route('deleteFromCart', '') }}/" + productId,
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId
                },
                success: function(data) {
                    if (data.status === 200) {
                        $row.fadeOut(400, function () {
                            $(this).remove();
                        });
                        toastr.success('تم التحديث بنجاح', 'Success');


                    } else {
                        toastr.warning('Success', "حدث خطأ");

                    }
                },
                error: function() {
                    toastr.error('Error', 'حدث خطأ');
                }
            });
        });
    });
</script>

<script>
    $(document).on('change', '.quantity-input', function(e) {
        e.preventDefault();

        // Get the product ID and quantity
        var productId = $(this).data('id');
        var quantity = $(this).val();

        console.log("Product ID: " + productId);
        console.log("New Quantity: " + quantity);

        // Perform the AJAX request to update the quantity
        $.ajax({
            url: "{{ route('updateQuantityOfCart') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}", // CSRF token for security
                product_id: productId, // Product ID from the input
                quantity: quantity // New quantity value from the input
            },
            success: function(data) {
                if (data.status === 200) {
                    toastr.success('Success', "تم تحديث الكمية بنجاح");
                    // Optionally update the subtotal or cart information
                    $('.subtotal-amount').text(data.new_total); // Assuming the response contains the new subtotal
                } else {
                    toastr.warning('Error', "حدث خطأ أثناء التحديث");
                }
            },
            error: function() {
                toastr.error('Error', 'حدث خطأ أثناء تحديث الكمية');
            }
        });
    });

</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/all.min.js"></script>

<script>


    $(".details-project .owl-carousel").owlCarousel({
        autoplay: true,
        autoplayhoverpause: true,
        autoplaytimeout: 100,
        items: 3,
        nav: false,
        loop: true,
        dots: false,
        responsive: {
            0 : {
                items: 2
            },
            485 : {
                items: 3
            },
            728 : {
                items: 2
            },
            879 : {
                items: 3
            },
            1200 : {
                items: 3
            }
        }
    });

</script>




