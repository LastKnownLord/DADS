<?php
	$dbConn = mysql_connect('localhost', 'greenbj6_gunApp', 't^h^u^g^555');

	if (!$dbConn){
		die('Could not connect: ' . mysql_error());
	}
	//$dbObj = mysql_select_db('lastknow_games', $dbConn);
?>