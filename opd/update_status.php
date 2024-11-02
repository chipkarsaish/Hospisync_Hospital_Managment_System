<?php
include('../database.php'); // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_name = $_POST['room_name'];
    $status = $_POST['status'];

    // Update the room status in the database
    $sql = "UPDATE hospital_rooms SET status = '$status' WHERE room_name = '$room_name'";

    if (mysqli_query($conn, $sql)) {
        echo "Room status updated successfully!";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
}
?>


