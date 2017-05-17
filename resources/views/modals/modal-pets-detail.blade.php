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
        <div id="pet-detail-map">
          <!--iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3902.7172994695616!2d-77.07001798571204!3d-11.99405284418647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105ce576243f53f%3A0xaae76d5bd5892e99!2sArguedas%2C+Lima+15301!5e0!3m2!1ses-419!2spe!4v1464324577124" width="100%" height="240" frameborder="0" style="border:0" allowfullscreen></iframe-->
        </div>
      </div>
      <div class="pet-detail-right">
        <div class="pet-detail-info-group">
          <h3 id="is-owner"></h3>
          <p><label>Nombre</label><span class="owner-detail-name"></span></p>
          <p><label>Contacto</label><span class="owner-detail-phone"></span></p>
          <p><label>Email</label><span class="owner-detail-email"></span></p>
          <p><label>Recompensa</label><span class="owner-detail-reward"></span></p>
        </div>
        <div class="pet-detail-info-group">
          <h3>Mascota</h3>
          <p><label>Nombre</label><span class="pet-detail-name"></span></p>
          <p><label>Raza</label><span class="pet-detail-race"></span></p>
          <p><label>Género</label><span class="pet-detail-gender"></span></p>
          <p><label>Descripción</label></p>
          <p class="description pet-detail-description"></p>
        </div>
        <div class="pet-detail-info-group">
          <h3>Reporte</h3>
          <p><label>Fecha</label><span class="report-detail-date"></span></p>
          <p><label>Hora</label><span class="report-detail-hour"></span></p>
          <p><label>Descripción</label></p>
          <p class="description report-detail-description"></p>
        </div>
      </div>
    </div>
  </div>
</div>
