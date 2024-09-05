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


