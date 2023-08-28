<?php 
ob_start();
session_start();

include('dbconn.php');
if(isset($_SESSION['user_token']) && !empty($_SESSION['user_token'])) {
    $username = $_SESSION['username'];
    $token = $_SESSION['user_token'];
    $result = mysqli_query($conn, "select username,mobile,city,pick from users where token = '$token'");
    $row = mysqli_fetch_assoc($result);
}

    ?>
<!DOCTYPE php>
<php lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Eterna Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Eterna
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/eterna-free-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="">

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">khillareswapnil973@gmail.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+91 9422922478</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1><a href="index.php">Blogs</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>
      <?php
if(isset($_SESSION["username"])) {
    ?>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="active" href="index.php">Home</a></li>
          <li><a href="blog.php">Blog</a></li>
          <li><a href="Portfolio/index.php">Portfolio</a></li>
          
          <li class="dropdown"><a href="#"><span><?php echo $_SESSION["username"];?></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
            <?php
              if(isset($_SESSION['admin_user_token'])) {
                  ?>
                  <li><a href="admin/admin_index.php"><?php echo $row['username']?></a></li>
              <?php
              }
    ?>
              <li><a href="home.php">Dashboard</a></li>
              <li><a href="edit.php">Edit Profile</a></li>
              <li><a href="upload.php">Upload Avatar</a></li>
              <li><a href="change_pass.php">Change Password</a></li>
              <li><a href="Logout.php">Logout</a></li>
            </ul>
          </li>
         <?php
}
    ?>
          
         
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
