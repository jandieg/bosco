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

<div style="width:750px;margin:0 auto;">
    <div class="modal-report-detail-left report-detail-center-export">
        <div class="modal-report-detail-image">
            <div class="modal-report-title">
                <h3>Encontrado</h3>

            </div>
            <span class="report-detail-lost-image report-detail-export-image">
            <img src="{{ asset('images/pets/'.$report['image']) }}">
          </span>
            <span class="report-detail-lost-phone" >
            <a class="report-phone report-phone-export" style="box-sizing: border-box;">{{ $report['user_phone'] }}</a>
          </span>
        </div>
        <div class="modal-report-detail-data clearfix">
            <p class="report-data-birthday report-detail-data-export report-detail-lost-date">{{ $report['date'] }}</p>
            <p class="report-data-location report-detail-data-export report-detail-lost-address">{{ $report['address'] }}</p>
        </div>
    </div>
</div>

</body>
</html>

