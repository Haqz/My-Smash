<?php

	$host = "localhost";
	$db_user = "root";
	$db_password = "";
	$db_name = "facesmash";
	$conn_string = "mysql:host=$host;dbname=$db_name";

	function getDB(){
	    $dbConnection = new PDO($mysql_conn_string, $dbuser, $dbpass);
	    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    return $dbConnection;
	}

?>