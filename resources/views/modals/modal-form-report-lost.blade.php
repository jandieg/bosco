<div id="form-report-lost" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
  <div class="modal-form-report modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <div class="modal-form-report-menu">
        <ul class="text-center">
          <li><span id="tab-1" data-tab="tab-1" class="tab-on"><em>1</em>Mascota</span></li>
          <li><span id="tab-2" data-tab="tab-2"><em>2</em>Reporte</span></li>
          <li><span id="tab-3" data-tab="tab-3"><em>3</em>Dueño</span></li>
        </ul>
      </div>
    </div>
    <div class="modal-body">
      <form id="form-report-lost" action="" method="post">
        <div class="row">
          <div id="form-report-lost-tab-1" class="form-report-lost-tab">
            <div class="col-lg-6 col-md-6">
              <div class="form-group" style="margin-bottom: 32px;">
                <label>Tipo</label>
                <div class="pet-type">
                  <input type="radio" name="petType" value="0"><label>Perro</label>
                  <input type="radio" name="petType" value="1"><label>Gato</label>
                </div>
              </div>
              <div class="form-group" style="margin-bottom: 32px;">
                <label>Nombre</label>
                <input type="text" class="form-control">
              </div>
              <div class="form-group" style="margin-bottom: 32px;">
                <label>Raza</label>
                <select class="form-control" name="race">
                  <option value="dog">Perro</option>
                  <option value="cat">Gato</option>
                </select>
              </div>
              <div class="form-group">
                <label>Género</label>
                <select class="form-control" name="gender">
                  <option value="male">Macho</option>
                  <option value="female">Hembra</option>
                </select>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Foto</label>
                <div class="btn-block clearfix">
                  <input type="file" class="filestyle lost-upload" data-buttonText="Sube una foto" data-input="false" data-iconName="glyphicon-plus" data-classButton="btn btn-primary">
                </div>
                <div class="upload-image-lost-preview">
                  <input type="file" class="lost-upload" style="display:none">
                  <div class="preview-img"></div>
                  <img class="fileopen-img" src="../img/icon-edit-white.png">
                </div>
              </div>
              <div class="form-group">
                <label>Descripción de mascota</label>
                <p class="help-block">(150 caracteres max)</p>
                <textarea class="form-control" rows="5"></textarea>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 center-block">
              <div class="form-group form-actions">
                <button type="button" data-tab="tab-2" class="btn btn-primary btn-button btn-lg btn-next">Siguiente</button>
              </div>
            </div>
          </div>
          <div id="form-report-lost-tab-2" class="form-report-lost-tab hide">
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Fecha y hora de desaparición</label>
                <div class="clearfix">
                  <div class="input-group form-date date">
                    <input type='text' class="form-control" id='datepicker'/>
                  </div>
                  <div class="input-group form-time date">
                    <input type='text' class="form-control" id='timepicker'/>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Descripción del reporte</label>
                <p class="help-block">(150 caracteres max)</p>
                <textarea class="form-control" rows="8"></textarea>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Última vez visto</label>
                <input type="text" class="form-control">
                <!--iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3902.7172994695616!2d-77.07001798571204!3d-11.99405284418647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105ce576243f53f%3A0xaae76d5bd5892e99!2sArguedas%2C+Lima+15301!5e0!3m2!1ses-419!2spe!4v1464324577124" width="100%" height="206" frameborder="0" style="border:0" allowfullscreen></iframe-->
                <div id="pet-lost-map">
                 </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 center-block">
              <div class="form-group form-actions">
                <button type="button" data-tab="tab-3" class="btn btn-primary btn-button btn-lg btn-next">Siguiente</button>
              </div>
            </div>
          </div>
          <div id="form-report-lost-tab-3" class="form-report-lost-tab hide">
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Nombre de dueño</label>
                <input type="text" class="form-control" value="{{ Auth::user()->name }}">
              </div>
              <div class="form-group">
                <label>Nombre de contacto</label>
                <input type="text" class="form-control" value="{{ Auth::user()->name }}">
              </div>
              <div class="form-group">
                <label>Recompensa</label>
                <p class="help-block">(en soles)</p>
                <input type="text" class="form-control">
                <p class="description-block">Opcional*</p>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Email de contacto #1</label>
                <input type="text" class="form-control" value="{{ Auth::user()->email }}">
              </div>
            </div>
            <div class="col-lg-12 col-md-12 center-block">
              <div class="form-group form-actions">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary btn-button btn-lg btn-submit-report">Finalizar</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>