<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Resume Yak')</title>
    @include('frontend.layouts.partials.styles')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>

    <!-- Page Wrapper #app -->
    <div id="app" class="page-start" style ="min-height: 100vh">
        @if(strpos(Request::url(), 'login') === false)
            @include('frontend.layouts.partials.header-nav')
        @endif

        <!-- Start Pages Part -->
        @yield('content')
        <!-- End Pages Part -->
    </div>


    @include('frontend.layouts.partials.scripts')
</body>

</html>