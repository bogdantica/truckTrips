/**
 * Created by tkagnus on 19/03/2017.
 */
// jQuery Plugin Boilerplate
// remember to change every instance of "gooMaps" to the name of your plugin!
(function ($) {
    // here we go!
    $.gooMaps = function (element, options) {
        var defaults = {
            style: [
                // {
                //     "featureType": "all",
                //     "elementType": "all",
                //     "stylers": [
                //         {
                //             // "visibility": "on"
                //         }
                //     ]
                // },
                // {
                //     "featureType": "administrative",
                //     "elementType": "all",
                //     "stylers": [
                //         {
                //             // "visibility": "off"
                //         }
                //     ]
                // },
                // {
                //     "featureType": "administrative.country",
                //     "elementType": "all",
                //     "stylers": [
                //         {
                //             "visibility": "on"
                //         }
                //     ]
                // },
                // {
                //     "featureType": "administrative.locality",
                //     "elementType": "all",
                //     "stylers": [
                //         {
                //             "visibility": "on"
                //         }
                //     ]
                // },
                // {
                //     "featureType": "landscape",
                //     "elementType": "all",
                //     "stylers": [
                //         {
                //             "visibility": "on"
                //         }
                //     ]
                // },
                // {
                //     "featureType": "landscape",
                //     "elementType": "geometry",
                //     "stylers": [
                //         {
                //             "visibility": "on"
                //         }
                //     ]
                // },
                // {
                //     "featureType": "landscape",
                //     "elementType": "labels",
                //     "stylers": [
                //         {
                //             "visibility": "off"
                //         }
                //     ]
                // },
                // {
                //     "featureType": "poi",
                //     "elementType": "all",
                //     "stylers": [
                //         {
                //             "visibility": "off"
                //         }
                //     ]
                // },
                // {
                //     "featureType": "road",
                //     "elementType": "all",
                //     "stylers": [
                //         {
                //             "visibility": "on"
                //         }
                //     ]
                // },
                // {
                //     "featureType": "road",
                //     "elementType": "geometry",
                //     "stylers": [
                //         {
                //             "visibility": "on"
                //         }
                //     ]
                // },
                // {
                //     "featureType": "road",
                //     "elementType": "labels",
                //     "stylers": [
                //         {
                //             "visibility": "off"
                //         }
                //     ]
                // },
                // {
                //     "featureType": "transit",
                //     "elementType": "all",
                //     "stylers": [
                //         {
                //             "visibility": "off"
                //         }
                //     ]
                // }
            ]


        };
        var plugin = this;
        plugin.settings = {};

        var $element = $(element), // reference to the jQuery version of DOM element
            element = element;    // reference to the actual DOM element

        var gooMaps;
        var directionMap;
        var points = [];
        var distance = 0;

        plugin.init = function () {
            plugin.settings = $.extend({}, defaults, options);

            initGooMaps();

            setTimeout(function () {
                plugin.addPoint();
            }, 2000);

        };

        var initGooMaps = function () {
            var romania = {lat: 45.8, lng: 24.5};

            gooMaps = new google.maps.Map($element[0], {
                center: romania,
                zoom: 5
            });

            gooMaps.setOptions({styles: plugin.settings.style});


            directionMap = new google.maps.DirectionsRenderer({
                map: gooMaps
            });
        };

        plugin.addPoint = function (point) {

            var request = {
                origin: {lat: 44.4377397, lng: 25.9542103},
                destination: {lat: 45.6524566, lng: 25.5262513},
                waypoints: [
                    // {
                    //     location: 'Peretu, Ro',
                    //     stopover: true
                    // },
                    // {
                    //     location: 'Ploiesti, Ro',
                    //     stopover: true
                    // }
                ],
                travelMode: 'DRIVING'
            };

            // Pass the directions request to the directions service.
            var directionsService = new google.maps.DirectionsService();
            directionsService.route(request, function (response, status) {
                if (status == 'OK') {
                    // Display the route on the map.
                    directionMap.setDirections(response);

                    distance = 0;
                    var myroute = response.routes[0];
                    for (var i = 0; i < myroute.legs.length; i++) {
                        distance += myroute.legs[i].distance.value;
                    }

                    distance = distance / 1000;
                    console.log(distance);
                }
            });
        };

        plugin.init();

    };

    // add the plugin to the jQuery.fn object
    $.fn.gooMaps = function (options) {
        return this.each(function () {
            // if plugin has not already been attached to the element
            if (undefined == $(this).data('gooMaps')) {
                var plugin = new $.gooMaps(this, options);
                $(this).data('gooMaps', plugin);
            }
        });
    }

})(jQuery);
