<?php
include('../database.php');


$query = "SELECT id, Name, Email, PhoneNumber, DateOfAppointment, PreferredTime, pdf_file_path FROM prev_patient;";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
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
        <a class="nav-link " aria-current="page" href="../Staffinfo/staffinfo.php">Staff Info</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="doctorpatient2.php">Patients Checklist</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="doctorapprove1.php">Patients Approved</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link active" href="prevpatients1.php">Previous Patients Info.</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pharma.php">Pharmaceutical Inventory</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../opd/main.php">OPD Managment</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Ward/ward.php">Ward Managment</a>
      </li>
      
    </ul>
    <div id="layoutSidenav_content">
        <div class="container-fluid px-4">
            <h1 class="mt-4">Previous Patients</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../Doctorinfo/doc.php">Doctor info</a></li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Patients
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Contact no.</th>
                                <th>E-mail</th>
                                <th>Preferred Date</th>
                                <th>Preferred Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row['Name']; ?></td>
                                <td><?php echo $row['PhoneNumber']; ?></td>
                                <td><?php echo $row['Email']; ?></td>
                                <td><?php echo $row['DateOfAppointment']; ?></td>
                                <td><?php echo $row['PreferredTime']; ?></td>
                                <td>
                                    <?php if (!empty($row['pdf_file_path'])) { ?>
                                        <a href="../DownloadPHP/download_pdf1.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary">Download PDF</a>
                                    <?php } else { ?>
                                        <span>No PDF</span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="../js/scripts.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
            <script src="../js/datatables-simple-demo.js"></script>
        </div>
    </div>
</body>
</html