<?php 
session_start();
$email = $_SESSION['email'];
// $name=$gender=$present_address=$permanent_address=$contact=$emergency_contact="";
$flag = 0;

$conn = mysqli_connect('localhost','root','','tourism_point');
if(!$conn){
	die("Connection Error");
}
$email_query="select * from user where email='$email' limit 1";
$email_result = mysqli_query($conn,$email_query);
$row = mysqli_fetch_array($email_result);
$name = $row['name'];
$_SESSION['user_ID'] = $userID = $row['user_ID'];

$profile_query="select * from profile_info where user_ID='$userID' limit 1";
$profile_result = mysqli_query($conn,$profile_query);
$row = mysqli_fetch_array($profile_result);

if (mysqli_num_rows($profile_result)==1) {
	$name = $row['name'];
	$gender = $row['gender'];
	$present_address = $row['present_address'];
	$permanent_address = $row['permanent_address'];
	$contact = $row['contact'];
	$emergency_contact = $row['emergency_contact'];
}

if(isset($_GET['cancel'])){
	$flag = 1;
}else if (isset($_GET['save'])){
	$flag =  1;
	$name = $_GET['fname'];
	$gender = $_GET['fgender'];
	$present_address = $_GET['fpresent_address'];
	$permanent_address = $_GET['fpermanent_address'];
	$contact = $_GET['fcontact'];
	$emergency_contact = $_GET['femergency_contact'];

	if(!empty($name) && !empty($gender) && !empty($present_address) && !empty($permanent_address) && !empty($contact) && !empty($emergency_contact) && mysqli_num_rows($profile_result)!=1){
		$insert_query  = "insert into profile_info(name,gender,present_address,permanent_address,contact,emergency_contact,user_ID) values('$name','$gender','$present_address','$permanent_address','$contact','$emergency_contact','$userID')";
		$insert_result = mysqli_query($conn,$insert_query);
	}else{

		$update_query = "update profile_info set name='$name',gender='$gender',present_address='$present_address',permanent_address='$permanent_address',contact='$contact',emergency_contact='$emergency_contact' where user_ID='$userID'";
		$update_result = mysqli_query($conn,$update_query);
	}
}else if(isset($_POST['no'])){
    $id =  $_GET['id'];
    date_default_timezone_set("Asia/Dhaka");
    $data = date("Y-m-d");
    $time = date("h:i:s a");
    $status = "Canceled by user$userID($name) at $data $time";

    $query = "UPDATE `tour_booking` SET `status`='$status',`action`='Canceled' WHERE booking_ID = '$id'";
    $result = mysqli_query($conn,$query);
}else{
	$flag = 0;
}



?>




<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<link rel="preconnect" href="https://fonts.gstatic.com">

	<title>TourismPoint | <?php echo isset($name) ? $name:"" ?></title>

	<link href="admin/CSS/app.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="CSS/profile.css">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="#">
					<span class="align-middle"><?php echo isset($name) ? $name:"" ?></span>
				</a>

				<ul class="sidebar-nav">

					<li class="sidebar-item active">
						<a class="sidebar-link" href="">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="#settings">
							<i class="align-middle" data-feather="settings"></i> <span class="align-middle">Settings</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="#packages">
							<i class="align-middle" data-feather="truck"></i> <span class="align-middle">Packages</span>
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
								<span class="text-dark">menu</span>
							</a>

							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="Home.php"><i class="align-middle me-1" data-feather=""></i> Home</a>
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

									<h5 class="card-title mb-0" style="padding-bottom: 15px; font-size: 25px;">Profile  <a href="temp.php"><img class="btn" style="height: 30px;" src="icon/edit.png"></a></h5>



									<form>
										<label for="femail" style="padding-right: 15%;">Email </label>
										<input style="outline: none;" type="email" id="femail" name="femail" value="<?php echo $email ?>" readonly><br><hr>

										<?php
										$temp1 = isset($_SESSION['send1']);
										$temp2 = isset($_SESSION['send2']);
										if($flag != 1){?>
											<label for="fname" style="padding-right: 15%;">Name </label>
											<input style="outline: none;" type="name" id="fname" name="fname" value="<?php echo $name ?>"><hr>

											<label for="fgender" style="padding-right: 15%;">Gender </label>
											<input style="outline: none;" type="name" id="fgender" name="fgender" value="<?php echo $gender ?>"><hr>

											<label for="fpresent_address" style="padding-right: 15%;">Present Address </label>
											<input style="outline: none;" type="text" id="fpresent_address" name="fpresent_address" value="<?php echo $present_address ?>"><hr>

											<label for="fpermanent_address" style="padding-right: 15%;">Permanent Address </label>
											<input style="outline: none;" type="text" id="femail" name="fpermanent_address" value="<?php echo $permanent_address ?>"><hr>

											<label for="fcontact" style="padding-right: 15%;">Contact </label>
											<input style="outline: none;" type="number" id="femail" name="fcontact" value="<?php echo $contact ?>"><hr>

											<label for="femergency_contact" style="padding-right: 15%;">Emergency Contact </label>
											<input style="outline: none;" type="number" id="femergency_contact" name="femergency_contact" value="<?php echo $emergency_contact ?>"><hr>

											<div style="padding-top: 10px;" class="text-right">
												<button class="btn btn_get btn_get_two" type="submit" name="cancel">Cancel</button>
												<button class="btn btn_get btn_get_two" type="submit" name="save">Save</button>
											</div><?php
										}else{?>
											<label for="fname" style="padding-right: 15%;">Name </label>
											<input style="outline: none;" type="name" id="fname" name="fname" value="<?php echo $name ?> " readonly><hr>

											<label for="fgender" style="padding-right: 15%;">Gender </label>
											<input style="outline: none;" type="name" id="fgender" name="fgender" value="<?php echo $gender ?>" readonly><hr>

											<label for="fpresent_address" style="padding-right: 15%;">Present Address </label>
											<input style="outline: none;" type="text" id="fpresent_address" name="fpresent_address" value="<?php echo $present_address ?>" readonly><hr>

											<label for="fpermanent_address" style="padding-right: 15%;">Permanent Address </label>
											<input style="outline: none;" type="text" id="femail" name="fpermanent_address" value="<?php echo $permanent_address ?>" readonly><hr>

											<label for="fcontact" style="padding-right: 15%;">Contact </label>
											<input style="outline: none;" type="number" id="femail" name="fcontact" value="<?php echo $contact ?>" readonly><hr>

											<label for="femergency_contact" style="padding-right: 15%;">Emergency Contact </label>
											<input style="outline: none;" type="number" id="femergency_contact" name="femergency_contact" value="<?php echo $emergency_contact ?>" readonly><hr><?php
										}?>
									</form>
								</div>
							</div>
						</div>
					</div>

					<section id="settings">
						<div class="row">
							<div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
								<div class="card flex-fill">
									<div class="card-header">
										<h5 class="card-title mb-0" style="padding-bottom: 15px; font-size: 25px;">Settings</h5>
										<ul>
											<li>Email <span style="padding-left: 14.5%;"><?php echo "$email"; ?></span></li><hr>
											<li>Password <a style="text-decoration: none; padding-left: 12%;" href="new_password.php"><span style="color: skyblue;"><?php echo "Change password ?"; ?></span></a></li><hr>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</section>

					<section id="packages">
						<div class="row">
							<div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
								<div class="card flex-fill">


								<div class="card-header">

                                    <?php 
                                    $table_query = "select * from tour_booking where 1";
                                    $result = mysqli_query($conn,$table_query);
                                    ?>

                                    <h5 class="card-title mb-0">Orders List</h5>
                                </div>
                                <table class="table table-hover my-0">
                                    
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="d-none d-xl-table-cell">Package</th>
                                            <th class="d-none d-xl-table-cell">From</th>
                                            <th class="d-none d-xl-table-cell">To</th>
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
                                                <?php 
                                                $action = $row['action'];

                                                if (!empty($action)) {
                                                	?>
                                                	<td><?php echo ($table_ID); ?></td>
                                                	<td class="d-none d-md-table-cell"><?php echo($row['package']) ?></td>
                                                	<td class="d-none d-md-table-cell"><?php echo($row['booking_from'])?>"</td>
                                                	<td class="d-none d-md-table-cell"><?php echo($row['booking_to'])?>"</td>
                                                	<td class="d-none d-md-table-cell"><?php echo($row['comment']) ?></td>
                                                	<td class="d-none d-md-table-cell"><?php echo($row['status']) ?></td>
                                                	<?php
                                                }


                                                if($action == "Confirmed"){
                                                    ?>
                                                    <form action="profile.php?id=<?php echo $bookingID;?>" method="post" enctype="multipart/form-data">
                                                        <td class="d-none d-md-table-cell">
                                                            <div class="card-body">
                                                                <button class="btn" type="submit" name="no">cancel</button>
                                                            </div>
                                                        </td>
                                                    </form>
                                                    <?php
                                                } else if(!empty($action)) {
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
					</section>


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
	
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var markers = [{
					coords: [31.230391, 121.473701],
					name: "Shanghai"
				},
				{
					coords: [28.704060, 77.102493],
					name: "Delhi"
				},
				{
					coords: [6.524379, 3.379206],
					name: "Lagos"
				},
				{
					coords: [35.689487, 139.691711],
					name: "Tokyo"
				},
				{
					coords: [23.129110, 113.264381],
					name: "Guangzhou"
				},
				{
					coords: [40.7127837, -74.0059413],
					name: "New York"
				},
				{
					coords: [34.052235, -118.243683],
					name: "Los Angeles"
				},
				{
					coords: [41.878113, -87.629799],
					name: "Chicago"
				},
				{
					coords: [51.507351, -0.127758],
					name: "London"
				},
				{
					coords: [40.416775, -3.703790],
					name: "Madrid "
				}
			];
			var map = new jsVectorMap({
				map: "world",
				selector: "#world_map",
				zoomButtons: true,
				markers: markers,
				markerStyle: {
					initial: {
						r: 9,
						strokeWidth: 7,
						stokeOpacity: .4,
						fill: window.theme.primary
					},
					hover: {
						fill: window.theme.primary,
						stroke: window.theme.primary
					}
				},
				zoomOnScroll: false
			});
			window.addEventListener("resize", () => {
				map.updateSize();
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
			var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
			document.getElementById("datetimepicker-dashboard").flatpickr({
				inline: true,
				prevArrow: "<span title=\"Previous month\">&laquo;</span>",
				nextArrow: "<span title=\"Next month\">&raquo;</span>",
				defaultDate: defaultDate
			});
		});
	</script>

</body>

</html>