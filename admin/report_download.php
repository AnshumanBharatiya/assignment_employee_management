<?php
session_start();
include('../includes/config.php');
error_reporting(0);
if (!isset($_SESSION['admin_usr'])) {
    header('location:index.php');
}
$admin_usr = $_SESSION['admin_usr'];


// Fetch data from user_tbl and user_task_tbl using join operation
$sql = "SELECT u.first_name, u.last_name, ut.start_time, ut.stop_time, ut.notes, ut.description
        FROM user_tbl u
        JOIN user_task_tbl ut ON u.user_id = ut.user_id";

$result = mysqli_query($con, $sql);

// Create CSV content
$csv_content = "Start Time, Stop Time, Notes, Description\n";
while ($row = mysqli_fetch_assoc($result)) {
    $csv_content .= $row['start_time'] . ', ' . $row['stop_time'] . ', "' . $row['notes'] . '", "' . $row['description'] . "\"\n";
}

// Close the result set
mysqli_free_result($result);

// // Close database connection
// mysqli_close($con);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Task|Report Download</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <section class="container-fluid">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">EMP_MGMT</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="admin_dashboard.php">User Create</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="all_user.php">All User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="report_download.php">Download Report</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>

                    </ul>
                </div>
            </nav>

            <!-- <div class="jumbotron"> -->
            <div class="container">
                <h2>User and Task Data</h2>
                <div class="">
                    <form action="download_report.php" method="post" class="my-2">
                        <input type="hidden" name="csv_content" value="<?php echo htmlentities($csv_content); ?>">
                        <button type="submit" class="btn btn-primary">Download CSV Report</button>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Start Time</th>
                                    <th>Stop Time</th>
                                    <th>Notes</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // include('../includes/config.php');

                                // SQL query to fetch data from both tables using JOIN operation
                                $sql = "SELECT  u.user_id, u.first_name, u.last_name, u.email, ut.start_time, ut.stop_time, ut.notes, ut.description FROM user_tbl u right JOIN user_task_tbl ut ON u.user_id = ut.user_id ORDER BY `ut`.`entry_date` DESC";

                                $result = mysqli_query($con, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['user_id'] . "</td>";
                                        echo "<td>" . $row['first_name'] . "</td>";                            
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['start_time'] . "</td>";
                                        echo "<td>" . $row['stop_time'] . "</td>";
                                        echo "<td>" . $row['notes'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='14' class='text-center'>No data found</td></tr>";
                                }

                                // Close database connection
                                mysqli_close($con);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>

    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../static/js/script.js"></script>
</body>

</html>