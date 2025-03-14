<!-- Header Part -->

<!-- <script>
    // localStorage.getItem("visited")
    var vis = localStorage.getItem("visited");
    if (vis === 'false') {
        var php = '<?php $visited = 'false'; ?>';
    }
</script> -->
<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container main-yak-logo">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img class="cursor-pointer" style="width: 150px;" src="{{ asset('images/logo/logo.png') }}"
                    alt="{{ config('app.name') }}" class="logo">
            </a>
            <span class="icon icon_menu" id="click-to-see-menu"><i class="fas fa-bars"></i></span>
            <!-- <resume-header-file/> -->

            @if (Route::currentRouteAction() != 'App\Http\Controllers\Frontend\PagesController@index')
                <resume-header-file />
            @endif
        </div>
    </nav>

</header>
<!-- <script>
    alert();
</script> -->
<!-- End Header Part -->
