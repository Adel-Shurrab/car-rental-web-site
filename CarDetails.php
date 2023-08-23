<?php
session_start();
include "connection.php";

if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
  $id = $_SESSION['id'];

  $sql2 = "SELECT profile_picture FROM users WHERE id = $id";
  $result2 = mysqli_query($connection, $sql2);
  $row2 = mysqli_fetch_assoc($result2);

  $picture = $row2['profile_picture'];

  $car_id = $_GET['id'];
  $sql = "SELECT * FROM `cars` WHERE car_id = $car_id";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);

  $model = $row["model"];
  $brand = $row["brand"];
  $quantity = $row["quantity"];
  $price = $row["price_per_hour"];
  $seats = $row["seats_num"];
  $gear = $row["gear"];
  $img1 = $row["img1"];
  $img2 = $row["img2"];
  $img3 = $row["img3"];
  $img4 = $row["img4"];


  $DR = '';
  $time = '';
  $PL = '';
  $DL = '';

  $errors = array(
    'DR' => '',
    'time' => '',
    'PL' => '',
    'DL' => ''
  );

  $now = date("m/d/Y", time());
  $word1 = explode("/", $now);

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Reserve'])) {
    $DR = $_POST['DR'];
    $time = $_POST['time'];
    $PL = $_POST['PL'];
    $DL = $_POST['DL'];
    $word2 = explode("/", $DR);
    $x0 = (int)$word2[0];
    $y0 = (int)$word1[0];
    $r0 = $x0 - $y0;
    $x1 = (int)$word2[1];
    $y1 = (int)$word1[1];
    $r1 = $x1 - $y1;
    $x2 = (int)$word2[2];
    $y2 = (int)$word1[2];
    $r2 = $x2 - $y2;
    if (empty($DR)) {
      $errors['DR'] = "data is empty";
    } elseif ((($r2 <= 0) && (($r0 == 0 && $r1 <= 0) || ($r0 < 0)))) {
      $errors['DR'] = "the date in the past";
    }
    if (empty($time)) {
      $errors['time'] = "time is empty";
    }
    if (empty($PL)) {
      $errors['PL'] = "pick-up location is empty";
    }
    if (empty($DL)) {
      $errors['DL'] = "Drop-off location is empty";
    }

    if (empty($errors['DR']) && empty($errors['time']) && empty($errors['PL']) && empty($errors['DL'])) {

      $_SESSION['DR'] = $DR;
      $_SESSION['time'] = $time;
      $_SESSION['PL'] = $PL;
      $_SESSION['DL'] = $DL;
      $_SESSION['car_id'] = $car_id;
      $_SESSION['price'] =  $price;


      header('Location: pay.php');
    }
  }
?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Car Details</title>
    <!--Custome Style -->
    <link rel="stylesheet" href="css/styleHome.css" />
    <link rel="stylesheet" href="css/styleCarDetails.css" />
    <!--FontAwesome Font Style -->
    <link rel="stylesheet" href="font6.4/css/all.css" />
    <!-- bootstrap css -->
    <!-- <link rel="stylesheet" href="bootstrab/css/bootstrap.min.css"> -->
    <!-- bootstrab js -->
    <!-- Include jQuery library -->

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
            <div class="profile_pic">
              <?php if (!empty($picture)) : ?>
                <img src="images/profile/<?= $picture ?>" alt="Profile Picture" class="nav-profile-pic">
              <?php elseif (empty($picture)) : ?>
                <img src="images/profile//profile.png" alt="Default Profile Picture" width="30" height="30" class="nav-profile-pic">
              <?php endif; ?>

            </div>
            <h5><?php echo $_SESSION['f_name'] . " " . $_SESSION['l_name'] ?></h5>
          </a>
        </div>
      </div>
    </header>
    <!-- End Header -->
    <!-- start car details box -->
    <div class="container">
      <div class="box1">
        <div class="box2">
          <div class="inbox1">
            <h5><?php echo $brand ?></h5>
            <h5><?php echo $model ?></h5>
            <div class="inner">
              <div class="inner2">
                <i class="fa-solid fa-user icon"></i>
                <p><?php echo $seats ?> passengers</p>
              </div>
              <div class="inner2 inner3">
                <i class="fa-solid fa-car-side"></i>
                <p>4 doors</p>
              </div>
            </div>
            <div class="inner">
              <div class="inner2">
                <i class="fa-regular fa-snowflake"></i>
                <p>Air Conditioning</p>
              </div>
              <div class="inner2">
                <i class="fa-solid fa-gauge"></i>
                <p><?php echo $gear ?></p>
              </div>
            </div>
            <div class="inner">
              <div class="inner2">
                <i class="fa-solid fa-gas-pump"></i>
                <p>Fuel: full to full</p>
              </div>
            </div>
          </div>
          <div class="inbox2">
            <h5><?php echo $price ?>$</h5>
            <p>per hour</p>
          </div>
        </div>

        <div class="box3">
          <div class="inbox1">
            <div class="img1 img-zoom-container">
              <img src="metronic_v6.1.0/theme/classic/demo1/uploads/<?php echo $img1 ?>" class="img-zoom" onclick="showBigImage(this.src)" />
            </div>
          </div>

          <!-- Inside .inbox2 -->
          <div class="inbox2 img-zoom-container">
            <img src="metronic_v6.1.0/theme/classic/demo1/uploads/<?php echo $img2 ?>" class="img-zoom" onclick="showBigImage(this.src)" />
            <img src="metronic_v6.1.0/theme/classic/demo1/uploads/<?php echo $img3 ?>" class="img-zoom" onclick="showBigImage(this.src)" />
            <img src="metronic_v6.1.0/theme/classic/demo1/uploads/<?php echo $img4 ?>" class="img-zoom" onclick="showBigImage(this.src)" />
          </div>
        </div>
      </div>
      <div class="box4">
        <h5>Car rental requirments</h5>
        <form action="" method="post">
          <div class="inner">
            <div class="inner2">
              <input type="text" id="datepicker" placeholder="Date of rent" name="DR" />
              <i class="fa-solid fa-calendar-days"></i>
              <p Style="color: red;"><?php echo $errors['DR']; ?></p>
            </div>
            <div class="inner2">
              <input type="time" id="timepicker" placeholder="Select a time" value="4" class="time" name="time">
              <p Style="color : red;"><?php echo $errors['time']; ?></p>
            </div>
          </div>
          <div class="inner">
            <div class="inner2">
              <input type="text" placeholder="pick-up location" name="PL" value="" />
              <i class="fa-solid fa-car-on"></i>
              <p Style="color : red;"><?php echo $errors['PL']; ?></p>
            </div>
            <div class="inner2">
              <input type="text" placeholder="Drop-off location" name="DL" />
              <i class="fa-solid fa-car-tunnel"></i>
              <p Style="color : red;"><?php echo $errors['DL']; ?></p>
            </div>
          </div>
          <div class="inner innerz">
            <button type="submit" name="Reserve">Reserve</button>
          </div>
        </form>
      </div>
      <!-- end car details box -->
      <?php

      $DR = '';
      $time = '';
      $PL = '';
      $DL = '';

      $errors = array(
        'DR' => '',
        'time' => '',
        'PL' => '',
        'DL' => ''
      );

      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Reserve'])) {
        $DR = $_POST['DR'];
        $time = $_POST['time'];
        $PL = $_POST['PL'];
        '';
        $DL = $_POST['DL'];


        if (empty($DR)) {
          $errors['DR'] = "data is empty";
        }
        if (empty($time)) {
          $errors['time'] = "time is empty";
        }
        if (empty($PL)) {
          $errors['PL'] = "pick-up location is empty";
        }
        if (empty($DL)) {
          $errors['DL'] = "Drop-off location is empty";
        }

        if (empty($errors['DR']) && empty($errors['time']) && empty($errors['PL']) && empty($errors['DL'])) {

          $_SESSION['DR'] = $DR;
          $_SESSION['time'] = $time;
          $_SESSION['PL'] = $PL;
          $_SESSION['DL'] = $DL;
          $_SESSION['car_id'] = $car_id;
          $_SESSION['price'] =  $price;
          $_SESSION['quantity'] =  $quantity;


          header('Location: pay.php');
        }
      }

      ?>


      <footer>
        <span class="policy">Privacy Policy</span>
        <span class="terms">Terms of use</span>
        <span class="copyright"><i class="fa-regular fa-copyright"></i> 2023 All rights reserved</span>
      </footer>



      <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img id="zoomedImg" class="modal-content" />
      </div>


      <script src="js/jQuery.js"></script>
      <script src="js/jquery-ui.js"></script>
      <link rel="stylesheet" href="css/jquery-ui.css" />
      <script src="/path/to/cdn/dayjs.min.js"></script>
      <script type="text/javascript" src="bootstrab/js/bootstrap.min.js"></script>
      <script src="js/datePicker.js"></script>
      <script src="js/zoom.js"></script>
  </body>

  </html>
<?php
} else {
  header("Location: signIn.php");
  exit;
}
?>