/*
	Javascript functions designed for the Geocode Address for Gun Show app.
	Created by: D.G.C. developers - Anton Drake and Elizabeth Drake
	Created in: 2016
*/

	var thisID;
	var thisName;
	var thisStartDate;
	var thisEndDate;
	var thisURL;
	var thisAddress;
	var thisCity;
	var thisState;
	var thisPhone;
	var thisVendors;
	var thisContact;
	var thisMonth;

/* ========================================================= */
	/* geocodeAddress() function */
/* ========================================================= */
	function geocodeAddress() {
		//alert('Inside geocodeAddress');
		//thisID = document.getElementById("id").value;
		var theCity = document.getElementById("city").value;
		var theState = document.getElementById("state").value;
		var theLocale = theCity + "," + theState;
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode( { 'address': theLocale}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var location = results[0].geometry.location;
				//alert('LAT: ' + location.lat() + ' LANG: ' + location.lng());
				storeLatLong(location.lat(), location.lng());
			} // close if
			else {
				alert("Something got wrong because status = " + status);
			} // close else
        });	// close geocoder
	}	// close function

/* ========================================================= */
	/* storeLatLong()
/* ========================================================= */
	function storeLatLong(thisLat, thisLng){
		//thisID = document.getElementById("id").value;
		
		thisName = document.getElementById("name").value;
		thisMonth = document.getElementById("month").value;
		thisStartDate = document.getElementById("startDate").value;
		thisEndDate = document.getElementById("endDate").value;
		thisURL = document.getElementById("URL").value;
		thisAddress = document.getElementById("address").value;
		thisCity = document.getElementById("city").value;
		thisState = document.getElementById("state").value;
		thisPhone = document.getElementById("phone").value;
		thisVendors = document.getElementById("vendors").value;
		thisContact = document.getElementById("contact").value;
		
		//alert("storeLatLong-> ID: " + thisID + " || LAT: " + thisLat + " || Long: " + thisLng);
		$.ajax({
			type:"POST",
			//dataType:"json",
			url: "assets/storeLatLong_tblEvents.php",
			data: {"thisName" : thisName, "thisMonth" : thisMonth, "thisStartDate" : thisStartDate, "thisEndDate" : thisEndDate, "thisURL" : thisURL, "thisAddress" : thisAddress, "thisCity" : thisCity, "thisState" : thisState, "thisPhone" : thisPhone, "thisVendors" : thisVendors, "thisContact" : thisContact, "thisLat" : thisLat, "thisLng" : thisLng },
			error: function() {
				$('#infoTest').html('<p>An error has occurred</p>');
			},
			success: function() {
			   
				$('#infoTest').html("<p> The event with Lat/Lng has been stored in database.</p>")
				alert("Enter another City/State to geoCode and Store");
			},

			async: false	// needs to be false
		});
	}


/* ========================================================= */
/* ========================================================= */