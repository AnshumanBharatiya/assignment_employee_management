<?php
session_start();

// Check if the admin_usr is logged in
if(isset($_SESSION['emp_user'])) {

    // Destroy the session
    unset($_SESSION['emp_user']);

    // Redirect the user to the login page or any other desired page after logout
    header("Location: index.php");
    exit;
} else {
    // If user is not logged in, redirect them to the login page
    header("Location: index.php");
    exit;
}
?>
