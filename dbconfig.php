<?php
$host = "localhost";
$database = "busnurd";
$username = "root";
$password = "";

$db = mysqli_connect($host,$username,$password,$database);

function sanitizeData($data) {
	global $db;
	$value = trim($data);
	return mysqli_real_escape_string($db, $data);
}

function checkAuthentication() {
	if (!isset($_SESSION['user_id'])) {
		header("location: index.php");
	} 
}

function isLoggedIn() {
	if (isset($_SESSION['user_id'])) {
		return true;
	} else {
		return false;
	}
}

function isAdmin() {
	if (isset($_SESSION['admin_id'])) {
		return true;
	} else {
		return false;
	}
}
?>