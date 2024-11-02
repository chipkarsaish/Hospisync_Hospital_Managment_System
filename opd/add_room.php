<?php
include('../database.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_name = $_POST['room_name'];
    $block_name = $_POST['block_name'];
    $status = $_POST['status'];
    $patient_name = $_POST['patient_name']; 

    
    $sql = "INSERT INTO hospital_rooms (room_name, block_name, status, patient_name) VALUES ('$room_name', '$block_name', '$status', '$patient_name')";

    if (mysqli_query($conn, $sql)) {
        
        header('Location: main.php'); 
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Add a New Room</h2>
        <form action="add_room.php" method="POST">
            <div class="mb-3">
                <label for="roomName" class="form-label">Room Name</label>
                <input type="text" class="form-control" id="roomName" name="room_name" required>
            </div>
            <div class="mb-3">
                <label for="blockName" class="form-label">Block Name</label>
                <input type="text" class="form-control" id="blockName" name="block_name" required>
            </div>
            <div class="mb-3">
                <label for="roomStatus" class="form-label">Room Status</label>
                <select class="form-control" id="roomStatus" name="status" required>
                    <option value="Vacant">Vacant</option>
                    <option value="Occupied">Occupied</option>
                    <option value="Housekeeping">Housekeeping</option>
                    <option value="Retain">Retain</option>
                    <option value="Blocked">Blocked</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="patientName" class="form-label">Patient Name</label>
                <input type="text" class="form-control" id="patientName" name="patient_name" placeholder="Enter patient name if occupied" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Room</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
