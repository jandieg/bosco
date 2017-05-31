@extends('layouts.base')
@section('content')

<section id="content">
  <div class="container-fluid">

    <!-- Block Works Item -->
    <div class="row">
      <div id="block-works-item-app" class="block-works-item clearfix">
        <a href="{{ url('como-funciona') }}" class="block-works-item-return">Regresar</a>
        <a href="#" class="block-works-item-link"></a>
        <img src="{{ asset('images/work_app.png') }}">
        <div class="block-works-item-detail">
          <div class="col-lg-9 col-lg-offset-2 col-md-10 col-md-offset-1">
            <h3>App</h3>
            <ul>
              <li>
                <div class="block-works-item-tag clearfix">
                  <em class="works-item-app-tag-1"></em>
                  <div>
                    <p>Reportar</p>
                    <p>Si tu mascota se pierde, puedes reportarla como perdida a trav¨¦s de la aplicaci¨®n.</p>
                  </div>
                </div>
              </li>
              <li>
                <div class="block-works-item-tag clearfix">
                  <em class="works-item-app-tag-2"></em>
                  <div>
                    <p>Growd GPS</p>
                    <p>Cada smartphone con el app funciona como un radar de b¨²squeda para encontrarla.</p>
                  </div>
                </div>
              </li>
              <li>
                <div class="block-works-item-tag clearfix">
                  <em class="works-item-app-tag-3"></em>
                  <div>
                    <p>Encontrado</p>
                    <p>Tan pronto como un usuario pase cerca de ella, te mandaremos la ubicaci¨®n excata donde fue vista.</p>
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