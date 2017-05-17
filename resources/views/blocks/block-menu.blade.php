<header>

  <!-- Header Top -->
  <div class="header-top">
    <div class="container-fluid">

      <!-- Navigation -->
      <div class="row">
        <nav>
          <!-- Block Logo -->
          <div class="col-lg-2 col-md-2 col-sm-2 block-logo text-center">
            <h1><a href="{{ url('/')}}">bosco</a></h1>
          </div>
          <!-- Block Menu -->
          <div class="col-lg-8 col-md-8 col-sm-8 block-menu">
            <div class="navbar navbar-fixed-top">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
              </div>
              <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav text-center">
                  <li class="first">
                    <a href="{{ url('/mascotas')}}" {{ (Request::is('mascotas') || Request::is('mascotas/*'))  ? ' class = "active"' : null }}>Mascotas</a>
                  </li>
                  <li>
                    <a href="{{ url('/como-funciona')}}" {{ (Request::is('como-funciona') || Request::is('como-funciona/*'))  ? ' class = "active"' : null }}>¿Como funciona?</a>
                  </li>
                  <li class="last">
                   <!-- <a href="{{ url('/ayuda')}}" {{ (Request::is('ayuda') || Request::is('ayuda/*'))  ? ' class = "active"' : null }}>Ayuda</a>-->
                     <a href="{{url('/contactanos')}}">Contáctanos</a>
                  </li>
                  <li data-toggle="modal" class="menu-item-session">
                    @if(empty($user->id))
                    <a data-toggle="modal" href="#form-user">Ingresar</a>
                    @else
                    <a href="#">{{ $user->name }} <em class="caret"></em></a>
                    <ul>
                      <li><a href="{{ url('mis-reportes') }}">Mis Reportes</a></li>
                      <li><a href="{{ url('cerrar-sesion') }}">Cerrar sesión</a></li>
                    </ul>
                    @endif
                  </li>
                </ul>
              </div><!--/.nav-collapse -->
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 block-session">
            @if(empty($user->id))
              <a data-toggle="modal" href="#form-user">Ingresar</a>
            @else
              <div class="link-user">
                <span>
                  {{ $user->name }} <em class="caret"></em>
                  <ul>
                    <li><a href="{{ url('mis-reportes') }}">Mis Reportes</a></li>
                    <li><a href="{{ url('cerrar-sesion') }}">Cerrar sesión</a></li>
                  </ul>
                </span>
              </a>
            @endif
          </div>
        </nav>
      </div>
    </div>
  </div>

</header>