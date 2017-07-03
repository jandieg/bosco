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
    <style>
    html{
    	margin:0px;
    }
    body{
      font-family: "Arial", "Arial-bold";
    }
    .pdf-report-phone {
	position: relative;
	background-color: rgba(0, 0, 0, 0.4);
	color: #fff;
	display: block;
	font-size:40px;
	padding-top:5px;
	line-height: 1;
	height: 55px;
	padding-bottom:25px;
	margin-top: -140px;
	text-align: center;
	width: 100%;
	z-index: 1040;
	}
	.modal-report-detail-footer {
	  position: fixed;
	  background-color:white;
	  top:1020px;
	  height:55px;
	  border-top: 2px solid #d6d6d6;
	}	
	.logo-gray {
	  background: url('../img/sprite.png') no-repeat 0 -39px;
	  height: 26px;
	  width: 90px;
	}
    </style>
</head>
<body style='background-color:white;margin:0px;'>

<div style="width:800px;height:1100px;margin:0 auto;">
      <div class="modal-report-detail-left" style="width:100%;">
        <div class="pdf-report-detail-image">
          <div class="pdf-report-title" style="height:150px;">
            <p style="padding-top:80px;padding-bottom:30px;border-bottom: 2px solid white;
            font-size:100px;text-align:center; font-family: Arial-bold !important;
            ">Perdido</p>
            <p style="padding-top:5px;">
               <span style="font-size:20px;">Nombre: </span><span style="font-size:22px; font-family: Arial-bold !important;">{{ $report['name'] }}&nbsp;|&nbsp;</span>
               <span style="font-size:20px;">Género: </span><span style="font-size:22px; font-family: Arial-bold !important;">{{ $report['gender'] }}&nbsp;|&nbsp;</span>
               <span style="font-size:20px;">Raza: </span><span style="font-size:22px; font-family: Arial-bold !important;">{{ $report['race'] }}</span>
            </p>
          </div>
          <div style='text-align:right;height:49px;float:right;background-color:black;color:white;margin-top:1px;padding:20px 20px 0px 20px; background-color: rgba(0, 0, 0, 0.4);'>
          <span style="font-size:24px;">Recompensa:&nbsp;</span><span style="font-size:26px; font-family: Arial-bold !important;">S/.&nbsp;{{ $report['reward'] }}</span>
          </div>
          <img src="{{ asset('images/pets/'.$report['image']) }}" style="width:100%;top:-51px;">
          <div class='pdf-report-phone'><img src="{{ url('/img/phone.png')}}" style="padding-top:25px;width:40px;height:auto;">&nbsp;&nbsp;{{ $report['user_phone'] }}</div>
        </div>
        <div class="pdf-report-detail-data clearfix" style="position:relative;background-color:white;height:75px;padding-top:0px;top:-55px;" >
          <div style="width:50%;float:left;font-size: 20px;">
              <img src="{{ url('/img/calendar.png')}}" style="padding-left:30px;padding-top:28px;">&nbsp;&nbsp;{{ $report['date'] }}
          </div>
          <div style="width:50%;float:right;font-size: 20px;">
              <img src="{{ url('/img/location.png')}}" style="padding-left:20px;padding-top:28px;">&nbsp;&nbsp;{{ $report['address'] }}
          </div>
        </div>
        <div class="modal-report-detail-footer">
          <div class="logo-gray" style="padding-right: 2px;"></div>
          <p style="margin-right: 100px;font-size: 20px;">¡Compartiendo la publicación ayudas a reunir una familia! Ayuda a encontrar mascotas perdidas y reportar mascotas encontradas entrando a www.bosco.pe</p>
        </div>
      </div>
</div>
</body>
</html>