<div id="report-detail-lost" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
  <div class="modal-report modal-content clearfix">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <div class="modal-body">
      <div class="modal-report-detail-left">
        <div class="modal-report-detail-image">
          <div class="modal-report-title">
            <h3>Perdido</h3>
            <div class="modal-report-data">
              <ul class="text-center">
                <li>Nombre: <span class="report-detail-lost-name" style=" text-transform:capitalize;">Lara</span></li><span style="font-size: 16px; font-weight: 900;">|</span>
                <li>Género: <span class="report-detail-lost-gender" style=" text-transform:capitalize;">Femenino</span></li><span style="font-size: 16px; font-weight: 900;">|</span>
                <li class="last">Raza: <span class="report-detail-lost-race" style=" text-transform:capitalize;">Pastor alemán</span></li>
              </ul>
            </div>
          </div>          
          <span style='text-align:right;height:40px;float:right;color:white;margin-top:0px;padding:20px 20px 10px 20px; background-color: rgba(0, 0, 0, 0.4); position: relative;' class="report-detail-reward">
            <div style="text-align: center; margin-top: -10px;">
          <span style="font-size:12px;">Recompensa:&nbsp;</span><span class="report-detail-lost-reward" style="font-size:14px; font-family: Arial !important; font-weight: bold;">S/.&nbsp;</span>
          </div>
          </span>
          <span class="report-detail-lost-image">
          
            <img  style="image-rendering: pixelated;" src="{{ asset('images/report_detail_image.png') }}" style="width:100%; margin-top:-55px;">
          </span>
          <span class="report-detail-lost-phone">
            <span class="report-phone" href="tel:969 003 009">969 003 009</span>
          </span>
        </div>
        <div class="modal-report-detail-data clearfix">
          <p class="report-data-birthday report-detail-lost-date">06 Febrero 2016</p>
          <p class="report-data-location report-detail-lost-address">Las coapibas, La Molina.</p>
        </div>
        <div class="modal-report-detail-footer">
          <div class="logo-gray"></div>
          <p>Reporta mascotas perdidas o encontradas entrando a www.bosco.pe.</p>
        </div>
      </div>
      <div class="modal-report-detail-right">
      	<div style='vertical-align:middle;'>
        <div class="modal-report-info">
          <p class="share-facebook">
            <em></em>
            <span class="check-on"></span><span class="check-off hide"></span>
            Facebook
          </p>
          <!--p class="share-instagran">
            <em></em>
            <span class="check-on"></span><span class="check-off hide"></span>
            Instagran
          </p>
          <p class="share-twitter">
            <em></em>
            <span class="check-off"></span><span class="check-on hide"></span>
            Twitter
          </p-->
		  <textarea placeholder="Escribe aquí un mensaje a la comunidad de Facebook" name="fb_comment" id="fb_comment" class="form-control" rows="5"></textarea>
          <div class="modal-report-button"  id="post_social_div">
            <button class="btn btn-primary btn-block btn-button">Compartir</button>
          </div>
        </div>
        <div class="modal-report-info">
          <div class="modal-report-button" id="download_report">
            <a href="#" class="btn btn-download-lost btn-button btn-block btn-blue">Descargar volante</a>
          </div>
          <div class="modal-report-button hide"  id="download_report_div">
            <a href="#" class="btn btn-download-lost btn-button btn-block btn-blue">JPG</a>
            <a href="#" class="btn btn-download-lost btn-button btn-block btn-blue">PDF</a>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>