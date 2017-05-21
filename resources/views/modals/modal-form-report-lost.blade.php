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
      <form id="form-report-lost-form" action="" method="post">
        <div class="row">
          <div id="form-report-lost-tab-1" class="form-report-lost-tab">
            <div class="col-lg-6 col-md-6">
              <div class="form-group" style="margin-bottom: 32px;">
                <label>Estado</label>
                <div class="pet-type">
                    <input type="radio" name="pet_status" id="pet_lost" value="lost">
                    <label for="pet_lost">Perdió</label>
                    <input type="radio" name="pet_status" id="pet_found" value="found">
                    <label for="pet_found">Encontró</label>
                </div>
              </div>
              <div class="form-group" id="name_div" style="margin-bottom: 32px;">
                <label>Nombre</label>
                <input type="text" name="lost_pet_name" class="form-control">
              </div>
              <div class="form-group" style="margin-bottom: 32px;">
                <label>Raza</label>
                <select class="form-control" name="lost_pet_race">
                  <option value="dog">Perro</option>
                  <option value="cat">Gato</option>
                </select>
              </div>
              <div class="form-group">
                <label>Género</label>
                <select class="form-control" name="lost_pet_gender">
                  <option value="male">Macho</option>
                  <option value="female">Hembra</option>
                </select>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Foto</label>
                <div class="btn-block clearfix">
                  <input type="file" id="lost_pet_file" class="filestyle lost-upload" data-buttonText="Sube una foto" data-input="false" data-iconName="glyphicon-plus" data-classButton="btn btn-primary">
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
                <textarea name="lost_pet_description" class="form-control" rows="5"></textarea>
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
                    <input type='text' name="lost_pet_date" class="form-control" id='datepicker'/>
                  </div>
                  <div class="input-group form-time date">
                    <input type='text' name="lost_pet_time" class="form-control" id='timepicker'/>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Descripción del reporte</label>
                <p class="help-block">(150 caracteres max)</p>
                <textarea name="lost_pet_report_description" class="form-control" rows="8"></textarea>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Última vez visto</label>
                <input type="text" name="lost_pet_last_seen" id="pac-input" class="form-control">
                <input type="hidden" name="lost_pet_last_address" id="pac-address" class="form-control">
                <input type="hidden" name="lost_pet_department" id="pac-department" class="form-control">
                <input type="hidden" name="lost_pet_city" id="pac-city" class="form-control">
                <input type="hidden" name="lost_pet_district" id="pac-district" class="form-control">
                <input type="hidden" name="lost_pet_latitude" id="pac-latitude" class="form-control">
                <input type="hidden" name="lost_pet_longitude" id="pac-longitude" class="form-control">
                <input type="hidden" name="lost_pet_postal_code" id="pac-postal_code" class="form-control">
                <!--iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3902.7172994695616!2d-77.07001798571204!3d-11.99405284418647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105ce576243f53f%3A0xaae76d5bd5892e99!2sArguedas%2C+Lima+15301!5e0!3m2!1ses-419!2spe!4v1464324577124" width="100%" height="206" frameborder="0" style="border:0" allowfullscreen></iframe-->
                <div id="pet-lost-map" style="width:100%;">
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
                <input type="text" name="lost_pet_owner_name" class="form-control" value="{{ Auth::user()? Auth::user()->name:'' }}">
              </div>
              <div class="form-group">
                <label>Nombre de contacto</label>
                <input type="text" name="lost_pet_contact_name" class="form-control" value="{{ Auth::user()? Auth::user()->name:'' }}">
              </div>
              <div class="form-group">
                <label>Recompensa</label>
                <p class="help-block">(en soles)</p>
                <input type="text" name="lost_pet_reward" class="form-control">
                <p class="description-block">Opcional*</p>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Email de contacto #1</label>
                <input type="text" name="lost_pet_contact_email" class="form-control" value="{{ Auth::user()? Auth::user()->email:'' }}">
              </div>
            </div>
            <div class="col-lg-12 col-md-12 center-block">
              <div class="form-group form-actions">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary btn-button btn-lg btn-submit-report">Finalizar</button>
              </div>
            </div>
          </div>
       
      </div>
           </form>
    </div>
  </div>
</div>