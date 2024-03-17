<?php
// Include database connection file
session_start();
error_reporting(0);

include('../includes/config.php');

try{
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Escape user inputs for security
        $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $new_user_status = 1;
    
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        date_default_timezone_set("Asia/Kolkata");
        $current_date_time = date("Y-m-d H:i:s");
    
        // Attempt to insert data into the table
        $sql = "INSERT INTO user_tbl (first_name, last_name, email, phone, password, new_user_status, last_password_change, entrydate) VALUES ('$first_name', '$last_name', '$email', '$phone', '$hashed_password', '$new_user_status', '$current_date_time', '$current_date_time')";
        if(mysqli_query($con, $sql)){
            $_SESSION['msg'] = "Records added successfully.";
            $_SESSION['success'] = 1;
            $_SESSION['status'] = 200;
            
        } else{
            $_SESSION['msg'] = "ERROR: Could not able to execute $sql. " . mysqli_error($con);
            $_SESSION['success'] = 0;
            $_SESSION['success'] = 400;
            
        }
        
    }
}catch(Exception $e){
    $_SESSION['msg'] = "Error : ". $e->getMessage();
    $_SESSION['success'] = 0;
    $_SESSION['success'] = 500;
}

// Close database connection
mysqli_close($con);
header('location:admin_dashboard.php');
exit;


?>
