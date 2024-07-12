<?php
session_start();
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $slot = intval($_POST['slot']);

    if ($slot <= 0) {
        die("Invalid slot value.");
    }

    $doctor_id = $_SESSION['doctor_id'];

    $query = "UPDATE doctors SET slot = ? WHERE id = ?";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ii", $slot, $doctor_id);
        if ($stmt->execute()) {
            header("Location: index.php?message=Slot created successfully");
        } else {
            echo "Error updating slot: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
    
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
