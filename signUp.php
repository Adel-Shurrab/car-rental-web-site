  <?php
  include "connection.php";
  require "functions.php";
  ?>


  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EeseRent | Home</title>
    <!-- Custom Style -->
    <link rel="stylesheet" href="css/styleSignUp.css" />
    <!-- FontAwesome Font Style -->
    <link rel="stylesheet" href="font6.4/css/all.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrab/css/bootstrap.min.css" />
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
            <li><a href="metronic_v6.1.0/theme/classic/demo1/index.php">Admin</a></li>
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
    $f_name = "";
    $l_name = "";
    $phone_num = "";
    $password = "";
    $confirmPassword = "";

    $errors = array(
      'email' => '',
      'f_name' => '',
      'l_name' => '',
      'phone_num' => '',
      'password' => '',
      'confirm_password' => '',
    );


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = $_POST["email"];
      $f_name = $_POST["f_name"];
      $l_name = $_POST["l_name"];
      $phone_num = $_POST["phone_num"];
      $password = $_POST["password"];
      $confirm_password = $_POST["confirm_password"];

      // Check if email already exists in the database
      $query = "SELECT * FROM users WHERE email = '$email'";
      $result = mysqli_query($connection, $query);
      $query1 = "SELECT * FROM `banned_users` WHERE email = '$email'";
      $result1 = mysqli_query($connection, $query1);
      do {
        if (empty($email)) {
          $errors['email'] = "You can't leave this empty.";
        } elseif (mysqli_num_rows($result) > 0) {
          // Email already exists
          $errors['email'] = "Email is already registered. Please choose a different email.";
        } elseif (mysqli_num_rows($result1) > 0) {
          $errors['email'] = "Banned user, Plese enter new email";
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
          $errors['email'] = "Please enter a valid email address.";
        }

        if (empty($f_name)) {
          $errors['f_name'] = "Please enter your first name.";
        } elseif (validateUserName($f_name)) {
          $errors['f_name'] = "Must start&end with letters";
        }

        if (empty($l_name)) {
          $errors['l_name'] = "Please enter your last name.";
        } elseif (validateUserName($l_name)) {
          $errors['l_name'] = "Must start&end with letters";
        }

        if (empty($phone_num)) {
          $errors['phone_num'] = "Please enter your phone number.";
        } elseif (validatePhone($phone_num)) {
          $errors['phone_num'] = "Invalid input!";
        }

        if (empty($password)) {
          $errors['password'] = "Please enter a password.";
        } elseif (validatePhone($password)) {
          $errors['password'] = "Password should be at least 8 characters long & Z,z & special character';
        ";
        }

        if (empty($confirm_password)) {
          $errors['confirm_password'] = "Please confirm your password.";
        } elseif ($confirm_password != $password) {
          $errors['confirm_password'] = "Password not match!";
        }

        if (empty($errors['confirm_password']) && empty($errors['password']) && empty($errors['phone_num']) && empty($errors['l_name']) && empty($errors['f_name']) && empty($errors['email'])) {
          // add new user to database
          // $sql = "INSERT INTO users (email, f_name, l_name, phone_num, password) " .
          $sql = "INSERT INTO `users`( `email`, `f_name`, `l_name`, `phone_num`, `password`) VALUES ('$email','$f_name','$l_name','$phone_num','$password')";
          $result = $connection->query($sql);

          if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
          }

          $email = "";
          $f_name = "";
          $l_name = "";
          $phone_num = "";
          $password = "";
          $confirm_password = "";

          header('Location: Home.php');
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
              <a href="signIn.php">Sign in</a>
            </div>
          </div>
        </div>

        <div class="right">
          <img src="images/logo/logo.png" alt="logo" />
          <div class="right_title">
            <h1>Sign up to get started</h1>
            <p>Enter your details to proceed further</p>
          </div>
          <form method="post">
            <!-- Email -->
            <div class="father">
              <div class="input-container">
                <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Email" />
                <i class="icon fas fa-envelope"></i>
              </div>
              <p class="text-danger"><?php echo $errors['email']; ?></p>
            </div>

            <!-- First Name -->
            <div class="name-input-container">
              <div class="father">
                <div class="input-container">
                  <input type="text" name="f_name" value="<?php echo $f_name; ?>" placeholder="First name" />
                  <i class="icon fas fa-user"></i>
                </div>
                <p class="text-danger"><?php echo $errors['f_name']; ?></p>
              </div>
              <!-- Last Name -->
              <div class="father">
                <div class="input-container">
                  <input type="text" name="l_name" value="<?php echo $l_name; ?>" placeholder="Last name" />
                  <i class="icon fas fa-user"></i>
                </div>
                <p class="text-danger"><?php echo $errors['l_name']; ?></p>
              </div>
            </div>

            <!-- Phone Number -->
            <div class="father">
              <div class="input-container">
                <input type="tel" name="phone_num" value="<?php echo $phone_num; ?>" placeholder="Mobile number" />
                <i class="icon fas fa-phone"></i>
              </div>
              <p class="text-danger"><?php echo $errors['phone_num']; ?></p>
            </div>

            <!-- Password -->
            <div class="father">
              <div class="input-container">
                <input type="password" name="password" id="password" value="<?php echo $password; ?>" placeholder="Password" />
                <i class="toggle-password fas fa-eye"></i>
              </div>
              <p class="text-danger"><?php echo $errors['password']; ?></p>
            </div>

            <!-- Confirm Password -->
            <div class="father">
              <div class="input-container">
                <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>" placeholder="Confirm password" />
              </div>
              <p class="text-danger"><?php echo $errors['confirm_password']; ?></p>
            </div>

            <button type="submit">Sign up</button>
          </form>
        </div>
      </div>
    </div>
    <footer>
      <span class="policy">Privacy Policy</span>
      <span class="terms">Terms of use</span>
      <span class="copyright"><i class="fa-regular fa-copyright"></i> 2023 All rights reserved</span>
    </footer>

    <!-- Bootstrap JS -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/show_password.js"></script>
  </body>

  </html>