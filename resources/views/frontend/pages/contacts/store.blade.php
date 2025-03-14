@extends('frontend.layouts.app')

@section('content')

<!-- Contact Info Page -->
<section class="page-resume-editor page-contact-info">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="sidebar">
                    <ul class="vertical-center">
                        <li class="w3-opacity-max"> <i class="fas fa-phone-volume"></i> Contact Info</li>
                        <li> <i class="fas fa-briefcase"></i> Work History</li>
                        <li class="w3-opacity-max"> <i class="fas fa-book-open"></i> Education</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="resume-editor-div">
                    <h2>
                        <span class="icon"><i class="fa fa-briefcase"></i></span>
                        Work History</h2>

                    <!-- Contact Form -->
                    <form action="" class="mt-3 contact-form">
                        <div class="row justify-content-center">
                            <div class="col-md-3 col-sm-12 group mr-2 " >
                                <div class="" style="display: inline-block">
                                    <input type="text" required>
                                    <!-- <span class="highlight"></span> -->
                                    <span class="bar"></span>
                                    <label>First Name*:</label>
                                </div>
                                <span><img src="{{ asset('images/bg/logo.png') }}" alt="{{ config('app.name') }}" class="small_logo"></span>
                            </div>

                            <div class="col-md-3 col-sm-12 group mr-2 ">
                                <div class="">
                                    <input type="text" required>
                                    <!-- <span class="highlight"></span> -->
                                    <span class="bar"></span>
                                    <label>Last Name*:</label>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12 group mr-2 ">
                                <div class="">
                                    <input type="text" required>
                                    <!-- <span class="highlight"></span> -->
                                    <span class="bar"></span>
                                    <label>Middle Initial:</label>
                                </div>
                            </div>
                        </div> <!-- end .row -->

                        <div class="row justify-content-center">
                            <div class="col-md-3 col-sm-12 group mr-2 ">
                                <div class="">
                                    <input type="text" required>
                                    <!-- <span class="highlight"></span> -->
                                    <span class="bar"></span>
                                    <label>Street Address:</label>
                                </div>
                                <span><img src="{{ asset('images/bg/logo.png') }}" alt="{{ config('app.name') }}" class="small_logo"></span>
                            </div>

                            <div class="col-md-7 col-sm-12">
                                <div class="row">
                                    <div class="col-md-5 col-sm-12 group mr-2">
                                        <div class="">
                                            <input type="text" required>
                                            <!-- <span class="highlight"></span> -->
                                            <span class="bar"></span>
                                            <label>City*:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-12 group">
                                        <div class="">
                                            <select name="state" id="state" class="select-item">
                                                <option value="0"></option>
                                                <option value="1">State 1</option>
                                                <option value="2">State 2</option>
                                            </select>
                                            <!-- <span class="highlight"></span> -->
                                            <span class="bar"></span>
                                            <label class="select-label">State*:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-12 group mr-2">
                                        <div class="">
                                            <select name="country" id="country" class="select-item">
                                                <option value="0"></option>
                                                <option value="1">country 1</option>
                                                <option value="2">country 2</option>
                                            </select>
                                            <!-- <span class="highlight"></span> -->
                                            <span class="bar"></span>
                                            <label class="select-label">Country*:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-12 group">
                                        <div class="">
                                            <input type="text" required>
                                            <!-- <span class="highlight"></span> -->
                                            <span class="bar"></span>
                                            <label>Postal Code*:</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end .row -->


                        <div class="row justify-content-center">
                            <div class="col-md-6 col-sm-12 group mr-2 ">
                                <div class="">
                                    <input type="text" required>
                                    <!-- <span class="highlight"></span> -->
                                    <span class="bar"></span>
                                    <label>Phone *:</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 group mr-2 ">
                                <div class="">
                                    <input type="text" required>
                                    <!-- <span class="highlight"></span> -->
                                    <span class="bar"></span>
                                    <label>Email Address *:</label>
                                </div>
                            </div>
                        </div> <!-- end .row -->


                        <div class="row justify-content-center">
                            <div class="col-md-6 col-sm-12 group mr-2 ">
                                <div class="">
                                    <input type="text" required>
                                    <!-- <span class="highlight"></span> -->
                                    <span class="bar"></span>
                                    <label>Professional Profile:</label>
                                </div>
                                <span><img src="{{ asset('images/bg/logo.png') }}" alt="{{ config('app.name') }}" class="small_logo"></span>
                            </div>
                            <div class="col-md-6 col-sm-12 group mr-2 ">
                                <div class="">
                                    <input type="text" required>
                                    <!-- <span class="highlight"></span> -->
                                    <span class="bar"></span>
                                    <label>Professional Website/Blog:</label>
                                </div>
                            </div>
                        </div> <!-- end .row -->

                        <div class="text-center">
                            <button class="btn btn-primary btn-rounded btn-next mt-4" type="submit">
                                <span class>Next</span>
                                <span class="pl-5">
                                    <i class="next-icon fas fa-chevron-right"></i>
                                </span>
                            </button>
                        </div>
                    </form>

                </div> <!-- end resume-editor-div -->

                <div class="resume-bottom">
                    <div class="row mt-3">
                        <div class="col-md-8 col-sm-12">
                            <ul class="footer-ul-links">
                                <li><a href="">Sitemap</a></li>
                                <li><a href="">Privacy Policy</a></li>
                                <li><a href="">Terms of Use</a></li>
                                <li><a href="">About Us</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <p class="text-center">
                                2024 Resume Yak. All rights reserved
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- End Contact Info Page -->
@endsection
@section('stylesheets')
<style>
    #app {
        background: url(/builder/images/bg/bg-resume-editor.png);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
@endsection