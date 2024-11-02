<?php
include('../database.php'); // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['pharmaceuticalId'];
    $name = $_POST['name'];
    $barcode = $_POST['barcode'];
    $vendor = $_POST['vendor'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];

    // Debug: Print form data
    echo "ID: $id, Name: $name, Barcode: $barcode, Vendor: $vendor, Category: $category, Quantity: $quantity";

    $query = "UPDATE pharmaceuticals SET name = ?, barcode = ?, vendor = ?, category = ?, quantity = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssii", $name, $barcode, $vendor, $category, $quantity, $id);

    if ($stmt->execute()) {
        echo "Pharmaceutical updated successfully.";
    } else {
        echo "Error updating pharmaceutical: " . $stmt->error;
    }
}
?>
