<?php
session_start();
include "connection.php";
require "functions.php";

if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];

  $password = "";
  $confirmPassword = "";

  $errors = array(
    'password' => '',
    'confirmPassword' => '',
  );

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    do {
      if (empty($password)) {
        $errors['password'] = "Please enter a password.";
      } elseif (validatePass($password)) {
        $errors['password'] = "Password should be at least 8 characters long and contain uppercase, lowercase, and special characters.";
      }

      if (empty($confirmPassword)) {
        $errors['confirmPassword'] = "Please confirm your password.";
      } elseif ($confirmPassword != $password) {
        $errors['confirmPassword'] = "Passwords do not match!";
        break;
      }



      if(empty($errors['confirmPassword'])&&empty($errors['password'])){
      $sql = "UPDATE users
              SET password = '$password'
              WHERE email = '$email'";

      $result = $connection->query($sql);

      if (!$result) {
        $errorMessage = "Invalid query: " . $connection->error;
      } else {
        header('Location: logout.php');
        exit;
      }

      $password = "";
      $confirmPassword = "";
      }

    } while (false);
  }
} else {
  header("Location: forgetPass.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EeseRent | New Password</title>
  <!-- Custom Style -->
  <link rel="stylesheet" href="css/newPass.css" />
  <!-- FontAwesome Font Style -->
  <link rel="stylesheet" href="font6.4/css/all.css" />
  <!-- Bootstrap CSS -->
  <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" /> -->
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
        <a href="./signUp.php" class="reg-cont">
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
          <div class="sign_in_footer">
            <div class="overlay"></div>
            <div class="content">
              <p>Don't have an account yet?</p>
              <a href="signUp.php">Sign up</a>
            </div>
          </div>
        </div>
      </div>
      <div class="right">
        <img src="images/logo/logo.png" alt="logo" />
        <div class="right_title">
          <h1>Create New Password</h1>
          <p>Please enter your new password</p>
        </div>
        <form method="post">
          <div class="input-container">
            <input type="password" name="password" id="" placeholder="New Password" />
            <i class="icon fas fa-lock"></i>
          </div>
          <p class="text-danger"><?php echo $errors['password']; ?></p>

          <div class="input-container">
            <input type="password" name="confirmPassword" id="" placeholder="Confirm Password" />
          </div>
          <p class="text-danger"><?php echo $errors['confirmPassword']; ?></p>

          <button type="submit">Set Password</button>
        </form>
      </div>
    </div>
  </div>
  <footer>
    <span class="policy">Privacy Policy</span>
    <span class="terms">Terms of use</span>
    <span class="copyright"><i class="fa-regular fa-copyright"></i> 2023 All rights reserved by
      EeseRent</span>
  </footer>

  <!-- Custom Script -->
  <script src="js/scriptNewPassword.js"></script>
</body>

</html>
