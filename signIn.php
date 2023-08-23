<?php
session_start();
include "connection.php";
require "functions.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EeseRent | Sign in</title>
  <!-- Custom Style -->
  <link rel="stylesheet" href="css/styleSignIn.css" />
  <!-- FontAwesome Font Style -->
  <link rel="stylesheet" href="font6.4/css/all.css" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
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
          <li><a href="#about_us">About us</a></li>
          <li><a href="Home.php#category">Categories</a></li>
          <li><a href="Home.php">Support</a></li>
          <li>
            <a href="">Admin</a>
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

  <?php
  $email = "";
  $password = "";
  $errors = array(
    'email' => '',
    'password' => '',
  );

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query1 = "SELECT * FROM `banned_users` WHERE email = '$email'";
    $result1 = mysqli_query($connection, $query1);

    do {
      if (empty($email)) {
        $errors['email'] = "Plese enter your email";
      } else if (mysqli_num_rows($result1) > 0) {
        $errors['email'] = "Banned user, Plese enter another email";
      }

      if (empty($password)) {
        $errors['password'] = "Please enter your password.";
      }

      if (empty($errors['password']) && empty($errors['email'])) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) === 1) {
          $row = mysqli_fetch_assoc($result);

          if ($row['type'] == 1 && $row['email'] === $email && $row['password'] === $password) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['f_name'] = $row['f_name'];
            $_SESSION['l_name'] = $row['l_name'];
            $_SESSION['phone_num'] = $row['phone_num'];
            $_SESSION['type'] = $row['type'];
            $_SESSION['id'] = $row['id'];

            // cookies
            $remember = isset($_POST["remember"]) ? true : false;

            if ($remember) {
              $expiry = time() + 10 * 24 * 60 * 60; // Cookie expires in 10 days
              $remember = $_POST["remember"];
              setcookie("email", $email, $expiry, "/");
              setcookie("password", $password, $expiry, "/");
            }
            // cookies

            header('Location: metronic_v6.1.0/theme/classic/demo1/index.php');
            exit;
          } else if ($row['email'] === $email && $row['password'] === $password) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['f_name'] = $row['f_name'];
            $_SESSION['l_name'] = $row['l_name'];
            $_SESSION['phone_num'] = $row['phone_num'];
            $_SESSION['type'] = $row['type'];

            // cookies
            $remember = isset($_POST["remember"]) ? true : false;

            if ($remember) {
              $expiry = time() + 10 * 24 * 60 * 60; // Cookie expires in 10 days
              $remember = $_POST["remember"];
              setcookie("email", $email, $expiry, "/");
              setcookie("password", $password, $expiry, "/");
            }
            // cookies

            header('Location: Home.php');
            exit;
          } else {
            $errors['password'] = "Incorrect password.";
          }
        } else {
          $errors['email'] = "Incorrect email!";
          break;
        }
      }
    } while (false);
  }

  ?>

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
        <img src="images/logo/logo.png" alt="logo" />
        <div class="right_title">
          <h1>Sign in to your account</h1>
          <p>Enter your credentials to access your account</p>
        </div>
        <form method="post">
          <!-- Email -->
          <div class="father">
            <div class="input-container">
              <input type="email" name="email" value="<?php if (isset($_COOKIE['email'])) {
                                                        echo $_COOKIE['email'];
                                                      } ?>" placeholder="Email" />
              <i class="icon fas fa-envelope"></i>
            </div>
            <p class="text-danger"><?php echo $errors['email']; ?></p>
          </div>
          <!-- Password -->
          <div class="father">
            <div class="input-container">
              <input type="password" name="password" id="password" value="<?php if (isset($_COOKIE['password'])) {
                                                                            echo $_COOKIE['password'];
                                                                          } ?>" placeholder="Password" />
              <i class="toggle-password fas fa-eye"></i>
            </div>
            <p class="text-danger"><?php echo $errors['password']; ?></p>
          </div>
          <div class="actions">
            <div class="remember-me">
              <input type="checkbox" name="remember" id="remember_me" />
              <label for="remember_me">Remember me</label>
            </div>
            <a href="./forgetPass.php" class="forgot">Forgot password?</a>
          </div>
          <button type="submit">Login</button>
        </form>
      </div>
    </div>
  </div>
  <footer>
    <span class="policy">Privacy Policy</span>
    <span class="terms">Terms of use</span>
    <span class="copyright">
      <i class="fa-regular fa-copyright"></i> 2023 All rights reserved
    </span>
  </footer>

  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  <script src="js/show_password.js"></script>
</body>

</html>