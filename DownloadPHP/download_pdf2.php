<?php
include('database.php');

if (isset($_GET['id'])) {
    $patientId = $_GET['id'];

    // Fetch the pdf_file_path from prev_patient table
    $query = "SELECT pdf_file_path FROM archived_patient WHERE id = $patientId LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $filePath = $row['pdf_file_path'];

        if (file_exists($filePath)) {
            // Set headers for file download
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            
            // Clear output buffer and read the file
            ob_clean();
            flush();
            readfile($filePath);
            exit;
        } else {
            echo "File not found.";
        }
    } else {
        echo "No report found for the given patient ID.";
    }
} else {
    echo "No patient ID provided.";
}
?>