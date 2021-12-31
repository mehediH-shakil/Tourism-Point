<?php 
session_start();
$conn = mysqli_connect('localhost','root','','tourism_point');
if(!$conn){
	die("Connection Error");
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
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="dashboard.php">
					<span class="align-middle">Admin Panel</span>
				</a>

				<ul class="sidebar-nav">

					<li class="sidebar-item active">
						<a class="sidebar-link" href="dashboard.php">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>

					<li class="sidebar-item">
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

					<h1 class="h3 mb-3">Dashboard</h1>

					<div class="row">
						<div class="col-xl-6 col-xxl-5 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">

										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Users</h5>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="user"></i>
														</div>
													</div>
												</div>

												<?php 
												$users_query = "SELECT * from user";
												if ($result = mysqli_query($conn, $users_query)) {
													$users = mysqli_num_rows( $result ); 
												?>
												<h1 class="mt-1 mb-3"><?php echo($users);} ?></h1>

											</div>
										</div>

										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Visitors</h5>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>

												<?php 
												$visitors_query = "SELECT * from visitors";
												if ($visitors_result = mysqli_query($conn, $visitors_query)) {
													$visitors = mysqli_num_rows( $visitors_result ); 
												?>
												<h1 class="mt-1 mb-3"><?php echo($visitors);} ?></h1>

											</div>
										</div>
									</div>

									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Revenue</h5>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="dollar-sign"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">$0.0</h1>
											</div>
										</div>

										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Orders</h5>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="shopping-cart"></i>
														</div>
													</div>
												</div>
												<?php 
												$orders_query = "SELECT * from tour_booking";
												if ($orders_result = mysqli_query($conn, $orders_query)) {
													$orders = mysqli_num_rows( $orders_result ); 
												?>
												<h1 class="mt-1 mb-3"><?php echo($orders);} ?></h1>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-6 col-xxl-7">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0">Chat Option</h5>
								</div>
								<div class="card-body py-3" style="height:240px;">
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
							<div class="card flex-fill">
								<div class="card-header">
									<?php 
                                    $table_query = "select * from tour_booking where action='Confirmed'";
                                    $result = mysqli_query($conn,$table_query);
                                    ?>

									<h5 class="card-title mb-0">Latest Oders</h5>
								</div>
								<table class="table table-hover my-0">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th class="d-none d-xl-table-cell">Email</th>
											<th class="d-none d-xl-table-cell">Oder Date</th>
											<th class="d-none d-xl-table-cell">Confirmed Date</th>
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
                                                <td class="d-none d-md-table-cell"><?php echo($row['email']) ?></td>
                                                <td class="d-none d-md-table-cell"><?php echo($row['booking_from']) ?></td>
                                                <td class="d-none d-md-table-cell"><?php echo($row['status']) ?></td>
                                            </tr>
                                            <?php
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