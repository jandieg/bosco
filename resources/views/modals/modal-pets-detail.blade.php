<div id="pet-detail" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
  <div class="dog-content modal-content clearfix">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <div class="modal-body">
      <div class="pet-detail-left">
        <div class="pet-detail-image">
          <img src="{{ asset('images/report_detail_image.png') }}" />
        </div>
        <div class="pet-detail-data">
          <p><label></label><span class="pet-detail-location"></span></p>
        </div>
        <div id="pet-detail-map"></div>        
        <div id='pet-detail-map-overlay'></div>
      </div>
      <div class="pet-detail-right">
        <div class="pet-detail-info-group">
          <h3 id="is-owner">Datos</h3>
          <p class="grilla"><label>Nombre</label><span class="owner-detail-name"></span></p>
          <p class="grilla"><label>Contacto</label><span class="owner-detail-phone"></span></p>
          <p class="grilla"><label>Email</label><span class="owner-detail-email"></span></p>
          <p class="grilla"><label>Recompensa</label><span class="owner-detail-reward"></span></p>
        </div>
        <div class="pet-detail-info-group">
          <h3>Mascota</h3>
          <p class="grilla"><label>Nombre</label><span class="pet-detail-name"></span></p>
          <p class="grilla"><label>Raza</label><span class="pet-detail-race"></span></p>
          <p class="grilla"><label>Género</label><span class="pet-detail-gender"></span></p>
          <p class="grilla"><label>Descripción</label><span class="description pet-detail-description"></span></p>
          <!--<p class="description pet-detail-description"></p>-->
        </div>
        <div class="pet-detail-info-group">
          <h3>Reporte</h3>
          <p class="grilla"><label>Fecha</label><span class="report-detail-date"></span></p>
          <p class="grilla"><label>Hora</label><span class="report-detail-hour"></span></p>
          <p class="grillaesp"><label>Dirección</label><span class="report-detail-address"></span></p>
          <p class="grilla"><label>Descripción</label><span class="description report-detail-description"></span></p>
          
        </div>
      </div>
    </div>
  </div>
</div>
