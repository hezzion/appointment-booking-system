<?php
// Include database connection file
include('../../includes/db.php');

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $patientname = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Sanitize inputs to prevent SQL injection
    $patientname = mysqli_real_escape_string($conn, $patientname);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);

    // Update query
    $sql = "UPDATE users SET name = '$patientname', email = '$email', phone = '$phone' WHERE patient_id = $patient_id";
    $patient_sql = "UPDATE patients SET patientname = '$patientname', email = '$email', phone = '$phone' WHERE user_id = $patient_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to index.php or any other success page
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>
