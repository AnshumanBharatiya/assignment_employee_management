<!-- Admin Login Page -->

<?php
session_start();
error_reporting(0);

include('../includes/config.php');
if(isset($_SESSION['admin_usr']))
{
  header('location:admin_dashboard.php');
}

$error = null;
if(isset($_POST['submit']))
{
	$username=mysqli_real_escape_string($con,$_POST['username']);
	$passwords=mysqli_real_escape_string($con,$_POST['password']);
	$userserach="SELECT * FROM admin_tbl where username='".$username."' AND status = '1'";
	$sresult=mysqli_query($con,$userserach);
	$usr_count=mysqli_num_rows($sresult);
	if($usr_count)
	{
		$row =mysqli_fetch_assoc($sresult);
		$fetch_pass=$row['password'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['admin_usr'] = $row['username'];
		$decode_pass=password_verify($passwords, $fetch_pass);
		if($decode_pass)
		{
            date_default_timezone_set("Asia/Kolkata");
            // Generate current datetime
            $current_datetime = date('Y-m-d H:i:s');
            // SQL query to update last_login field with current datetime
            $sql = "UPDATE admin_tbl SET last_login = '$current_datetime' WHERE username='".$username."'";
            mysqli_query($con,$sql);

            header('location:admin_dashboard.php');
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
    <title>Admin Login Page</title>
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
                <h4 class="text-center m-2">Admin Login</h4>
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