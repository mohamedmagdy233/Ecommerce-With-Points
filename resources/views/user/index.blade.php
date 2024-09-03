<html lang="ar" >
<head>

    @include('user.parts.head')

</head>

<body class="sticky-header">
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->

<main class="main-wrapper">

    @include('user.parts.header')
    @include('user.parts.slider')
    @include('user.parts.bestSeller')
    @include('user.parts.category')


    @include('user.parts.product')


</main>


@include('user.parts.footer')

@include('user.layouts.cart')
@include('user.layouts.js')

<a href="#top" class="back-to-top" id="backto-top"><i class="fal fa-arrow-up"></i></a>


</body>

</html>
