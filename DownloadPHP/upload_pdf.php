<?php
include('database.php');

if (isset($_FILES['pdfFile']) && isset($_POST['patientId'])) {
    $patientId = $_POST['patientId'];
    $file = $_FILES['pdfFile'];

    // Check if the file is a PDF
    if ($file['type'] == 'application/pdf') {
        // Define the directory where the file will be saved
        $uploadDir = 'uploads/';
        $filePath = $uploadDir . basename($file['name']);

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            // Update the patient record with the PDF file path
            $query = "UPDATE patient SET pdf_file_path = '$filePath' WHERE id = $patientId";
            if (mysqli_query($conn, $query)) {
                echo "PDF uploaded and saved successfully. File path: $filePath"; // Debugging output
            } else {
                echo "Database update failed: " . mysqli_error($conn);
            }
        } else {
            echo "Failed to move the uploaded file.";
        }
    } else {
        echo "Please upload a valid PDF file.";
    }
} else {
    echo "No file or patient ID received.";
}
?>
