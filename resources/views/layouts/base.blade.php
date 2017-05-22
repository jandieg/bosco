<!DOCTYPE html>
<html lang="es">
  <head>
		<title>@section('title') @show </title>
		@section('metas')
		@show
		@section('css')@show
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/yui-reset.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bosco.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cropper.css') }}">
  </head>
  <body>
    @include('blocks.block-menu')
		@yield('content')
		@include('blocks.block-footer')
		@include('modals.modal-form-user')
    @include('modals.modal-pets-detail')
    @include('modals.modal-form-report-cropper')
    @include('modals.modal-reports-detail-lost')
    @include('modals.modal-reports-detail-founds')
    @include('modals.modal-form-report-lost')
    @include('modals.modal-form-report-founds')
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/moment-with-locales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-filestyle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/cropper.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bosco.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6kUmkn79fl1DsSaFQLDxhefSwVYjiOtI&libraries=places&callback=initMap"
         async defer></script>
    @section('js')@show
    
  </body>
</html>