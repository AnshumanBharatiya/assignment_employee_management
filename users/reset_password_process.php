<?php
session_start();
error_reporting(0);

// Include database connection file
include('../includes/config.php');

// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $current_password = mysqli_real_escape_string($con, $_POST['current_password']);
    $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);
    // $user_id = mysqli_real_escape_string($con, $_POST['user_id']);

    // Retrieve user's current password from database
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT password FROM user_tbl WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $stored_password = $row['password'];

    date_default_timezone_set("Asia/Kolkata");
    $current_date_time = date("Y-m-d H:i:s");

    // Verify if current password matches the stored password
    if(password_verify($current_password, $stored_password)) {
        // Check if new password matches the confirm password
        if($new_password === $confirm_password) {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            // Update user's password in the database
            $update_sql = "UPDATE user_tbl SET password = '$hashed_password', new_user_status = '0', last_password_change = '$current_date_time', last_login = '$current_date_time'  WHERE user_id = '$user_id'";
            if(mysqli_query($con, $update_sql)) {
                $_SESSION['new_user_status'] = 0;
                $_SESSION['days_difference'] = 0;
                $_SESSION['msg_password'] = "Password reset successfully.";
                $_SESSION['success'] = 1;
            } else {
                $_SESSION['new_user_status'] = 1;
                $_SESSION['days_difference'] = 100;
                $_SESSION['msg_password'] = "Error resetting password: " . mysqli_error($con);
                $_SESSION['success'] = 0;
            }
        } else {
            $_SESSION['new_user_status'] = 1;
            $_SESSION['days_difference'] = 100;
            $_SESSION['msg_password'] = "New password and confirm password do not match.";
            $_SESSION['success'] = 0;
        }
    } else {
        $_SESSION['new_user_status'] = 1;
        $_SESSION['days_difference'] = 100;
        $_SESSION['msg_password'] = "Current password is incorrect.";
        $_SESSION['success'] = 0;
    }
}

// Close database connection
mysqli_close($con);

// Redirect back to reset password page
header('Location: password_change.php');
exit;
?>