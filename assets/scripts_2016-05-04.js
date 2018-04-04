/*
	Javascript functions designed for the Gun Show app.
	Created by: D.G.C. developers - Anton Drake and Elizabeth Drake
	Created in: 2016
*/
/*	Global Variables */
	var gunmap;
	var theEventString;
	var theEventParse = [];
	var markers = [];
	var gunmap_events = [];
	var valMonthSelected;
	valMonthSelected = 0;
	var eventLoc = [];
	var marker, i;
	var geocoder;
	var infowindow;

/* ========================================================= */
/* ========================================================= */
	/* javascript functions for the gun-show events app */
/* ========================================================= */
/* ========================================================= */


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
				//$('#infoTest').text(theEventString);
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
		if (gunmap_locations.length > 10){
			for (i = 15; i < 25; i++) {
				geocodeAddress(gunmap_locations[i], i);
			} // close for i loop
		} // close if
		else {
			for(i in gunmap_locations){
				geocodeAddress(gunmap_locations[i], i);
			} // close for i loop
		} // close else
	} // close setMarkers

/* ========================================================= */
	/* geocodeAddress() function */
/* ========================================================= */
	function geocodeAddress(locations, indie) {
		//alert("Inside geocodeAddress: indie = " + indie);
		geocoder =  new google.maps.Geocoder();
		infowindow = new google.maps.InfoWindow();
		var locale = locations.eventCity + "," + locations.eventState;
		var eventID = locations.eventID;
		var eventName = locations.eventName;
		
		geocoder.geocode({'address':locale}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var myLatLng = results[0].geometry.location;
				var html = eventName + "<br /> <input id='clickMe' type='button' value='Click_This' onclick='doFunction(" + eventID + ");' />";
				placeMarkers(myLatLng, html, eventName);
			} // close if
			else {
				alert("Something got wrong because status = " + status);
			} // close else
		});	// close geocoder
	}	// close function
	
/* ========================================================= */
	/* placeMarkers() function */
/* ========================================================= */
	function placeMarkers(theLatLng, theHTML, theTitle){
		//alert("Inside placeMarkers");
		infowindow = new google.maps.InfoWindow();
		marker = new google.maps.Marker({
			position: theLatLng,
			map: gunmap,
			animation: google.maps.Animation.DROP,
			title: theTitle,
			html: theHTML,
			icon: "images/target_marker02.png"
		});
		google.maps.event.addListener(marker, 'click', function() {
					infowindow.setContent(this.html);
					infowindow.open(gunmap, this);
		}); // close addListener
	} // close placeMarkers	
	
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
		
		google.maps.event.addListener(gunmap, 'zoom_changed', function() {
			if (gunmap.getZoom() < minZoomLevel) gunmap.setZoom(minZoomLevel);
		});	//close google.maps.event...
		
		getEvents(); // load gunmap_events array
		setMarkers(gunmap_events); // place markers
		
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
	

