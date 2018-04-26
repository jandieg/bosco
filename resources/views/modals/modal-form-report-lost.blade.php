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
  <div class="modal-form-report modal-content" style="height:90%;max-height:70em">
    <div class="modal-header" style="padding: 0px;">
      <button type="button" style="padding:.9em; color: white; opacity: 1" class="close" data-dismiss="modal" aria-hidden="true">
        <i class="glyphicon glyphicon-remove"></i>
      </button>
      <div class="modal-form-report-menu header-reporte">
        <!--<ul class="text-center">
          <li id="report_tab_1"><span id="tab-1" data-tab="tab-1" class="tab-on"><em>1</em>Mascota</span></li>
          <li id="report_tab_2" onclick="Map_correction();"><span id="tab-2" data-tab="tab-2"><em>2</em>Reporte</span></li>
          <li id="report_tab_3"><span id="tab-3" data-tab="tab-3"><em>3</em>Tus datos</span></li>
        </ul>-->
        <div class="text-center" style="vertical-align: middle;padding:.6em">
          Reporta en tres pasos
        </div>
      </div>
    </div>
    <div class="modal-body" style='height:90%; overflow-y: auto;'>
      <form id="form-report-lost-form" action="" method="post">
        <div class="row">
          <!-- <div id="form-report-lost-tab-1" class="form-report-lost-tab"> cierre tab 1 -->
            
            <div class="col-lg-12 col-md-12">
              <div class="form-group titulo-reporte">
                Mascota
              </div>
              <div class="form-group">
                <label>Estado</label>
                <div class="pet-type">
                    <input type="radio" name="pet_status" id="pet_lost_radio" value="lost">
                    <label for="pet_lost_radio">Perdido</label>
                    <input type="radio" name="pet_status" id="pet_found_radio" value="found">
                    <label for="pet_found_radio">Encontrado</label>
                </div>
                    <input type="hidden" name="report_id" id="report_id">
              </div>
              <div class="form-group encontrado" id="name_div" style="margin-bottom: 32px;">
                <label>Nombre de mascota</label>
                <input type="text" name="lost_pet_name" id="lost_pet_name" class="form-control" maxlength="20">
              </div>
              <div class="form-group  encontrado">
                <label>Mascota:</label>
                <select class="form-control" onchange="updateListPets()" name="lost_pet_type" id="lost_pet_type">
                  <option value="perro">Perro</option>
                  <option value="gato">Gato</option>
                </select>
              </div>

              <div class="form-group  encontrado" style="margin-bottom: 32px;">
                <label>Raza</label>
                <input type="text" name="lost_pet_race" id="lost_pet_race" class="form-control" maxlength="20" list="mascotasl">
                <datalist id="mascotasl">
                   <option value="Alano">
    <option value="Alaskan Malamute">
    <option value="American Staffordshire Terrier">
    <option value="American Water Spaniel">
    <option value="Antiguo Pastor Inglés">    
    <option value="Basset Azul Gaseogne">
    <option value="Basset Hound">    
    <option value="Basset leonado">    
    <option value="Beagle">
    <option value="Bearded Collie">
    <option value="Bichón Maltés">
    <option value="Bobtail">
    <option value="Border Collie">
    <option value="Boston Terrier"> 
    <option value="Boxer">
    <option value="Bull Terrier">
    <option value="Bulldog Americano">
    <option value="Bulldog Frances">
    <option value="Bulldog Ingles">
    <option value="Caniche">
    <option value="Carlino">
    <option value="Chihuahua">
    <option value="Cirneco del Etna">
    <option value="Chow Chow">
    <option value="Cocker Spaniel Americano">
    <option value="Cocker Spaniel Ingles">
    <option value="Dalmata">
    <option value="Dobermann">
    <option value="Dogo Alemán">
    <option value="Dogo Argentino">
    <option value="Dogo de Burdeos">
    <option value="Finlandes">
    <option value="Fox Terrier pelo liso">
    <option value="Fox Terrier">
    <option value="Foxhound Americano">
    <option value="Foxhound Ingles">
    <option value="Galgo Afgano">
    <option value="Gigante Pirineos">
    <option value="Golden Retriever">
    <option value="Gos d Atura">
    <option value="Gran Danes">
    <option value="Husky Siberiano">
    <option value="Laika Siberia">
    <option value="Laika Ruso-europeo">
    <option value="Labrador">
    <option value="Mastin del Pirineo">
    <option value="Mastin del Tibet">
    <option value="Mastín Español">
    <option value="Mastin Napolitano">
    <option value="Pastor Aleman">
    <option value="Pastor Australiano">
    <option value="Pastor Belga">
    <option value="Pastor de Brie">
    <option value="Pastor de Cara Rosa">
    <option value="Pekines">
    <option value="Perdiguero Chesapeake">
    <option value="Perdiguero Pelo Liso">
    <option value="Perdiguero Rizado">
    <option value="Perdiguero Portugues">
    <option value="Pitbull">
    <option value="Podenco Ibicenco">
    <option value="Podenco Portugues">
    <option value="Presa Canario">
    <option value="Presa Mallorquin">    
    <option value="Rottweiler">
    <option value="Rough Collie">
    <option value="Sabueso Español">
    <option value="Sabueso Hélenico">
    <option value="Sabueso Italiano">
    <option value="Sabueso Suizo">
    <option value="Samoyedo">
    <option value="San Bernardo"> 
    <option value="Scottish Terrier"> 
    <option value="Setter Irlandés">
    <option value="Shar Pei"> 
    <option value="Shiba Inu"> 
    <option value="Staffordshire Bull Terrier">
    <option value="Teckel">
    <option value="Terranova">
    <option value="Terrier Australiano">
    <option value="Terrier Escocés"> 
    <option value="Terrier Irlandés">
    <option value="Terrier Japonés">
    <option value="Terrier Negro Ruso">
    <option value="Terrier Norfolk">
    <option value="Terrier Norwich">
    <option value="Yorkshire Terrier">
                </datalist>
                <!--select class="form-control" name="lost_pet_race" id="lost_pet_race">
                  <option value="dog">Perro</option>
                  <option value="cat">Gato</option>
                </select-->
              </div>
              <div class="form-group  encontrado">
                <label>Género</label>
                <select class="form-control" name="lost_pet_gender" id="lost_pet_gender">
                  <option value="macho">Macho</option>
                  <option value="hembra">Hembra</option>
                </select>
              </div>
            </div>
            <div class="col-lg-12 col-md-12">
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
            <!--<div class="col-lg-12 col-md-12 center-block">
              <div class="form-group form-actions">
                <button id="goto_map_tab" type="button" data-tab="tab-2" class="btn btn-primary btn-button btn-lg btn-next">Siguiente</button>
              </div>
            </div>-->
          <!--</div> cierre tab 1-->
          <!--<div id="form-report-lost-tab-2" class="form-report-lost-tab hide">-->
            
            <div class="col-lg-12 col-md-12">
              <div class="form-group titulo-reporte">
                Reporte
              </div>
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
               <!-- <label>Última vez visto</label>                
                <div class="inputsAddress">               
               <div class="form-group">
                <div class="col-md-12">
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
                </div>
                <div class="form-group">        
                <div class="col-md-12">
                <label for="city">
                Ciudad
                  <select id="city" class="form-control">
                    <option value="callao">Seleccione</option>
                  </select>                
                  </label>
                </div>
                <div class="col-md-12">
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
              </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
              <input type ="hidden" id="lat" name="pet-lost-lat" />
                <input type ="hidden" id="lng" name="pet-lost-lng" />            
                <div id="pet-lost-map" style="width:100%;height:200px;">
                 </div>
              </div>
              
              <!--<div class="form-group encontrado">
                <label>¿Cómo se perdió?</label>               
                <textarea placeholder="150 caracteres max" name="lost_pet_report_description" id="lost_pet_report_description" class="form-control" rows="4"></textarea>
              </div>-->
              <label>Calle</label>
                <div id='pac-input-div'><input type="text" id="pac-input" class="form-control" placeholder="Ingresa la dirección donde se perdió o arrastra el PIN"></div>
                <input type="hidden" name="pet-lost-address" id="pac-address" class="form-control">                
                <input type="hidden" name="pet-lost-lat" id="lat" class="form-control">
                <input type="hidden" name="pet-lost-lng" id="lng" class="form-control">
                <input type="hidden" name="lost_pet_postal_code" id="pac-postal_code" class="form-control">
                <div id="pet-lost-map" style="width:100%;height:300px;">
                 </div>
            </div>
            <!--<div class="col-lg-12 col-md-12 center-block">
              <div class="form-group form-actions">
                <button type="button" data-tab="tab-3" class="btn btn-primary btn-button btn-lg btn-next">Siguiente</button>
              </div>
            </div>-->
          <!--</div> cierre tab 2 -->
          <!--<div id="form-report-lost-tab-3" class="form-report-lost-tab hide"> cierro tab-->
          </div>
            <div class="col-lg-12 col-md-12">
              <div class="form-group titulo-reporte">
                Tus Datos
              </div>
              <div class="form-group">
                <label>Nombre de dueño</label>
                <input type="text" id="el_dueno" name="lost_pet_owner_name" class="form-control" value="{{ Auth::user()? Auth::user()->name:'' }}">
              </div>
              <div class="form-group">
                <label>Teléfono de contacto</label>
                <input type="numeric" name="lost_pet_contact_name" id="lost_pet_contact_phone" class="form-control" value="{{ Auth::user()? Auth::user()->phone:'' }}">
              </div>
              <div class="form-group">
                <label><div style="float:left;">Recompensa</div><div style="float:right;" class="description-block-reward">Opcional*</div></label>
                <div style='margin-top:20px;'>
                <!--<span class="help-block" style="text-align:right;width:30px;">S/.</span>-->
                <input type="text" name="lost_pet_reward" id="lost_pet_reward" class="form-control numeric" style='margin-top:-35px;' placeholder="S/.">
                </div>                
              </div>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <label>Email de contacto</label>
                <input type="text" name="lost_pet_contact_email" class="form-control" value="{{ Auth::user()? Auth::user()->email:'' }}">
              </div>
            </div>
            <div class="col-lg-12 col-md-12 center-block">
              <div class="form-group form-actions row">     
                <div class="col-md-6 col-sm-12">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary btn-button btn-lg btn-submit-report">Finalizar</button>
                </div>           
                <div class="col-md-6 col-sm-12">
                  <button data-dismiss="modal" aria-hidden="true" type="button" class="btn btn-primary btn-button btn-lg close" style="color: black !important; background: white !important; border: 1px solid lightgray; text-align: center; float: initial; opacity: 1;" >Cancelar</button>                
                </div>                                                             
              </div>
            </div>
          <!--</div> cierre tab 3 -->       
      </div>
           </form>
    </div>
  </div>
</div>