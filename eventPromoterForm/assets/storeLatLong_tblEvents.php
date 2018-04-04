<?php 

	# Fill our vars and run on client server
	$dsn = 'mysql:host=localhost;dbname=greenbj6_devGunApp';
	$dbuser = 'greenbj6_gunApp';
	$dbpass = 't^h^u^g^555';

	//$theID = $_POST['thisID'];
	
	$thisName = $_POST['thisName'];
	$thisStartDate = $_POST['thisStartDate'];
	$thisEndDate = $_POST['thisEndDate'];
	$thisURL = $_POST['thisURL'];
	$thisAddress = $_POST['thisAddress'];
	$thisCity = $_POST['thisCity'];
	$thisState = $_POST['thisState'];
	$thisPhone = $_POST['thisPhone'];
	$thisVendors = $_POST['thisVendors'];
	$thisContact = $_POST['thisContact'];
	$thisMonth = $_POST['thisMonth'];
	$thisLat = $_POST['thisLat'];
	$thisLng = $_POST['thisLng'];
	
	try {
		$db = new PDO($dsn, $dbuser, $dbpass);
	}
	catch (PDOException $e) {
		$error_message = $e->getMessage();
		echo "<p> Error occurred while connecting: $error_message </p>";
	}

	//$sqlQuery = "UPDATE tblEvents SET eventLat = :tryLat, eventLong = :tryLng WHERE eventID = :tryID";
	$sqlQuery = "INSERT INTO tblEvents (eventName, eventStartDate, eventEndDate, eventURL, eventAddress, eventCity, eventState, eventPhone, eventVendors, eventContact, eventMonth, eventLat, eventLong) VALUES (:thisEventName, :thisEventStartDate, :thisEventEndDate, :thisEventURL, :thisEventAddress, :thisEventCity, :thisEventState, :thisEventPhone, :thisEventVendors, :thisEventContact, :thisEventMonth, :thisEventLat, :thisEventLong);";

	
	$statement = $db->prepare($sqlQuery);
	
	$statement->bindValue(':thisEventName', $thisName);
	$statement->bindValue(':thisEventStartDate', $thisStartDate);
	$statement->bindValue(':thisEventEndDate', $thisEndDate);
	$statement->bindValue(':thisEventURL', $thisURL);
	$statement->bindValue(':thisEventAddress', $thisAddress);
	$statement->bindValue(':thisEventCity', $thisCity);
	$statement->bindValue(':thisEventState', $thisState);
	$statement->bindValue(':thisEventPhone', $thisPhone);
	$statement->bindValue(':thisEventVendors', $thisVendors);
	$statement->bindValue(':thisEventContact', $thisContact);
	$statement->bindValue(':thisEventMonth', $thisMonth);
	$statement->bindValue(':thisEventLat', $thisLat);
	$statement->bindValue(':thisEventLong', $thisLng);
	
	//$statement->bindValue(':tryID', $theID);
	$statement->execute();
	$statement->closeCursor();

?>
