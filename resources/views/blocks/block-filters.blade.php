<!-- Block Filters -->
<div class="row">
  <div class="block-filters clearfix">
    <div class="col-lg-12 col-md-12">
      <div class="filter-image"></div>
      <form id="form-pets-filters" class="form-inline" action="{{ url('filter/mascotas/'.$type) }}" method="POST">

        <div class="form-group">
          <select id="ubigeo-department" class="form-control" name="department" required="" aria-required="true">
            <option value="" default style="display:none;">Departamento</option>
<!--            <option value="Amazonas">Amazonas</option>
            <option value="Ancash">Ancash</option>
            <option value="Apurimac">Apurimac</option>
            <option value="Arequipa">Arequipa</option>
            <option value="Ayacucho">Ayacucho</option>
            <option value="Cajamarca">Cajamarca</option>
            <option value="Callao">Callao</option>
            <option value="Cusco">Cusco</option>
            <option value="Huancavelica">Huancavelica</option>
            <option value="Huanuco">Huanuco</option>
            <option value="Ica">Ica</option>
            <option value="Junin">Junin</option>
            <option value="La Libertad">La Libertad</option>
            <option value="Lambayeque">Lambayeque</option>
            <option value="Lima">Lima</option>
            <option value="Loreto">Loreto</option>
            <option value="Madre De Dios">Madre De Dios</option>
            <option value="Moquegua">Moquegua</option>
            <option value="Pasco">Pasco</option>
            <option value="Piura">Piura</option>
            <option value="Puno">Puno</option>
            <option value="San Martin">San Martin</option>
            <option value="Tacna">Tacna</option>
            <option value="Tumbes">Tumbes</option>
            <option value="Ucayali">Ucayali</option>-->
            @if($departments)
            @foreach($departments as $department)
            <option value="{{ $department['department'] }}">{{ $department['department'] }}</option>
            @endforeach
            @endif
          </select>
        </div>
        <div class="form-group">
          <select id="ubigeo-city" class="form-control" name="city">
            <option value="" default style="display:none;">Ciudad</option>
            <!--@if($cities)
            @foreach($cities as $city)
            <option value="{{ $city['city'] }}">{{ $city['city'] }}</option>
            @endforeach
            @endif-->
          </select>
        </div>
        <div class="form-group">
          <select id="ubigeo-district" class="form-control" name="district">
            <option value="" default style="display:none;">Distrito</option>
            <!--@if($cities)
            @foreach($districts as $district)
            <option value="{{ $district['district'] }}">{{ $district['district'] }}</option>
            @endforeach
            @endif-->
          </select>
        </div>
        <div class="form-group form-actions pull-right">
          <a href="/mis-reportes" class="btn btn-primary">Reportar</a>
        </div>
      </form>
    </div>
  </div>
</div>