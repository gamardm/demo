
var map;
var markers = [];

//InitMap
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 39.5355255, lng: -10.0963343},
        zoom: 7
    });
}

//Populate country dropdown
getCountries();

$("#B2C-button").click(function (e) {
    e.preventDefault();
    $("#officesContent").hide();
    $('#B2CContent').show();

    $('#offices-button').removeClass('current');
    $('#B2C-button').addClass('current');

    deleteMarkers();

});

$("#offices-button").click(function (e) {
    e.preventDefault();
    $("#officesContent").show();
    $('#B2CContent').hide();

    $('#B2C-button').removeClass('current');
    $('#offices-button').addClass('current');

    deleteMarkers();
});

//Generate Distributors List
$('#countries-b2b').on('change', function(){
    var countryID = $(this).val();
    getStores(countryID);
});

//Get Office
$('#countries-offices').on('change', function(){
    var countryCode = $('#countries-offices option:selected').attr("country-code");
    getOffice(countryCode);
});

//Distributor Event trigger
$(document).on('click', 'a.distributor-gen', function(e){
    e.preventDefault();
    var distributorID = $(this).attr("data-id");
    getDistributor(distributorID);
});

function getStores(countryID){
    $.ajax({
        url: "http://api.gps-webservices.com/api/v2/b2b/"+countryID+"/brand/5",
        method: "GET",
        crossDomain: true,
        headers:{
            Authorization: 'Basic ' + btoa('inaset-paper:wtbnavigator'),
        },
        dataType: "json",
        contentType: 'application/json',
        success: function(result){
            if (result.length){
                $('.buy-location__list').empty();
                $('.no-stores-message').remove();
                for (var i = 0; i < result.length; i++){
                    var markup  = '';
                    var name    = result[i].name;
                    var id      = result[i].id;

                    markup  = '<li><a href="#" class="distributor-gen"  title="'+name+'" data-id="'+id+'">'+name+'</a></li>';

                    $(markup).appendTo($('.buy-location__list'));
                }
            } else {
                $('.buy-location__list').empty();
                $('<div class="no-stores-message text-center col-md-12"><p class="alert alert-info" role="alert"><strong>Oh snap! </strong>Looks like there are no stores available at your location. <br/> Please choose another country.</p></div>').appendTo($('.buy-location__list'));
            }
        }
    });
}

function getCountries(){
    var countries = $('#countries-b2b');
    var countriesOff = $('#countries-offices');
    countries.html('');

    $.ajax({
        url: "http://api.gps-webservices.com/api/v2/countries",
        method: "GET",
        crossDomain: true,
        headers:{
            Authorization: 'Basic ' + btoa('inaset-paper:wtbnavigator'),
        },
        dataType: "json",
        contentType: 'application/json',
        success: function(result){
            if (result.length){
                countries.empty();
                countriesOff.empty();
                countries.append('<option value="" disabled selected>Select country</option>');
                countriesOff.append('<option value="" disabled selected>Select country</option>');

                for (var i = 0; i < result.length; i++){
                    countries.append('<option country-code="'+result[i].code+'" value="'+result[i].id+'">'+result[i].name+'</option>');
                    countriesOff.append('<option country-code="'+result[i].code+'" value="'+result[i].id+'">'+result[i].name+'</option>');
                }

            } else {
                countries.empty();
                countriesOff.empty();
                countries.append('<option>Service not available</option>');
                countriesOff.append('<option>Service not available</option>');
            }
        },
        error: function(){
            countries.empty();
            countriesOff.empty();
            countries.append('<option>Service not available</option>');
            countriesOff.append('<option>Service not available</option>');
        }

    });
}

function getDistributor(distributorID){
    $.ajax({
        url: "http://api.gps-webservices.com/api/v2/distributor/"+distributorID,
        method: "GET",
        crossDomain: true,
        headers:{
            Authorization: 'Basic ' + btoa('inaset-paper:wtbnavigator')
        },
        dataType: "json",
        contentType: 'application/json',
        success: function(result){
            if (result != ''){
                var name            = result.name;
                var image           = result.image;
                var phone           = result.phone;
                var phone2          = result.phone2;
                var phone3          = result.phone3;
                var fax             = result.fax;
                var fax2            = result.fax2;
                var email           = result.email;
                var website         = result.website;
                var website2        = result.website2;
                var address         = result.address;
                var cp              = result.cp;
                var city            = result.city;
                var lat             = Number(result.lat);
                var long            = Number(result.long);
                var fullAddress     = '';
                var contentString   = '';
                var myLatLng        = {lat: 0, lng: 0};
                if( lat != 0 && lat != '' && long != 0 && long != ''  )
                    myLatLng    = {lat: lat, lng: long};

                if(address != '') {
                    fullAddress += address;
                    if (cp != '')
                        fullAddress += ', '+ cp;
                    if (city != '')
                        fullAddress += ', '+ city;
                }

                contentString = '<div id="content" class="marker">'; //Content open
                contentString += '<h1>'+name+'</h1>';

                if(image != '' && image != null)
                    contentString += '<img src="'+image+'"></img>';

                if(fullAddress != '')
                    contentString += '<p class="address">'+fullAddress+'</p>';

                if(phone != '' && phone != null)
                    contentString += '<p>Tel: '+phone+'</p>';
                if(phone2 != '' && phone2 != null)
                    contentString += '<p>Tel2: '+phone2+'</p>';
                if(phone3 != '' && phone3 != null)
                    contentString += '<p>Tel3: '+phone3+'</p>';

                if(fax != '' && fax != null)
                    contentString += '<p>Fax: '+fax+'</p>';
                if(fax2 != '' && fax2 != null)
                    contentString += '<p>Fax2: '+fax2+'</p>';

                if(email != '' && email != null)
                    contentString += '<p><strong>'+email+'</strong></p>';

                if(website != undefined)
                    contentString += '<p><strong><a href="'+website+'">'+website+'</a></strong></p>';
                if(website2 != undefined)
                    contentString += '<p><strong><a href="'+website2+'">'+website2+'</a></strong></p>';

                contentString += '</div>'; //Content close

                markerRender(myLatLng, contentString);

            }
        }
    });
}

function getOffice(countryCode){
    $.ajax({
        url: "http://api.gps-webservices.com/api/v2/sales-office",
        method: "GET",
        crossDomain: true,
        headers:{
            Authorization: 'Basic ' + btoa('inaset-paper:wtbnavigator')
        },
        dataType: "json",
        contentType: 'application/json',
        success: function(result){
            if (result[countryCode] != ''){
                var name            = result[countryCode].name;
                var phone           = result[countryCode].phone_1;
                var fax             = result[countryCode].fax_1;
                var email           = result[countryCode].mail;
                var website         = result[countryCode].website;
                var address         = result[countryCode].address;
                var cp              = result[countryCode].cp;
                var city            = result[countryCode].city;
                var lat             = Number(result[countryCode].latitude);
                var long            = Number(result[countryCode].longitude);
                var fullAddress     = '';
                var contentString   = '';
                var myLatLng        = {lat: 0, lng: 0};
                if( lat != 0 && lat != '' && long != 0 && long != ''  )
                    myLatLng    = {lat: lat, lng: long};

                if(address != '') {
                    fullAddress += address;
                    if (cp != '')
                        fullAddress += ', '+ cp;
                    if (city != '')
                        fullAddress += ', '+ city;
                }

                contentString = '<div id="content" class="marker">'; //Content open
                contentString += '<h1>'+name+'</h1>';

                if(fullAddress != '')
                    contentString += '<p class="address">'+fullAddress+'</p>';

                if(phone != '' && phone != null)
                    contentString += '<p>Tel: '+phone+'</p>';

                if(fax != '' && fax != null)
                    contentString += '<p>Fax: '+fax+'</p>';

                if(email != '' && email != null)
                    contentString += '<p><strong>'+email+'</strong></p>';

                if(website != undefined && website != null)
                    contentString += '<p><strong><a href="'+website+'">'+website+'</a></strong></p>';

                contentString += '</div>'; //Content close

                markerRender(myLatLng, contentString);

            }
        }
    });
}

function markerRender(position, contentString){
    deleteMarkers();
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    var marker = new google.maps.Marker({
        position: position,
        map: map,
        icon: {url: "<?php echo get_template_directory_uri(); ?>/source/content/map_marker.png"}
    });

    markers.push(marker);

    map.panTo(position);
    infowindow.open(map, marker);
}

function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
    setMapOnAll(null);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
    clearMarkers();
    markers = [];
}
