@extends('layouts.base')
@section('content')

<section id="content">
  <div class="container-fluid">

    <!-- Block Works Item -->
    <div class="row">
      <div id="block-works-item-web" class="block-works-item clearfix">
        <a href="{{ url('como-funciona') }}" class="block-works-item-return">Regresar</a>
        <a href="#" class="block-works-item-link"></a>
        <img src="{{ asset('images/work_web.png') }}">
        <div class="block-works-item-detail">
          <div class="col-lg-9 col-lg-offset-2 col-md-10 col-md-offset-1">
            <h3>Web</h3>
            <ul>
              <li>
                <div class="block-works-item-tag clearfix">
                  <em class="works-item-web-tag-1"></em>
                  <div>
                    <p>Tipo de reporte</p>
                    <p>Selecciona el tipo de reporte a generar. Mascota perdida o mascota encontrada.</p>
                  </div>
                </div>
              </li>
              <li>
                <div class="block-works-item-tag clearfix">
                  <em class="works-item-web-tag-2"></em>
                  <div>
                    <p>Datos</p>
                    <p>Llena tus datos, los de tu mascot, los detalles del reporte y publicarlo.</p>
                  </div>
                </div>
              </li>
              <li>
                <div class="block-works-item-tag clearfix">
                  <em class="works-item-web-tag-3"></em>
                  <div>
                    <p>Volante al instante</p>
                    <p>Genera automaticamente un volante par aimprimir y compartir en redes sociales.</p>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    @include('blocks.block-subscription')

  </div>
</section>

@endsection