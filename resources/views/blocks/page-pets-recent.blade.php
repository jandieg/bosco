  <!-- Block Filters -->
  <div class="block-filters clearfix">
    <div class="col-lg-12 col-md-12">
      <div class="filter-image"></div>
      <form id="form-pets-filters" class="form-inline" action="http://bosco.pe/filter/mascotas/perdidos" method="POST" novalidate="novalidate">
        <div class="form-group form-actions">
          <a data-toggle="modal" href="http://bosco.pe/mascotas" class="btn btn-primary">Buscar</a>
        </div>
      </form>
    </div>
  </div>
  <!-- Block Images -->
  <div id="block-home-gallery" class="block-gallery clearfix">
    <div class="view-content" id="home_gallery_ul_parent">
      <div class="prev-gallery-btn"><</div>
      <ul class="pets-list text-left">
        @if(!empty($reports['data']))
          @foreach($reports['data'] as $item)
        <li>
          <a data-toggle="modal">
            <div style="background-image:url({{ asset('images/pets/' . $item['image']) }});background-size:cover;width:150px;height:150px;" id="_{{ $item['id']}}"></div>

            <div class="gallery-item-hover"  onclick="gallery_item_over({{ $item['id'] }})"><!--onclick="item_detail_view({{ $item['id'] }})"-->
              <p>{{ $item['description'] }}</p>
            </div>
            <div class="gallery-item-detail">
              <h2>{{ $item['name'] }}</h2>
              <p class="gallery-item-birthday">{{ date_format(date_create($item['date']), 'd M Y') }}</p>
              <p class="gallery-item-location">{{ $item['address'] }}</p>
            </div>
          </a>
        </li>
            @endforeach
            <li>
              <div class="block-recent-more pull-right">
                <a href="/mascotas" class="btn btn-lg btn-default">Ver mas</a>
              </div>
            </li>
          @endif
      </ul>
      <div class="next-gallery-btn">></div>

    </div>
  </div>