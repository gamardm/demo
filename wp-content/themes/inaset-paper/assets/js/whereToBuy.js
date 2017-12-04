
var map;
var markers = [];
var infoWindow;
var bounds;
var browserLocation;

var langID = 5;
var notAvailable = "Service not available";
var selectCountry = "Select Country";
var noDist = "<strong>Oh snap! </strong>Looks like there are no stores available at your location. <br/> Please choose another country.";

switch (document.documentElement.lang.toLowerCase()){
    case "pt":
        langID = 1;
        notAvailable = "Serviço não disponivel";
        selectCountry = "Seleccione País";
        noDist = "Não existem distribuidores na sua localização. <br/> Por favor, escolha outro país.";
        break;
    case "de":
        langID = 2;
        notAvailable = "Service not available";
        selectCountry = "Select Country";
        noDist = "<strong>Oh snap! </strong>Looks like there are no stores available at your location. <br/> Please choose another country.";
        break;
    case "it":
        langID = 3;
        notAvailable = "Servizio non disponibile";
        selectCountry = "Seleziona il paese";
        noDist = "Sembra che non ci siano negozi disponibili presso la tua sede. <br/> Scegli un altro paese.";
        break;
    case "es":
        langID = 4;
        notAvailable = "Servicio no disponible";
        selectCountry = "Seleccionar País";
        noDist = "<strong>¡Ah! </strong>Parece que no hay tiendas disponibles en su ubicación. <br/> Por favor elija otro país.";
        break;
    case "fr":
        langID = 6;
        notAvailable = "Service non disponible";
        selectCountry = "Sélectionner le Pays";
        noDist = "On dirait qu'il n'y a pas de magasins disponibles à votre emplacement. <br/> Choisissez un autre pays.";
        break;
    case "pl":
        langID = 7;
        notAvailable = "Błąd wewnętrzny";
        selectCountry = "Wybierz kraj";
        noDist = "Brak wyników wyszukiwania dla danej lokalizacji. <br/> Proszę wybrać inny kraj.";
        break;
    default:
        langID = 5;
}

//InitMap
function initMap() {
    var infoWindow = new google.maps.InfoWindow;

    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 38.7223263, lng: -9.1392714},
        zoom: 7
    });

    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            console.log(pos);

            browserLocation = pos;

            map.setCenter(pos);
        }, function() {
            //IF PERMISSION NOT GRANTED OR ERROR FOUND IN GEOLOCATION
            console.log('Permission not granted, searching for server location...');

            var countryCodeAjax = 'PT';

            var ajaxPromise = jQuery.ajax({
                url: "http://freegeoip.net/json/",
                method: "GET",
                dataType: "jsonp",
                async: false
            });

            ajaxPromise.done(function(data) {
                var pos = {
                    "lat": data.latitude,
                    "lng": data.longitude
                };

                browserLocation = pos;

                map.setCenter(pos);

                countryCodeAjax = data.country_code;

                var urlParams = new URLSearchParams(window.location.search);
                var type = urlParams.get('type'); // "edit"

                console.log(type);

                if(type == 'distributors'){
                    console.log('distributors');
                    var countryID = getCountryId(countryCodeAjax);
                    clearList();
                    getStoresB2B(countryID);
                    getStoresB2C(countryID);
                }else{
                    console.log('sales');
                    getOffice(countryCodeAjax);
                }


            })
                .fail(function(xhr) {
                    console.log('error callback for true condition', xhr);
                });

        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, map.getCenter());
    }

    function handleLocationError(browserHasGeolocation, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
        console.log('Error: Your browser doesn\'t support geolocation.');
    }



    function getCountryId(countryCode){

        var countryIDPRO = 144; //default Portugal

        var countryIDPromise = jQuery.ajax({
            url: "http://api.gps-webservices.com/api/v2/countries",
            async: false,
            method: "GET",
            crossDomain: true,
            headers:{
                Authorization: 'Basic ' + btoa('inaset-paper:wtbnavigator')
            },
            dataType: "json",
            contentType: 'application/json'
        });

        countryIDPromise
            .done(function(data) {
                jQuery.each(data, function( key, item ){
                    if (countryCode == item.code){
                        countryIDPRO = item.id;
                    }
                });
            })
            .fail(function(xhr) {
                console.log('error callback for true condition', xhr);
            });

        return countryIDPRO;

    }

    function getCountries(){

        var countriesOff = jQuery('#countries-offices');
        countriesOff.html('');

        jQuery.ajax({
            url: "http://api.gps-webservices.com/api/v2/countries/lang/"+langID,
            method: "GET",
            crossDomain: true,
            headers:{
                Authorization: 'Basic ' + btoa('inaset-paper:wtbnavigator'),
            },
            dataType: "json",
            contentType: 'application/json',
            success: function(result){
                if (result.length){

                    countriesOff.empty();

                    countriesOff.append('<option value="">'+selectCountry+'</option>');

                    for (var i = 0; i < result.length; i++){
                        countriesOff.append('<option value="'+result[i].code+'">'+result[i].name+'</option>');
                    }

                } else {
                    countriesOff.empty();
                    countriesOff.append('<option>'+notAvailable+'</option>');
                }
            },
            error: function(){
                countriesOff.empty();
                countriesOff.append('<option>'+notAvailable+'</option>');
            }

        });
    }

    function getCountriesBrand(){

        var countries = jQuery('#countries-b2b');
        countries.html('');

        jQuery.ajax({
            url: "http://api.gps-webservices.com/api/v2/countries/brand/5/lang/"+langID,
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

                    countries.append('<option value="">'+selectCountry+'</option>');

                    for (var i = 0; i < result.length; i++){
                        countries.append('<option value="'+result[i].id+'">'+result[i].name+'</option>');
                    }

                } else {
                    countries.empty();
                    countries.append('<option>'+notAvailable+'</option>');
                }
            },
            error: function(){
                countries.empty();
                countries.append('<option>'+notAvailable+'</option>');
            }

        });

    }

    function getStoresB2B(countryID){

        jQuery.ajax({
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

                    jQuery('.no-stores-message').hide();

                    for (var i = 0; i < result.length; i++){
                        var id = result[i].id;

                        getDistributor(id);

                    }
                }else{
                    jQuery('.no-stores-message').show();
                }
            }
        });
    }

    function getStoresB2C(countryID){
        console.log(countryID);
        jQuery.ajax({
            url: "http://api.gps-webservices.com/api/v2/b2c/"+countryID+"/brand/5",
            method: "GET",
            crossDomain: true,
            headers:{
                Authorization: 'Basic ' + btoa('inaset-paper:wtbnavigator'),
            },
            dataType: "json",
            contentType: 'application/json',
            success: function(result){
                if (result.length){

                    jQuery('.no-stores-message').hide();

                    for (var i = 0; i < result.length; i++){
                        var id = result[i].id;

                        getDistributor(id);
                    }
                }else{
                    jQuery('.no-stores-message').show();
                }
            }
        });
    }

    function getDistributor(distributorID){
        console.log('getDistributor');

        jQuery.ajax({
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
                    var dist = distributorMarker(result);

                    addMarker(dist);

                }

            }
        });

    }

    function getOffice(countryCode){
        jQuery.ajax({
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
                    var dist = distributorMarker(result[countryCode]);

                    addMarker(dist);

                    google.maps.event.trigger(markers[0], 'click');

                }
            }
        });
    }

    function distributorMarker(result){

        var distributorInfo = {};

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
        var lat             = ( !isNaN(Number(result.lat)) ) ? Number(result.lat) : Number(result.latitude) ;
        var long            = ( !isNaN(Number(result.long)) ) ? Number(result.long) : Number(result.longitude) ;
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

        //if(image != '' && image != null)
        //    contentString += '<img src="'+image+'"></img>';

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

        distributorInfo.contentString   = contentString;
        distributorInfo.latLng          = myLatLng;
        distributorInfo.title           = name;

        return distributorInfo;
    }

    function addMarker(distributor){
        console.log(distributor.latLng);
        var position = distributor.latLng;

        var marker = new google.maps.Marker({
            position: position,
            map: map,
            icon: {url: "/wp-content/themes/inaset-paper/assets/images/map_marker.png"}
        });

        google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(distributor.contentString);
            infoWindow.open(map, marker);
        });

        var markup = '';
        markup  = '<li><a href="#" class="distributor-gen"  title="'+distributor.title+'" data-markerid="'+markers.length+'">'+distributor.title+'</a></li>';
        jQuery(markup).appendTo(jQuery('.buy-location__list'));

        markers.push(marker);

        positionMap();

    }

    function positionMap(){
        /** Actualizar posição do mapa sempre que é inserido um marker **/

        bounds = new google.maps.LatLngBounds();

        for (var i = 0; i < markers.length; i++) {
            bounds.extend(markers[i].getPosition());
        }

        map.fitBounds(bounds);

        var zoom = map.getZoom();
        map.setZoom(zoom > 12 ? 12 : zoom);
    }

    function clearMarkers() {

        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }

        markers = [];
    }

    function clearList() {
        jQuery('.buy-location__list').empty();

        jQuery('.list').hide().removeClass('open');
        jQuery('.button__list-view').removeClass('beforeArrow');
        jQuery('.map-overlay').fadeOut();
    }


    /** FUNCTIONS RUI **/

    jQuery(document).ready(function (){

        getCountries();
        getCountriesBrand();

        jQuery(document).on('click', 'a.distributor-gen', function(e){
            e.preventDefault();

            google.maps.event.trigger(markers[jQuery(this).data('markerid')], 'click');

            //Fechar list e overlay
            //clearList();

            jQuery('.list').hide().removeClass('open');
            jQuery('.button__list-view').removeClass('beforeArrow');
            jQuery('.map-overlay').fadeOut();

        });

        jQuery("#B2C-button").click(function (e) {
            e.preventDefault();

            jQuery("#officesContent").hide();
            jQuery('#B2CContent').show();

            jQuery('#offices-button').removeClass('current');
            jQuery('#B2C-button').addClass('current');

            jQuery("#countries-offices option:first").attr('selected','selected');
            jQuery("#countries-b2b option:first").attr('selected','selected');

            if(markers.length)
                clearMarkers();

            map.setCenter( browserLocation );
            var zoom = map.getZoom();
            map.setZoom(zoom > 7 ? 7 : zoom);

        });

        jQuery("#offices-button").click(function (e) {
            e.preventDefault();
            jQuery("#officesContent").show();
            jQuery('#B2CContent').hide();

            jQuery('#B2C-button').removeClass('current');
            jQuery('#offices-button').addClass('current');

            jQuery("#countries-offices option:first").attr('selected','selected');
            jQuery("#countries-b2b option:first").attr('selected','selected');

            if(markers.length)
                clearMarkers();

            //Fechar list view
            clearList();
            jQuery('.buy-location__list').append('<li>Please, select the country first</li>');

            map.setCenter( browserLocation );
            var zoom = map.getZoom();
            map.setZoom(zoom > 7 ? 7 : zoom);
        });

        jQuery('select#countries-offices').on('change', function(){
            console.log('Select Box Change');

            var countryCode = jQuery('#countries-offices option:selected').val();

            if(markers.length)
                clearMarkers();

            clearList();
            getOffice(countryCode);
        });

        jQuery('select#countries-b2b').on('change', function(){
            console.log('Select Box Change id=countries-b2b');
            var countryCode = jQuery('#countries-b2b option:selected').val();

            if(markers.length)
                clearMarkers();

            clearList();
            getStoresB2C(countryCode);
            getStoresB2B(countryCode);

            //Abrir list view
            if (!jQuery('.list').hasClass('open')){
                jQuery('.list').show().addClass('open');
                jQuery('.button__list-view').addClass('beforeArrow');
                jQuery('.map-overlay').fadeIn();
            }
        });

        jQuery('#list-toggle').click(function(e){
            e.preventDefault();

            if (!jQuery('.list').hasClass('open')){

                jQuery('.list').show().addClass('open');
                jQuery('.button__list-view').addClass('beforeArrow');
                jQuery('.map-overlay').fadeIn();

            } else {
                jQuery('.list').hide().removeClass('open');
                jQuery('.button__list-view').removeClass('beforeArrow');
                jQuery('.map-overlay').fadeOut();
            }

        });

        jQuery('.map-overlay, .list .close').click(function(e){
            e.preventDefault();

            jQuery('.list').hide().removeClass('open');
            jQuery('.button__list-view').removeClass('beforeArrow');
            jQuery('.map-overlay').fadeOut();
        });

    })



    /** END FUNCTIONS RUI **/

}












