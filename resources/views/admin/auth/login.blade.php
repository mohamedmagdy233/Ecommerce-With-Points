<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('admin.auth.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
    <style>
        .swal2-popup,
        .swal2-modal {
            font-size: 16px !important;
        }

        body.dark-mode {
            color: #c5c9e6;
            background-color: #212741; }
    </style>

    <style>
        body.dark-mode {
            background-color: #212741;
            color: #ffffff;
        }

        .swal2-popup,
        .swal2-modal {
            font-size: 16px !important;
        }

        .dark-mode .swal2-popup,
        .dark-mode .swal2-modal {
            background-color: #212741;
            color: #fff;
        }

        .dark-mode .input-text {
            background-color: #212741;
            color: #fff;
        }

        .dark-mode .btn-login,
        .dark-mode .btn-language {
            /*background-color: #444;*/
            color: #fff;
        }

        .dark-mode .input-icon i {
            color: #bbb;
        }

        .signup-container,
        .welcome-container {
            transition: background-color 0.3s, color 0.3s;
        }
    </style>

</head>

<body class="dark-mode">
<div class="container">
    <div class="language-switcher">
        <a href="{{ LaravelLocalization::getLocalizedURL(lang() == 'en' ? 'ar' : 'en', null, [], true) }}"
           class="btn btn-language">{{ lang() == 'en' ? trns('Arabic') : trns('English') }}</a>
    </div>
    <div class="dark-switcher">
        <a id="toggleDarkMode" class="btn btn-language">{{ trns('dark_mode') }}</a>
    </div>

    <main class="signup-container" style="margin-top: 40px">
        <h1 class="heading-primary">{{ trns('login') }}<span class="span-blue">.</span></h1>
        <p class="text-mute">{{ trns('please_enter_verification_data') }}</p>

        <form class="signup-form" action="{{route('admin.login')}}" method="post" id="LoginForm">
            @csrf
            <label class="inp">
                <input type="text" name="input" class="input-text" placeholder="&nbsp;">
                <span class="label">{{ trns('enter_user_name_or_your_code')  }}</span>
                <span class="input-icon"><i class="fa-solid fa-envelope"></i></span>
            </label>
            <label class="inp">
                <input type="password" name="password" class="input-text" placeholder="&nbsp;" id="password">
                <span class="label"> {{ trns('password') }}</span>
                <span class="input-icon input-icon-password" data-password><i class="fa-solid fa-eye"></i></span>
            </label>
            <button class="btn btn-login" id="loginButton"> {{ trns('login') }}</button>
        </form>
    </main>
    <div class="welcome-container"
         style="background-image: url({{asset('lock.webp')}}); background-size: cover">
        {{--        <h1 class="heading-secondary">--}}
        {{--            {{ trns('welcome back') }}--}}
        {{--            <span class="lg">--}}
        {{--            {{isset($setting) ? $setting->title_ar : config('app.name')}}--}}
        {{--        </span>--}}
        {{--        </h1>--}}
    </div>

@include('admin.auth.js')
    <script>
        document.getElementById('toggleDarkMode').addEventListener('click', function () {
            document.body.classList.toggle('dark-mode');
        });
    </script>
</html>
