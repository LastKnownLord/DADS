
<html>
	<head>
		<title>Gun Show Events</title>
		<meta name = "viewport" content ="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="styles/stylesheet.css" />
		<!-- responsive web design stylesheet -->
		<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
	 <!-- Google Maps and Places API -->
	<!--	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=true"></script> -->
			<script asynch src="http://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyAN7Khtmvz8nYThWWqYQedGX063ZJMhkNs"></script>
	<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<!-- include the jQuery Mobile stylesheet -->
		<link rel = “stylesheet” href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<!-- include the jQuery and jQuery Mobile JavaScript files -->
		<script src= "https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script src= "https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<!-- our scripts -->
		<script type="text/javascript" src="assets/scripts_trial.js"></script>
		<script type="text/javascript" src="assets/hideScript.js"></script>
	</head>
	<body>
		<div class = "container">
			<div class = "header">
				<h1>Gun Show Events</h1>
				<p>Click on a state for gun shows in that area</p>
			</div>
			 <!-- <div id="map-canvas" style="margin-left: 300px;"> </div> -->
			<div id="map-canvas" style="margin-right: 30px;">
			</div>
			<div>
				<p style="margin-top: -5px">
				<form id='pickMonthForm' name='pickmonth' method = "post">
				<label for="pickmonth">Filter by month:</label>
					<select size = "1" name = "pickmonth" id = "pickmonth">
						<option value ="00">All</option>
						<option value ="01">January </option>
						<option value ="02">February </option>
						<option value ="03">March </option>
						<option value ="04">April </option>
						<option value ="05">May </option>
						<option value ="06">June </option>
						<option value ="07">July </option>
						<option value ="08">August </option>
						<option value ="09">September </option>
						<option value ="10">October </option>
						<option value ="11">November </option>
						<option value ="12">December </option>
					</select>
				</form>
				</p>
			</div>
			<div id="infoTest" style="color:white;">&nbsp;</div>
		</div>
	</body>
</html>