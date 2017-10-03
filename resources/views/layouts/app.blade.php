<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME','Truck Trips') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">

    <link href="/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="/assets/js/plugins/pickers/datetimepicker/datetimepicker.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/app.css" rel="stylesheet" type="text/css">

    <script>
        window.html = {};
        window.truck = {
            csrf: "{{ csrf_token() }}"
        }
    </script>

</head>
<body>

@include('components.navbar')
<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

    {{--@if(isset($sidebar))--}}
        @include('components.sidebar.sidebar')
    {{--@endif--}}
    <!-- Main content -->
        <div class="content-wrapper">
            {{--            @if(isset($title) || isset($breadcrumbs))--}}
                @include('components.header')
            {{--@endif--}}
            <div class="content">

                @stack('content')

                <div class="footer text-muted">
                    &copy; 2015. Truck Log
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/assets/js/plugins/loaders/pace.min.js"></script>
<script type="text/javascript" src="/assets/js/core/libraries/jquery.min.js"></script>
<script type="text/javascript" src="/assets/js/core/libraries/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/js/plugins/loaders/blockui.min.js"></script>
{{--<script type="text/javascript" src="/assets/js/plugins/visualization/d3/d3.min.js"></script>--}}
{{--<script type="text/javascript" src="/assets/js/plugins/visualization/d3/d3_tooltip.js"></script>--}}
{{--<script type="text/javascript" src="/assets/js/plugins/forms/styling/switchery.min.js"></script>--}}
{{--<script type="text/javascript" src="/assets/js/plugins/forms/styling/uniform.min.js"></script>--}}
{{--<script type="text/javascript" src="/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>--}}
<script type="text/javascript" src="/assets/js/plugins/ui/moment/moment.min.js"></script>
<script type="text/javascript" src="/assets/js/plugins/pickers/daterangepicker.js"></script>
<script type="text/javascript" src="/assets/js/plugins/forms/selects/select2.min.js"></script>
{{--<script type="text/javascript" src="/assets/js/plugins/forms/inputs/formatter.min.js"></script>--}}
<script type="text/javascript" src="/assets/js/plugins/pickers/datetimepicker/datetimepicker.min.js"></script>
<script type="text/javascript" src="/assets/js/app/app.js"></script>
<script type="text/javascript" src="/assets/js/app/form2.js"></script>
<script type="text/javascript" src="/assets/js/app/trip/services.js"></script>
<script type="text/javascript" src="/assets/js/app/trip/places.js"></script>

<script type="text/javascript"
        src="/assets/js/plugins/jquery_remember_state/source/javascripts/jquery.remember-state.js"></script>

<script type="text/javascript" src="/assets/js/plugins/editors/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/assets/js/plugins/editors/cookie/cookie.js"></script>
<script type="text/javascript" src="/assets/js/plugins/forms/wizards/steps.min.js"></script>
<script type="text/javascript" src="/assets/js/plugins/pickers/pickadate/picker.js"></script>
<script type="text/javascript" src="/assets/js/plugins/pickers/pickadate/picker.time.js"></script>

<script type="text/javascript" src="/assets/js/app/modalView.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7AJQm_b46ubAguGaokhuD307T8cRqGas&libraries=places"></script>
<script type="text/javascript" src="/assets/js/app/gooAutComp.js"></script>
<script type="text/javascript" src="/assets/js/app/gooMaps.js"></script>

<script type="text/javascript" src="/assets/js/core/app.js"></script>
@stack('scripts')

</body>
</html>

