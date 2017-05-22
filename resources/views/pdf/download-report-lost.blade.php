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

<div style="width:715px;margin:0 auto;">
    <div class="modal-report-detail-left report-detail-center-export" style="width:100%;margin:0 auto;">
        <div class="modal-report-detail-image">
            <div class="pdf-report-title">
                <h3>Perdido</h3>
                <div class="report-data-export">
                    <div class="text-center">
                        <h4>Nombre: <span class="report-detail-lost-name">{{ $report['name'] }}</span></h4>
                        <h4>Género: <span class="report-detail-lost-gender">{{ $report['gender'] }}</span>&nbsp;&nbsp;&nbsp;&nbsp;Raza: <span class="report-detail-lost-race">{{ $report['race'] }}</span></h4>
                    </div>
                </div>
            </div>
            <span class="report-detail-lost-image report-detail-export-image">
            <img src="{{ asset('images/pets/'.$report['image']) }}">
          </span>
          <span class="report-detail-lost-phone" >
            <a class="report-phone report-phone-export" style="box-sizing: border-box;">{{ $report['user_phone'] }}</a>
          </span>
        </div>
        <div class="pdf-report-detail-data text-center">
            <h4 style="text-align: center;padding-top: 10px;">DATE : {{ $report['date'] }}</h4>
            <h4 style="text-align: center;padding-top: 10px;">ADDRESS : {{ $report['address'] }}</h4>
        </div>
    </div>
</div>
</body>
</html>

