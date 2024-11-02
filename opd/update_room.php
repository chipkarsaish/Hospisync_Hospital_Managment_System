<?php
include('../database.php'); // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_name = $_POST['room_name'];
    $patient_name = $_POST['patient_name'];
    $status = $_POST['status'];

    // SQL query to update room information
    $sql = "UPDATE hospital_rooms SET patient_name = '$patient_name', status = '$status' WHERE room_name = '$room_name'";

    if (mysqli_query($conn, $sql)) {
        echo "Room updated successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
