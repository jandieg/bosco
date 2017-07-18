@extends('layouts.base')
@section('content')

<section id="content">
  <div class="container">

    <!-- Block Works -->
    <div class="row">
      <div class="page-content clearfix">
        <div id="contact-us" class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
          <h3>Mis reportes</h3>
        </div>
      </div>
    </div>

    <!-- Block Reports -->
    <div class="row">
      <div class="block-reports-content col-lg-12">
        <div id="block-reports-lost" class="block-reports block-reports-lost col-lg-6 col-md-6 col-sm-6 col-xs-12 clearfix">
          <div class="view-content">
            <ul class="text-left">
                <li>
                    <a data-toggle="modal" href='#' class="report-lost-add">
                    <em>+</em>
                    <h4>Reportar perdido</h4>
                  </a>
                </li>
              @if(!empty($reports['lost']['data']))
            @foreach($reports['lost']['data'] as $item)
              <li>
                <div class="report-item-content">                  
                  <img src="{{ asset('images/pets/' . $item['image']) }}" style="width:206px;height:206px;" id="_{{ $item['id']}}"/>
                  <div class="report-item-detail">
                    <h2>{{ $item['name'] }}</h2>
                    <p class="report-item-birthday">{{ $item['date'] }}</p>
                    <p class="report-item-location">{{ $item['address'] }}</p>
                  </div>
                </div>
                <div class="report-buttons">
                  <a data-toggle="modal" class="btn btn-primary btn-block _item_{{ $item['id'] }}" onclick="item_detail_view({{ $item['id'] }});">Generar volante</a>
                  <a data-toggle="modal" href="#" class="btn btn-primary btn-green btn-block _item_{{ $item['id'] }}" onclick="item_finded_pet({{ $item['id']}});">Encontrado</a>
                </div> 
                <img class="edit_menu" src="{{ asset('img/icon-edit-red.png') }}"/>
                <div class="edit_menu_div">   
                    <div class="rotated_div_tag"></div>
                    <div class="edit_menu_body">
                    <p style="margin-bottom: 0px;" class="enlace" onclick="edit_pet_detail({{ $item['id'] }},0);"><img class="edit_icon" src="{{ asset('img/icon-edit.png') }}"/>&emsp;<span>Editar</span></p>
                    <p class="enlace" ><img class="edit_icon" src="{{ asset('img/Icono-Promover.png') }}"/>&emsp;<span>Promover</span></p>
                    <p style="margin-bottom: 0px;" class="enlace" onclick="delete_pet_detail({{ $item['id'] }},0);"><img class="edit_icon" src="{{ asset('img/icon-delete.png') }}"/>&emsp;<span>Eliminar</span></p>
                    </div>
                </div>
              </li>
              @endforeach
            @endif
            </ul>
          </div>
        </div>
        <div id="block-reports-founds" class="block-reports block-reports-founds col-lg-6 col-md-6 col-sm-6 col-xs-12 clearfix">
          <div class="view-content">
            <ul class="text-left">
                <li>
                  <a data-toggle="modal" href="#" class="report-found-add">
                    <em>+</em>
                    <h4>Reportar encontrado</h4>
                  </a>
                </li>
              @if(!empty($reports['found']['data']))
              @foreach($reports['found']['data'] as $item)
              <li>
                <div class="report-item-content">
                  <img src="{{ asset('images/pets/' . $item['image']) }}"  style="width:206px;height:206px;"/>
                  <div class="report-item-detail">
                    <h2>{{ $item['name'] }}</h2>
                    <p class="report-item-birthday">{{ $item['date'] }}</p>
                    <p class="report-item-location">{{ $item['address'] }}</p>
                  </div>
                </div>
                <div class="report-buttons">
                  <a data-toggle="modal" class="btn btn-primary btn-block" onclick="item_detail_view({{ $item['id'] }});">Generar volante</a>
                  <a data-toggle="modal" href="#" class="btn btn-primary btn-green btn-block">Encontrado</a>
                </div>
                <img class="edit_menu" src="{{ asset('img/icon-edit-red.png') }}"/>
                <div class="edit_menu_div">   
                    <div class="rotated_div_tag"></div>
                    <div class="edit_menu_body">
                    <p style="margin-bottom: 0px;" class="enlace" onclick="edit_pet_detail({{ $item['id'] }},0);"><img class="edit_icon" src="{{ asset('img/icon-edit.png') }}"/>&emsp;<span>Editar</span></p>
                    <p class="enlace"><img class="edit_icon" src="{{ asset('img/Icono-Promover.png') }}"/>&emsp;<span>Promover</span></p>
                    <p style="margin-bottom: 0px;" class="enlace" onclick="delete_pet_detail({{ $item['id'] }},0);"><img class="edit_icon" src="{{ asset('img/icon-delete.png') }}"/>&emsp;<span>Eliminar</span></p>
                    </div>
                </div>
              </li>
              @endforeach
            @endif
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
 <div class="alert-message"></div>

@endsection