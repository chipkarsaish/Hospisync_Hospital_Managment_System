<?php
include('../database.php');

// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patientId = $_POST['patientId'];

    // Start a transaction
    mysqli_begin_transaction($conn);

    try {
        // Insert the patient record into the new table
        $insertQuery = "INSERT INTO prev_patient (id, Name, PhoneNumber, DateOfAppointment, PreferredTime, Email, pdf_file_path, DoctorName)
                        SELECT id, Name, PhoneNumber, DateOfAppointment, PreferredTime, Email, pdf_file_path, DoctorName
                        FROM archived_patient
                        WHERE id = ?";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("i", $patientId);

        if (!$stmt->execute()) {
            throw new Exception("Insert query failed: " . $stmt->error);
        }

        // Delete the patient record from the original table
        $deleteQuery = "DELETE FROM archived_patient WHERE id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("i", $patientId);

        if (!$stmt->execute()) {
            throw new Exception("Delete query failed: " . $stmt->error);
        }

        // Commit the transaction
        mysqli_commit($conn);
        echo "Patient moved successfully.";
    } catch (Exception $e) {
        // Rollback the transaction in case of error
        mysqli_rollback($conn);
        echo "Error moving patient: " . $e->getMessage();
    }
}
?>

