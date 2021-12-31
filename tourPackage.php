<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'tourism_point');
if (!$conn) {
	die("Connection Error");
}

if (isset($_POST['save'])) {
    $id = $_GET['id'];
    $_SESSION['id'] = $id;
    header("location: details.php");
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
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="text-dark">Home</div>
										</div>
									</a>

									<a href="#" class="list-group-item">
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

						<a class="nav-link d-none d-sm-inline-block" href="#">
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
						<h1 class="h3 d-inline align-middle">Tour Packages</h1>
					</div>

					<div class="row" style="align-items: stretch;">
						<?php
						$tour_package_query = "SELECT * FROM `tour_package`";
						$tour_package_result = mysqli_query($conn,$tour_package_query);
						while($row = mysqli_fetch_array($tour_package_result)) { 
							$packageID = $row['package_ID'];
                            $packgeName = $row['package_name'];
                            $packgeType = $row['package_type'];
                            $packgeLocation = $row['package_location'];
                            $packgeFeatures = $row['package_features'];
                            $packgeDetails = $row['package_details'];
                            $packgePrice = $row['package_price'];
                            $packgeImage = $row['package_image'];
							?>
							<div class="col-12 col-md-3">
								<div class="card">
									<?php $image_path = "admin/upload/".$row['package_image'];?>
									<form action="tourPackage.php?id=<?php echo $packageID; ?>" method="post" enctype="multipart/form-data">
										<img class="card-img-top" src="<?php echo($image_path); ?>" alt="image">
										<div class="card-header">
											<h5 class="card-title mb-0"><?php echo($row['package_name']); ?></h5>
										</div>
										<div class="card-body">
											<p class="card-text text-justify"><?php echo($row['package_details']); ?></p>
											<button class="btn btn-primary" type="submit" name="save">Details</button>
										</div>
									</form>
									
								</div>
							</div>
							<?php 
						} ?>

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