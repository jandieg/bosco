<!-- Block Filters -->
<link href="../css/bootstrap-slider.min.css" rel="stylesheet" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-slider.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript" src="../js/mascotas.js"></script>
<div class="row">
    <div class="block-filters clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="filter-image"></div>
            <form id="form-pets-filters" class="" action="{{url('filter/mascotas/'.$type) }}" method="POST">
                <div class="form-group col-md-6 col-lg-6">
                    <input id="location" type="text" class="form-control" />
                </div>
                <div class="form-group col-md-4 col-lg-4">
                    <div class="dropdown megamenu">
                        <button class="btn btn-large btn-block btn-default dropdown-toggle"
                            type="button" data-toggle="modal" data-target="#distanceModal">
                            Rango de busqueda
                            <span class="caret"></span>
                        </button>
                    </div>
                </div>
            </form>
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