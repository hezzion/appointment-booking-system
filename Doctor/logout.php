<?php 
    session_start();

    unset($_SESSION['doctor_id']);

    header("Location: login.php");
    exit();
?>