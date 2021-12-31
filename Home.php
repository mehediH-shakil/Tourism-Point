<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'tourism_point');
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Quicksand:400,600,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="includes/fonts/icomoon/style.css">
  <link rel="stylesheet" href="includes/CSS/owl.carousel.min.css">
  <link rel="stylesheet" href="includes/CSS/bootstrap.min.css">
  <link rel="stylesheet" href="includes/CSS/home_navBar.css">
  <link href="admin/CSS/app.css" rel="stylesheet">
  <link href="CSS/tourPackage.css" rel="stylesheet">

  <title>Tourism Point</title>
</head>

<body>
  <?php include('includes/visitor_ip.php'); ?>
  <?php include('includes/home_navBar.php'); ?>

  <div class="hero" style="background-image: url('includes/images/Rajshahi_Railway_Station_Building.jpg');"></div>


  <main class="content">
    <div class="container-fluid p-0">

          <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Latest Packages</h1>
          </div>

          <div class="row" style="align-items: stretch;">
            <?php
            $tour_package_query = "SELECT * FROM `tour_package` ORDER BY `package_ID` DESC";
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

  <script src="includes/js/jquery-3.3.1.min.js"></script>
  <script src="includes/js/popper.min.js"></script>
  <script src="includes/js/bootstrap.min.js"></script>
  <script src="includes/js/jquery.sticky.js"></script>
  <script src="includes/js/main.js"></script>
</body>

</html>