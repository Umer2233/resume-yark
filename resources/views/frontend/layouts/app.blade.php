<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Resume Yak')</title>
    @include('frontend.layouts.partials.styles')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Fonts Awsome Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.css">
    <link href="https://kenwheeler.github.io/slick/slick/slick.css" rel="stylesheet" />
    <link href="https://kenwheeler.github.io/slick/slick/slick-theme.css" rel="stylesheet" />
    <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>

    <!-- Page Wrapper #app -->
    <div id="app" class="page-start" style="min-height: 100vh; z-index: 99;
    position: relative">
          @if(strpos(Request::url(), 'login') === false && strpos(Request::url(), 'reset-password') === false &&
          strpos(Request::url(), 'forgotpassword') === false)
          @include('frontend.layouts.partials.header-nav')
          @endif

        <!-- Start Pages Part -->
        @yield('content')
        <!-- End Pages Part -->


        <!-- <div id="footer-bg"><img src="http://html.resumeyak.com/images/bg/footer-bg.png" /></div>
        <div id="clouds-bg"><img src="http://html.resumeyak.com/images/bg/clouds-bg.png" /></div> -->

        <div id="footer-bg"><img src="{{ asset('images/bg/footer-bg.png') }}" /></div>
        <div id="clouds-bg"><img src="{{ asset('images/bg/clouds-bg.png') }}" /></div>
    </div>


    @include('frontend.layouts.partials.scripts')
</body>

<style>
    #footer-bg {
        position: absolute;
        bottom: 0px;
        left: 0px;
        z-index: -99;
    }

    #clouds-bg {
        position: absolute;
        top: 135px;
        left: 9%;
        z-index: -99;
    }

    #footer-bg img,
    #clouds-bg img {
        max-width: 100%;
        width: 100% !important;
    }
</style>

</html>
