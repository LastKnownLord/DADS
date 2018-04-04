<html>
	<head>
		<title>Gun Show Events</title>
		<meta name = "viewport" content ="width-device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<!-- responsive web design stylesheet -->
		<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
	 <!-- Google Maps and Places API -->
	<!--		<script asynch src="http://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyAN7Khtmvz8nYThWWqYQedGX063ZJMhkNs"></script> -->
			<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
			<script src= "https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<!-- our scripts -->
		<script type="text/javascript" src="assets/scripts.js">
			google.maps.event.addDomListener(window, 'load', geocodeAddress);
		</script>
	</head>
	<body>
		<div style="margin-left: 10px;">
			<h1>Geocode Address for GunApp</h1>
			<p>Event Name: <input type="textbox" name="name" id="name" /></p>
			<p>Start Month: <input type="textbox" name="month" id="month" /></p>
			<p>Start Date: <input type="textbox" name="startDate" id="startDate" /></p>
			<p>End Date: <input type="textbox" name="endDate" id="endDate" /></p>
			<p>URL: <input type="textbox" name="URL" id="URL" /></p>
			<p>Street Address: <input type="textbox" name="address" id="address" /></p>
			<p>City: <input type="textbox" name="city" id="city" /></p>
			<p>State: <input type="textbox" name="state" id="state" /></p>	
			<p>Phone: <input type="textbox" name="phone" id="phone" /></p>
			<p>Vendors IDs (#,#,#...): <input type="textbox" name="vendors" id="vendors" /></p>
			<p>Contact (optional): <input type="textbox" name="contact" id="contact" /></p>

			<p>Submit new event to DB: <input type="submit" onClick="geocodeAddress()" /></p>
			<div id="infoTest" style="color:black;">results</div>
		</div>
	</body>
</html>