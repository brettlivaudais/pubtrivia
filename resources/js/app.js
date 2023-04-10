import './bootstrap';

function setCookie(key, value, expiry) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
}

function getCookie(key) {
    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] : null;
}

function eraseCookie(key) {
    var keyValue = getCookie(key);
    setCookie(key, keyValue, '-1');
}

$( document ).ready(function() {
    $("#register_user_type").change( function() {
      $(".register_name").hide();
      $(".register_name_" + $(this).val()).show();
    });


    $(".favorite_location").click(function() {
      var button = $(this);
      if(button.attr('aria-label').includes('un')) {
        var action = 'remove';
      } else {
        var action = 'add';
      }
      var url =  "/api/favorite/" + action + '/' +  $(this).attr('location_id');
      $.ajax(
          url, {
          dataType: 'json',
          xhrFields: {
              withCredentials: true
          },
          success: function( data ) {
            if(action=='add') {
              button.attr('aria-label','un-favorite this location')
              button.html('<i class="fa-solid fa-heart"></i>');
            } else {
              button.attr('aria-label','favorite this location')
              button.html('<i class="fa-regular fa-heart"></i>');
            }
          }
        }
      );
    });


    $('.star-rating i').on('click', function() {
      $(this).addClass('active');
      $(this).addClass('active');
      $(this).prevAll('i').addClass('active');
      $(this).nextAll('i').removeClass('active');

      var rating = $(this).data('rating');
      var url =  "/api/rating/add/" + $(".favorite_location").first().attr('location_id') + '/' + rating;
      $.ajax(
          url, {
          dataType: 'json',
          xhrFields: {
              withCredentials: true
          },
          success: function( data ) {
            
          }
        }
      );
    });

    $("#getLocation").click(function () {
        $("#getLocation").html('<i class="fa-solid fa-gear fa-spin"></i>').attr('disabled',true);
        if ("geolocation" in navigator){
            navigator.geolocation.getCurrentPosition(function(position){ 
                    setCookie('lat', position.coords.latitude, 365);
                    setCookie('long', position.coords.longitude, 365);

                    var bounds = map.getBounds();
                    var coordinates = bounds.getSouthWest() + delim + bounds.getNorthEast();
                    coordinates = coordinates.replaceAll("(",'').replaceAll(")",'').replaceAll(" ",'').replaceAll(",",delim);
                    searchMap('','',coordinates);

                    /*
                    $.getJSON( "api/geolocation/" +  position.coords.latitude + '/' + position.coords.longitude, function( data ) {
                        $("#location_search").val(data.data[0].locality + ', ' + data.data[0].region_code);
                        $("#getLocation").html('<i class="fa-solid fa-location-crosshairs">').attr('disabled',false);
                    });
                    */
                });
        }else{
            $("#getLocation").html('<i class="fa-solid fa-ban"></i>').attr('disabled',true);
        }
    });

    $("#btn-check-all").click( function() {
        if($(this).is(':checked')) {
            $(".dayoftheweek").prop("checked", false);
            $(".locationbox").fadeIn('fast');
        }
    })

    $(".dayoftheweek").click( function() {
        if($(".dayoftheweek:checked").length > 0 && $(".dayoftheweek:checked").length < 7) {
            $("#btn-check-all").prop("checked", false);
        } else {
            $("#btn-check-all").prop("checked", true);
            $(".dayoftheweek").prop("checked", false);
        }

        $(".locationbox").each( function() {
            if($("#btn-check-" + $(this).attr('day')).is(':checked') || $("#btn-check-all").is(':checked')) {
                $(this).css("height", "auto");
            } else {
                $(this).css("height", "0").css("overflow","hidden");
            }
            
        });
        

        //grid.masonry('layout');

    });

    $(document).on('keyup', '#location_search', function() {
        $(this).removeClass('is-invalid');
        eraseCookie('lat');
        eraseCookie('long');
        if($(this).val().length > 2) {
            $("#auto_complete").css("display", "block").html('');
            $("#getLocation").html('<i class="fa-solid fa-gear fa-spin"></i>');
            $.getJSON( "/api/autocomplete/" +  $(this).val(), function( data ) {
                var items = [];
                $.each( data, function( key, val ) {
                    items.push( "<li><a class='dropdown-item' href='#'>" + val.city + ', ' + val.state + "</a></li>" );
                });
                $("#auto_complete").css("display", "block").html(items.join());
                $("#getLocation").html('<i class="fa-solid fa-location-crosshairs">');
            });
        }
    });

    $("#location_search_btn").click( function() {
        if($('#location_search').val() != '') {
            searchMap($('#location_search').val(),$('#distance').val(),'');
        } else {
            //TO DO: search error message
            $('#location_search').addClass('is-invalid');
           
        }

    });

    $(document).on('click', '.dropdown-item', function() {
        eraseCookie('lat');
        eraseCookie('long');
        $("#location_search").val($(this).text());
        $("#auto_complete").css("display", "none");
    });
    
    /*
    grid = $('#locations').masonry({
        itemSelector: '.locationbox',
        percentPosition: true,
        columnWidth: '.locationbox',
    });
    */

});

  var map;
  var markers = new Array;
  var zoomlevels = {
    5: 11,
    15: 10,
    25: 9,
    50: 8
  }
  var delim = '|';

  function initMap() {

    lat =  34.052235;
    long = -118.243683;
    showMap(null,lat,long);

    var lat = parseFloat(getCookie('lat'));
    var long = parseFloat(getCookie('long'));
    
    if(lat && long) {
      showMap(null,lat,long);
    } else if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showMap);
    } else {
      lat =  34.052235;
      long = -118.243683;
      showMap(null,lat,long);
    }
  }

  function showMap(position,latitude,longitude) {

    console.log('showMap');

    // Get the user's latitude and longitude
    if(position) {
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;
    }
  
    // Create a map centered at the user's location
    map = new google.maps.Map(document.getElementById("map"), {
      center: { lat: latitude, lng: longitude },
      zoom: 10,
    });

    
    google.maps.event.addListener(map, 'dragend', function() {
    
      var newCenter = map.getCenter();
      var bounds = map.getBounds();
      var coordinates = bounds.getSouthWest() + delim + bounds.getNorthEast();
      coordinates = coordinates.replaceAll("(",'').replaceAll(")",'').replaceAll(" ",'').replaceAll(",",delim);

      setCookie('lat', newCenter.lat(), 365);
      setCookie('long', newCenter.lng(), 365);
      
      var geocoder = new google.maps.Geocoder();
      geocoder.geocode({'location': map.getCenter()}, function(results, status) {
        if (status === 'OK') {
          if (results[0]) {
            var addressComponents = results[0].address_components;
            for (var i = 0; i < addressComponents.length; i++) {
              var types = addressComponents[i].types;
              if (types.indexOf('locality') !== -1) {
                var cityName = addressComponents[i].long_name;
              }
              if (types.indexOf("administrative_area_level_1") !== -1) {
                var stateAbbr = addressComponents[i].short_name;
              }
            }
            if(cityName && stateAbbr) {
              $("#location_search").val(cityName + ', ' + stateAbbr);
            }
            searchMap('','',coordinates);
          } else {
            console.log('No results found');
          }
        } else {
          console.log('Geocoder failed due to:', status);
        }
      });
    
    });
    
    google.maps.event.addListener(map, 'zoom_changed', function() {
      var bounds = map.getBounds();
      var coordinates = bounds.getSouthWest() + delim + bounds.getNorthEast();
      coordinates = coordinates.replaceAll("(",'').replaceAll(")",'').replaceAll(" ",'').replaceAll(",",delim);
      searchMap('','',coordinates);
    });

    google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
      var bounds = map.getBounds();
      var coordinates = bounds.getSouthWest() + delim + bounds.getNorthEast();
      coordinates = coordinates.replaceAll("(",'').replaceAll(")",'').replaceAll(" ",'').replaceAll(",",delim);
      searchMap('','',coordinates);
    });

    
  
  }
  
  window.initMap = initMap;




var is_running = false;
function searchMap(search,distance,coordinates) {
    if(!is_running) {
      //is_running = true;
      //grid.masonry('destroy');
      setCookie('search', $('#location_search').val(), 365);
      $("#locations").html('<div style="text-align:center"><i class="fa-solid fa-gear fa-spin" style="font-size: 250px; opacity: 0.15; padding-left:14px"></i></div>');
      
      if(search) {
          var url = "/api/search/?search=" +  search + "&distance=" + distance;
      } else if (coordinates) {
          var url = "/api/search/?coordinates=" +  coordinates;
      }
      
      
      $.getJSON( url, function( data ) {
          var items = [];
          map.setCenter({lat: data.lat, lng: data.lng});
          //map.setZoom(zoomlevels[distance]);
          for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
          }
          $.each( data.locations, function( key, val ) {
              items.push( `<div class="col-sm- 6 col-lg-4 locationbox" day="${val.dayoftheweek}">
                              <div class="card">
                                  <a href="/locations/${val.slug}">
                                  <img class="bd-placeholder-img card-img-top" width="100%" style="border: 0" src = "${val.logo_url}"/></a>
                                  <div class="card-body">
                                      <h5 class="card-title">${val.name}</h5>
                                      ${val.address} (${val.distance} mi)
                                  </div>
                                  <div class="card-footer text-muted">
                                  <div class="float-right">
                                      <i class="fa-solid fa-star"></i>
                                      <i class="fa-solid fa-star"></i>
                                      <i class="fa-solid fa-star"></i>
                                      <i class="fa-regular fa-star"></i>
                                      <i class="fa-regular fa-star"></i>
                                  </div>
                                  <p class="card-text">${val.dayoftheweek} at ${val.time}
                                  </p>
                                  </div>
                              </div>
                              <div>
                                  &nbsp;
                              </div>
                          </div>`);

                          var id = val.id;
                          var lat = parseFloat(val.lat);
                          var long = parseFloat(val.long);
                          var marker = [];

                          marker[id] = new google.maps.Marker({
                              position: { lat: lat, lng: long },
                              map: map,
                              title: "<b>{{ $location->name }}</b><br>{{ $location->dayoftheweek }} at {{  $location->time }}",
                            });
                            google.maps.event.addListener(marker[id], 'click', (function(marker, i) {
                              return function() {
                                // Create an info window or custom div to display information about the marker
                                var infoWindow = new google.maps.InfoWindow({
                                  content: marker.title
                                });
                                // Open the info window or custom div
                                infoWindow.open(map, marker[id]);
                              }
                            })(marker[id], marker[id]));
                            markers.push(marker[id]);
          });

          $("#locations").html(items.join(''));
          
          
          
          is_running = false;
      });
    }
}




var grid;