(function () {
    var mascotas_lat;
    var mascotas_lng;
    var mascotas_distance = 1000;
    var distance;
    var isGeolocationAcessible = false;
    initializeSearchIfLocationAccessed();

    function initializeSearchIfLocationAccessed() {
        try {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    mascotas_lat = position.coords.latitude;
                    mascotas_lng = position.coords.longitude;
                    isGeolocationAcessible = true;
                    searchPets();
                    $('#location').val("My location");
                    distance.enable();
                    $('#distanceOk').show();
                });
            }
        } catch (e) {
            $('#warning').show();
        }
    }

    initMap = function () {
        var options = { componentRestrictions: { country: 'pe' } };
        var autocomplete = new google.maps.places.Autocomplete(document.getElementById('location'), options);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            mascotas_lat = place.geometry.location.lat();
            mascotas_lng = place.geometry.location.lng();
            distance.enable();
            $('#distanceOk').show();
            searchPets();
        });
        if(isGeolocationAcessible){
            $('#location').val("My location");
            distance.enable();
            $('#distanceOk').show();
        }
    }

    $(document.body).on('change', '#location', function () {
        distance.disable();
        $('#distanceOk').hide();
        $('ul.pets-list').html('');
    });


    setTimeout(function () {
        distance = $("#distance").slider()
		.on('slide', distanceChange)
		.data('slider');
        distance.disable();
        $('#distanceOk').hide();
        updateRangeHandle();
    }, 100);

    $(document.body).on('click', '#distanceSlider', distanceChange);


    function distanceChange() {
        $('#distanceHeading').text(distance.getValue());
    }

    $(document.body).on('click', '#distanceOk', function () {
        mascotas_distance = distance.getValue();
        searchPets();
    });

    $(document.body).on('click', '#distanceCancel', function () {
        distance.setValue(mascotas_distance);
        $('#distanceHeading').text(mascotas_distance);
    });

    function searchPets() {
        $.ajax({
            type: "GET",
            url: window.location.origin + '/search-pets-by-location',
            dataType: 'json',
            cache: false,
            data: {
                lat: mascotas_lat,
                lng: mascotas_lng,
                dist: mascotas_distance,
                limitado: 20
            },
            success: function (data) {
                $('#error').hide();
                if (data.data && data.data.length > 0) {
                    var html = prepareHtml(data.data);
                    $('ul.pets-list').html(html);
                    $('#noRecords').hide();
                }
                else {
                    $('ul.pets-list').html('');
                    $('#noRecords').show();
                }
            },
            error: function () {
                $('#error').show();
            }
        });
    }

    function prepareHtml(data) {
        var li_html = '';
        var gallery_class_name = 'gallery-item-hover',
            gallery_event = "gallery_item_over";

        for (var i = 0; i < data.length; i++) {
            li_html += '<li><a data-toggle="modal"><img src="/images/pets/' + data[i]['image'] + '">';
            li_html += '<div class="gallery-item-hover" onclick="gallery_item_over(' + data[i]['id'] + ')">';
            li_html += '<p>' + data[i]['description'] + '</p>';
            li_html += '</div>';
            li_html += '<div class="gallery-item-detail">';
            li_html += '<h2>' + data[i]['name'] + '</h2>';
            li_html += '<p class="gallery-item-birthday">' + data[i]['date'] + '</p>';
            li_html += '<p class="gallery-item-location">' + data[i]['address'] + '</p>';
            li_html += '</div>';
            li_html += '</a>';
            li_html += '</li>';
        }
        //li_html += '<li><div class="block-recent-more pull-right"><a href= "/mascotas" class="btn btn-lg btn-default" > Ver mas</a ></div ></li>';

        return li_html;
    }

    function updateRangeHandle() {
        if(isSmallScreen()) {
            $('#rangeHandle').removeClass('no-right-border');
            $('#rangeHandle').addClass('rounded-right-border');
            $('#rangeHandle').next('input').next('span').hide();
            $('#rangeHandle').next('input').hide();
        }
        else{
            $('#rangeHandle').addClass('no-right-border');
            $('#rangeHandle').removeClass('rounded-right-border');
            $('#rangeHandle').next('input').next('span').show();
            $('#rangeHandle').next('input').show();
        }
    }

    function isSmallScreen() {
        return $('#hideOnXS').is(':hidden');
    }

    $(window).resize(updateRangeHandle);

}());
