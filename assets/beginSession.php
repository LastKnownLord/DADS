<?php
	
	session_start();
	
	$_SESSION['eventID'] = $_POST["eID"];
	echo "<script type='text/javascript' language='javascript'>location.href='assets/gunEventPage.php';</script>";
	
?>





