<div class="container">
  <div class="modal fade" id="modal-cropper" aria-labelledby="modalLabel" role="dialog" tabindex="-1" data-width="400" style="z-index: 9999;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom: 1px solid #e5e5e5;padding: 18px 30px;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h5 class="modal-title" id="modalLabel">Crop the image</h5>
        </div>
        <div class="modal-body">
          <div style="width:80%;margin:0px auto;">
            <img id="cropper-image" src="">
          </div>
          <div class="docs-data" style="display:none;">
            <div style="display:flex;">
              <div class="input-group input-group-sm options-left col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label class="input-group-addon" for="dataX">X</label>
                <input type="text" class="form-control" id="dataX" placeholder="x">
                <span class="input-group-addon">px</span>
              </div>
              <div class="input-group input-group-sm options-right col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label class="input-group-addon" for="dataWidth">W</label>
                <input type="text" class="form-control" id="dataWidth" placeholder="width">
                <span class="input-group-addon">px</span>
              </div>
            </div>
            <div style="display:flex;">
              <div class="input-group input-group-sm options-left col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label class="input-group-addon" for="dataY">Y</label>
                <input type="text" class="form-control" id="dataY" placeholder="y">
                <span class="input-group-addon">px</span>
              </div>
              <div class="input-group input-group-sm options-right col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label class="input-group-addon" for="dataHeight">H</label>
                <input type="text" class="form-control" id="dataHeight" placeholder="height">
                <span class="input-group-addon">px</span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" id="cropper-confirm">Confirm</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <!--a data-toggle="modal" id="btn-cropper" href="#modal-cropper" style="display:none;"-->
</div>
