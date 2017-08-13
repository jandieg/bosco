<!-- Block Filters -->
@section('js')
<link href="../css/bootstrap-slider.min.css" rel="stylesheet" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-slider.min.js"></script>
<script type="text/javascript" src="../js/mascotas.js"></script>
@endsection

<div class="row">
    <div class="block-filters clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="form-group col-md-8 col-lg-8">
                <div class="input-group" id="location-group">
                    <span class="input-group-addon no-right-border">
                        <i class="glyphicon glyphicon-map-marker"></i>
                    </span>
                    <input id="location" placeholder="Escribir zona o distrito" type="text" class="form-control no-left-border large-addon" />
                    <span class="input-group-addon no-right-border no-right-border modal-handle"
                        data-toggle="modal" data-target="#distanceModal">
                        <i class="glyphicon glyphicon-resize-horizontal"></i>
                    </span>
                    <input type="button" class="form-control no-left-border no-right-border modal-handle"
                        value="Rango de busqueda" 
                        data-toggle="modal" data-target="#distanceModal" />
                    <span class="input-group-addon no-left-border modal-handle"
                        data-toggle="modal" data-target="#distanceModal">
                        <i class="caret"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="distanceModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    <span id="distanceHeading">1000</span>&nbsp;metros
                </h3>
                <h4>Radio de búsqueda desde la ubicación seleccionada</h4>
                <br />
            </div>
            <div class="modal-body">
                <input id="distance" data-slider-id='distanceSlider' type="text" data-slider-min="100" data-slider-max="10000"
                    data-slider-step="100" data-slider-value="1000" data-slider-tooltip="hide" />
            </div>
            <div class="modal-footer">
                <a id="distanceCancel" href="javascript:void(0)" class="pull-left text-warning" data-dismiss="modal">Cancelar</a>
                <a id="distanceOk" href="javascript:void(0)" class="pull-right" data-dismiss="modal">Aplicar</a>
            </div>
        </div>
    </div>
</div>