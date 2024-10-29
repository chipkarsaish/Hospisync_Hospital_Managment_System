<?php
include('../database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patientId = $_POST['patientId'];

    // Start a transaction
    mysqli_begin_transaction($conn);

    try {
        // Insert the patient record into the new table
        $insertQuery = "INSERT INTO archived_patient (id, Name, PhoneNumber, DateOfAppointment, PreferredTime,  Email, pdf_file_path, DoctorName)
                        SELECT id, Name, PhoneNumber, DateOfAppointment, PreferredTime, Email, pdf_file_path, DoctorName
                        FROM patient
                        WHERE id = $patientId";
        if (!mysqli_query($conn, $insertQuery)) {
            throw new Exception("Insert query failed: " . mysqli_error($conn));
        }

        // Delete the patient record from the original table
        $deleteQuery = "DELETE FROM patient WHERE id = $patientId";
        if (!mysqli_query($conn, $deleteQuery)) {
            throw new Exception("Delete query failed: " . mysqli_error($conn));
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



