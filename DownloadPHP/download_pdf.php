<?php
include('database.php');

if (isset($_GET['id'])) {
    $patientId = $_GET['id'];

    // Try to fetch from both patient and checked_patients table
    $query = "SELECT pdf_file_path FROM patient WHERE id = $patientId";
              
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $filePath = $row['pdf_file_path'];

        if (file_exists($filePath)) {
            // File download headers
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
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

