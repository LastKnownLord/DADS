<?php

	# Fill our vars and run on cli
	$dsn = 'mysql:host=localhost;dbname=greenbj6_devGunApp';
	$dbuser = 'greenbj6_gunApp';
	$dbpass = 't^h^u^g^555';
	
	
	try {
		$db = new PDO($dsn, $dbuser, $dbpass);
	}
	catch (PDOException $e) {
		$error_message = $e->getMessage();
		echo "<p> Error occurred while connecting: $error_message </p>";
	}
	
	$filterMonth = $_POST["month"];
	
	if ($filterMonth > 0){
		//$sqlQuery = "SELECT * FROM tblEvents";
		//$sqlQuery = "SELECT * FROM tblEvents WHERE eventMonth = 5";
		$sqlQuery = "SELECT * FROM tblEvents WHERE eventMonth = " . $filterMonth . "";
		$result = $db->prepare($sqlQuery);
		$result->execute();
		// $dbResultArray = array();
		$dbResultArray = $result->fetchAll(PDO::FETCH_ASSOC);
		//$dServer= json_encode($dbResultArray);
		$result->closeCursor();
	}
	
	else {
		$sqlQuery = "SELECT * FROM tblEvents";
		//$sqlQuery = "SELECT * FROM `tblEvents` WHERE `eventMonth` = '5'";
		$result = $db->prepare($sqlQuery);
		$result->execute();
		$dbResultArray = $result->fetchAll(PDO::FETCH_ASSOC);
		//$dServer= json_encode($dbResultArray);
		$result->closeCursor();
	}

	print json_encode($dbResultArray);
	
	//send results to a file
			$aNewLine = "\n";
			$fname = "getGunmapEventsLog.txt";
			$myfile = fopen("dbResultsArray.txt", "w") or die("Unable to open file!");
			$newInfo = "month selected: " . $filterMonth . "starting new...";
			$fcontents = $newInfo. $aNewLine . "------------------------------------------------" . $aNewLine;
			file_put_contents($fname, $fcontents, FILE_APPEND);
			file_put_contents($fname, var_export($dbResultArray, TRUE), FILE_APPEND);
			fclose($myfile);
	//end send results  
	//print $dServer;		
?>





