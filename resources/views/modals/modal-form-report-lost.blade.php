<style>

      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      .pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
        z-index:20000 !important;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        width: 100%; 
        height: 36px; 
        padding: 6px 12px; 
        background-color: #fff;
        border: 1px solid #ccd0d2;
        border-radius: 4px;
        box-shadow: inset 0 1x 1px rgba(0,0,0,.075);
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
      }
      /*{
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-top:0px;
        width:100% !important;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }*/

      #pac-input:focus {
        border-color: #98cbe8; 
        outline: 0; 
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(152,203,232,.6)
      }/*{
        border-color: #4d90fe;
      }*/

      

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }
</style>
<div id="form-report-lost" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
  <div class="modal-form-report modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <div class="modal-form-report-menu">
        <ul class="text-center">
          <li id="report_tab_1"><span id="tab-1" data-tab="tab-1" class="tab-on"><em>1</em>Mascota</span></li>
          <li id="report_tab_2" onclick="Map_correction();"><span id="tab-2" data-tab="tab-2"><em>2</em>Reporte</span></li>
          <li id="report_tab_3"><span id="tab-3" data-tab="tab-3"><em>3</em>Dueño</span></li>
        </ul>
      </div>
    </div>
    <div class="modal-body" style='height:420px; overflow-y: auto;'>
      <form id="form-report-lost-form" action="" method="post">
        <div class="row">
          <div id="form-report-lost-tab-1" class="form-report-lost-tab">
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Estado</label>
                <div class="pet-type">
                    <input type="radio" name="pet_status" id="pet_lost_radio" value="lost">
                    <label for="pet_lost_radio">Perdió</label>
                    <input type="radio" name="pet_status" id="pet_found_radio" value="found">
                    <label for="pet_found_radio">Encontró</label>
                </div>
                    <input type="hidden" name="report_id" id="report_id">
              </div>
              <div class="form-group" id="name_div" style="margin-bottom: 32px;">
                <label>Nombre</label>
                <input type="text" name="lost_pet_name" id="lost_pet_name" class="form-control">
              </div>
              <div class="form-group" style="margin-bottom: 32px;">
                <label>Raza</label>
                <input type="text" name="lost_pet_race" id="lost_pet_race" class="form-control">
                <!--select class="form-control" name="lost_pet_race" id="lost_pet_race">
                  <option value="dog">Perro</option>
                  <option value="cat">Gato</option>
                </select-->
              </div>
              <div class="form-group">
                <label>Género</label>
                <select class="form-control" name="lost_pet_gender" id="lost_pet_gender">
                  <option value="macho">Macho</option>
                  <option value="hembra">Hembra</option>
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
                <textarea  placeholder="150 caracteres max"  name="lost_pet_description" id="lost_pet_description" class="form-control" rows="5"></textarea>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 center-block">
              <div class="form-group form-actions">
                <button id="goto_map_tab" type="button" data-tab="tab-2" class="btn btn-primary btn-button btn-lg btn-next">Siguiente</button>
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
                <label>¿Cómo se perdió?</label>               
                <textarea placeholder="150 caracteres max" name="lost_pet_report_description" id="lost_pet_report_description" class="form-control" rows="8"></textarea>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
              
                <label>Última vez visto</label>
                <!--
                <div id='pac-input-div'><input type="text" id="pac-input" class="form-control" placeholder="Ingresa la dirección donde se perdió o arrastra el PIN" name="lost_pet_input"></div>
                <input type="hidden" name="lost_pet_last_address" id="pac-address" class="form-control">
                <input type="hidden" name="lost_pet_department" id="pac-department" class="form-control">
                <input type="hidden" name="lost_pet_city" id="pac-city" class="form-control">
                <input type="hidden" name="lost_pet_district" id="pac-district" class="form-control">
                <input type="hidden" name="lost_pet_latitude" id="pac-latitude" class="form-control">
                <input type="hidden" name="lost_pet_longitude" id="pac-longitude" class="form-control">
                <input type="hidden" name="lost_pet_postal_code" id="pac-postal_code" class="form-control"> -->
                <div class="inputsAddress">
               
               <div class="form-group">
                <div class="col-md-4 col-sm-12">
                <label for="department">Departamento
                  <select id="dep" class="form-control">
                      @if(isset($departments))
                      <option value="">Seleccione</option>
                      @foreach($departments as $department)
                      <option value="{{ $department['department'] }}">{{ $department['department'] }}</option>
                      @endforeach
                      @endif
                  </select>
                  </label>
                </div>                                             
                <div class="col-md-4 col-sm-12">
                <label for="city">
                Ciudad
                  <select id="city" class="form-control">
                    <option value="callao">Seleccione</option>
                  </select>                
                  </label>
                </div>
                <div class="col-md-4 col-sm-12">
                <label for="distric">
                  Distrito               
                  <select id="dist" class="form-control">
                    <option value="">Seleccione</option>  
                  </select>
                  </label>
               </div>                
                </div>           
                 <div class="form-group">
                 <div class="col-md-12">
                 <label for="street">
                 Calle
                  <input maxlength="50" type="text" class="form-control" name="pet-lost-calle" id="street" placeholder="Calle / avenida" autocapitalize="words" required />               
                  </label>
                 </div>                                 
                </div>        
                <input type ="hidden" id="lat" name="pet-lost-lat" />
                <input type ="hidden" id="lng" name="pet-lost-lng" />            
                <div id="pet-lost-map" style="width:100%;height:300px;">
                 </div>
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
                <label>Teléfono de contacto</label>
                <input type="numeric" name="lost_pet_contact_name" class="form-control" value="">
              </div>
              <div class="form-group">
                <label>Recompensa</label>
                <div style='margin-top:20px;'>
                <span class="help-block" style="text-align:right;width:30px;">S/.</span>
                <input type="text" name="lost_pet_reward" id="lost_pet_reward" class="form-control numeric" style='padding-left:40px;margin-top:-35px;'>
                </div>
                <p class="description-block">Opcional*</p>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Email de contacto</label>
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