@extends('layouts.base')
@section('content')
<section id="content">
  <div class="container-fluid">

    <!-- Block Works -->
    <div class="row">
      <div class="page-content clearfix">
        <div id="contact-us" class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
          <h3>¡Contáctenos!</h3>
          <div class="page-content-detail">
            <p>¿Tienes alguna sugerencia? Cuéntanosla por este medio o escríbenos a <a href="mailto:hola@bosco.pe">hola@bosco.pe</a></p>
          </div>
          <div class="form-contact clearfix">
          <form id="form-contact-us-form" action="" method="post">     
          {{ csrf_field() }}     
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <input type="text" placeholder="Nombre" value="" class="form-control" name="nombre_contacto">
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <input type="text" placeholder="Email" value="" class="form-control" name="email_contacto">
              </div>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <textarea placeholder="Mensaje" rows="10" class="form-control" name="mensaje_contacto"></textarea>
              </div>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="form-group form-actions">
                <button class="btn btn-primary btn-lg btn-block btn-submit-contact">Enviar</button>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection