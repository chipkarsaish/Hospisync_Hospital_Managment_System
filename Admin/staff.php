<?php
include('../database.php');

// Fetch data from staff table
$staffQuery = "SELECT id, name, email, dob, department FROM staff";
$staffResult = mysqli_query($conn, $staffQuery);
if (!$staffResult) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Information</title>
    <link href="D:\PHP\htdocs\test\css\styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../Images/logo.jpg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                HospiSync
            </a>
        </div>
    </nav>
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link " aria-current="page" href="#">Admin Info</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="doctor.php">Doctors</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active " href="staff.php">Staff</a>
      </li>
      
    </ul>
    <table class="table table-striped-columns">
        
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date of Birth</th>
                                <th>Department</th>
                                <th>Actions</th>
                            </tr>
                            <?php while($row = mysqli_fetch_assoc($staffResult)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['dob']; ?></td>
                                <td><?php echo $row['department']; ?></td>
                                <td>
                                    <a href="edit_staff.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete_staff.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this staff member?')">Delete</a>
                                </td>
                            </tr>
                            <?php } ?>
                        
                    </table>
                
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>