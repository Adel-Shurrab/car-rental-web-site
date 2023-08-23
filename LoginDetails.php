<?php
session_start();
include "connection.php";
require "functions.php";

if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
  $id = $_SESSION['id'];

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST["password"];
    $new_password = $_POST["new_password"];

    $errors = array(
      'password' => '',
      'new_password' => ''
    );

    // Validate current password
    if (empty($current_password)) {
      $errors['password'] = "Please enter your current password.";
    } elseif ($current_password != $_SESSION['password']) {
      $errors['password'] = "Wrong password!";
    }

    // Validate new password
    if (empty($new_password)) {
      $errors['new_password'] = "Please enter a new password.";
    } elseif (validatePass($new_password)) {
      $errors['new_password'] = "Password should be at least 8 characters long and contain uppercase, lowercase, and special characters.";
    }

    

    if(empty($errors['new_password'])&&empty($errors['password'])){
      $sql = "UPDATE users
              SET password = '$new_password'
              WHERE id = '$id'";

    $result = $connection->query($sql);
    if (!$result) {
      $errorMessage = "Invalid query: " . $connection->error;
    } else {
      $_SESSION['password'] = $new_password;
      header('Location: profileSettings.php');
      exit;
    }
    }
  }

?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EeseRent | Login Details</title>
    <!--Custome Style -->
    <link rel="stylesheet" href="css/styleHome.css" />
    <link rel="stylesheet" href="css/stylelogindetails.css" />
    <!--FontAwesome Font Style -->
    <link rel="stylesheet" href="font6.4/css/all.css" />
    <!-- bootstrap css -->
    <!-- <link rel="stylesheet" href="bootstrab/css/bootstrap.min.css"> -->
    <!-- bootstrab js -->
    <script type="text/javascript" src="bootstrab/js/bootstrap.min.js"></script>
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
              <?php
              if ($_SESSION['type'] == 1) {
                echo '<a href="metronic_v6.1.0/theme/classic/demo1/index.php">Admin</a>';
              } else {
                echo '<a href="./logout.php">Admin</a>';
              }
              ?>
            </li>


          </ul>
        </nav>
        <div class="register">
          <a href="./logout.php" class="reg-cont">
            Logout
          </a>
          <a href="profileSettings.php" class="profile">
            <!-- Profile picture -->
            <div class="profile_pic"></div>
            <h5><?php echo $_SESSION['f_name'] . " " . $_SESSION['l_name'] ?></h5>
          </a>
        </div>
      </div>
    </header>
    <!-- End Header -->

    <!-- start  section -->
    <section>
      <div class="container">
        <h1 class="f-title">Profile Settings</h1>

        <div class="landing">
          <div class="overlay">
            <div class="con">
              <a href="profileSettings.php" class="bot">
                <i class="fa-solid fa-angle-left" style="color: #466267"></i>
              </a>
              <div class="texxt">
                <h1>Login details</h1>
                <h3>Change password</h3>
              </div>
            </div>
          </div>
        </div>

        <div class="ac-sec">
          <form method="post" class="ac-form">
            <h1 class="change">Change password</h1>

            <div class="row row1">
              <div class="box box1">
                <i class="fa-solid fa-lock" style="color: black"></i>
                <input type="password" name="password" placeholder="Current Password" />
              </div>
            </div>
            <p class="text-danger"><?php echo $errors['password']; ?></p>

            <div class="row row1 roww">
              <div class="box">
                <input type="password" name="new_password" placeholder="New Password" />
              </div>
            </div>
            <p class="text-danger"><?php echo $errors['new_password']; ?></p>

            <div class="button">
              <button type="submit">Update Settings</button>

              <div class="a"><a href="./profileSettings.php">Cancel</a></div>
            </div>
          </form>
        </div>
      </div>
    </section>

    <!-- end  section -->

    <!-- start footer -->
    <footer>
      <span class="policy">Privacy Policy</span>
      <span class="terms">Terms of use</span>
      <span class="copyright"><i class="fa-regular fa-copyright"></i> 2023 All rights reserved</span>
    </footer>
    <!-- end footer -->

    <script src="js/search.js"></script>
  </body>

  </html>
<?php
} else {
  header("Location: profileSettings.php");
  exit;
}
