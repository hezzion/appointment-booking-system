<?php 

    // Database configuration
    $host = 'localhost';  // Your database host (usually 'localhost')
    $username = 'root';  // Your database username
    $password = '';  // Your database password (empty since there's no password)
    $database = 'my project';  // Your database name
    
    // Establish a connection to the database
    $conn = new mysqli($host, $username, $password, $database);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        // echo "Connected successfully";
    }
    
?>