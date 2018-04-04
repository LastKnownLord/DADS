/*
	Javascript functions designed for the Gun Show app.
	Created by: D.G.C. developers - Anton Drake and Elizabeth Drake
	Created in: 2016
*/
/* ========================================================= */
/* ========================================================= */
	/* javascript functions/vars for the gun-show events app */
/* ========================================================= */
/* ========================================================= */
/*	Global Variables */
	var gunmap;
	var theEventString;
	var theEventParse = [];
	var markers = [];
	var gunmap_events = [];
	var valMonthSelected;
	valMonthSelected = 0;
	var marker, i;
	var geocoder;
	var infowindow;

/* ========================================================= */
	/* getEvents() function */
/* ========================================================= */
	function getEvents(){
		$.ajax({
			type:"POST",
			dataType:"json",
			url: "assets/getGunmapEvents.php",	
			data: { "month": valMonthSelected },
			error: function() {
				$('#infoTest').html('<p>An error has occurred</p>');
			},
			success: function(dServer) {
				theEventString = JSON.stringify(dServer);
				theEventParse = JSON.parse(theEventString);
				for(var x in theEventParse){
					gunmap_events.push(theEventParse[x]);
				}
			},
			async: false	// needs to be false
		});
	}

/* ========================================================= */
	/* setMarkers() function */
/* ========================================================= */
	function setMarkers(gunmap_locations) 
	{
		if (markers.length > 0){
			clearMarkers();
		} // end if to clear markers
		for(i in gunmap_locations){
			//geocodeAddress(gunmap_locations[i]);
			placeMarkers(gunmap_locations[i]);
		} // close for i loop
	} // close setMarkers

/* ========================================================= */
	/* placeMarkers() function */
/* ========================================================= */
	function placeMarkers(locations){
		infowindow = new google.maps.InfoWindow();
		var theLatLng = new google.maps.LatLng(locations.eventLat, locations.eventLong);
		var html = locations.eventName + "<br /> Start Date: " + locations.eventStartDate + "<br /> <input id='clickMe' type='button' value='Click to visit' onclick='doFunction(" + locations.eventID + ");' />";
		marker = new google.maps.Marker({
			position: theLatLng,
			map: gunmap,
			animation: google.maps.Animation.DROP,
			title: locations.eventName,
			html: html,
			icon: "images/target_marker02.png"
		});
		google.maps.event.addListener(marker, 'click', function() {
					infowindow.setContent(this.html);
					infowindow.open(gunmap, this);
		}); // close addListener
		markers.push(marker);
	} // close placeMarkers	

/* ========================================================= */
	// Marker visibilty ??
/* ========================================================= */
	function makeMarkersVisible(isTrue) {
		//alert("makeMarkersVisible: " + isTrue );
		if (isTrue == 'yup'){
			for (var mv = 0; mv < markers.length; mv++) {
				markers[mv].setVisible(true);
			} // close for to make markers visible
		} // close if
		else {
			for (var mv = 0; mv < markers.length; mv++) {
				markers[mv].setVisible(false);
			} // close for to make markers invisible
		} // close else
	} // close makeMarkersVisible

/* ========================================================= */
	//remove all current markers that are on the map
/* ========================================================= */
	function clearMarkers() {
	  for (var cm = 0; cm < markers.length; cm++) {
		markers[cm].setMap(null);
	  }
	}
/* ========================================================= */
	/* inititalize() function */
/* ========================================================= */
	function initialize()	
	{
		infowindow = new google.maps.InfoWindow();
		geocoder =  new google.maps.Geocoder();
		var usaLocation = new google.maps.LatLng(37.09024, -95.712891);
		var minZoomLevel = 3;	// This is the minimum zoom level that we'll allow
		var mapOptions = {
			zoom: minZoomLevel,
			center: usaLocation,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		} // close mapOptions
		gunmap = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		geocoder.geocode({'address': 'US'}, function (results, status) {
			gunmap.fitBounds(results[0].geometry.viewport);               
		});	// close geocoder
		google.maps.event.addListener(gunmap, 'click', function(event) {
					makeMarkersVisible('yup'); // expose markers
					$('#pickMonthForm').show();
					var NewMapCenter = event.latLng;
					var newCenterLat = NewMapCenter.lat();
					var newCenterLng = NewMapCenter.lng();
					var minZoomLevel = 6;	// This is the minimum zoom level that we'll allow
					gunmap.setZoom(6);
					gunmap.setCenter(NewMapCenter);
				});
		google.maps.event.addListener(gunmap, 'zoom_changed', function() {
			//makeMarkersVisible('yup'); // expose markers
			//$('#pickmonth').show();
			if (gunmap.getZoom() < minZoomLevel) gunmap.setZoom(minZoomLevel);
		});	//close google.maps.event...

		getEvents(); // load gunmap_events array
		setMarkers(gunmap_events); // place markers
		makeMarkersVisible('nope'); // hide makrers
		
	} // close initialilze function
	
/* ========================================================= */
	/* (document).ready(function() function */
/* ========================================================= */
	$(document).ready(function() {

		$('#pickmonth').on('change', function() {
				var optionSelected = $(this).val();
				gunmap_events = [];
				valMonthSelected = optionSelected;
				getEvents();
				setMarkers(gunmap_events);
			});
		$('#pickMonthForm').hide();

		initialize();
	});
	
/* ========================================================= */
	/* get eventID from button click function */
/* ========================================================= */
	function doFunction(eID) {

		$.ajax({
			type:"POST",
			dataType:"html",
			url: "assets/beginSession.php",	
			data: { "eID": eID },
			error: function() {
				$('#infoTest').html('<p>An error has occurred</p>');
			},
			success: function(dServer) {
			   $('#infoTest').html(dServer);
			},
			async: false	// needs to be false
		});
	}
	

