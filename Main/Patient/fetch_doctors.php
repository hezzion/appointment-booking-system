<?php
include('../../includes/db.php');

if (isset($_GET['department'])) {
    $department = mysqli_real_escape_string($conn, $_GET['department']);
    
    // Prepare SQL query to select doctors from the database by department
    $sql = "SELECT fullname FROM doctors WHERE department = '$department'";
    
    // Execute SQL query
    $result = $conn->query($sql);
    
    // Fetch all doctors in an array
    $doctors = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $doctors[] = $row['fullname'];
        }
    }

    // Output doctors as JSON
    echo json_encode($doctors);

    // Close database connection
    $conn->close();
}
?>
