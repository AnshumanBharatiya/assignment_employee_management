<!-- User Login Page -->


<?php
session_start();
error_reporting(0);

include('../includes/config.php');

if(isset($_SESSION['emp_user']))
{
    if($_SESSION['new_user_status'] == "1" || $_SESSION['days_difference'] >= 30){
        header('location:password_change.php');
    }else{
        header('location:user_dashboard.php');
    }
  
}

$error = null;
if(isset($_POST['submit']))
{
	$email=mysqli_real_escape_string($con,$_POST['username']);
	$passwords=mysqli_real_escape_string($con,$_POST['password']);
	$userserach="SELECT * FROM user_tbl WHERE email='".$email."' LIMIT 1";
	$sresult=mysqli_query($con,$userserach);
	$usr_count=mysqli_num_rows($sresult);
	if($usr_count)
	{
		$row =mysqli_fetch_assoc($sresult);
		$_SESSION['new_user_status']=$row['new_user_status'];
		$fetch_pass=$row['password'];
		$_SESSION['emp_user'] = $row['email'];
		$_SESSION['user_id'] = $row['user_id'];
		$decode_pass=password_verify($passwords, $fetch_pass);
		if($decode_pass)
		{
            if($_SESSION['new_user_status'] == "1"){
                header('location:password_change.php');
            }else{


                // Check last password change timestamp
                $last_password_change = strtotime($row['last_password_change']);
                $current_time = time();
                $difference = $current_time - $last_password_change;
                $_SESSION['days_difference'] = floor($difference / (60 * 60 * 24));
                
                // If it's been more than 30 days since last password change, redirect to password change page
                if ($_SESSION['days_difference'] >= 30) {
                    header('location:password_change.php');
                    exit;
                }else{
                    date_default_timezone_set("Asia/Kolkata");
                    // Generate current datetime
                    $current_datetime = date('Y-m-d H:i:s');
                    // SQL query to update last_login field with current datetime
                    $sql = "UPDATE user_tbl SET last_login = '$current_datetime' WHERE user_id='".$_SESSION['user_id']."'";
                    mysqli_query($con,$sql);
        
                    header('location: user_dashboard.php');
                }

            }
           
        }
        else
        {
            $error = "Incorrect Password";
        }
    }
    else
    {
        $error =  "Check your Username, Username not found";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/css/login.css"/>
</head>
<body>
    <div class="container pt-5">
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <?php if($error){ ?>
				<div class="alert alert-danger text-center" role="alert">
					Oops... <?php echo htmlentities($error); ?>
				</div>
				<?php } ?>
                <h4 class="text-center m-2">User Login</h4>
                <!-- Login Form -->
                <form class="mt-3" method="post">
                    <input type="text" id="username" class="fadeIn second" name="username" placeholder="Username">
                    <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
                    <button type="submit" name="submit" class="btn btn-primary btn-block mt-5" >Login Now</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>