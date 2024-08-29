<meta charset="UTF-8">
<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- FAVICON -->
<link rel="shortcut icon" type="image/x-icon"
      href="{{ getFile(isset($setting) ? $setting->logo : null)}}"/>

<!-- TITLE -->
<title>@yield('title')</title>

<!-- BOOTSTRAP CSS -->
<link href="{{asset('assets/admin')}}/assets/plugins/bootstrap5/css/bootstrap.min.css" rel="stylesheet"/>

@if(lang() == 'ar')
    <!-- STYLE CSS *** remove rtl to switch *** -->
    <link href="{{asset('assets/admin/assets/css-rtl/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin')}}/assets/css-rtl/skin-modes.css" rel="stylesheet"/>
    <link href="{{asset('assets/admin')}}/assets/css-rtl/dark-style.css" rel="stylesheet"/>
@else

    <!-- STYLE CSS *** remove rtl to switch *** -->
    <link href="{{asset('assets/admin/assets/css/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/admin')}}/assets/css/skin-modes.css" rel="stylesheet"/>
    <link href="{{asset('assets/admin')}}/assets/css/dark-style.css" rel="stylesheet"/>
@endif







@if(lang() == 'ar')
    <!-- SIDE-MENU CSS *** remove rtl to switch *** -->
    <link href="{{asset('assets/admin')}}/assets/css-rtl/sidemenu.css" rel="stylesheet">
@else
    <link href="{{asset('assets/admin')}}/assets/css/sidemenu.css" rel="stylesheet">

@endif
<!--PERFECT SCROLL CSS-->
<link href="{{asset('assets/admin')}}/assets/plugins/p-scroll/perfect-scrollbar.css" rel="stylesheet"/>

<!-- CUSTOM SCROLL BAR CSS-->
<link href="{{asset('assets/admin')}}/assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet"/>

<!--- FONT-ICONS CSS -->
<link href="{{asset('assets/admin/assets/css/icons.css')}}" rel="stylesheet"/>

<!-- SIDEBAR CSS -->
<link href="{{asset('assets/admin')}}/assets/plugins/sidebar/sidebar.css" rel="stylesheet">

<!-- COLOR SKIN CSS -->
<link id="theme" rel="stylesheet" type="text/css" media="all"
      href="{{asset('assets/admin')}}/assets/colors/color1.css"/>

{{--<!-- CK EDITOR -->--}}
{{--<script src="{{asset('ckeditor/ckeditor.js')}}"></script>--}}
{{--<!-- TOASTR CSS -->--}}

{{--  ckeditor  --}}
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.css">


{{--  ckeditor  --}}
@toastr_css

<!-- Switcher CSS -->
<link href="{{asset('assets/admin')}}/assets/switcher/css/switcher-rtl.css" rel="stylesheet">
<link href="{{asset('assets/admin')}}/assets/switcher/demo.css" rel="stylesheet">

<script defer src="{{asset('assets/admin')}}/assets/iconfonts/font-awesome/js/brands.js"></script>
<script defer src="{{asset('assets/admin')}}/assets/iconfonts/font-awesome/js/solid.js"></script>
<script defer src="{{asset('assets/admin')}}/assets/iconfonts/font-awesome/js/fontawesome.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet"/>


<link href="{{ asset('assets/admin/assets/css/select2.min.css') }}" rel="stylesheet"/>
<script src="{{ asset('assets/admin/assets/plugins/Parsley/dist/parsley.min.js') }}"></script>

@yield('css')
