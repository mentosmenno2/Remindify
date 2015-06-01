<?php


/*-----------------connect to database-----------------*/

require("settings.php");
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);

if ($mysqli->connect_error) {
	die("Connection failed: " . $mysqli->connect_error);
}