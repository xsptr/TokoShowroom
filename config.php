<?php

define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'showroom');

/**
 * $dbconnect : koneksi ke database
 */

$dbconnect = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

/**
 * Check Error yang terjadi saat koneksi
 * jika terdapat error maka die() // stop dan tampilkan error
 */
if ($dbconnect->connect_error) {
	die('Database Not Connected. Error : ' . $dbconnect->connect_error);
}