<?php 
	session_start();
	
	# Fill our vars and run on client server
			$dsn = 'mysql:host=localhost;dbname=greenbj6_devGunApp';
			$dbuser = 'greenbj6_gunApp';
			$dbpass = 't^h^u^g^555';
			$gunShowId = $_SESSION['eventID'];
			try {
				$db = new PDO($dsn, $dbuser, $dbpass);
			}
			catch (PDOException $e) {
				$error_message = $e->getMessage();
				echo "<p> Error occurred while connecting: $error_message </p>";
			}
			if ($gunShowId > 0){
				$sqlQuery = "SELECT * FROM tblEvents WHERE eventID = '$gunShowId'";
				$result = $db->prepare($sqlQuery);
				$result->execute();
				while($dbResultArray = $result->fetch()) {
					$eventName = $dbResultArray['eventName'];
					$eventStart = $dbResultArray['eventStartDate'];
					$eventAddress = $dbResultArray['eventAddress'];
					$eventCity = $dbResultArray['eventCity'];
					$eventState = $dbResultArray['eventState'];
					$eventContact = $dbResultArray['eventContact'];
					// query tblVendors 
					$eventVendors = $dbResultArray['eventVendors'];
				}
				$result->closeCursor();
			}
			else {
				$sqlQuery = "SELECT 1 FROM tblEvents";
				$result = $db->prepare($sqlQuery);
				$result->execute();
				$dbResultArray = $result->fetchAll(PDO::FETCH_ASSOC);
				$result->closeCursor();
			}
			//here we need a query to get all the vendors listed under this event ID and also need a count of number of vendors
			//$theVendors = explode(',', $eventVendors);
			$theVendors = json_encode($eventVendors);
		?>

<html>
	<head>
		<title>Gun Show Events</title>
		<meta name = "viewport" content ="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../styles/stylesheet.css" />
		<!-- our scripts -->
		<script type="text/javascript" src="assets/scripts.js"></script>
			<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<!-- include the jQuery Mobile stylesheet -->
		<link rel = “stylesheet” href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<!-- include the jQuery and jQuery Mobile JavaScript files -->
		<script src= "https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script src= "https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
		<script type="text/javascript">

		/* ========================================================= */
			/* parseVendorList function */
		/* ========================================================= */
			function parseVendorList(){
				var theArray = new Array();
				var theVendorArray = new Array();
				theArray = <?php echo ($theVendors); ?>;
				theVendorArray = theArray.split(',');
				var cList = $('#vendorList');
				//for (i in theVendorArray){
				for (i = 0; i < theVendorArray.length; i++){
					var html = theVendorArray[i];
					cList.append("<li id='aVendor'> Vendor: " + html + "</li>");
				} // close for
			} // close parseVendorList
		
		/* ========================================================= */
			/* (document).ready(function() [wait for DOM to fully load]*/
		/* ========================================================= */
			$(document).ready(function() {
				parseVendorList();

			}); // close document.ready

		</script>
	</head>
	<body>
		<div class = "container">
		<!-- <div for information about the event> </div>-->
			<div class = "header">
				<div id = "vendor_ads_top">
					<img src = "../images/lawfulAd.jpg">
				</div>
				<h1 id="event_name"><?php echo $eventName; ?></h1>
				<h3 id = "event_address"><?php echo $eventAddress. " ".$eventCity.", ".$eventState; ?></h3>
				<h3 id="url_more">Contact: <a href = "<?php echo $eventContact; ?>"> <?php echo $eventContact; ?> </a></h3>
			</div>
			<div style="margin-top: 20px"><hr></div>
			 <!-- <div for vendor list> </div>-->
			<div id="vendors" style="margin-right: 30px;">
				<h1>Participating Vendors:</h1>
				<div id="displayResult">
					<ul id = "vendorList">
					</ul>
				</div>
			</div>
			<div id = "vendor_ads_bot">
				<img src = "../images/GunSHow1JPEG.jpg">
			</div>
		</div>
	</body>
</html>