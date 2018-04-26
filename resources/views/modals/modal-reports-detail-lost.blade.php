<div id="report-detail-lost" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
  <div class="modal-report modal-content clearfix">
    <button type="button" class="close modal-oculto" data-dismiss="modal" aria-hidden="true">X</button>
    <div class="modal-body">
   
        <div class="modal-report-detail-left">
        <span class="report-detail-lost-image">          
            <img   src="{{ asset('images/report_detail_image.png') }}" style="width:100%; height: 80vh; margin-top:0px;
            image-rendering: pixelated; 
            image-rendering: optimizeQuality;
            image-rendering: optimizeSpeed;
            image-rendering: -moz-crisp-edges;
            image-rendering: -webkit-optimize-contrast;
            ">
          </span>
          </div>
      <!--</div>-->
      <!--Empieza modal righ-->
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
            <div class="modal-report-button" id="download_report_div">
              <a href="#" class="btn btn-download-lost btn-button btn-block btn-blue">Descargar volante</a>
            </div>
            <!--<div class="modal-report-button hide"  id="download_report_div">
              <a href="#" class="btn btn-download-lost btn-button btn-block btn-blue">JPG</a>
              <a href="#" class="btn btn-download-lost btn-button btn-block btn-blue">PDF</a>
            </div>-->
          </div>
        </div>
      </div>
      <!--se acaba el modal righ-->      
    </div>
    <div class="modal-loader"></div>
  </div>
</div>