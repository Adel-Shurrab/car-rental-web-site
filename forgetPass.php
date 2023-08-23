<?php
session_start();
include "connection.php";
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

$email = "";
$errors = array(
  'email' => '',
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST["email"];

  do {
    if (empty($email)) {
      $errors['email'] = "Please enter your email";
      break;
    }

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);

      if ($row['email'] === $email) {
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['id'] = $row['id'];

        // Send password reset link
        $mail = new PHPMailer(true);
        try {
          // Server settings
          $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
          $mail->isSMTP(); // Send using SMTP
          $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
          $mail->SMTPAuth   = true; // Enable SMTP authentication
          $mail->Username   = 'eeserent4@gmail.com'; // SMTP username
          $mail->Password   = 'gofcmwbygzoajpyd'; // SMTP password
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
          $mail->Port       = 587; // TCP port to connect to

          // Recipients
          $mail->setFrom('eeserent4@gmail.com', 'EeseRent');
          $mail->addAddress($email, 'User'); // Add a recipient

          // Content
          $mail->isHTML(true); // Set email format to HTML
          $mail->Subject = 'Reset Password';
          $mail->Body    = '<a href="http://localhost/car%20rental/newPass.php">Click here to reset your password</a>';
          $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

          $mail->send();
          header('location: codeVerification.php');
          exit;
        } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
      }
    } else {
      $errors['email'] = "Incorrect email!";
      break;
    }
  } while (false);
}
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EeseRent | Forgot Password</title>
  <!-- Custom Style -->
  <link rel="stylesheet" href="css/styleForgetPass.css" />
  <!-- <link rel="stylesheet" href="css/styleSignIn.css" /> -->
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
          <li><a href="Home.php">About us</a></li>
          <li><a href="Home.php#category">Categories</a></li>
                        <li><a href="Home.php">Support</a></li>
          <li>
            <a href="metronic_v6.1.0/theme/classic/demo1/index.php">Admin</a>
          </li>
        </ul>
      </nav>
      <div class="register">
        <a href="signUp.php" class="reg-cont">
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

      <!-- Right section -->
      <div class="right">
        <img src="images/registration/Ellipse 1.png" alt="logo" />
        <div class="right_title">
          <h1>Lost your password? <br> Enter your details to reset</h1>
          <p>Enter your email address below to reset your password</p>
        </div>
        <form method="post">
          <div class="input-container">
            <input type="email" name="email" placeholder="Email" />
            <i class="icon fas fa-envelope"></i>
          </div>
          <p class="text-danger"><?php echo $errors['email']; ?></p>
          <button type="submit">Reset Password</button>
        </form>
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