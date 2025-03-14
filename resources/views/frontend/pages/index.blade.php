@extends('frontend.layouts.app')


@section('content')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log(window.innerWidth, 'window.innerWidth');

            const menuElement = document.querySelector("#click-to-see-menu");

            function updateMenuDisplay() {
                if (window.innerWidth < 450) {
                    if (menuElement) menuElement.style.display = "none";
                } else {
                    if (menuElement) menuElement.style.display = "none";
                }
            }
            updateMenuDisplay();

            window.addEventListener("resize", function() {
                updateMenuDisplay();
            });
        });
    </script>

    <!-- HomePage Starting Resume -->
    <section class="home-page-image-main new-top-header-menu">
        <div class="container start-container">
            <div class="row">
                <div class="col-md-4 top-bubble">
                    <img src="{{ asset('images/bg/yak.png') }}" alt="{{ config('app.name') }}" class="yak">
                </div>
                <div class="col-md-8">
                    <div class="start-info">
                        <h3 class="welcome-title mobile-text-heading">Welcome to Resume Yak</h3>
                        <div class="start-description">
                            <p>
                                My name is Norbu, and for the next 30 to 60 minutes I
                                will <del>torture you</del> help you <strong>create the best resume!</strong> There
                                are plenty of other tools out there that will help you
                                create a mediocre resume in less time, but I will help
                                you create a resume or resumes that will help you land
                                job interviews.
                            </p>
                            <p>
                                If you want a resume that will stand out, you will need
                                to put the time into it. However, you can stop and take a
                                break anytime. In fact, I encourage it.
                            </p>
                            <p>
                                As you create your resume, click, tap or lick my face icon
                                next to inputs like the checkbox below to get
                                professional tips. You can also click on the logo to get
                                even more advice.
                            </p>
                            <!-- Vue JS Page Start Component -->
                            <page-start tooltip="{{ $tick_tip }}" url={{ url('/') }}></page-start>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('images/bg/yak.png') }}" alt="{{ config('app.name') }}"
                        class="yak mobile-yawk-image-box">
                </div>
            </div>
        </div>
    </section>
    <!-- End HomePage Starting Resume -->
@endsection
