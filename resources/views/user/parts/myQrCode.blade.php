<!doctype html>
<html class="no-js" lang="ar">

@include('user.parts.head')
@include('user.parts.header')

<main class="main-wrapper">
    <!-- Start Breadcrumb Area  -->
    <div class="axil-breadcrumb-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item"><a href="{{ route('main.index') }}">الرئيسيه</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active" aria-current="page">الماسح الضوئي</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->

    <!-- Start My Account Area  -->
    <div class="axil-dashboard-area axil-section-gap">
        <div class="container">
            <div class="axil-dashboard-warp">
                <div class="axil-dashboard-author">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="title mb-0">مرحباً بك، {{ auth()->user()->name }}!</h5>
                            <p class="mt-2">استخدم هذا الرمز لمشاركة رابط التسجيل الخاص بك مع الآخرين.</p>
                        </div>
                    </div>
                    <!-- QR Code for the Authenticated User -->
                    <div>
                        @php
                            use BaconQrCode\Renderer\ImageRenderer;
                            use BaconQrCode\Renderer\RendererStyle\RendererStyle;
                            use BaconQrCode\Renderer\Image\SvgImageBackEnd;
                            use BaconQrCode\Writer;

                            // Use the url() helper to generate the full URL dynamically
                            $userUrl = url('/register?user_id=' . auth()->user()->id);

                            // Generate QR code for the user registration URL
                            $renderer = new ImageRenderer(
                                new RendererStyle(200),
                                new SvgImageBackEnd()
                            );
                            $writer = new Writer($renderer);
                            $qrCodeSvg = $writer->writeString($userUrl);
                        @endphp

                        <div>
                            {!! $qrCodeSvg !!} <!-- Display the QR Code here -->
                        </div>

                        <!-- Display the registration link as a button -->
                        <div class="mt-3">
                            <a href="{{ $userUrl }}" target="_blank" class="btn btn-info">
                                رابط التسجيل الخاص بك
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End My Account Area  -->
</main>

@include('user.parts.footer')
@include('user.parts.cart')
@include('user.layouts.js')

</html>
