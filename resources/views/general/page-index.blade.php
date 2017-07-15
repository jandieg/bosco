@extends('layouts.home')
@section('content')
<section id="content" class="bg-home">
  <div id="page-home" class="container-fluid">

    <!-- Block Video -->
    <div class="row">
      <div class="block-video">
        <div class="arrow-down"></div>
        <div class="block-video-content">
          <p>Un amor tan grande, no merece ser separado</p>
          <a href="mis-reportes" class="btn btn-video">Reportar mascota</a>
        </div>
      </div>
    </div>



    <!-- Block Partners -->
    <div class="row">
      <div class="block-partners clearfix">
        <ul>
          <li><a href="#"><img src="{{ asset('images/partners/logo_startup_peru.png') }}"></a></li>
          <li><a href="#"><img src="{{ asset('images/partners/logo_pucp.png') }}"></a></li>
          <!--li><a href="#"><img src="{{ asset('images/partners/logo_universidad_delima.png') }}"></a></li-->
          <li><a href="#"><img src="{{ asset('images/partners/logo_wuf.png') }}"></a></li>
          <li><a href="#"><img src="{{ asset('images/partners/logo_voz_animal.png') }}"></a></li>
          <li><a href="#"><img src="{{ asset('images/partners/logo_sos_veterinaria.png') }}"></a></li>
        </ul>
      </div>
    </div>

    <!-- Block Help -->
    <div class="row" >
      <div class="block-help clearfix">
        <div class="block-help-background"></div>
        <div class="block-help-container">
          <div class="block-help-title">
            <h2>Ayudamos a encontrar mascotas perdidas en 4 pasos</h2>
            <h5>Bosco ayuda a encontrar mascotas perdidas y tambien a reportar aquellas encontradas en la calle</h5>
          </div>
          <div class="block-help-content">
              <div class="col-lg-9 col-lg-offset-2 col-md-9 col-md-offset-2 col-sm-10 col-sm-offset-2">
                  <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="block-works-item-tag clearfix">
                      <img src="../img/Icono_1.png">
                      <div>
                        <strong>1 - Mascotas perdidas</strong>
                        <p>Ingresa a la sección mascotas perdidas" en la parte superior.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="block-works-item-tag clearfix">
                      <img src="../img/Icono_2.png">
                      <div>
                        <strong>2 - Selecciona el tipo de reporte</strong>
                        <p>Selecciona el tipo de reporte a generar; mascota perdida o mascota encontrada.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="block-works-item-tag clearfix">
                      <img src="../img/Icono_3.png">
                      <div>
                        <strong>3-Rellena tus datos</strong>
                        <p>Completa tus datos, Ios de tu mascota, los detalles del reporte y listo.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="block-works-item-tag clearfix">
                      <img src="../img/Icono_4.png">
                      <div>
                        <strong>4 - Volante al instante</strong>
                        <p>Adicional, se genera un volante que puedes imprimir y/o compartir en redes sociales.</p>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
          <div class="block-help-start">
            &nbsp;
          </div>
        </div>
      </div>
    </div>

    <!-- Block Recent -->
    <div class="row" >
      <div class="block-recent clearfix">
        <div class="block-recent-title">
          <h2>Agregados recientemente</h2>
          <div class="red-underline"></div>
          <div class="red-underline"></div>
        </div>
        <div class="block-recent-content">
          @include('blocks.page-pets-recent')
        </div>
        <div class="block-recent-more pull-right">
          <a href="/mascotas" class="btn btn-lg btn-default">Ver mas</a>
        </div>
      </div>
    </div>

    @include('blocks.block-subscription')

  </div>
</section>
@endsection

@if (session('openLogin'))
    <script>
    document.addEventListener("DOMContentLoaded", function() {    
      document.querySelector('[href="#form-user"]').click();
    });
    </script>
@endif