<div id="form-user" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
  <div class="modal-content">
    <div id="form-user-login" class="form-user">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Ingresa</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <form role="form" method="POST" action="{{ url('/login') }}">
              {{ csrf_field() }}
              <div class="form-group">
                <input name="email" type="email" class="form-control" placeholder="Email">
              </div>
              <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="Contraseña">
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input name="remember" type="checkbox"> Recordarme
                      </label>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div style="margin-top:10px;">
                    <a target="_blank" href="{{ url('recuperar-contrasena') }}">Olvidé contraseña</a>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Ingresar</button>
              </div>
              <div class="form-group">
                <a style="color:#fff" href="{{ url('iniciar-sesion/fb') }}" class="btn btn-facebook btn-lg btn-block btn-facebook">Ingresa con Facebook</a>
              </div>
              <div id="login-message" style="display: none"></div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <p>¿No tienes una cuenta? <a data-form="form-user-register" href="#">Regístrate</a></p>
      </div>
    </div>
    <div id="form-user-register" class="hide form-user">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Registrar</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <form role="form" method="POST" action="{{ url('/registro') }}">
              {{ csrf_field() }}
              <div class="form-group">
                <input name="name" type="text" class="form-control" placeholder="Nombre">
              </div>
              <div class="form-group">
                <input name="email" type="email" class="form-control" placeholder="Email">
              </div>
              <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="Contraseña">
              </div>
              <div class="form-group">
                <input name="password_confirmation" type="password" class="form-control" placeholder="Confirmar contraseña">
              </div>
              <div class="form-group">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="terms"> Acepto los <a target="_blank" href="{{ url('terminos-y-condiciones') }}">Términos y Condiciones</a>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Registrar</button>
              </div>
              <div id="register-message" style="display: none"></div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <p>¿Tienes una cuenta? <a data-form="form-user-login" href="#">Ingresa</a></p>
      </div>
    </div>
  </div>
</div>