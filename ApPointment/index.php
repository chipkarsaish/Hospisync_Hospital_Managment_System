<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "hospital";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $doctor = htmlspecialchars($_POST['doctor']);
    $date = htmlspecialchars($_POST['date']);
    $time_slot = htmlspecialchars($_POST['time_slot']); // Changed to time_slot

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO patient (Name, Email, PhoneNumber, DoctorName, DateOfAppointment, PreferredTime) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ssssss", $name, $email, $phone, $doctor, $date, $time_slot); // Changed to time_slot
    // Execute the statement
    if ($stmt->execute()) {
        $confirmationMessage = "Appointment booked successfully!";
    } else {
        $confirmationMessage = "Error: " . $stmt->error;
    }
    // Close the statement
    $stmt->close();
}

// Fetch doctor names
$sql = "SELECT id, name FROM doctors";
$result = $conn->query($sql);

// Define available time slots
$time_slots = [
    "09:00 - 10:00 AM",
    "10:00 - 11:00 AM",
    "11:00 - 12:00 PM",
    "12:00 - 01:00 PM",
    "01:00 - 02:00 PM",
    "02:00 - 03:00 PM",
    "03:00 - 04:00 PM",
    "04:00 - 05:00 PM"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Appointment Booking</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .time-slot {
            background-color: lightgray;
            color: black;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin: 5px;
        }

        .time-slot.active {
            background-color: darkgray;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Book an Appointment</h2>
        <form id="appointmentForm" action="index.php" method="POST">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="doctor">Select Doctor</label>
                <select id="doctor" name="doctor" required>
                    <option value="">Choose a Doctor</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="date">Preferred Date</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time_slot">Preferred Time</label>
                <div id="time_slot_buttons">
                    <?php
                    foreach ($time_slots as $slot) {
                        echo "<button type='button' class='time-slot' data-value='$slot'>$slot</button>";
                    }
                    ?>
                </div>
                <input type="hidden" id="time_slot" name="time_slot" required>
            </div>
            <button type="submit">Book Appointment</button>
        </form>
        <?php
        if (isset($confirmationMessage)) {
            echo "<p id='confirmationMessage'>$confirmationMessage</p>";
        }
        ?>
    </div>
    <script>
        document.querySelectorAll('.time-slot').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.time-slot').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                document.getElementById('time_slot').value = button.getAttribute('data-value');
            });
        });
    </script>
</body>
</html>
<?php
$conn->close();
?>



