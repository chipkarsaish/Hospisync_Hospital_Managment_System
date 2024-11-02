<?php
include('../database.php'); // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $barcode = $_POST['barcode'];
    $vendor = $_POST['vendor'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];

    // Debug: Print form data
    echo "Name: $name, Barcode: $barcode, Vendor: $vendor, Category: $category, Quantity: $quantity";

    $query = "INSERT INTO pharmaceuticals (name, barcode, vendor, category, quantity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $name, $barcode, $vendor, $category, $quantity);

    if ($stmt->execute()) {
        echo "Pharmaceutical added successfully.";
    } else {
        echo "Error adding pharmaceutical: " . $stmt->error;
    }
}
?>
