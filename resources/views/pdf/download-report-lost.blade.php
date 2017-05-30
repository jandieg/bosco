<!doctype html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perdido</title>
    <link rel="stylesheet" type="text/css" href="{{ url('css/yui-reset.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/bosco.css') }}">
</head>
<body>

<div style="width:100%;margin:0 auto;">
      <div class="modal-report-detail-left" style="width:100%;">
        <div class="modal-report-detail-image">
          <div class="modal-report-title" style="height:80px;">
            <h3 style="padding-top: 20px;padding-bottom: 20px;border-bottom: 1px solid white;">Perdido</h3>
            <!--<div class="modal-report-data" style="z-index: 100;">-->
               <h4>Nombre: <span class="report-detail-lost-name">{{ $report['name'] }}</span>&nbsp;&nbsp;&nbsp;
                   Género: <span class="report-detail-lost-gender">{{ $report['gender'] }}</span>&nbsp;&nbsp;&nbsp;
                   Raza: <span class="report-detail-lost-race">{{ $report['race'] }}</span>
               </h4>
            <!--</div>-->
          </div>
          <span class="report-detail-lost-image">
            <img src="{{ asset('images/pets/'.$report['image']) }}" style="width:100%;">
          </span>
          <!--<span class="report-detail-lost-phone">-->
            <a class="report-phone" href="#" style="font-size: 36px;padding-top:15px;opacity: 0.5;height:25px;">{{ $report['user_phone'] }}</a>
          <!--</span>-->
        </div>
        <div class="modal-report-detail-data clearfix" style="height:75px;">
          <div style="padding:10px;width:50%;float:left;font-size: 20px;">
              <img src="{{ url('/img/calendar.png')}}" style="padding:5px;">{{ $report['date'] }}
          </div>
          <div style="padding:10px;width:50%;float:right;font-size: 20px;">
              <img src="{{ url('/img/location.png')}}" style="padding:5px;">{{ $report['address'] }}
          </div>
        </div>
        <div class="modal-report-detail-footer">
          <div class="logo-gray" style="padding-right: 2px;"></div>
          <p style="margin-right: 100px;font-size: 16px;">¡Compartiendo la publicación ayudas a reunir una familia! Ayuda a encontrar mascotas perdidas y reportar mascotas encontradas entrando a www.bosco.pe</p>
        </div>
      </div>
</div>
</body>
</html>