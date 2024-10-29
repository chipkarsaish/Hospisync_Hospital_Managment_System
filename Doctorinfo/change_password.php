<?php
include('../doctorlog.php')
session_start();
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
    $current_password = $_POST["current_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];
    $email = $_SESSION["email"]; // Assuming the user's email is stored in the session

    // Fetch the current password from the database
    $sql = "SELECT password FROM doctors WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($current_password, $row["password"])) {
            if ($new_password == $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $sql = "UPDATE doctors SET password='$hashed_password' WHERE email='$email'";
                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success' role='alert'>Password updated successfully.</div>";
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Error updating password: " . $conn->error . "</div>";
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'>New passwords do not match.</div>";
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>Current password is incorrect.</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>No user found with this email.</div>";
    }

    $conn->close();
}
?>
