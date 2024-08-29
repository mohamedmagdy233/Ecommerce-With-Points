<!doctype html>
<html lang="ar" dir="rtl">

<head>
    @include('admin/layouts/head')
    <style>
        .skeleton-loader {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 20px;
        }

        .loader-header, .loader-body {
            display: flex;
            flex-direction: column;
        }

        .skeleton {
            background-color: #ddd;
            border-radius: 4px;
        }

        .skeleton-text {
            width: 70%;
            height: 20px;
            margin-bottom: 10px;
        }

        .skeleton-close {
            width: 10px;
            height: 10px;
            align-self: flex-end;
        }

        .skeleton-input {
            width: 100%;
            height: 20px;
        }

        .skeleton-textarea {
            width: 100%;
            height: 60px;
        }

        /* Animation to show loading effect */
        .skeleton {
            animation: shimmer 1.5s infinite linear;
        }

        @keyframes shimmer {
            0% {
                background-color: #e0e0e0;
            }
            50% {
                background-color: #c7c7c7;
            }
            100% {
                background-color: #e0e0e0;
            }
        }
    </style>
</head>

<body class="app sidebar-mini">

<!-- Start Switcher -->
{{--@include('admin/layouts/switcher')--}}
<!-- End Switcher -->

<!-- GLOBAL-LOADER -->
@include('admin/layouts/loader')
<!-- /GLOBAL-LOADER -->

<!-- PAGE -->
<div class="page">
    <div class="page-main">
        <!--APP-SIDEBAR-->
    @include('admin/layouts/main-sidebar')
    <!--/APP-SIDEBAR-->

        <!-- Header -->
    @include('admin/layouts/main-header')
    <!-- Header -->
        <!--Content-area open-->
        <div class="app-content">
            <div class="side-app">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">{{trns('welcome_!')}} {{ auth()->user()->name }} <i class="fas fa-heart text-danger"></i></h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">@yield('page_name')</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                @yield('content')
            </div>
            <!-- End Page -->
        </div>
        <!-- CONTAINER END -->
    </div>
    <!-- SIDE-BAR -->

    <!-- FOOTER -->
@include('admin/layouts/footer')
<!-- FOOTER END -->
</div>
<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-angle-up mt-4"></i></a>

@include('admin/layouts/scripts')
@yield('ajaxCalls')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const darkModeToggle = document.getElementById('darkModeBtn');

        // Function to toggle dark mode
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            document.body.classList.toggle('dark-menu');

            // Update the stored value in localStorage
            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
            } else {
                localStorage.removeItem('darkMode');
            }
        }

        // Event listener for the button
        darkModeToggle.addEventListener('click', toggleDarkMode);

        // Check localStorage for dark mode setting on page load
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
            document.body.classList.add('dark-menu');
        }
    });

</script>
@toastr_js
@toastr_render
</body>
</html>
