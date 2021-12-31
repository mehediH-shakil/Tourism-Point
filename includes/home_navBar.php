<?php
$conn = mysqli_connect('localhost', 'root', '', 'tourism_point');
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>

  <div class="site-navbar site-navbar-target js-sticky-header">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-2">
          <h1 class="my-0 site-logo"><a href="#">Tourismpoint</a></h1>
        </div>
        <div class="col-10">
          <nav class="site-navigation text-right" role="navigation">
            <div class="container">
              <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

              <ul class="site-menu main-menu js-clone-nav d-none d-lg-block">
                <li class="active"><a href="Home.php" class="nav-link">Home</a></li>
                <li><a href="tourPackage.php" class="nav-link">Tour</a></li>
                <li><a href="#about-section" class="nav-link">About</a></li>
                <li><a href="#contact-section" class="nav-link">Contact</a></li>

                <?php
                if (isset($_SESSION['email'])) {
                  $email = $_SESSION['email'];
                  $email_query = "select * from user where email='$email' limit 1";
                  $email_result = mysqli_query($conn, $email_query);
                  $row = mysqli_fetch_array($email_result);
                  $name = $row['name']; ?>

                  <li class="has-children">
                    <a href="#" class="nav-link"><?php echo $name; ?></a>
                    <ul class="dropdown arrow-top">
                      <li><a href="../Travel_and_Tourism_Management_System/profile.php" class="nav-link">Profile</a></li>
                      <li><a href="../Travel_and_Tourism_Management_System/logout.php" class="nav-link">Logout</a></li>
                    </ul>
                  </li><?php
                      } else {
                        ?><li><a href="log-in.php" class="nav-link">Log In</a></li><?php
                      } ?>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>
  </div>

</body>

</html>