@extends('layouts.home')
@section('content')

<section id="content" class="section-works">

    <!-- Block  -->
    <div class="row">
      <div class="block-team">
        <div class="block-team-background"></div>
        <div class="block-team-content">
          <h2>El equipo</h2>
          <div class="red-underline"></div>
          <div class="red-underline"></div>
          <h4>Somos una comunidad creciente enfocada en ayudar a encontrar mascotas perdidas.</h4>
        </div>
      </div>
    </div>

    <!-- Block Works -->
    <div class="row">
      <div class="block-about-us clearfix">
        <div class="block-about-us-item col-lg-4 col-md-4 col-sm-4">
          <a href="#">
            <div class="block-about-us-background"></div>
            <div class="block-about-us-detail">
              <h3>¿Quiénes somos?</h3>
              <p>Somos una comunidad creciente enfocada en encontrar mascotas perdidas.</p>
            </div>
            <img src="{{ asset('images/about_us_item_2.png') }}">
            <span class="block-about-us-line"></span>
          </a>
        </div>
        <div class="block-about-us-item col-lg-4 col-md-4 col-sm-4">
          <a href="#">
            <div class="block-about-us-background"></div>
            <div class="block-about-us-detail">
              <h3>¿Por qué lo hacemos?</h3>
              <p>Porque una mascota es parte de una familia y no hay nada más importante que la seguridad y protección de los que más queremos.</p>
            </div>
            <img src="{{ asset('images/about_us_item_3.png') }}">
            <span class="block-about-us-line"></span>
          </a>
        </div>
        <div class="block-about-us-item col-lg-4 col-md-4 col-sm-4">
          <a href="#">
            <div class="block-about-us-background"></div>
            <div class="block-about-us-detail">
              <h3>¿Cómo lo hacemos?</h3>
              <p>Trabajando en equipo para brindar tecnología orientada al cuidado y protección de las mascotas.</p>
            </div>
            <img src="{{ asset('images/about_us_item_4.png') }}">
            <span class="block-about-us-line"></span>
          </a>
        </div>
      </div>
    </div>
</section>

@endsection