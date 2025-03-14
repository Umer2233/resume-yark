@extends('frontend.layouts.app')

@section('content')
<!-- Contact Info Page -->

        @if (strpos(Request::url(), 'login') !== false )
      <section class="page-contact-info">
        @else
      <section class="page-resume-editor page-contact-info">
        @endif
        <div class="container space-remove-mobile">
            <router-view field_firstname="{{ $fieldtipsarray['firstName'] }}"
                field_streetaddress="{{ $fieldtipsarray['streetaddress'] }}"
                field_profile="{{ $fieldtipsarray['profile'] }}" field_position="{{ $fieldtipsarray['position'] }}"
                field_positionclassification="{{ $fieldtipsarray['PositionClassification'] }}"
                field_educationschool="{{ $fieldtipsarray['educationSchool'] }}"
                field_educationdegree="{{ $fieldtipsarray['educationDegree'] }}"
                field_educationgradyear="{{ $fieldtipsarray['educationGradyear'] }}"
                field_educationgradmonth="{{ $fieldtipsarray['educationGradmonth'] }}"
                field_educationmajor="{{ $fieldtipsarray['educationMajor'] }}"></router-view>
        </div>
    </section>
    <!-- End Contact Info Page -->
    @endsection
    @section('stylesheets')
    <style>
    /* #app {
            background: url(/resume-yawk/builder/public/images/bg/bg-resume-editor.png);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        } */
    </style>
    @endsection
