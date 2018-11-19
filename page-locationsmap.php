<!DOCTYPE html>
<html>
  <head>
    <script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>

    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 600px;
        mapTypeControl: true;
      }

      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

    </style>

  </head>
  <body>

    <div id="map"></div>

    <script type="text/javascript">

      // more info for customisations
      //https://developers.google.com/maps/documentation/javascript/marker-clustering

      var aStyle     = [

      			

                {
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#444444"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#f2f2f2"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 45
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#c446ec"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            // "color": "#792f2a"
                              "color": "#AAAAAA"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                }
            ];
      var aLocations = [];
      var iconBase   = '<?php echo  get_theme_root_uri(); ?>/impact_hub_theme/img/locationmap/';
      // var icons = {
      //     uprunning: {
      //       icon: iconBase + 'location.png'
      //     }
      //   };
      var markers     = [];
      var map;
      var aStyles = [];

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 2,
          center: new google.maps.LatLng(22,-7),
          mapTypeId: 'terrain',
          styles : aStyle,
          mapTypeControl: false,




        });


        jQuery.ajax( {
            url: 'https://spreadsheets.google.com/feeds/list/1H9SyvK8ITEz6qH8R4QxWdgXhzg1LnqlfUk2JBihnNyo/od6/public/values?alt=json',
            method: 'GET',
          }).done( function ( response ) {



                for (var i = 0; i < response.feed.entry.length; i++) {

                  var infoWindow = new google.maps.InfoWindow;

                  var coords = response.feed.entry[i];
                  var lat    = coords.gsx$latitude.$t;
                  var long   = coords.gsx$longitude.$t;
                  var title  = coords.gsx$ihname.$t;
                  var icon   = '';

                  // console.log('icon url: ',iconBase+'uprunning.png');

                  if(coords.gsx$status.$t.toLowerCase() == 'uprunning'){
                    icon = iconBase+'uprunning.png';
                  }else if(coords.gsx$status.$t.toLowerCase() == 'initiative'){
                      icon = iconBase+'initiative.png';
                  }else if(coords.gsx$status.$t.toLowerCase() == 'candidate'){
                      icon = iconBase+'candidate.png';
                  }else if(coords.gsx$status.$t.toLowerCase() == 'temporary closure'){
                      icon = iconBase+'temporary_closure.png';
                  }else if(coords.gsx$status.$t.toLowerCase() == 'pilot'){
                      icon = iconBase+'pilot.png';
                  }
                  var iconFull = {
                      url: icon, // url
                      // scaledSize: new google.maps.Size(50, 50), // scaled size
                      // origin: new google.maps.Point(0,0), // origin
                      // anchor: new google.maps.Point(0, 0) // anchor
                  };
                  // var sType =

                  aLocations[title] = coords;
                  // console.log('coords',coords);
                  // console.log(lat , long );
                  var latLng = new google.maps.LatLng( lat , long );
                  var marker = new google.maps.Marker({
                    position : latLng,
                    map      : map,
                    title    : title,
                    icon     : iconFull
                  });

                  marker.addListener('click', function() {
                    // console.log(this.title,aLocations, aLocations[this.title] );
                    infoWindow.setContent(
                      '<h3>'+aLocations[this.title].gsx$ihname.$t+'</h3>'+'<h5><a href="http://'+aLocations[this.title].gsx$website.$t+'" target="_BLANK">'+aLocations[this.title].gsx$website.$t+'</a></h5>'

                    );

                    var lat  = aLocations[this.title].gsx$latitude.$t;
                    var long = aLocations[this.title].gsx$longitude.$t;
                    var title = aLocations[this.title].gsx$ihname.$t;
                    var latLng = new google.maps.LatLng( lat , long );

                    var coords = aLocations[this.title];

                    var icon = '';
                    if(coords.gsx$status.$t.toLowerCase() == 'uprunning'){
                      icon = iconBase+'uprunning.png';
                    }else if(coords.gsx$status.$t.toLowerCase() == 'initiative'){
                        icon = iconBase+'initiative.png';
                    }else if(coords.gsx$status.$t.toLowerCase() == 'candidate'){
                        icon = iconBase+'candidate.png';
                    }else if(coords.gsx$status.$t.toLowerCase() == 'temporary closure'){
                        icon = iconBase+'temporary_closure.png';
                    }else if(coords.gsx$status.$t.toLowerCase() == 'pilot'){
                        icon = iconBase+'pilot.png';
                    }
                    var iconFull = {
                        url: icon, // url
                        // scaledSize: new google.maps.Size(50, 50), // scaled size
                        // origin: new google.maps.Point(0,0), // origin
                        // anchor: new google.maps.Point(0, 0) // anchor
                    };

                    var marker = new google.maps.Marker({
                      position : latLng,
                      map      : map,
                      title    : title,
                      icon     : iconFull
                    });

                    infoWindow.open(map, marker);
                  });
                  markers.push(marker);

                  aStyles.push({
                    url:  iconBase+'',
                    height: 35,
                    width: 40,
                    anchor: [8, 0],
                    textColor: '#FFFFFF',
                    textSize: 18
                  });
                }

                var markerCluster = new MarkerClusterer(map, markers,
                  {
                      imagePath: iconBase+'',
                      // styles:  aStyles[0]
                      // styles   : [{ textColor:"white"}]
                    }


                  );

                // marker.setMap(map);
        });
      }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_Yb78OYsEZgzn2bfCxUNhdv9BzIbCI3E&callback=initMap">
    </script>
  </body>
</html>
