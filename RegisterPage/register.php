<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_1'])) {
        // Doctor registration
        $name = $_POST['name_1'];
        $email = $_POST['email_1'];
        $dob = date('Y-m-d', strtotime($_POST['dob_1']));
        $specialization = $_POST['specialization'];
        $experience = $_POST['experience_1'];
        $password = $_POST['psw_1'];

        $sql = "INSERT INTO doctors (name, email, dob, specialization, experience, password) VALUES ('$name', '$email', '$dob', '$specialization', '$experience', '$password')";

        if ($conn->query($sql) === TRUE) {
            header("Location: confirmation.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['submit_2'])) {
        // Staff registration
        $name = $_POST['name_2'];
        $email = $_POST['email_2'];
        $dob = date('Y-m-d', strtotime($_POST['dob_2']));
        $department = $_POST['department'];
        $password = $_POST['psw_2'];

        $sql = "INSERT INTO staff (name, email, dob, department, password) VALUES ('$name', '$email', '$dob', '$department', '$password')";

        if ($conn->query($sql) === TRUE) {
            header("Location: confirmation.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Register</h2>
            <form id="roleForm">
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select id="role" name="role" required>
                        <option value="">Select Role</option>
                        <option value="doctor">Doctor</option>
                        <option value="staff">Staff</option>
                    </select>
                </div>
                <button type="button" id="nextButton" class="btn">Next</button>
            </form>

            <!------- Doctor Registration Form ----------->

            <form id="doctorForm" style="display: none;" action = "register.php" method = "POST">
                <h3>Doctor Registration</h3>
                <label for="doctorName">Name:</label>
                <input type="text" id="doctorName" name="name_1" required>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="doctorEmail" name="email_1" required>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth (DD-MM-YYYY):</label>
                    <input type="date" id="doctorDob" name="dob_1" required>
                </div>
                <div class="form-group">
                    <label for="specialization">Specialization:</label>
                    <select id="specialization" name="specialization" required>
                        <option value="select">--Select--</option>
                        <option value="orthopedic">Orthopedic</option>
                        <option value="pediatrician">Pediatrician</option>
                        <option value="cardiologist">Cardiologist</option>
                        <option value="neurologist">Neurologist</option>
                        <option value="nephrology">Nephrologist</option>
                        <option value="oncology">Oncologist</option>
                        <option value="physciology">Psychiatrist</option>   
                    </select>
                </div>
                <div class="form-group">
                    <label for="experience">Years of Experience:</label>
                    <input type="number" id="experience" name="experience_1" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="doctorPsw" name="psw_1">
                    
                    required>
                </div>
                <input type="submit" class="btn" value="SignUp" name="submit_1"/>
            </form>

            <!--------- Staff Registration Form ------------>
            <form id="staffForm" style="display: none;" action = "register.php" method = "POST">
                <h3>Staff Registration</h3>
                <label for="staffName">Name:</label>
                <input type="text" id="staffName" name="name_2" required>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="staffEmail" name="email_2" required>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth (DD-MM-YYYY):</label>
                    <input type="date" id="staffDob" name="dob_2" required>
                </div>
                <div class="form-group">
                    <label for="department">Department:</label>
                    <input type="text" id="department" name="department" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="staffPsw" name="psw_2">
                    
                    
                </div>
                <input type="submit" class="btn" value="SignUp" name="submit_2"/>
            </form>
        </div>
        <div id="error-message"></div>
    </div>
    <script src="register.js"></script>
</body>
</html>


