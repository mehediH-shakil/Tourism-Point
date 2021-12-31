<?php 
$conn = mysqli_connect('localhost','root','','tourism_point');
if(!$conn){
    die("Connection Error");
} 

if(isset($_POST['yes'])){
    $id =  $_GET['id'];
    date_default_timezone_set("Asia/Dhaka");
    $data = date("Y-m-d");
    $time = date("h:i:s a");
    $status = "Confirmed by admin at $data $time";

    $query = "UPDATE `tour_booking` SET `status`='$status',`action`='Confirmed' WHERE booking_ID = '$id'";
    $result = mysqli_query($conn,$query);
}else if(isset($_POST['no'])){
    $id =  $_GET['id'];
    date_default_timezone_set("Asia/Dhaka");
    $data = date("Y-m-d");
    $time = date("h:i:s a");
    $status = "Canceled by admin at $data $time";

    $query = "UPDATE `tour_booking` SET `status`='$status',`action`='Canceled' WHERE booking_ID = '$id'";
    $result = mysqli_query($conn,$query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <title>Dashboard</title>

    <link href="CSS/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">s
                <a class="sidebar-brand" href="dashboard.php">
                    <span class="align-middle">Admin Panel</span>
                </a>

                <ul class="sidebar-nav">

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="dashboard.php">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="dashboard.php">
                            <i class="align-middle" data-feather="plus-circle"></i> <span class="align-middle">Create Tour Packages</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="dashboard.php">
                            <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Manage Tour Packages</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="manageUser.php">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Manage Users</span>
                        </a>
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="manageBooking.php">
                            <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Manage Booking</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Manage Issues</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="align-middle" data-feather="file"></i> <span class="align-middle">Manage Pages</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <span class="text-dark">Admin</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    <div class="row">
                        <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
                            <div class="card flex-fill">
                                <div class="card-header">

                                    <?php 
                                    $table_query = "select * from tour_booking where 1";
                                    $result = mysqli_query($conn,$table_query);
                                    ?>

                                    <h5 class="card-title mb-0">Booking List</h5>
                                </div>
                                <table class="table table-hover my-0">
                                    
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th class="d-none d-xl-table-cell">Phone No.</th>
                                            <!-- <th class="d-none d-xl-table-cell">Email</th> -->
                                            <th class="d-none d-xl-table-cell">Package</th>
                                            <th class="d-none d-xl-table-cell">From/To</th>
                                            <th class="d-none d-xl-table-cell">Comment</th>
                                            <th class="d-none d-xl-table-cell">Status</th>
                                            <th class="d-none d-xl-table-cell">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $table_ID = 0; 
                                        while($row = mysqli_fetch_array($result)) { 
                                            $table_ID = $table_ID + 1;
                                            $actionDB = $row['action'];
                                            $bookingID = $row['booking_ID'];

                                            ?>
                                            <tr>
                                                <td><?php echo ($table_ID); ?></td>
                                                <td class="d-none d-xl-table-cell"><?php echo($row['booking_name']) ?> </td>
                                                <td class="d-none d-xl-table-cell"><?php echo($row['contact']); ?> </td>
                                                <!-- <td class="d-none d-md-table-cell"><?php echo($row['email']) ?></td> -->
                                                <td class="d-none d-md-table-cell"><?php echo($row['package']) ?></td>
                                                <td class="d-none d-md-table-cell"><?php echo("(".$row['booking_from'].") (".$row['booking_to'].")") ?></td>
                                                <td class="d-none d-md-table-cell"><?php echo($row['comment']) ?></td>
                                                <td class="d-none d-md-table-cell"><?php echo($row['status']) ?></td>

                                                <?php 
                                                $action = $row['action'];
                                                if($action == "Confirmed" || empty($action)){
                                                    ?>
                                                    <form action="manageBooking.php?id=<?php echo $bookingID;?>" method="post" enctype="multipart/form-data">
                                                        <td class="d-none d-md-table-cell">
                                                            <div class="card-body">
                                                                <button class="btn" type="submit" name="yes">confirm</button> /
                                                                <button class="btn" type="submit" name="no">cancel</button>
                                                            </div>
                                                        </td>
                                                    </form>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <td class="d-none d-md-table-cell" style="color: red;"><?php echo($row['action']) ?></td>
                                                    <?php
                                                }
                                                ?>
                                            </tr><?php
                                        }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="../Home.php" target="_blank"><strong>Tourism Point</strong></a> &copy;
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#" target="_blank">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#" target="_blank">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#" target="_blank">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#" target="_blank">Terms</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="js/app.js"></script>

</body>

</html>