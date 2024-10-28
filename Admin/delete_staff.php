<?php
include('../database.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete staff
    $query = "DELETE FROM staff WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "Staff deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
