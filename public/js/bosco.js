window.fbAsyncInit = function() {
	FB.init({
	    appId      : '1925180084394238',
	    xfbml      : true,
	    version    : 'v2.9'
	});
};

var bMobile =   // will be true if running on a mobile device
    navigator.userAgent.indexOf("Mobile") !== -1 ||
    navigator.userAgent.indexOf("iPhone") !== -1 ||
    navigator.userAgent.indexOf("Android") !== -1 ||
    navigator.userAgent.indexOf("Windows Phone") !== -1;


(function(d, s, id){
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function resetScrollPos(selector) {
    var divs = document.querySelectorAll(selector);
    for (var p = 0; p < divs.length; p++) {
        if (Boolean(divs[p].style.transform)) { //for IE(10) and firefox
            divs[p].style.transform = 'translate3d(0px, 0px, 0px)';
        } else { //for chrome and safari
            divs[p].style['-webkit-transform'] = 'translate3d(0px, 0px, 0px)';
        }
    }
}

function postFacebook(id) {
    
    
	FB.login(function(response) {
	    console.log(response);
        var comment = "Mascota Extraviada";
        if ($("#fb_comment").val().toString().length > 0) {
            comment = $("#fb_comment").val().toString();
        }
	    userID=response.authResponse.userID;
	    accessToken=response.authResponse.accessToken;
	        $.ajax({
		        type: "GET",
		        url: window.location.origin + '/facebook-post',
		        dataType: 'json',
                async: false,
		        cache: false,
		        data: {report_id:id, user_id: userID, access_Token: accessToken},
		        success: function (result) {
                    $("#facebook-post-success").modal().show();
                    setTimeout(function () { $("#facebook-post-success").modal().hide(); }, 3000);
		        }
		        });
	    FB.api('/'+userID+'/photos', 'post', 
        {   url: window.location.origin + '/report.jpg',
            caption: comment,
            access_token: accessToken
        }
        );
	} , {scope:'email,manage_pages,publish_actions,publish_pages'});
}

$('.numeric').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
});
$(".link-user > span").on('click', function () {
    if ($(this).hasClass('active')) {
        $(this).removeClass('active');
    } else {
        $('.link-user > span').removeClass('active');
        $(this).addClass('active');
    }
});

$(".nav li > a").on('click', function () {
    if ($(this).parent().hasClass('active')) {
        $(this).parent().removeClass('active');
    } else {
        $('.nav li > a').parent().removeClass('active');
        $(this).parent().addClass('active');
    }
});

$(".works-desktop #block-works-web > a").click(function (e) {
    e.preventDefault();
    $(".works-content-left").animate({"left": "0"}, "slow");
});

$(".works-desktop #block-works-app > a").click(function (e) {
    e.preventDefault();
    $(".works-content-right").animate({"right": "0"}, "slow");
});

$('.works-content-left .block-works-item-return').click(function (e) {
    e.preventDefault();
    $(".works-content-left").animate({"left": "-100%"}, "slow");
});

$('.works-content-right .block-works-item-return').click(function (e) {
    e.preventDefault();
    $(".works-content-right").animate({"right": "-100%"}, "slow");
});

$('#form-pets-filters').validate();

$('.check-on').click(function () {
    $(this).addClass('hide');
    $(this).parent().children('.check-off').removeClass('hide');
});
$('.check-off').click(function () {
    $(this).addClass('hide');
    $(this).parent().children('.check-on').removeClass('hide');
});

$('#form-report-lost .modal-form-report-menu li span').click(function () {
    var tab = $(this).data('tab');
    $('#form-report-lost .modal-form-report-menu li span').removeClass('tab-on');
    $(this).addClass('tab-on');
    $('#form-report-lost .modal-form-report .form-report-lost-tab').addClass('hide');
    $('#form-report-lost-' + tab).removeClass('hide');
    hideMapComponents();
});

$('#form-report-lost .modal-form-report .form-actions .btn-next').click(function () {
    var tab = $(this).data('tab');
    resetScrollPos('.modal-body');
    $(".modal-body").scrollTop(0);
    //$(".modal-content").scrollTop(0);

    if (tab == "tab-2") {
        if ($("#lost_pet_name").val().length == 0) {
            alert('Debe ingresar el nombre de la mascota' + $("#lost_pet_name").text());
            return false;
        }

        if ($("#lost_pet_race").val().length == 0) {
            alert('Debe ingresar la raza de la mascota');
            return false;
        }

        if ($("#lost_pet_description").val().length == 0) {
            alert('Debe ingresar la descripcion de la mascota');
            return false;
        }

        var cropper = $('#cropper-image').cropper('getCroppedCanvas');        
        if (cropper == null) {
            alert('Debe ingresar la imagen de la mascota');
            return false;
        }
    }

    if (tab == "tab-3") {
        if ($("#datepicker").val().length == 0) {
            alert('Debe ingresar la fecha de desaparicion de la mascota');
            return false;
        }

        if ($("#timepicker").val().length == 0) {
            alert('Debe ingresar la hora de desaparicion de la mascota');
            return false;
        }

        if ($("#lost_pet_report_description").val().length == 0) {
            alert('Debe ingresar la descripcion del reporte');
            return false;
        }   

        if ($("#dep").val().length == 0) {
            alert('Debe seleccionar departamento');
            return false;
        }

        if ($("#city").val().length == 0) {
            alert('Debe seleccionar la ubicacion');
            return false;
        }

        if ($("#dist").val().length == 0) {
            alert('Debe seleccionar distrito');
            return false;
        }

        if ($("#street").val().length == 0) {
            alert('Debe seleccionar la calle');
            return false;
        }          
    }

    $('#form-report-lost .modal-form-report-menu li span').removeClass('tab-on');
    $('#form-report-lost .modal-form-report-menu li span#' + tab).addClass('tab-on');
    $('#form-report-lost .modal-form-report .form-report-lost-tab').addClass('hide');
    $('#form-report-lost-' + tab).removeClass('hide');
    hideMapComponents();
});

$('#form-report-founds .modal-form-report-menu li span').click(function () {
    var tab = $(this).data('tab');
    $('#form-report-founds .modal-form-report-menu li span').removeClass('tab-on');
    $(this).addClass('tab-on');
    $('#form-report-founds .modal-form-report .form-report-founds-tab').addClass('hide');
    $('#form-report-founds-' + tab).removeClass('hide');
    hideMapComponents();
});

$('#form-report-founds .modal-form-report .form-actions .btn-next').click(function () {
    var tab = $(this).data('tab');
    $('#form-report-founds .modal-form-report-menu li span').removeClass('tab-on');
    $('#form-report-founds .modal-form-report-menu li span#' + tab).addClass('tab-on');
    $('#form-report-founds .modal-form-report .form-report-founds-tab').addClass('hide');
    $('#form-report-founds-' + tab).removeClass('hide');
    hideMapComponents();
});

    
   

$('#form-user .modal-footer a').click(function () {
    var form = $(this).data('form');
    $('#form-user .form-user').addClass('hide');
    $('#' + form).removeClass('hide');
});

$('#datepicker').datetimepicker({
    format: "DD MMMM YYYY"
});
$('#timepicker').datetimepicker({
    format: "H:mm"
});

function gallery_item_over(id, status) {
    $("#pet-detail").modal().show();
    $('.pet-detail-image').html('');
    $('.pet-detail-location').html('');
    $('.owner-detail-name').html('');
    $('.owner-detail-phone').html('');
    $('.owner-detail-email a').html('');
    $('.owner-detail-reward').html('');
    $('.pet-detail-name').html('');
    $('.pet-detail-race').html('');
    $('.pet-detail-gender').html('');
    $('.pet-detail-description').html('');
    $('.report-detail-date').html('');
    $('.report-detail-hour').html('');
    $('.report-detail-description').html('');
    modal_center();
    var $this = $(this);
    $.ajax({
        type: "GET",
        url: window.location.origin + '/mascotas-detalle',
        dataType: 'json',
        cache: false,
        data: {report_id: id, status: status},
        success: function (data) {
            if (data.result) {
                $('.pet-detail-image').html('<img src="/images/pets/' + data.pet.pet_image + '" style="width:100%;">');
                $('.pet-detail-location').html(data.pet.address);
                $('.owner-detail-phone').html('<a class="report-phone" href="tel:' + data.pet.user_phone + '">' + data.pet.user_phone + '</a>');
                $('.owner-detail-name').html(data.pet.user_name);
                $('.owner-detail-email').html(data.pet.user_email);
                $('.owner-detail-reward').html(data.pet.owner_reward);
                $('.pet-detail-name').html(data.pet.pet_name);
                $('.pet-detail-race').html(data.pet.pet_race);
                $('.pet-detail-gender').html(data.pet.pet_gender);
                $('.pet-detail-description').html(data.pet.pet_description);
                $('.report-detail-date').html(data.pet.report_date);
                $('.report-detail-date').html(data.pet.report_date);
                $('.report-detail-hour').html(data.pet.report_time);
                $('.report-detail-address').html(data.pet.location_address);
                $('.report-detail-description').html(data.pet.report_description);
                var lat = parseFloat(data.pet.location_latitude);
                var lon = parseFloat(data.pet.location_longitude);

                modal_center();
                if (detail_marker)
                    detail_marker.setMap(null);
                google.maps.event.trigger(detail_map, 'resize');
                detail_marker = new google.maps.Marker({
                    position: {lat: lat, lng: lon},
                    draggable: true,
                    animation: google.maps.Animation.DROP,
                });
                detail_marker.addListener('click', toggleBounce);
                detail_marker.setMap(detail_map);
                detail_map.setZoom(15);
                detail_map.setCenter(new google.maps.LatLng(lat, lon));
            }
        }
    });
}

function item_finded_pet(id) {
    $(this).siblings().css('pointer-events','none');
    var pet = $("#_" + id);
    var url = pet.attr('src');
    var img = new Image();
    img.src = url;
    var canvas = document.createElement('canvas');
    var ctx = canvas.getContext("2d");
    var pic_real_width, pic_real_height;
    $("<img/>") // se hace una copia en memoria de la imagen para no lidiar con el css que reduce a 206
        .attr("src", $(pet).attr("src"))
        .load(function() {
            pic_real_width = this.width;   
            pic_real_height = this.height; 
            canvas.width = pic_real_width;
            canvas.height = pic_real_height;
            ctx.drawImage(img, 0, 0, pic_real_width, pic_real_width);
            ctx.fillStyle = "green";
            ctx.globalAlpha = 0.5;
            ctx.fillRect(0, 0, pic_real_width, pic_real_height);
            var textoWidth  = pic_real_width * 0.3;
            var textoHeight = pic_real_height * 0.6;
            ctx.globalAlpha = 1;
            ctx.fillStyle = "white";
            ctx.font = "65px Arial";
            ctx.fillText('Encontrado', textoWidth, textoHeight);
            
            ctx.beginPath();
            ctx.arc(pic_real_width * 0.5, pic_real_height * 0.45, 40, 0, 2 * Math.PI);
            ctx.closePath();
            //ctx.fill();
            ctx.lineWidth = 8;
            ctx.strokeStyle = "white";
            ctx.stroke();
            ctx.fillStyle = "white";
            
            // Draw the left eye
            // 20 - 10
            ctx.beginPath();
            ctx.arc((pic_real_width * 0.5) - 15, (pic_real_height * 0.45) - 15, 8, 0, 2 * Math.PI);
            ctx.closePath();
            ctx.fill();


            // Draw the right eye
            // +19 - 10
            ctx.beginPath();
            ctx.arc((pic_real_width * 0.5) + 14, (pic_real_height * 0.45) - 15, 8, 0, 2 * Math.PI);
            ctx.closePath();
            ctx.fill();

            // Draw the mouth
            //0+5
            /*ctx.beginPath();            
            ctx.arc((pic_real_width * 0.5), (pic_real_height * 0.45) + 5, 26, Math.PI, 2 * Math.PI, true);
            ctx.closePath();
            ctx.strokeStyle = "white";
            ctx.fill();*/
            ctx.beginPath()
            ctx.moveTo((pic_real_width * 0.5) - 15, pic_real_height * 0.45);
            ctx.bezierCurveTo((pic_real_width * 0.5) - 15, (pic_real_height * 0.45) + 20,
                (pic_real_width * 0.5) + 14, (pic_real_height * 0.45) + 20,
                (pic_real_width * 0.5) + 14, pic_real_height * 0.45);
            ctx.strokeStyle = "white";
            ctx.stroke();

            pet.attr('src', canvas.toDataURL('image/jpeg')); 

            var processjpg = canvas.toDataURL('image/jpeg');
            $("._item_" + id).css('pointer-events', 'none !important');
            $("._item_" + id).attr('disabled', true);


            $.ajax({
                type: "POST",
                url: window.location.origin + '/mis-reportes-encontrado',
                dataType: 'json',
                cache: false,
                async: false,
                data: "id=" + id + "&pngimageData=" + processjpg,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    if (result) {
                        console.log('encontrado exitosamente');
                    }
                }
            });  
        });
   
    
}
function item_detail_view(id) {
    $("#report-detail-lost").modal().show();
    $("#report-detail-lost").find('a').show();
    $('.report-detail-lost-image').html('');
    $('.report-detail-lost-address').html('');
    $('.report-detail-lost-phone').html('');
    $('.report-detail-lost-name').html('');
    $('.report-detail-lost-race').html('');
    $('.report-detail-lost-gender').html('');
    $('.report-detail-lost-date').html('');
    modal_center();
    $.ajax({
        type: "GET",
        url: window.location.origin + '/mis-reportes-detalle-perdido',
        dataType: 'json',
        cache: false,
        data: {reportid: id},
        success: function (data) {
            if (data.result) {
                $('.report-detail-lost-image').html('<img src="/images/pets/' + data.report.image + '" style="width:500px;height:500px;">');
                $('.report-detail-lost-address').html(data.report.address);
                $('.report-detail-lost-phone').html('<a class="report-phone" href="tel:' + data.report.user_phone + '">' + data.report.user_phone + '</a>');
                $('.report-detail-lost-name').html(data.report.name);
                $('.report-detail-lost-race').html(data.report.race);
                $('.report-detail-lost-gender').html(data.report.gender);
                $('.report-detail-lost-date').html(data.report.date);
                $('#post_social_div').html('<button onclick="postFacebook('+id+')" class="btn btn-primary btn-block btn-button">Compartir</button>');
                $('#download_report_div').children().first().attr('href', data.path + '/descargar-volante/jpg/?reportid=' + id);
                $('#download_report_div').children().last().attr('href', data.path + '/descargar-volante/pdf/?reportid=' + id);
                $('#report_id').val(id);
                modal_center();
            }
        }
    });
}
var locationsCountry = $('#ubigeo-department');
locationsCountry.on('change', function (e) {
    e.preventDefault();
    var $this = $(this);
    console.log($this.val());
    if ($this.val() == "Todos") {
        $("#ubigeo-city").html('<option value="" default style="display:none;">-----</option>').fadeIn();
        $("#ubigeo-district").html('<option value="" default style="display:none;">-----</option>').fadeIn();
        $('#ubigeo-city').addClass('error');
        $('#ubigeo-district').addClass('error');
        var department = "Todos";
        var city = "";
        var district = "";
        $.ajax({
            type: "GET",
            url: window.location.origin + '/search-pets',
            dataType: 'json',
            cache: false,
            data: { department: department, city: city, district: district },
            success: function (data) {
                var li_html = '';
                if (data.data) {
                    var gallery_class_name, gallery_event;
                    if ($('ul.pets-list')) {
                        gallery_class_name = 'gallery-item-hover';
                        gallery_event = "gallery_item_over";
                    }
                    if ($('ul.pets-list').parent().attr('id') == 'home_gallery_ul_parent') {
                        gallery_class_name = 'gallery-div-hover';
                        gallery_event = "item_detail_view";
                    }
                    for (var i = 0; i < data.data.length; i++) {
                        li_html += '<li><a data-toggle="modal"><img src="/images/pets/' + data.data[i]['image'] + '">';
                        li_html += '<div class="gallery-item-hover" onclick="gallery_item_over(' + data.data[i]['id'] + ')">';
                        li_html += '<p>' + data.data[i]['description'] + '</p>';
                        li_html += '</div>';
                        li_html += '<div class="gallery-item-detail">';
                        li_html += '<h2>' + data.data[i]['name'] + '</h2>';
                        li_html += '<p class="gallery-item-birthday">' + data.data[i]['date'] + '</p>';
                        li_html += '<p class="gallery-item-location">' + data.data[i]['address'] + '</p>';
                        li_html += '</div>';
                        li_html += '</a>';
                        li_html += '</li>';
                    }
                    if ($('ul.pets-list'))
                        $('ul.pets-list').html(li_html);
                    if ($('ul.pets-list'))
                        $('ul.pets-list').html(li_html);
                }
            }
        });
    } else {
        $.ajax({
            type: "GET",
            url: window.location.origin + '/ubigeo-ciudades',
            dataType: 'json',
            cache: false,
            data: { department: $this.val() },
            success: function (data) {
                if (data.result) {
                    $('#ubigeo-city').html(data.options).fadeIn();
                    $("#ubigeo-city").append('<option value="Todos">Todos</option>');
                    $('#ubigeo-district').html('<option value="" default style="display:none;">Distrito</option>').fadeIn();                    
                    $("#ubigeo-district").append('<option value="Todos">Todos</option>');
                    $('#ubigeo-city').addClass('error');
                    $('#ubigeo-district').addClass('error');
                }
            }
        });


        var department = $this.val();
        var city = "";
        var district = "";
        $.ajax({
            type: "GET",
            url: window.location.origin + '/search-pets',
            dataType: 'json',
            cache: false,
            data: { department: department, city: city, district: district },
            success: function (data) {
                var li_html = '';
                if (data.data) {
                    var gallery_class_name, gallery_event;
                    if ($('ul.pets-list')) {
                        gallery_class_name = 'gallery-item-hover';
                        gallery_event = "gallery_item_over";
                    }
                    if ($('ul.pets-list').parent().attr('id') == 'home_gallery_ul_parent') {
                        gallery_class_name = 'gallery-div-hover';
                        gallery_event = "item_detail_view";
                    }
                    for (var i = 0; i < data.data.length; i++) {
                        li_html += '<li><a data-toggle="modal"><img src="/images/pets/' + data.data[i]['image'] + '">';
                        li_html += '<div class="gallery-item-hover" onclick="gallery_item_over(' + data.data[i]['id'] + ')">';
                        li_html += '<p>' + data.data[i]['description'] + '</p>';
                        li_html += '</div>';
                        li_html += '<div class="gallery-item-detail">';
                        li_html += '<h2>' + data.data[i]['name'] + '</h2>';
                        li_html += '<p class="gallery-item-birthday">' + data.data[i]['date'] + '</p>';
                        li_html += '<p class="gallery-item-location">' + data.data[i]['address'] + '</p>';
                        li_html += '</div>';
                        li_html += '</a>';
                        li_html += '</li>';
                    }
                    if ($('ul.pets-list'))
                        $('ul.pets-list').html(li_html);
                    if ($('ul.pets-list'))
                        $('ul.pets-list').html(li_html);
                }
            }
        });


    }
    


});


var locationsCity = $('#ubigeo-city');
locationsCity.on('change', function (e) {
    e.preventDefault();
    var $this = $(this);
    if ($this.val() == "Todos") {
        $("#ubigeo-district").html('<option value="" default style="display:none;">-----</option>').fadeIn();
        var department = $('#ubigeo-department').val();
        var city = "Todos";
        var district = "";
        $.ajax({
            type: "GET",
            url: window.location.origin + '/search-pets',
            dataType: 'json',
            cache: false,
            data: { department: department, city: city, district: district },
            success: function (data) {
                var li_html = '';
                if (data.data) {
                    var gallery_class_name, gallery_event;
                    if ($('ul.pets-list')) {
                        gallery_class_name = 'gallery-item-hover';
                        gallery_event = "gallery_item_over";
                    }
                    if ($('ul.pets-list').parent().attr('id') == 'home_gallery_ul_parent') {
                        gallery_class_name = 'gallery-div-hover';
                        gallery_event = "item_detail_view";
                    }
                    for (var i = 0; i < data.data.length; i++) {
                        li_html += '<li><a data-toggle="modal"><img src="/images/pets/' + data.data[i]['image'] + '">';
                        li_html += '<div class="gallery-item-hover" onclick="gallery_item_over(' + data.data[i]['id'] + ')">';
                        li_html += '<p>' + data.data[i]['description'] + '</p>';
                        li_html += '</div>';
                        li_html += '<div class="gallery-item-detail">';
                        li_html += '<h2>' + data.data[i]['name'] + '</h2>';
                        li_html += '<p class="gallery-item-birthday">' + data.data[i]['date'] + '</p>';
                        li_html += '<p class="gallery-item-location">' + data.data[i]['address'] + '</p>';
                        li_html += '</div>';
                        li_html += '</a>';
                        li_html += '</li>';
                    }
                    if ($('ul.pets-list'))
                        $('ul.pets-list').html(li_html);
                    if ($('ul.pets-list'))
                        $('ul.pets-list').html(li_html);
                }
            }
        });
    } else {
        $.ajax({
            type: "GET",
            url: window.location.origin + '/ubigeo-distritos',
            dataType: 'json',
            cache: false,
            data: { city: $this.val() },
            success: function (data) {
                if (data.result) {
                    $('#ubigeo-district').html(data.options).fadeIn();
                    $("#ubigeo-district").append('<option value="Todos">Todos</option>');
                    $('#ubigeo-district').addClass('error');
                }
            }
        });

        var department = $('#ubigeo-department').val();
        var city = $this.val();
        var district = "";
        $.ajax({
            type: "GET",
            url: window.location.origin + '/search-pets',
            dataType: 'json',
            cache: false,
            data: { department: department, city: city, district: district },
            success: function (data) {
                var li_html = '';
                if (data.data) {
                    var gallery_class_name, gallery_event;
                    if ($('ul.pets-list')) {
                        gallery_class_name = 'gallery-item-hover';
                        gallery_event = "gallery_item_over";
                    }
                    if ($('ul.pets-list').parent().attr('id') == 'home_gallery_ul_parent') {
                        gallery_class_name = 'gallery-div-hover';
                        gallery_event = "item_detail_view";
                    }
                    for (var i = 0; i < data.data.length; i++) {
                        li_html += '<li><a data-toggle="modal"><img src="/images/pets/' + data.data[i]['image'] + '">';
                        li_html += '<div class="gallery-item-hover" onclick="gallery_item_over(' + data.data[i]['id'] + ')">';
                        li_html += '<p>' + data.data[i]['description'] + '</p>';
                        li_html += '</div>';
                        li_html += '<div class="gallery-item-detail">';
                        li_html += '<h2>' + data.data[i]['name'] + '</h2>';
                        li_html += '<p class="gallery-item-birthday">' + data.data[i]['date'] + '</p>';
                        li_html += '<p class="gallery-item-location">' + data.data[i]['address'] + '</p>';
                        li_html += '</div>';
                        li_html += '</a>';
                        li_html += '</li>';
                    }
                    if ($('ul.pets-list'))
                        $('ul.pets-list').html(li_html);
                    if ($('ul.pets-list'))
                        $('ul.pets-list').html(li_html);
                }
            }
        });
    }
    
});

var locationsDistrict = $('#ubigeo-district');
locationsDistrict.on('change', function (e) {
    var department = '';
    var city = '';
    if ($("#ubigeo-district").val() == "Todos") {
        var department = $("#ubigeo-department").val();
        var city = $("#ubigeo-city").val();
    } 
    
    var district = $('#ubigeo-district').val();
    $.ajax({
        type: "GET",
        url: window.location.origin + '/search-pets',
        dataType: 'json',
        cache: false,
        data: {department: department, city: city, district: district},
        success: function (data) {
            var li_html = '';
            if (data.data) {
                var gallery_class_name, gallery_event;
                if ($('ul.pets-list'))
                {
                    gallery_class_name = 'gallery-item-hover';
                    gallery_event = "gallery_item_over";
                }
                if ($('ul.pets-list').parent().attr('id') == 'home_gallery_ul_parent') {
                    gallery_class_name = 'gallery-div-hover';
                    gallery_event = "item_detail_view";
                }
                for (var i = 0; i < data.data.length; i++) {
                    li_html += '<li><a data-toggle="modal"><img src="/images/pets/' + data.data[i]['image'] + '">';
                    li_html += '<div class="gallery-item-hover" onclick="gallery_item_over(' + data.data[i]['id'] + ')">';
                    li_html += '<p>' + data.data[i]['description'] + '</p>';
                    li_html += '</div>';
                    li_html += '<div class="gallery-item-detail">';
                    li_html += '<h2>' + data.data[i]['name'] + '</h2>';
                    li_html += '<p class="gallery-item-birthday">' + data.data[i]['date'] + '</p>';
                    li_html += '<p class="gallery-item-location">' + data.data[i]['address'] + '</p>';
                    li_html += '</div>';
                    li_html += '</a>';
                    li_html += '</li>';
                }
                if ($('ul.pets-list'))
                    $('ul.pets-list').html(li_html);
                if ($('ul.pets-list'))
                    $('ul.pets-list').html(li_html);
            }
        }
    });
});

var reportLostAdd = $('.report-lost-add');
reportLostAdd.on('click', function (e) {
    map_initial = true;
    $("#form-report-lost").modal().show();
    $("#form-report-lost #pet_lost_radio").prop("checked", true);
    $("#form-report-lost #name_div").show();
    var margin_top = $("#form-report-lost").find('.modal-content').outerHeight() / 2;
   // $("#form-report-lost").find('.modal-content').css('top', '50vh');
    //$("#form-report-lost").find('.modal-content').css('margin-top', '-' + margin_top + 'px');
    
    Initialize_Report(); 
    /*var pac_html = "<input type='text' id='pac-input' placeholder='Ingresa la dirección donde se perdió o arrastra el PIN'></input>";
    $("#pac-input-div").html(pac_html);*/
});
var reportFoundAdd = $('.report-found-add');
reportFoundAdd.on('click', function (e) {
    map_initial = true;
    $("#form-report-lost #pet_found_radio").prop("checked", true);
    //$("#form-report-lost #name_div").hide();
    $("#form-report-lost").modal().show();
    var margin_top = $("#form-report-lost").find('.modal-content').outerHeight() / 2;
    //$("#form-report-lost").find('.modal-content').css('top', '50vh');
    //$("#form-report-lost").find('.modal-content').css('margin-top', '-' + margin_top + 'px');
    
    Initialize_Report()
    var pac_html = "<input type='text' id='pac-input' placeholder='Ingresa la dirección donde se perdió o arrastra el PIN'></input>";
    $("#pac-input-div").html(pac_html);
});
$('#report_tab_1').on('click', function () {
    var pac_html = "<input type='text' id='pac-input' placeholder='Ingresa la dirección donde se perdió o arrastra el PIN'></input>";
    $("#pac-input-div").html(pac_html);
});
$('#report_tab_3').on('click', function () {
    var pac_html = "<input type='text' id='pac-input' placeholder='Ingresa la dirección donde se perdió o arrastra el PIN'></input>";
    $("#pac-input-div").html(pac_html);
});
function Initialize_Report()
{
    $("#form-report-lost-tab-1").show();
    $("#lost_pet_file").parent().show();
    $(".upload-image-lost-preview").hide();
    $('.upload-image-lost-preview .preview-img').removeAttr('style');
    $('#report_id').val('');
    $('#lost_pet_name').val('');
    $('#lost_pet_race').val('');
    $('#lost_pet_gender').val('');
    $('#lost_pet_description').val('');
    $('#datepicker').val('');
    $('#timepicker').val('');
    /*$('#pac-input').val('');
    $('#pac-address').val('');
    $('#pac-department').val('');
    $('#pac-city').val('');
    $('#pac-district').val('');
    $('#pac-postal_code').val('');
    $('#pac-latitude').val('');
    $('#pac-longitude').val('');*/
    $('#lost_pet_report_description').val('');
    $('#lost_pet_reward').val('');
    if (lost_marker)
        lost_marker.setMap(null);
    /*lost_marker = new google.maps.Marker({
        position: {lat: latitude, lng: longitude},
        draggable: true,
        animation: google.maps.Animation.DROP,
    });
    */

    geocoder = new google.maps.Geocoder();
    lost_marker.setMap(lost_map);
    //lost_map.addListener('click', toggleBounce);
    lost_map.setCenter(new google.maps.LatLng(latitude, longitude));
    lost_map.setZoom(15);
    $('.inputsAddress input').filter('[required]').keyup(startPoll);
    $('#dist').on('change', geocodeAddress);
    $('#city').on('change', geocodeAddressCity);
    $('#dep').on('change', geocodeAddressDep);
}

var reportDetailFound = $('.report-detail-found');
reportDetailFound.on('click', function (e) {
    $('.report-detail-found-image').html('');
    $('.report-detail-found-address').html('');
    $('.report-detail-found-phone').html('');
    $('.report-detail-found-date').html('');
    modal_center();
    e.preventDefault();
    var $this = $(this);
    $.ajax({
        type: "GET",
        url: window.location.origin + '/mis-reportes-detalle-encontrado',
        dataType: 'json',
        cache: false,
        data: {reportid: $this.data('id')},
        success: function (data) {
            if (data.result) {
                $('.report-detail-found-image').html('<img src="' + data.path + '/images/pets/' + data.pet.image + '">');
                $('.report-detail-found-address').html(data.pet.address);
                $('.report-detail-found-phone').html('<a class="report-phone" href="tel:' + data.pet.phone + '">' + data.pet.phone + '</a>');
                $('.report-detail-found-date').html(data.pet.date);
                $('.btn-download-found').attr('href', data.path + '/descargar-volante/encontrado/?reportid=' + $this.data('id'));
                modal_center();
            }
        }
    });
});

var submitContact = $('.btn-submit-contact');
submitContact.on('click', function(e){
    e.preventDefault();    
    $.ajax({ 
        type: "POST",
        url: window.location.origin + '/contactanos2',
        cache: false,
        async: false,
        dataType: 'json',
        data: $('#form-contact-us-form').serialize(),
        success: function (result) {
            if (result) {
                alert('Correo enviado exitosamente');
                window.location.reload();
            }
        }
    });
});
var submitReport = $('.btn-submit-report');
submitReport.on('click', function (e) {
    e.preventDefault();
    if ($("input[name='lost_pet_owner_name']").val().length == 0) {
        alert("Debe ingresar el nombre del propietario");
        return false;
    }

    if ($("input[name='lost_pet_contact_name']").val().length == 0) {
        alert("Debe ingresar el numero de contacto");
        return false;
    }
    
    if ($("input[name='lost_pet_contact_email']").val().length == 0) {
        alert("Debe ingresar el correo del contacto");
        return false;
    }


    submitReport.html('Cargando...');
    var cropcanvas = $('#cropper-image').cropper('getCroppedCanvas');
    if($(".preview-img").css('background-image')=='' && !cropcanvas && $('#report_id').val()=='') {
    submitReport.html('Finalizar');
	alert('Elija una imagen del animal doméstico en su computadora, por favor');    
	$("#form-report-lost-tab-1").removeClass('hide');
	$("#form-report-lost-tab-2").addClass('hide');
	$("#form-report-lost-tab-3").addClass('hide');
	$("#tab-1").addClass('tab-on');
	$("#tab-2").removeClass('tab-on');
	$("#tab-3").removeClass('tab-on');
	return false;
    }
    //var address = $("#pac-address").val();
    /*if (!address) {
        submitReport.html('Finalizar');
        alert('Seleccionar área en el mapa, por favor');
        $("#form-report-lost-tab-1").addClass('hide');
        $("#form-report-lost-tab-2").removeClass('hide');
        $("#form-report-lost-tab-3").addClass('hide');
        $("#tab-1").removeClass('tab-on');
        $("#tab-2").addClass('tab-on');
        $("#tab-3").removeClass('tab-on');
        return false;
    }*/

    var department = $("#dep").val();
    var city = $("#city").val();
    var district = $("#dist").val();
    var street = $("#street").text();
    console.log(street);
    var croppng;
    /*if (cropcanvas)
        croppng = cropcanvas.toDataURL("image/png");
    else
        croppng = '';
    */
    
    croppng = datosimg;
    $('#cropper-image').cropper('clear');
    $('#cropper-image').cropper('destroy');
    $.ajax({
        type: "POST",
        url: window.location.origin + '/mis-reportes-registrar',
        dataType: 'json',
        cache: false,
        async: false,
        data: $('#form-report-lost-form').serialize() + "&pngimageData=" + croppng 
        + "&department=" + department + "&city=" + city + "&district=" + district + "&street=" + street,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (result) {
            if (result) {                
                window.location.reload();
            }
        }
    });
});

var submitSubscription = $('#form-subscriptions');
submitSubscription.submit(function (e) {
    e.preventDefault();
    var $this = $(this);
    $.ajax({
        type: "POST",
        url: $this.attr('action'),
        dataType: 'json',
        cache: false,
        data: submitSubscription.serialize(),
        success: function (data) {
            $('#subscription-message').show();
            if (data.status) {
                $('#subscription-message').html(data.message);
            } else {
                $('#subscription-message').html(data.errors.join('<br>'));
            }
        }
    });
});

var submitRegister = $('#form-user-register').find('form');
submitRegister.submit(function (e) {
    e.preventDefault();
    var data = submitRegister.serialize();
    var $this = $(this);
    $.ajax({
        type: "POST",
        url: $this.attr('action'),
        dataType: 'json',
        cache: false,
        data: data,
        success: function (data) {
            if (data.url)
                window.location.href = data.url;
            else
            {
                $('#register-message').show();
                modal_center();
                if (data.status) {
                    $('#register-message').html(data.message);
                } else {
                    $('#register-message').html(data.errors.join('<br>'));
                }
            }
        }
    });
});

var submitLogin = $('#form-user-login').find('form');
submitLogin.submit(function (e) {
    e.preventDefault();
    var $this = $(this);
    $.ajax({
        type: "POST",
        url: $this.attr('action'),
        dataType: 'json',
        cache: false,
        data: submitLogin.serialize(),
        success: function (data) {
            $('#login-message').show();
            modal_center();
            if (data.status) {
                $('#login-message').html(data.message);
                $(location).attr('href', data.url);
            } else {
                $('#login-message').html(data.errors.join('<br>'));
            }
        }
    });
});

$("#download_report").on("mouseover", function () {
    $("#download_report_div").removeClass('hide');
})

$("#download_report").parent().on("mouseleave", function () {
    $("#download_report_div").addClass('hide');
})
$("#download_report_div").on("mouseleave", function () {
    $("#download_report_div").addClass('hide');
})
//});

var detail_map, found_map, lost_map;
var detail_marker, found_marker, lost_marker;
var init_latitude, init_longitude;
var latitude, longitude;
var map_initial = false;
var timer;
var geocoder;

function initMap() {
    var lat,lon;
    init_latitude = -12.038601;
    init_longitude = -77.058927;
    lost_map = new google.maps.Map(document.getElementById('pet-lost-map'), {
        center: {lat: init_latitude, lng: init_longitude},
        zoom: 15,
        disableDefaultUI: true
    });

    
    /*google.maps.event.addListener(lost_map, 'rightclick', function (e) {
        lat = e.latLng.lat();
        lon = e.latLng.lng();
        lost_marker.setMap(null);
        lost_marker = new google.maps.Marker({
            position: {lat: lat, lng: lon},
            draggable: true,
            animation: google.maps.Animation.DROP
        });
        google.maps.event.addListener(lost_marker, 'dragend', function (e) {
            lat = e.latLng.lat();
            lon = e.latLng.lng();
            displayLocation(lat, lon, lost_map);
        });
        lost_marker.setMap(lost_map);
        google.maps.event.addListener(lost_marker, 'dragend', function (e) {
            lat = e.latLng.lat();
            lon = e.latLng.lng();
            displayLocation(lat, lon, lost_map);
        });
        displayLocation(lat, lon, lost_map);
    });
    */
    detail_map = new google.maps.Map(document.getElementById('pet-detail-map'), {
        center: {lat: init_latitude, lng: init_longitude},
        zoom: 15,
        disableDefaultUI: true
    });
    detail_marker = new google.maps.Marker({
        position: {lat: init_latitude, lng: init_longitude},
        draggable: true,
        animation: google.maps.Animation.DROP,
    });

    lost_marker = new google.maps.Marker({        
        map: lost_map,
        draggable: true,
        animation: google.maps.Animation.DROP
    }); 
    detail_marker.setMap(detail_map);
    google.maps.event.addListener(detail_marker, 'click', function (e) {
        lat = e.latLng.lat();
        lon = e.latLng.lng();
        //displayLocation(lat, lon, detail_map);
    });      
    google.maps.event.addListener(lost_marker, 'click', function(e){
        $("#lat").val(e.latLng.lat());
        $("#lng").val(e.latLng.lng());
    });
    
      // Create the search box and link it to the UI element.
    /*var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);*/
  //  lost_map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    // Bias the SearchBox results towards current map's viewport.
  /*  lost_map.addListener('bounds_changed', function () {
        searchBox.setBounds(lost_map.getBounds());
    });
*/
    var markers = [];
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
  /*  searchBox.addListener('places_changed', function () {
        var places = searchBox.getPlaces();

        if (places.length == 0) {
        	alert('No hay ninguna dirección con el mismo nombre que el texto de entrada');
            	return;
        }
        else if (places.length == 1) 
        {
	        var lat = places[0].geometry.location.lat();
		var lon = places[0].geometry.location.lng();  
	        lost_marker.setMap(null);
	        lost_marker = new google.maps.Marker({
	            position: {lat: lat, lng: lon},
	            draggable: true,
	            animation: google.maps.Animation.DROP
	        });
	        google.maps.event.addListener(lost_marker, 'dragend', function (e) {
	            lat = e.latLng.lat();
	            lon = e.latLng.lng();
	            displayLocation(lat, lon, lost_map);
	        });
	        lost_marker.setMap(lost_map);
	        google.maps.event.addListener(lost_marker, 'dragend', function (e) {
	            lat = e.latLng.lat();
	            lon = e.latLng.lng();
	            displayLocation(lat, lon, lost_map);
        	});        	
        	displayLocation(lat, lon, lost_map);
        }
        else
        {
            alert('Hay varias direcciones con el mismo nombre que el texto de entrada');
            return;
        }
    });*/
}


function displayLocation(latitude, longitude, map) {
    var geocoder;
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(latitude, longitude);
    map.setCenter(latlng);
    geocoder.geocode(
            {'latLng': latlng},
            function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        map.setZoom(15);
                        map.setCenter(results[0].geometry.location);
                        var postal_code = extractFromAdress(results[0].address_components, "postal_code");
                        var street_number = extractFromAdress(results[0].address_components, "street_number");
                        var district = extractFromAdress(results[0].address_components, "route");
                        var city = extractFromAdress(results[0].address_components, "locality");
                        var department = extractFromAdress(results[0].address_components, "administrative_area_level_2");
                        var country = extractFromAdress(results[0].address_components, "country");
                        document.getElementById('pac-input').value = street_number + " " + district + " " + city + " " + department;
                        document.getElementById('pac-department').value = department;
                        document.getElementById('pac-city').value = city;
                        document.getElementById('pac-district').value = district;
                        document.getElementById('pac-address').value = street_number + " " + district + " " + city + " " + department;
                        document.getElementById('pac-latitude').value = latitude;
                        document.getElementById('pac-longitude').value = longitude;
                        document.getElementById('pac-postal_code').value = postal_code;
                    } else {
                        document.getElementById('pac-input').value.innerHTML = "address not found";
                    }
                } else {
                    document.getElementById('pac-input').value.innerHTML = "Geocoder failed due to: " + status;
                }
            }
    );
}

function startPoll() {
    if (timer == undefined) {
        timer = setInterval(geocodeAddress, 2000);
        geocodeAddress();
    }
}

function isNull(v) {
    return !v || v == '';
}

function geocodeAddressDep() {
    $this = $("#dep")
    $.ajax({
        type: "GET",
        url: window.location.origin + '/ubigeo-ciudades',
        dataType: 'json',
        cache: false,
        data: { department: $this.val() },
        success: function (data) {
            if (data.result) {
                $('#city').html(data.options).fadeIn();
                $("#city").append('<option value="">Ciudad</option>');
                $('#dist').html('<option value="" default style="display:none;">Distrito</option>').fadeIn();
                $("#dist").append('<option value="">Distrito</option>');
                $('#city').addClass('error');
                $('dist').addClass('error');
            }
        }
    });

    var address = $('#street').val();
    if (!isNull(address)) address += ' ' + $('#num').val();
    if (!isNull($('#urb').val())) address += ',' + $('#urb').val();
    if (!isNull($("#dist option:selected").text())) address += ',' + $("#dist option:selected").text();
    if ($("#city option:selected").text()) address += ',' + $("#city option:selected").text();

    if (!isNull(address)) {
        geocoder.geocode({ 'address': address + ',Peru' }, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                lost_map.panTo(results[0].geometry.location);
                $("#lat").val(results[0].geometry.location.lat);
                $("#lng").val(results[0].geometry.location.lng);
                lost_marker.setPosition(results[0].geometry.location);
                lost_marker.setAnimation(google.maps.Animation.BOUNCE);
                setTimeout(function () {
                    lost_marker.setAnimation(null);
                }, 2000);
            }
        });
    }
}


function geocodeAddressCity() {
    $this = $("#city");

    $.ajax({
        type: "GET",
        url: window.location.origin + '/ubigeo-distritos',
        dataType: 'json',
        cache: false,
        data: { city: $this.val() },
        success: function (data) {
            if (data.result) {
                $('#dist').html(data.options).fadeIn();
                $("#dist").append('<option value="">Distrito</option>');
                $('#dist').addClass('error');
            }
        }
    });


    var address = $('#street').val();
    if (!isNull(address)) address += ' ' + $('#num').val();
    if (!isNull($('#urb').val())) address += ',' + $('#urb').val();
    if (!isNull($("#dist option:selected").text())) address += ',' + $("#dist option:selected").text();
    if ($("#city option:selected").text()) address += ',' + $("#city option:selected").text();

    if (!isNull(address)) {
        geocoder.geocode({ 'address': address + ',Peru' }, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                lost_map.panTo(results[0].geometry.location);
                $("#lat").val(results[0].geometry.location.lat);
                $("#lng").val(results[0].geometry.location.lng);
                lost_marker.setPosition(results[0].geometry.location);
                lost_marker.setAnimation(google.maps.Animation.BOUNCE);
                setTimeout(function () {
                    lost_marker.setAnimation(null);
                }, 2000);
            }
        });
    }
}

function geocodeAddress() {

    var address = $('#street').val();
    if (!isNull(address)) address += ' ' + $('#num').val();
    if (!isNull($('#urb').val())) address += ',' + $('#urb').val();
    if (!isNull($("#dist option:selected").text())) address += ',' + $("#dist option:selected").text();
    if ($("#city option:selected").text()) address += ',' + $("#city option:selected").text();

    if (!isNull(address)) {
        console.log('la calle es ' + address);
        geocoder.geocode({ 'address': address + ',Peru' }, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                $("#lat").val(results[0].geometry.location.lat);
                $("#lng").val(results[0].geometry.location.lng);
                lost_map.panTo(results[0].geometry.location);
                lost_marker.setPosition(results[0].geometry.location);
                lost_marker.setAnimation(google.maps.Animation.BOUNCE);
                setTimeout(function () {
                    lost_marker.setAnimation(null);
                }, 2000);
            }
        });
    }
}

/*$("#pac-input").on("blur", function () {
    var address = $(this).val();
    $("#pac-address").val(address);
});*/
function extractFromAdress(components, type) {
    for (var i = 0; i < components.length; i++)
        for (var j = 0; j < components[i].types.length; j++)
            if (components[i].types[j] == type)
                return components[i].long_name;
    return "";
}
function toggleBounce() {
    if (detail_marker.getAnimation() !== null) {
        detail_marker.setAnimation(null);
    } else {
        detail_marker.setAnimation(google.maps.Animation.BOUNCE);
    }
}

function loadPets() {
    $.ajax({
        type: "GET",
        url: $(this).parent().parent().attr('actions'),
        data: {department: $this.val(), province: $('#ubigeo-city').val(), district: $('#ubigeo-district').val()},
        success: function (data) {
            if (data.status) {

            }
        }
    });
}

var datosimg;
var w_total = $('#pets-list').width();
var w_view = $(window).width() * 0.8;
var cnt_pets = parseInt(w_view / 205);
var w_gallery = cnt_pets * 205 + 95;
var pos_preview_area = cnt_pets * 205;
var pos_next_btn = cnt_pets * 205 + 35;
$('#block-home-gallery').width(w_gallery);
$('.prev-gallery-btn').hide();
$('.next-gallery-btn').show();
$('.next-gallery-btn').css('left', pos_next_btn);
$('.gallery-preview-area').css('left', pos_preview_area);
//window resize event
$(window).resize(function () {
    w_view = $(window).width() * 0.8;
    cnt_pets = parseInt(w_view / 205);
    w_gallery = cnt_pets * 205 + 95;
    pos_preview_area = cnt_pets * 205;
    pos_next_btn = cnt_pets * 205 + 35;
    $('#block-home-gallery').width(w_gallery);
    $('.next-gallery-btn').css('left', pos_next_btn);
    $('.gallery-preview-area').css('left', pos_preview_area);
});
//homepage slider animation
$('.prev-gallery-btn').click(function () {
    $('.next-gallery-btn').show();
    var prev_pos_gallery = $('.pets-list').position().left;
    if (Number(prev_pos_gallery + w_gallery) > -15)
        prev_pos_gallery = -10 - w_gallery;
    $('.pets-list').animate({left: prev_pos_gallery + w_gallery + 'px'}, 1000, function () {
        prev_pos_gallery += w_gallery;
        if (Number(prev_pos_gallery) > -15)
            $('.prev-gallery-btn').hide();
    });
});

$('.next-gallery-btn').click(function () {
    $('.prev-gallery-btn').show();
    var prev_pos_gallery = $('.pets-list').position().left;
    if (Math.abs(prev_pos_gallery - w_gallery * 2) > w_total)
        prev_pos_gallery = -w_total + w_gallery * 2;
    $('.pets-list').animate({left: prev_pos_gallery - w_gallery + 'px'}, 1000, function () {
        if (Math.abs(prev_pos_gallery - w_gallery * 2) >= w_total) {
            $('.next-gallery-btn').hide();
        }
    });
});
//image preview  flag - 0:found 1:lost
function cropper_Modal() {
    $("#modal-cropper").modal().show();
//    modal_center();
}
var upload_flag = 0;
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            //cropper
            $('#cropper-image').attr('src', e.target.result);
            //$('#btn-cropper').trigger('click');
            cropper_Modal();
            //$('.alert-message').text('Al subir la foto.. se alinea con esta linea');
            /*var w_window = $(window).width();
            var w_alert = 350;
            if (w_window > 400) {
                w_alert = 350;
                $('.alert-messsage').css('font-size', '14px');
                $('.alert-messsage').height(30);
                $('.alert-messsage').css('line-height', '30px');
            } else {
                w_alert = 270;
                $('.alert-messsage').css('font-size', '12px');
                $('.alert-messsage').height(27);
                $('.alert-messsage').css('line-height', '27px');
            }
            $('.alert-message').width(w_alert);
            $('.alert-message').css('left', (w_window - w_alert) / 2 + 'px');
            $('.alert-message').fadeIn(100);
            window.setTimeout(function () {
                $(".alert-message").fadeOut(300);
            }, 2000);*/
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$('.upload-image-found-preview .fileopen-img').click(function () {
    $('.upload-image-found-preview .found-upload').trigger('click');
});

$('.upload-image-lost-preview .fileopen-img').click(function () {
    $('.upload-image-lost-preview .lost-upload').trigger('click');
});

$(".found-upload").change(function () {
    upload_flag = 0;
    previewImage(this);
});

$(".lost-upload").change(function () {
    upload_flag = 1;
    previewImage(this);
});

//hide google map components
function hideMapComponents() {
    initMap();
}

//for cropper
$('#cropper-confirm').on('click', function () {
    // Crop
    var h = parseInt($('#dataHeight').val());
    var w = parseInt($('#dataWidth').val());
    var cropper = $('#cropper-image').cropper('getCroppedCanvas');

    var croppedCanvas;
    thumbWidth = 800;
    
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext("2d");
        newWidth = thumbWidth;        
        newHeight = Math.floor(h/w*newWidth);
        canvas.width = newWidth;
        canvas.height = newHeight;

        ctx.drawImage(cropper, 0, 0, newWidth, newHeight);
        datosimg = canvas.toDataURL("image/jpeg");
        $('#cropper-image').cropper('clear');
        $('#cropper-image').cropper('destroy');
    
        $('.upload-image-lost-preview .preview-img').css('background-image', 'url(' + datosimg + ')');
        $('.upload-image-lost-preview').show();
        $('#lost_pet_file').parent().hide();
        $('#modal-cropper .modal-header button').trigger('click');
    /*} else {
        $('.upload-image-lost-preview .preview-img').css('background-image', 'url(' + cropper.toDataURL() + ')');
        $('.upload-image-lost-preview').show();
        $('#lost_pet_file').parent().hide();
        $('#modal-cropper .modal-header button').trigger('click');
    }*/
    
});

$('#modal-cropper').on('shown.bs.modal', function () {
    var $dataX = $('#dataX');
    var $dataY = $('#dataY');
    var $dataHeight = $('#dataHeight');
    var $dataWidth = $('#dataWidth');
    $('#cropper-image').cropper({
        crop: function (e) {
            $dataX.val(Math.round(e.x));
            $dataY.val(Math.round(e.y));
            $dataHeight.val(Math.round(e.height));
            $dataWidth.val(Math.round(e.width));
        },
        done: function (data) {
            // Output the result data for cropping image.
        }
    });
    modal_center();
}).on('hidden.bs.modal', function () {
    // cropBoxData = $image.cropper('getCropBoxData');
    // canvasData = $image.cropper('getCanvasData');
    $('#cropper-image').cropper('destroy');
});
$('#form-report-lost').on('shown.bs.modal', function () {
//    alert();
}).on('hidden.bs.modal', function () {
    $("#form-report-lost-tab-1").removeClass('hide');
    $("#form-report-lost-tab-2").addClass('hide');
    $("#form-report-lost-tab-3").addClass('hide');
    $("#tab-1").addClass('tab-on');
    $("#tab-2").removeClass('tab-on');
    $("#tab-3").removeClass('tab-on');
});
$('.edit_menu').on('mouseover', function () {
    $(this).next().show();
})
$('.edit_menu_div').on('mouseleave', function () {
    $(this).hide();
})
$('#pet_lost_radio').on('click', function () {
    $("#form-report-lost").find('#name_div').show();
    $("#form-report-lost").find('#pet_lost_radio').prop("checked", true);
});
$('#pet_found_radio').on('click', function () {
    //$("#form-report-lost").find('#name_div').hide();
    $("#form-report-lost").find('#pet_found_radio').prop("checked", true);
});
function edit_pet_detail(id, status)
{
    map_initial = false;
    $("#form-report-lost").modal().show();
    $('#report_id').val(id);
    if (status == 0)
    {
        $("#form-report-lost").find('#name_div').show();
        $("#form-report-lost").find('#pet_lost_radio').prop("checked", true);
    } else
    {
        $("#form-report-lost").find('#name_div').hide();
        $("#form-report-lost").find('#pet_found_radio').prop("checked", true);
    }
//    modal_center();
    if (status == 0)
        status = 'lost';
    else
        status = 'found';
    $.ajax({
        type: "GET",
        url: window.location.origin + '/mascotas-detalle',
        dataType: 'json',
        cache: false,
        data: {report_id: id, status: status},
        success: function (data) {
            if (data) {                
                var pac_html = "<input type='text' id='pac-input'></input>";
                $("#pac-input-div").html(pac_html);
                $("#lost_pet_file").parent().hide();
                $(".upload-image-lost-preview").show();
                $('.upload-image-lost-preview .preview-img').attr('style', 'background-image:url("/images/pets/' + data.pet.pet_image + '")');
                $('#lost_pet_name').val(data.pet.pet_name);
                $('#lost_pet_race').val(data.pet.pet_race);
                $('#lost_pet_gender').val(data.pet.pet_gender);
                $('#lost_pet_description').val(data.pet.pet_description);
                $('#datepicker').val(data.pet.report_date);
                $('#timepicker').val(data.pet.report_time);
                $('#pac-input').val(data.pet.location_address);
                $('#pac-address').val(data.pet.location_address);
                $('#pac-department').val(data.pet.ubigeo_department);
                $('#pac-city').val(data.pet.ubigeo_city);
                $('#pac-district').val(data.pet.ubigeo_district);
                $('#pac-postal_code').val(data.pet.ubigeo_code);
                latitude = parseFloat(data.pet.location_latitude);
                longitude = parseFloat(data.pet.location_longitude);
                $('#pac-latitude').val(latitude);
                $('#pac-longitude').val(longitude);
                $('#lost_pet_report_description').val(data.pet.report_description);
                $('#lost_pet_reward').val(data.pet.owner_reward);
                var margin_top = $("#form-report-lost").find('.modal-content').outerHeight() / 2;
                $("#form-report-lost").find('.modal-content').css('top', '50vh');
                $("#form-report-lost").find('.modal-content').css('margin-top', '-' + margin_top + 'px');
            }
        }
    });
}
$("#goto_map_tab").on('click', function(){
    Map_correction();
});
function Map_correction()
{
    var lat, lon;
    if (map_initial)
    {
        lat = init_latitude;
        lon = init_longitude;
    } else
    {
        lat = latitude;
        lon = longitude;
        if (lost_marker)
            lost_marker.setMap(null);
        lost_marker = new google.maps.Marker({
            position: {lat: lat, lng: lon},
            draggable: true,
            animation: google.maps.Animation.DROP,
        });        
        google.maps.event.addListener(lost_marker, 'dragend', function (e) {
            lat = e.latLng.lat();
            lon = e.latLng.lng();
            displayLocation(lat, lon, lost_map);
        });
        lost_marker.setMap(lost_map);
        lost_map.setCenter(new google.maps.LatLng(lat, lon));
        lost_map.setZoom(15);
        google.maps.event.addListener(lost_marker, 'rightclick', function (e) {
            var lat = e.latLng.lat();
            var lon = e.latLng.lng();
            displayLocation(lat, lon, lost_map);
        });
    }
}
function delete_pet_detail(id)
{
    if (confirm('Desea eliminar este informe realmente?'))
        $.ajax({type: "GET",
            url: window.location.origin + '/delete_report',
            dataType: 'json',
            cache: false,
            data: {report_id: id},
            success: function (result) {
                if (result) {
                    window.location.reload();
                }
            }
        });
}
$(window).on('mouseover', function () {
    modal_center();
})
function modal_center()
{
    /*
    console.log(navigator.userAgent.toString());
    $('.modal-content').each(function () {
        var margin_top = $(this).outerHeight() / 2;
        var screen_height=$(window).outerHeight() /2;
        
        //console.log(screen_height+">"+margin_top);
        if(screen_height>margin_top )
        {

		$(this).css('top', '50vh');
		$(this).css('margin-top', '-' + margin_top + 'px');
        }
        else
        {
        	$(this).removeAttr('style');
        }

        if (bMobile) {
            console.log('esta en movil');
            
            $(this).css('position', 'absolute');
            $(this).css('height', '90vh !important');
            if ($(this).children().first().hasClass('form-user')) {
                $(this).css('top', '1vh');
                $(this).css('margin-top', '10vh');
            }
            //$(this).css('left', '1vw');
            
            
            //$(this).css('left', '10vw');
            var margin_left = $(this).outerWidth(true)/2;
            var screen_width = $(window).width()/2;
            
            
            var width_modal = $(this).width() / 2;
            var diff = 0;
            if (width_modal <= 1) {
                diff = screen_width / 2 - width_modal;
            } else {
                diff = screen_width - width_modal;
            }
            
            
            diff = Number(diff) - 17;      
            console.log(diff);
            $(this).css('margin-left', diff + 'px');
            $(this).css('margin-left', '5vw');
            $(this).css('display', 'block');
            //$(this).css('margin-left', '5vw');
        }
    });*/
}