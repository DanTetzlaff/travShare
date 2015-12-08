/*
Author: Daniel Tetzlaff
Created: November 2015
Version: 1.0

Controls the implimentation and styling of google maps 
*/

// custom styling for a google map object 
var styles = [
    {
        "featureType": "administrative",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "water",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "transit",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "landscape",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.local",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "water",
        "stylers": [
            {
                "color": "#84afa3"
            },
            {
                "lightness": 52
            }
        ]
    },
    {
        "stylers": [
            {
                "saturation": -17
            },
            {
                "gamma": 0.36
            }
        ]
    },
    {
        "featureType": "transit.line",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#3f518c"
            }
        ]
    }
];

function initMap() {
		// set settings for the map and assign custom style to default map options
	var mapOptions = {
		zoom: 13,
		center: myLatLng,
		styles: styles
	};
		
		//create map object
	var map = new google.maps.Map(document.getElementById('map'), mapOptions);
	
	/*basic non-style map
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 13,
		center: myLatLng
	});*/

		//set a marker to be placed on the map at the coordinated of the picture
	var marker = new google.maps.Marker({
		icon: 'http://google.com/mapfiles/ms/micons/ltblu-pushpin.png',
		animation: google.maps.Animation.DROP,
		position: myLatLng,
		map: map,
		title: imageT
	});
}

