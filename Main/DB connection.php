<?php

$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "sms_db";  

$conn = mysqli_connect($sName, $uName, $pass, $db_name);
if (!$conn) {
    die("Unable to connect to database");
}