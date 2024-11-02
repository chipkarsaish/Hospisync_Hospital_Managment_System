<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "hospital";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, 3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Assuming the Staff's ID is stored in the session after login
if (isset($_SESSION['user_id'])) {
    $staff_id = $_SESSION['user_id'];

    // Fetch staff information from the database
    $query = "SELECT name, email, dob, department FROM staff WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $staff_id);
    $stmt->execute();
    $result = $stmt->get_result();



    if ($result->num_rows > 0) {
        $staff = $result->fetch_assoc();
    } else {
        die("Staff member not found.");
    }
} else {
    die("User ID not set in session.");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
        <img src="Logo.jpg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
          HospiSync
        </a>
      </div>
    </nav>
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">Staff Info</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="../StaffDashboard/doctorpatient2.php">Patients Checklist</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="../StaffDashboard/doctorapprove1.php">Patients Approved</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="../StaffDashboard/prevpatients1.php">Previous Patients Info.</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../StaffDashboard/pharma.php">Pharmaceutical Inventory</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../StaffDashboard/opd/main.php">OPD Managment</a>
      </li>
      
    </ul>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-4">
          <div class="card">
          <img src="profile.jpg" class="card-img-top" alt="Profile Picture" width = "100px" height = "290px">
            <div class="card-body text-center">
              <h5 class="card-title"><?php echo $staff['name']; ?></h5>
              <p class="card-text">Staff Member</p>
              <button type="button" class="btn btn-danger" onclick="confirmLogout()">Logout</button>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              Staff Member Information
            </div>
            <div class="card-body">
              
              <ul class="list-group list-group-flush">
                <li class="list-group-item">Email: <?php echo $staff['email']; ?></li>
                <li class="list-group-item">Department: <?php echo $staff['department']; ?></li>
                <li class="list-group-item">DOB: <?php echo $staff['dob']; ?></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function confirmLogout() {
            if (confirm("Are you sure you want to logout?")) {
                // Redirect to the logout URL
                window.location.href = '../main.php'; // Replace 'logout.php' with your actual logout URL
            }
        }
    </script>
  </body>
</html>
