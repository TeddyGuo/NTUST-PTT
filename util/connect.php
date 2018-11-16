<?php
	$con = new mysqli("127.0.0.1", "root", "newpassword", "HEHE") or die('Error while selecting database: '.mysqli_connect_error());
	// version php5
	/*
	$con = mysql_connect('127.0.0.1', 'root', 'newpassword') or die('Error while connecting SQL: '.mysql_error());
	mysql_select_db('HEHE', $con) or die('Error while selecting database: '.mysql_error());
	mysql_query('SET NAMES UTF8');
	*/
?>
