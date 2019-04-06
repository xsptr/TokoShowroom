<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "showroom";

// Koneksi dan memilih database di server
$db = new mysqli($server, $username, $password, $database);

if ($db->connect_error){
	die("Unable to connect database: " . $db->connect_error);
}
