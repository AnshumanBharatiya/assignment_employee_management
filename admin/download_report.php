<?php
if(isset($_POST['csv_content'])) {
    // Set headers for CSV file download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="task_report.csv"');

    // Output CSV content
    echo $_POST['csv_content'];
    exit;
} else {
    // If CSV content is not set, redirect to the previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
?>
