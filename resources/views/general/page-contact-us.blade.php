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
            <p>¿Tienes alguna sugerencia? Cuéntanosla por este medio o  escribiendonos a <a href="mailto:sugerencias@bosco.pe">sugerencias@bosco.pe</a></p>
          </div>
          <div class="form-contact clearfix">
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <input type="text" placeholder="Nombre" value="" class="form-control">
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <input type="password" placeholder="Email" value="" class="form-control">
              </div>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <textarea placeholder="Mensaje" rows="10" class="form-control"></textarea>
              </div>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="form-group form-actions">
                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Enviar">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection