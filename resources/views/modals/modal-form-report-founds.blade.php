<div id="form-report-founds" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
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
      <form id="form-report-found" action="" method="post">
        <div class="row">
          <div id="form-report-founds-tab-1" class="form-report-founds-tab">
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
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
                  <input type="file" class="filestyle found-upload" data-buttonText="Sube una foto" data-input="false" data-iconName="glyphicon-plus" data-classButton="btn btn-primary">
                </div>
                <div class="upload-image-found-preview">
                  <input type="file" class="found-upload" style="display:none">
                  <div class="preview-img"></div>
                  <img class="fileopen-img" src="../img/icon-edit-white.png">
              </div>
              <div class="form-group">
                <label>Descripción de mascota</label>
                <p class="help-block">(150 caracteres max)</p>
                <textarea class="form-control" rows="5"></textarea>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 center-block">
              <div class="form-group form-actions">
                <button type="button" data-tab="tab-2" class="btn btn-primary btn-button btn-lg btn-blue btn-next">Siguiente</button>
              </div>
            </div>
          </div>
          </div>
          <div action="" id="form-report-founds-tab-2" class="form-report-founds-tab hide">
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
                <label>Descripción de mascota</label>
                <p class="help-block">(150 caracteres max)</p>
                <textarea class="form-control" rows="8"></textarea>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Última vez visto</label>
                <input type="text" class="form-control">
                 <div id="pet-found-map">
                 </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 center-block">
              <div class="form-group form-actions">
                <button type="button" data-tab="tab-3" class="btn btn-primary btn-button btn-lg btn-blue btn-next">Siguiente</button>
              </div>
            </div>
          </div>
          <div action="#" id="form-report-founds-tab-3" class="form-report-founds-tab hide">
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Nombre de contacto</label>
                <input name="user[name]" type="text" class="form-control" value="{{ Auth::user()->name }}">
              </div>
              <div class="form-group">
                <label>Número de contacto</label>
                <input name="user[phone]" type="phone" class="form-control" value="{{ Auth::user()-> name }}">
              </div>
              <div class="form-group">
                <label>Recompensa</label>
                <p class="help-block">(en soles)</p>
                <input name="report[reward]" type="text" class="form-control">
                <p class="description-block">Opcional*</p>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Email de contacto #1</label>
                <input name="user[email]" type="text" class="form-control"  value="{{ Auth::user()-> email }}" disabled>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 center-block">
              <div class="form-group form-actions">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary btn-button btn-lg btn-blue">Finalizar</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>