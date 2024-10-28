<?php
include('../database.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch doctor details
    $query = "SELECT id, name, email, dob, specialization, experience FROM doctors WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $doctor = $result->fetch_assoc();
    } else {
        die("Doctor not found.");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $specialization = $_POST['specialization'];
    $experience = $_POST['experience'];

    // Update doctor details
    $query = "UPDATE doctors SET name = ?, email = ?, dob = ?, specialization = ?, experience = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $name, $email, $dob, $specialization, $experience, $id);
    if ($stmt->execute()) {
        echo "<script>alert('Doctor updated successfully.'); window.location.href='doctor.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Doctor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Doctor</h2>
        <form method="post" action="edit_doctor.php">
            <input type="hidden" name="id" value="<?php echo $doctor['id']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $doctor['name']; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $doctor['email']; ?>">
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $doctor['dob']; ?>">
            </div>
            <div class="mb-3">
                <label for="specialization" class="form-label">Specialization</label>
                <input type="text" class="form-control" id="specialization" name="specialization" value="<?php echo $doctor['specialization']; ?>">
            </div>
            <div class="mb-3">
                <label for="experience" class="form-label">Experience</label>
                <input type="text" class="form-control" id="experience" name="experience" value="<?php echo $doctor['experience']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Doctor</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
