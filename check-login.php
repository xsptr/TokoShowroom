<?php
session_start();
require 'config.php';

if ( isset($_POST['username']) && isset($_POST['password'])) {

	$username = $_POST['username'];
	$password = md5( $_POST['password']);

	$username = $dbconnect->escape_string($username);
	$password = $dbconnect->escape_string($password);

		$sql_check = "SELECT nama,
						 lvl_user,
						 id_user
					  FROM user
					  WHERE
					  		username='$username'
					  		AND
					  		password='$password'
					  LIMIT 1";

		$check_log = $dbconnect->query($sql_check);

		if ($check_log->num_rows == 1) {
			$row = $check_log->fetch_assoc();

			
				$_SESSION['user_login'] = $row['lvl_user'];
				$_SESSION['sess_id']	= $row['id_user'];
				$_SESSION['nama']		= $row['nama'];

				if( $row['lvl_user'] == 'admin'){
					$_SESSION['admin']= 'TRUE';
				}

			header('location:on-'.$_SESSION['user_login']);
			exit();

		} else {
			header('location: login.php?error='.base64_encode('Username dan Password Salah!!!!'));
			exit();
		}


} else {
	header('location:login.php');
	exit;
}