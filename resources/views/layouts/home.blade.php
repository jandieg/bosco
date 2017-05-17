<!DOCTYPE html>
<html lang="es">
  <head>
		<title>@section('title') @show </title>
		@section('metas')
		@show
		@section('css')@show
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/yui-reset.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bosco.css') }}">
  </head>
  <body id="home-page">

    @include('blocks.block-menu')
		@yield('content')
		@include('blocks.block-footer')
		@include('modals.modal-form-user')

    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/moment-with-locales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-filestyle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bosco.js') }}"></script>
    @section('js')@show

  </body>
</html>