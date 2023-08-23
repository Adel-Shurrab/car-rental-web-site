<?php
session_start();
include "connection.php";
require "functions.php";
$id = $_SESSION['id'];
echo $id;

if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EeseRent | Code Verification</title>
    <!-- Custom Style -->
    <link rel="stylesheet" href="css/codeVerification.css" />
    <!-- FontAwesome Font Style -->
    <link rel="stylesheet" href="font6.4/css/all.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <!-- Bootstrap JS -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  </head>

  <body>
    <!-- Start Header -->
    <header>
      <div class="container">
        <a href="Home.php" class="logo">
          <img src="images/logo/logo.png" alt="logo" width="60" height="60" />
        </a>
        <nav>
          <ul>
          <li><a href="Home.php#about_us">About us</a></li>
          <li><a href="Home.php#category">Categories</a></li>
                        <li><a href="Home.php">Support</a></li>
            <li>
              <a href="metronic_v6.1.0/theme/classic/demo1/index.php">Admin</a>
            </li>
          </ul>
        </nav>
        <div class="register">
          <a href="#" class="reg-cont">
            <div class="square">
              <i class="fas fa-user"></i>
            </div>
            <h5>Sign Up</h5>
          </a>
        </div>
      </div>
    </header>
    <!-- End Header -->

    <div class="container">
      <div class="all_content">
        <!-- Left section -->
        <div class="left">
          <div class="overlay"></div>
          <div class="left_content">
            <h1 class="left_title">
              Ride. <br />
              Rent. <br />
              Repeat. <br /><br />
              Your car rental <br />
              Destination
            </h1>
          </div>
          <div class="sign_in_footer">
            <div class="overlay"></div>
            <div class="content">
              <p>Already have an account?</p>
              <a href="signUp.php">Sign up</a>
            </div>
          </div>
        </div>
        <div class="right">
          <img src="images/registration/Untitled-1.png" alt="logo" />
          <div class="right_title">
            <h1>link to rest password</h1>
            <p>cheack your email , link sent to your <a href="https://mail.google.com/">email</a></p>
          </div>
        </div>
      </div>
    </div>
    <footer>
      <span class="policy">Privacy Policy</span>
      <span class="terms">Terms of use</span>
      <span class="copyright"><i class="fa-regular fa-copyright"></i> 2023 All rights reserved</span>
    </footer>
  </body>

  </html>
<?php
} 
else {
  header("Location: forgetPass.php");
  exit;
}
