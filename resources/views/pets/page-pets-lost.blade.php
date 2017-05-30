@extends('layouts.base')
@section('content')

<!-- Header Content -->
<div class="header-content">
  <div class="container-fluid">

    <!-- Block Buttons -->
    <div class="row">
      <div class="block-buttons">
        <div class="col-md-12 col-lg-12 text-center">
          <a href="{{url('/mascotas/perdidos')}}" class="btn btn-lg {{ (Request::is('mascotas') || Request::is('mascotas/perdidos')) ? 'btn-primary' : 'btn-default' }}">Perdidos</a>
          <a href="{{url('/mascotas/encontrados')}}" class="btn btn-lg {{ (Request::is('mascotas/encontrados')) ? 'btn-primary' : 'btn-default' }}">Encontrados</a>
        </div>
      </div>
    </div>

  </div>
</div>

<section id="content"> 
  <div class="container">

     @include('blocks.block-filters',['type'=>'perdidos'])

    <!-- Block Images -->
    <div class="row">
      <div id="block-gallery-lost" class="block-gallery clearfix">
        <div class="view-content">
        @if(!empty($reports['data']))
          <ul class="pets-list text-left">
          @foreach($reports['data'] as $item)
            <li>
              <a data-toggle="modal"><!--href="#pet-detail"-->
                <img src="{{ asset('images/pets/' . $item['image']) }}" />
                <div class="gallery-item-hover" onclick="gallery_item_over({{ $item['id'] }})">
                  {!! $item['description'] !!}
                </div>
                <div class="gallery-item-detail">
                  <h2>{{ $item['name'] }}</h2>
                  <p class="gallery-item-birthday">{{ $item['date'] }}</p>
                  <p class="gallery-item-location">{{ $item['address'] }}</p>
                </div>
              </a>
            </li>
            @endforeach
          </ul>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>


@endsection

@section('js')
@endsection