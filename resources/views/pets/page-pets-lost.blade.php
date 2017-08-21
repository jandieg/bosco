@extends('layouts.base')
@section('content')

<!-- Header Content -->
<div class="header-content">
  <div class="container-fluid">

    <!-- Block Buttons -->
    <div class="row">
      <div class="block-buttons">
        <div class="col-md-12 col-lg-12 text-center">
          <a href="{{url('/mascotas/perdidos')}}" class="btn btn-lg {{ (Request::is('mascotas') || Request::is('mascotas/perdidos')) ? 'btn-primary' : 'btn-default' }}">Perdidas</a>
          <a href="{{url('/mascotas/encontrados')}}" class="btn btn-lg {{ (Request::is('mascotas/encontrados')) ? 'btn-primary' : 'btn-default' }}">Encontradas</a>
        </div>
      </div>
    </div>

  </div>
</div>

<section id="content"> 
  <div class="container">

     @include('blocks.block-filters-lost',['type'=>'perdidos'])

    <!-- Block Images -->
          <div class="alert alert-warning" style="display:none;" id="warning">
            Location access is blocked for this application.
          </div>
    <div class="row">
      <div id="block-gallery-lost" class="block-gallery clearfix">
        <div class="view-content">
          <div class="alert alert-info" style="display:none;" id="noRecords">
            No hay mascotas perdidas en este rango
          </div>
          <div class="alert alert-danger" style="display:none;" id="error">
            Error occured while getting the data.
          </div>
          <ul class="pets-list text-left centradas">
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection

@section('js')
@endsection
@if (session('openLogin'))
    <script>
    document.addEventListener("DOMContentLoaded", function() {    
      document.querySelector('[href="#form-user"]').click();
      document.querySelector('.block-help-container').style.height = 'auto';
    });
    </script>
@endif