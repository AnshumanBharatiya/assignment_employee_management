<?php
session_start();
error_reporting(0);

$emp_user = $_SESSION['emp_user'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Password Reset</h2>
                <h6 class="text-left mb-4">Hello <?php echo $emp_user. ' Please Reset Your Password'; ?></h6>
                <?php if(isset($_SESSION['msg_password']) && $_SESSION['msg_password'] != ""){ ?>
                    <div class="alert alert-primary text-center" role="alert" id="msgDiv">
                        <?php echo htmlentities($_SESSION['msg_password']); ?>
                    </div>
                    <?php } ?>

                <form action="reset_password_process.php" method="POST">
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </form>
            </div>
        </div>
    </div>

   <!-- Bootstrap JS (Optional) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
        function hideMessage() {
            var msgDiv = document.getElementById('msgDiv');
            if (msgDiv) {
                msgDiv.style.display = 'none';
            }
        }
        // Hide message after 5 seconds
        setTimeout(hideMessage, 1000);
  </script>
</body>
</html>

<?php 
$_SESSION['msg_password'] = "";

if($_SESSION['new_user_status'] != "1" && $_SESSION['days_difference'] < 30){
    header('Refresh:1;URL=user_dashboard.php');
}
?>