<!-- Block Filters -->
<div class="row">
  <div class="block-filters clearfix">
    <div class="col-lg-12 col-md-12">
      <div class="filter-image"></div>
      <form id="form-pets-filters" class="form-inline" action="{{ url('filter/mascotas/'.$type) }}" method="POST">

        <div class="form-group">
          <select id="ubigeo-department" class="form-control" name="department" required>
            <?php echo $optionDepartments; ?>
          </select>
        </div>
        <div class="form-group">
          <select id="ubigeo-city" class="form-control" name="city">
            <option value="" selected>Ciudad</option>
          </select>
        </div>
        <div class="form-group">
          <select id="ubigeo-district" class="form-control" name="district">
            <option value="" selected>Distrito</option>
          </select>
        </div>
        <div class="form-group form-actions pull-right">
          <a {{ empty($user->id)?"data-toggle=modal href=#form-user":"href=".url('mis-reportes') }} class="btn btn-primary">Reportar</a>
        </div>
      </form>
    </div>
  </div>
</div>