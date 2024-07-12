<?php 
session_start();
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'appointments';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
	die("Connection failed: " .$conn->connect_error);
}

if (!isset($_SESSION['admin_login'])) {
    // header("Location: login.php");
}

?>