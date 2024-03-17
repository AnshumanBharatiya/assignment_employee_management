<?php
// Include database connection file
session_start();
error_reporting(0);

include('../includes/config.php');

try{
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Escape user inputs for security
        $start_time = mysqli_real_escape_string($con, $_POST['start_time']);
        $stop_time = mysqli_real_escape_string($con, $_POST['stop_time']);
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $notes = mysqli_real_escape_string($con, $_POST['notes']);
        $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
        

        // echo $start_time;
        // die;
        date_default_timezone_set("Asia/Kolkata");
        $current_date_time = date("Y-m-d H:i:s");
    
        // Attempt to insert data into the table
        $sql = "INSERT INTO user_task_tbl (user_id, notes, description, start_time, stop_time, entry_date, update_date) VALUES ('$user_id', '$notes', '$description', '$start_time', '$stop_time', '$current_date_time', '$current_date_time')";
        if(mysqli_query($con, $sql)){
            $_SESSION['msg1'] = "Records added successfully.";
            $_SESSION['success'] = 1;
            $_SESSION['status'] = 200;
            
        } else{
            $_SESSION['msg1'] = "ERROR: Could not able to execute $sql. " . mysqli_error($con);
            $_SESSION['success'] = 0;
            $_SESSION['success'] = 400;
        }
        
    }
}catch(Exception $e){
    $_SESSION['msg1'] = "Error : ". $e->getMessage();
    $_SESSION['success'] = 0;
    $_SESSION['success'] = 500;
}

// Close database connection
mysqli_close($con);
header('location:user_dashboard.php');
exit;


?>
