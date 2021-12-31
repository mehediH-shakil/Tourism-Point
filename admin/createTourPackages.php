<?php
$conn = mysqli_connect('localhost', 'root', '', 'tourism_point');
if (!$conn) {
    die("Connection Error");
}

$packgeNameError = "";
$packgeTypeError = "";
$packgeLocationError = "";
$packgeFeaturesError = "";
$packgeDetailsError = "";
$packgePriceError = "";
$packgeImageError = "";


if (isset($_GET['cancel'])) {
    $packgeNameError = "";
    $packgeTypeError = "";
    $packgeLocationError = "";
    $packgeFeaturesError = "";
    $packgeDetailsError = "";
    $packgePriceError = "";
    $packgeImageError = "";
} else if (isset($_POST['save'])) {
    $packgeName = $_POST['packgeName'];
    $packgeType = $_POST['packgeType'];
    $packgeLocation = $_POST['packgeLocation'];
    $packgeFeatures = $_POST['packgeFeatures'];
    $packgeDetails = $_POST['packgeDetails'];
    $packgePrice = $_POST['packgePrice'];

    $target_dir = "upload/";
    $filename = $target_dir.basename($_FILES['packgeImage']['name']);
    $temp_file_name = $_FILES['packgeImage']['tmp_name'];
    $image=basename($_FILES['packgeImage']['name']);

    if (empty($packgeName)) {
        $packgeNameError = "Package Name is required.";
    }
    if (empty($packgeType)) {
        $packgeTypeError =  "Package Type is required.";
    }
    if (empty($packgeLocation)) {
        $packgeLocationError =  "Packge Location is required.";
    }
    if (empty($packgeFeatures)) {
        $packgeFeaturesError =  "Packge Features is required.";
    }

    if (empty($packgeDetails)) {
        $packgeDetailsError =  "Packge Details is required.";
    }

    if (empty($packgePrice)) {
        $packgePriceError =  "Packge Price is required.";
    }

    if (empty($image)) {
        $packgeImageError =  "Packge Image is required.";
    }

    if (!empty($packgeName) && !empty($packgeType) && !empty($packgeLocation) && !empty($packgeFeatures) && !empty($packgeDetails) && !empty($packgePrice) && !empty($image)) {

        move_uploaded_file($temp_file_name,$filename);

        $insert_query  = "INSERT INTO `tour_package`(`package_name`, `package_type`, `package_location`, `package_features`, `package_details`, `package_price`, `package_image`) VALUES ('$packgeName','$packgeType','$packgeLocation','$packgeFeatures','$packgeDetails','$packgePrice','$image')";
        $insert_result = mysqli_query($conn, $insert_query);
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <title>TourismPoint</title>

    <link href="CSS/app.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="CSS/style_main.css">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="dashboard.php">
                    <span class="align-middle">Admin Panel</span>
                </a>

                <ul class="sidebar-nav">

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="dashboard.php">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="createTourPackages.php">
                            <i class="align-middle" data-feather="plus-circle"></i> <span class="align-middle">Create Tour Packages</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="manageTourPackages.php">
                            <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Manage Tour Packages</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="manageUser.php">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Manage Users</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
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

                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Create a Tour Package</h5>
                                        </div>

                                        <div class="card-body">
                                            <input type="text" name="packgeName" value="<?php echo isset($packgeName) ? $packgeName : "" ?>" class="form-control margin-top-bottom-10" placeholder="Package Name">
                                            <span class="error"><?php echo isset($packgeNameError) ? $packgeNameError : "" ?></span>

                                            <input type="text" name="packgeType" value="<?php echo isset($packgeType) ? $packgeType : "" ?>" class="form-control margin-top-bottom-10" placeholder="Package Type">
                                            <span class="error"><?php echo isset($packgeTypeError) ? $packgeTypeError : "" ?></span>

                                            <input type="text" name="packgeLocation" value="<?php echo isset($packgeLocation) ? $packgeLocation : "" ?>" class="form-control margin-top-bottom-10" placeholder="Package Location">
                                            <span class="error"><?php echo isset($packgeLocationError) ? $packgeLocationError : "" ?></span>

                                            <input type="text" name="packgeFeatures" value="<?php echo isset($packgeFeatures) ? $packgeFeatures : "" ?>" class="form-control margin-top-bottom-10" placeholder="Package Features">
                                            <span class="error"><?php echo isset($packgeFeaturesError) ? $packgeFeaturesError : "" ?></span>

                                            <textarea name="packgeDetails" value="<?php echo isset($packgeDetails) ? $packgeDetails : "" ?>" class="form-control margin-top-bottom-10" rows="5" placeholder="Package Details"></textarea>
                                            <span class="error"><?php echo isset($packgeDetailsError) ? $packgeDetailsError : "" ?></span>

                                            <input type="text" name="packgePrice" value="<?php echo isset($packgePrice) ? $packgePrice : "" ?>" class="form-control margin-top-bottom-10" placeholder="Package price">
                                            <span class="error"><?php echo isset($packgePriceError) ? $packgePriceError : "" ?></span>

                                            <input type="file" name="packgeImage" value="<?php echo isset($packgeImage) ? $packgeImage : "" ?>" class="form-control margin-top-bottom-10" placeholder="Package Image">
                                            <span class="error"><?php echo isset($packgeImageError) ? $packgeImageError : "" ?></span>

                                        </div>
                                        <div class="card-body text-right">
                                            <button class="btn btn-border" type="submit" name="cancel">Reset</button>
                                            <button class="btn btn-primary" type="submit" name="save">Create</button>
                                        </div>
                                    </form>
                                </div>
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