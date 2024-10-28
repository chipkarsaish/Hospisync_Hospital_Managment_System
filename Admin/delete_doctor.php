<?php
include('../database.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete doctor
    $query = "DELETE FROM doctors WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "Doctor deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
