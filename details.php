<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'tourism_point');
if (!$conn) {
	die("Connection Error");
}
$Error = "";

if (isset($_POST['save'])) {
    $id = $_SESSION['id'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $comment = $_POST['comment'];

    (int)$fromM = "$from[5]"."$from[6]";
    (int)$toM = "$to[5]"."$to[6]";

    (int)$fromDate = "$from[8]"."$from[9]";
    (int)$toDate = "$to[8]"."$to[9]";

    $date = abs((($fromM*30) + $fromDate)-(($toM*30) + $toDate));

    $userID = $_SESSION['user_ID'];
    $email = $_SESSION['email'];

    $profile_query="select * from profile_info where user_ID='$userID' limit 1";
	$profile_result = mysqli_query($conn,$profile_query);
	$row = mysqli_fetch_array($profile_result);

	if (mysqli_num_rows($profile_result)==1) {
		$name = $row['name'];
		$contact = $row['contact'];
	}

	$package_query = "SELECT * FROM `tour_package` where package_ID = '$id'";
	$package_result = mysqli_query($conn,$package_query);
	$row = mysqli_fetch_array($package_result); 
	$packageID = $row['package_ID'];
	$packgeName = $row['package_name'];


	date_default_timezone_set("Asia/Dhaka");
	$data = date("Y-m-d");
	$time = date("h:i:s a");
	$status = "Created by user$userID($name) at $data $time";

  	$q="select * from tour_booking where booking_from='$from' and package_ID='$packageID'";
    $r=mysqli_query($conn,$q);

    if(mysqli_num_rows($r)>0){
    	$Error = "This Package Already Book";
    }else{
    	$query = "INSERT INTO `tour_booking`(`booking_name`, `contact`, `email`, `package`, `booking_from`, `booking_to`, `comment`, `status`, `user_ID`, `package_ID`) VALUES ('$name','$contact','$email','$packgeName','$from','$to','$comment','$status','$userID','$packageID')";
    	$result = mysqli_query($conn,$query);
    }
    
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<link rel="preconnect" href="https://fonts.gstatic.com">

	<title>Tourism Point</title>

	<link href="admin/CSS/app.css" rel="stylesheet">
	<link href="CSS/tourPackage.css" rel="stylesheet">
</head>

<body>
	<div class="wrapper">

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<h1 class="logo"><a href="../Travel_and_Tourism_Management_System/Home.php" class="text-muted">Tourismpoint</a></h1>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">

						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="menu"></i>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
									<?php
									if (isset($_SESSION['email'])) {
										$email = $_SESSION['email'];
										$email_query = "select * from user where email='$email' limit 1";
										$email_result = mysqli_query($conn, $email_query);
										$row = mysqli_fetch_array($email_result);
										$name = $row['name'];
										echo $name; //print a profile name for mobile menu
									} else {
										echo "Log In";
									} ?>
								</div>
								<div class="list-group">
									<a href="Home.php" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="text-dark">Home</div>
										</div>
									</a>

									<a href="tourPackage.php" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="text-dark">Tour</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="text-dark">About</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="text-dark">Contact</div>
										</div>
									</a>

									<?php
									if (isset($_SESSION['email'])) {
									?>
										<div class="row g-0 align-items-center">
											<a href="logout.php" class="list-group-item">
												<div class="row g-0 align-items-center">
													<div class="text-dark">Log out</div>
												</div>
											</a>
										</div>
										</a><?php
										} else {
											echo "Tourism Point";
										} ?>
								</div>
							</div>
						</li>

						<a class="nav-link d-none d-sm-inline-block" href="Home.php">
							<span class="text-dark">Home</span>
						</a>

						<a class="nav-link d-none d-sm-inline-block" href="tourPackage.php">
							<span class="text-dark">Tour</span>
						</a>

						<a class="nav-link d-none d-sm-inline-block" href="#">
							<span class="text-dark">About</span>
						</a>

						<a class="nav-link d-none d-sm-inline-block" href="#">
							<span class="text-dark">Contact</span>
						</a>

						<?php
						if (isset($_SESSION['email'])) {
							$email = $_SESSION['email'];
							$email_query = "select * from user where email='$email' limit 1";
							$email_result = mysqli_query($conn, $email_query);
							$row = mysqli_fetch_array($email_result);
							$name = $row['name']; ?>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								<span class="text-dark"><?php echo $name; ?></span>
							</a><?php
							} else {
								?>
							<a class="nav-link d-none d-sm-inline-block" href="log-in.php">
								<span class="text-dark">Log In</span>
							</a><?php
							} ?>

						<div class="dropdown-menu dropdown-menu-end">
							<a class="dropdown-item" href="../Travel_and_Tourism_Management_System/profile.php"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
							<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="../Travel_and_Tourism_Management_System/logout.php">Log out</a>
						</div>
						</li>
					</ul>
				</div>
			</nav>


			<main class="content">
				<div class="container-fluid p-0">

					<div class="mb-3">
						<h1 class="h3 d-inline align-middle"></h1>
					</div>

					<div class="row">
						<?php $id = $_SESSION['id'];

						$tour_package_query = "SELECT * FROM `tour_package` where package_ID = '$id'";
						$tour_package_result = mysqli_query($conn,$tour_package_query);
						$row = mysqli_fetch_array($tour_package_result); 
						$packageID = $row['package_ID'];
                        $packgeName = $row['package_name'];
                        $packgeType = $row['package_type'];
                        $packgeLocation = $row['package_location'];
                        $packgeFeatures = $row['package_features'];
                        $packgeDetails = $row['package_details'];
                        $packgePrice = $row['package_price'];
                        $packgeImage = $row['package_image'];
						?>

						<span style="text-align: center; color: red; margin: 5px; font-size: 16px; padding-bottom: 15px;"><?php echo isset($Error) ? $Error:"" ?></span>



							<div class="col-6 col-md-6">
								<div class="card">
									<?php $image_path = "admin/upload/".$row['package_image'];?>
									<form action="tourPackage.php?id=<?php echo $packageID; ?>" method="post" enctype="multipart/form-data">
										<img style="width: 100%; height: 30%;" src="<?php echo($image_path); ?>" alt="image">
										<div class="card-body">
											<p class="card-text text-justify"><?php echo($row['package_details']); ?></p>
										</div>
									</form>
									
								</div>
							</div>

							<div class="col-6 col-md-6">

								<div class="card">
									<form action="details.php?id=<?php echo $packageID; ?>" method="post" enctype="multipart/form-data">
										<div class="card-header">
											<h5 class="card-title mb-0"><b><?php echo($row['package_name']); ?></b></h5>
										</div>
										<div class="card-body">

											<p class="card-text mb-1"><b>Package Type: </b><?php echo($row['package_type']); ?></p>
											<p class="card-text mb-1"><b>Package Location: </b><?php echo($row['package_location']); ?></p>
											<p class="card-text mb-6"><b>Package Features: </b><?php echo($row['package_features']); ?></p>


											<p class="card-text mb-1"><b>From</b></p>
											<input type="date" name="from" class="form-control margin-top-bottom-10">
											<p class="card-text mb-1"><b>To</b></p>
											<input type="date" name="to" class="form-control margin-top-bottom-10 mb-3">


											<p style="font-size: 18px;" class="card-text mb-4"><b>Price: </b><?php echo($row['package_price']); ?> BDT</p>

											<p class="card-text mb-1">Comment</p>
											<textarea name="comment" class="form-control margin-top-bottom-10 mb-3" rows="4"></textarea>

											<button class="btn btn-primary mb-1" type="submit" name="save">Book</button>
										</div>
									</form>
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

	<script src="admin/js/app.js"></script>

</body>

</html>