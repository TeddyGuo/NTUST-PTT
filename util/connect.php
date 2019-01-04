<?php
	 $con = new mysqli("127.0.0.1", "root", "newpassword", "HEHE") or die('Error while selecting database: '.mysqli_connect_error());
	//$con = new mysqli("us-cdbr-iron-east-01.cleardb.net", "b3814a2aa0f0f8", "2e2a4848", "heroku_cc89c495e6357c1") or die('Error while selecting database: '.mysqli_connect_error());

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	// $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	// $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// version php5
	/*
	$con = mysql_connect('127.0.0.1', 'root', 'newpassword') or die('Error while connecting SQL: '.mysql_error());
	mysql_select_db('HEHE', $con) or die('Error while selecting database: '.mysql_error());
	mysql_query('SET NAMES UTF8');
	*/
?>
