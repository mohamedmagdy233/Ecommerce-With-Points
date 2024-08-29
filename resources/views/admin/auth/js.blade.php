<script src="{{asset('assets/admin')}}/assets/js/jquery-3.4.1.min.js"></script>
@toastr_js
@toastr_render
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
<script>
    function expand(lbl) {
        var elemId = lbl.getAttribute("for");
        document.getElementById(elemId).style.height = "45px";
        document.getElementById(elemId).classList.add("my-style");
        lbl.style.transform = "translateY(-45px)";
    }

    $("form#LoginForm").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        var url = $('#LoginForm').attr('action');
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            beforeSend: function () {
                $('#loginButton').html('<span class="spinner-border spinner-border-sm mr-2" ' +
                    ' ></span> <span style="margin-left: 4px;">{{  trns('waiting...')}}</span>').attr('disabled', true);

            },
            complete: function () {


            },
            success: function (data) {
                if (data == 200) {
                    swal.fire({
                        title: "{{ trns('welcome_back') }}",
                        icon: "success"
                    }).then(function () {
                        window.location.href = '{{route('adminHome')}}';
                    });
                    {{--window.setTimeout(function () {--}}
                    {{--    window.location.href = '{{route('adminHome')}}';--}}
                    {{--}, 1000);--}}
                } else {
                    toastr.error('{{ trns('login_failed') }}');
                    $('#loginButton').html(`<i id="lockId" class="fa fa-lock" style="margin-left: 6px"></i> {{trns('login')}}`).attr('disabled', false);
                }

            },
            error: function (data) {
                if (data.status === 500) {
                    $('#loginButton').html(`<i id="lockId" class="fa fa-lock" style="margin-left: 6px"></i> {{trns('login')}}`).attr('disabled', false);
                    toastr.error('هناك خطأ ما');
                } else if (data.status === 422) {
                    $('#loginButton').html(`<i id="lockId" class="fa fa-lock" style="margin-left: 6px"></i> {{trns('login')}}`).attr('disabled', false);
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors, function (key, value) {
                        if ($.isPlainObject(value)) {
                            $.each(value, function (key, value) {
                                toastr.error(value);
                            });

                        } else {
                        }
                    });
                } else {
                    $('#loginButton').html(`<i id="lockId" class="fa fa-lock" style="margin-left: 6px"></i> {{ trns('login') }}`).attr('disabled', false);

                    toastr.error('{{ trns('login_failed') }}');
                }
            },//end error method

            cache: false,
            contentType: false,
            processData: false
        });
    });

</script>
