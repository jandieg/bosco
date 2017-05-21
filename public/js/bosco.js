$(document).ready(function () {
    $(window).on('mouseover', function () {
        modal_center();
    })
    function modal_center()
    {
        $('.modal-content').each(function () {
            var margin_top = $(this).outerHeight() / 2;
            $(this).css('top', '50vh');
            $(this).css('margin-top', '-' + margin_top + 'px');
        });
    }
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
        format: "YYYY-MM-DD"
    });
    $('#timepicker').datetimepicker({
        format: "H:mm:ss"
    });

    var petDetail = $('.gallery-item-hover');
    petDetail.on('click', function (e) {
        e.preventDefault();
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
            data: {petid: $this.data('id'), status: $this.data('status')},
            success: function (data) {
                if (data.result) {
//                    console.log(data.pet);return false;
                    $('.pet-detail-image').html('<img src="/images/pets/' + data.pet.pet_image + '">');
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
                    modal_center(); 
                    google.maps.event.trigger(detail_map, 'resize');
                    detail_map.setCenter(new google.maps.LatLng(data.pet.location_latitude, data.pet.location_longitude));
                    detail_map.setZoom(15);
                    detail_marker = new google.maps.Marker({
                        position: {lat: data.pet.location_latitude, lng: data.pet.location_longitude},
                        draggable: true,
                        animation: google.maps.Animation.DROP,
                    });
                    detail_marker.addListener('click', toggleBounce);
                    detail_marker.setMap(detail_map);
                }
            }
        });
    });

    var locationsCountry = $('#ubigeo-department');
    locationsCountry.on('change', function (e) {
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            type: "GET",
            url: window.location.origin + '/ubigeo-ciudades',
            dataType: 'json',
            cache: false,
            data: {departmentid: $this.val()},
            success: function (data) {
                if (data.result) {
                    $('#ubigeo-city').html(data.options).fadeIn();
                    $('#ubigeo-district').html('<option value="" default="">Distrito</option>').fadeIn();
                    $('#ubigeo-city').addClass('error');
                    $('#ubigeo-district').addClass('error');
                }
            }
        });


    });

    var locationsCity = $('#ubigeo-city');
    locationsCity.on('change', function (e) {
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            type: "GET",
            url: window.location.origin + '/ubigeo-distritos',
            dataType: 'json',
            cache: false,
            data: {cityid: $this.val()},
            success: function (data) {
                if (data.result) {
                    $('#ubigeo-district').html(data.options).fadeIn();
                    $('#ubigeo-district').addClass('error');
                }
            }
        });
    });

    var reportAdd = $('.report-lost-add');
    reportAdd.on('click', function (e) {
        e.preventDefault();
        $("#form-report-lost").modal().show();
        $("#form-report-lost").find('#pet_lost').attr('checked','checked');
        $("#form-report-lost").find('#name_div').show();
        modal_center();
    });
    var reportAdd = $('.report-found-add');
    reportAdd.on('click', function (e) {
        e.preventDefault();
        $("#form-report-lost").modal().show();
        $("#form-report-lost").find('#pet_found').attr('checked','checked');
        $("#form-report-lost").find('#pet_found').attr('checked','checked');
        $("#form-report-lost").find('#name_div').hide();
        modal_center();
    });
    var reportDetailLost = $('.report-detail-lost');
    reportDetailLost.on('click', function (e) {
        item_detail_view(e, this);
    });
    var galleryDivHover = $('.gallery-div-hover');
    galleryDivHover.on('click', function (e) {
        item_detail_view(e, this);
    });
    function item_detail_view(e, obj){        
        e.preventDefault();
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
        var data_id = $(obj).attr('data-id');
        $.ajax({
            type: "GET",
            url: window.location.origin + '/mis-reportes-detalle-perdido',
            dataType: 'json',
            cache: false,
            data: {reportid: data_id},
            success: function (data) {
                if (data.result) {
                    $('.report-detail-lost-image').html('<img src="/images/pets/' + data.report.image + '">');
                    $('.report-detail-lost-address').html(data.report.address);
                    $('.report-detail-lost-phone').html('<a class="report-phone" href="tel:' + data.report.user_phone + '">' + data.report.user_phone + '</a>');
                    $('.report-detail-lost-name').html(data.report.name);
                    $('.report-detail-lost-race').html(data.report.race);
                    $('.report-detail-lost-gender').html(data.report.gender);
                    $('.report-detail-lost-date').html(data.report.date);
                    $('.btn-download-lost').attr('href', data.path + '/descargar-volante/perdido/?reportid=' + data_id);
                    modal_center();
                }
            }
        });
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
    var submitReport = $('.btn-submit-report');
    submitReport.on('click', function (e) {
        e.preventDefault();
        var cropcanvas = $('#cropper-image').cropper('getCroppedCanvas');
        var croppng = cropcanvas.toDataURL("image/png");
        var filename = $('#lost_pet_file').val();
        $.ajax({
            type: "POST",
            url: window.location.origin + '/mis-reportes-registrar',
            dataType: 'json',
            cache: false,
            data: $('#form-report-lost-form').serialize() + "&pngimageData=" + croppng + "&filename=" + filename,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                if (result) {
                    window.location.reload();
                    $('#form-report-lost-form').each(function () {
                        this.reset();
                    });
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
        var $this = $(this);
        $.ajax({
            type: "POST",
            url: $this.attr('action'),
            dataType: 'json',
            cache: false,
            data: submitRegister.serialize(),
            success: function (data) {
                $('#register-message').show();
                modal_center();
                if (data.status) {
                    $('#register-message').html(data.message);
                } else {
                    $('#register-message').html(data.errors.join('<br>'));
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
});

var detail_map, found_map, lost_map;
var detail_marker, found_marker, lost_marker;
function initMap() {
    if (document.getElementById('pet-detail-map') != null)
        detail_map = new google.maps.Map(document.getElementById('pet-detail-map'), {
            center: {lat: -12.038601, lng: -77.058927},
            zoom: 8,
            disableDefaultUI: true
        });
    if (document.getElementById('pet-found-map') != null)
        found_map = new google.maps.Map(document.getElementById('pet-found-map'), {
            center: {lat: -12.038601, lng: -77.058927},
            zoom: 8,
            disableDefaultUI: true
        });
    if (document.getElementById('pet-lost-map') != null)
        lost_map = new google.maps.Map(document.getElementById('pet-lost-map'), {
            center: {lat: -12.038601, lng: -77.058927},
            zoom: 8,
            disableDefaultUI: true
        });
    found_marker = new google.maps.Marker({
        position: {lat: -12.038601, lng: -77.058927},
        draggable: true,
        animation: google.maps.Animation.DROP,
    });
    lost_marker = new google.maps.Marker({
        position: {lat: -12.038601, lng: -77.058927},
        draggable: true,
        animation: google.maps.Animation.DROP,
    });
    found_marker.setMap(found_map);
    lost_marker.setMap(lost_map);
    google.maps.event.addListener(lost_marker, 'dragend', function (e) {
        var lat = e.latLng.lat();
        var lon = e.latLng.lng();
        displayLocation(lat, lon, lost_map);
    });
}
function displayLocation(latitude, longitude, map) {
    var geocoder;
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(latitude, longitude);

    geocoder.geocode(
            {'latLng': latlng},
            function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        map.setZoom(15);
                        map.setCenter(results[0].geometry.location);
                        var address = results[0].formatted_address;
                        var value = address.split(",");
                        var postal_code = extractFromAdress(results[0].address_components, "postal_code");
                        var street_number = extractFromAdress(results[0].address_components, "street_number");
                        var district = extractFromAdress(results[0].address_components, "route");
                        var city = extractFromAdress(results[0].address_components, "locality");
                        var department = extractFromAdress(results[0].address_components, "administrative_area_level_2");
                        var country = extractFromAdress(results[0].address_components, "country");
                        count = value.length;
                        country = value[count - 1];
                        state = value[count - 2];
                        city = value[count - 3];
                        document.getElementById('pac-input').value = address;
                        document.getElementById('pac-department').value = department;
                        document.getElementById('pac-city').value = city;
                        document.getElementById('pac-district').value = district;
                        document.getElementById('pac-address').value = street_number + "," + district + "," + city + "," + department + "," + country;
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

var w_total = $('.home-pets-list').width();
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

//homepage slider animation
$('.prev-gallery-btn').click(function () {
    $('.next-gallery-btn').show();
    var prev_pos_gallery = $('.home-pets-list').position().left;
    if (Number(prev_pos_gallery + w_gallery) > -15)
        prev_pos_gallery = -10 - w_gallery;
    $('.home-pets-list').animate({left: prev_pos_gallery + w_gallery + 'px'}, 1000, function () {
        prev_pos_gallery += w_gallery;
        if (Number(prev_pos_gallery) > -15)
            $('.prev-gallery-btn').hide();
    });
});

$('.next-gallery-btn').click(function () {
    $('.prev-gallery-btn').show();
    var prev_pos_gallery = $('.home-pets-list').position().left;
    if (Math.abs(prev_pos_gallery - w_gallery * 2) > w_total)
        prev_pos_gallery = -w_total + w_gallery * 2;
    $('.home-pets-list').animate({left: prev_pos_gallery - w_gallery + 'px'}, 1000, function () {
        if (Math.abs(prev_pos_gallery - w_gallery * 2) >= w_total) {
            $('.next-gallery-btn').hide();
        }
    });
});

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
//image preview  flag - 0:found 1:lost
function cropper_Modal(){
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
            $('.alert-message').text('Al subir la foto.. se alinea con esta linea');
            var w_window = $(window).width();
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
            }, 2000);
            if (upload_flag == 0) {
                // $('.upload-image-found-preview .preview-img').css('background-image','url(' + e.target.result + ')');
                $('.found-upload').parent().hide();
                $('.upload-image-found-preview').css('display', 'inline-block');
            } else {
                // $('.upload-image-lost-preview .preview-img').css('background-image','url(' + e.target.result + ')');
                $('.lost-upload').parent().hide();
                $('.upload-image-lost-preview').css('display', 'inline-block');
            }
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
    if (w > 600 && h > 600) {
        croppedCanvas = $('#cropper-image').cropper('getCroppedCanvas', {
            width: 600,
            height: 600
        });
    } else if (w > 600) {
        croppedCanvas = $('#cropper-image').cropper('getCroppedCanvas', {
            width: 600,
            height: h
        });
    } else if (h > 600) {
        croppedCanvas = $('#cropper-image').cropper('getCroppedCanvas', {
            width: w,
            height: 600
        });
    } else {
        croppedCanvas = $('#cropper-image').cropper('getCroppedCanvas');
    }
    // Show
    if (upload_flag == 0)
        $('.upload-image-found-preview .preview-img').css('background-image', 'url(' + croppedCanvas.toDataURL() + ')');
    else
        $('.upload-image-lost-preview .preview-img').css('background-image', 'url(' + croppedCanvas.toDataURL() + ')');
    $('#modal-cropper .modal-header button').trigger('click');
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
}).on('hidden.bs.modal', function () {
    // cropBoxData = $image.cropper('getCropBoxData');
    // canvasData = $image.cropper('getCanvasData');
    //$('#cropper-image').cropper('destroy');
});