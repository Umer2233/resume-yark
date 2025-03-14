<!-- Bootstrap And Full JS Bundle With All Js Components -->
<script src="{{ asset('js/manifest.js') }}"></script>
<script src="{{ asset('js/vendor.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://kenwheeler.github.io/slick/slick/slick.js"></script>
<!-- <script type="text/javascript" src="{{ asset('js/custom/custom.js') }}"></script> -->

<!-- More Custom Script -->
@yield('scripts')

<script>
$(".template-slidre-box").slick({
    centerMode: false,
    slidesToShow: 3,
    autoplay: true,
    autoplayspeed: 500,
    dots: true,
    arrows: true,
    responsive: [{
            breakpoint: 993,
            settings: {
                arrows: true,
                centerMode: false,
                centerPadding: "0px",
                slidesToShow: 3,
            },
        },
        {
            breakpoint: 480,
            settings: {
                arrows: false,
                centerMode: false,
                centerPadding: "0px",
                slidesToShow: 1,
            },
        },
    ],
});
</script>
