<?php 
    session_start();
    include "connection.php";
    

    $card_num = '';
    $card_name = '';
    $ex_date = '';
    $cvv = '';
    $p_code = '';
    $rental_d = '';
    $final_cost = '';
    $price = $_SESSION['price'];

    $errors = array(
      'card_num' => '',
      'card_name' => '',
      'ex_date' => '',
      'cvv' => '',
      'p_code' => '',
      'rental_d' => '',
    );

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pay'])){
      $card_num = $_POST['card_num'];
      $card_name = $_POST['card_name'];
      $ex_date = $_POST['ex_date'];
      $cvv = $_POST['cvv'];
      $p_code = $_POST['p_code'];
      $rental_d = $_POST['rental_d'];
      $final_cost = $_POST['final_cost'];


        if($card_num == ""){
          $errors['card_num'] = "card_num is empty";
        }
        if($card_name == ""){
          $errors['card_name'] = "card_name is empty";
        }
        if($ex_date == ""){
          $errors['ex_date'] = "ex_date is empty";
        }
        if($cvv == ""){
          $errors['cvv'] = "cvv is empty";
        }
        if($p_code == ""){
          $errors['p_code'] = "p_code is empty";
        }
        if($rental_d == ""){
          $errors['rental_d'] = "rental_d is empty";
        }

        if(empty($errors['rental_d']) && empty($errors['p_code']) && empty($errors['cvv']) && empty($errors['ex_date'])&& empty($errors['card_name'])&& empty($errors['card_num'])){



          $DR = $_SESSION['DR'];
          $time = $_SESSION['time'];
          $PL = $_SESSION['PL'];
          $DL = $_SESSION['DL'];
          $id = $_SESSION['id'];
          $car_id = $_SESSION['car_id'];
          $from_date = date("d-m-Y",time());
          $booking_num = mt_rand(100000, 999999);
    
          $sql = "INSERT INTO `booking`( `user_id`,`total_price`,`booking_num`, `car_id`, `from_date`, `to_date`, `time`, `PL`, `DL`) VALUES ('$id', '$final_cost','$booking_num','$car_id','$from_date','$DR','$time','$PL','$DL')";
          $result = $connection->query($sql);
    
          if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
          }

          $sql22 = "INSERT INTO `ex_booking`( `user_id`,`total_price`,`booking_num`, `car_id`, `from_date`, `to_date`, `time`, `PL`, `DL`) VALUES ('$id', '$final_cost','$booking_num','$car_id','$from_date','$DR','$time','$PL','$DL')";
          $result22 = $connection->query($sql22);
    
          if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
          }
          
          $quantity = $_SESSION['quantity'];
          $quantity = (int)$quantity - 1;

          $sql1 = "UPDATE `cars` SET `quantity`='$quantity' WHERE `car_id` = '$car_id' ";
          $result1 = $connection->query($sql1);
          
          if (!$result1) {
            $errorMessage = "Invalid query: " . $connection->error;
          }
          
          header("Location: Home.php");
          exit;
          

        }



    }


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment</title>
    <!--Custome Style -->
    <link rel="stylesheet" href="css/stylePayment.css" />
    <!--FontAwesome Font Style -->
    <link rel="stylesheet" href="font6.4/css/all.css" />
    <!-- bootstrap css -->
    <!-- <link rel="stylesheet" href="bootstrab/css/bootstrap.min.css"> -->
    <!-- bootstrab js -->
    <!-- Include jQuery library -->
    <script src="js/jQuery.js"></script>
    <!-- Include jQuery UI library -->
    <script src="js/jquery-ui.js"></script>
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <!-- time picker -->
    <script src="/path/to/cdn/dayjs.min.js"></script>
    <script></script>
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
          <a href="signUp.php" class="reg-cont">
            <div class="square">
              <i class="fa-solid fa-user"></i>
            </div>
            <h5>Sign Up</h5>
          </a>
        </div>
      </div>
    </header>
    <!-- End Header -->

    <!-- Payment Form -->
    <div class="container">
      <div class="payment-box">
        <h2>Payment</h2>
        <form method = "post">
          <div class="input-container">
            <label for="card-number">Card Number</label>
            <input type="text" id="card-number" name="card_num" />
            <p Style = "color : red;"><?php echo $errors['card_num']; ?></p>
          </div>
          <div class="input-container">
            <label for="card-name">Cardholder Name </label>
            <input type="text" id="card-name" name="card_name" />
            <p Style = "color : red;"><?php echo $errors['card_name']; ?></p>
          </div>
          <div class="input-container">
            <label for="expiry-date">Expiry Date</label>
            <input type="text" id="expiry-date" name="ex_date" />
            <p Style = "color : red;"><?php echo $errors['ex_date']; ?></p>
          </div>
          <div class="input-container">
            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" />
            <p Style = "color : red;"><?php echo $errors['cvv']; ?></p>
          </div>
          <div class="input-container">
            <label for="postal-code">Postal Code</label>
            <input type="text" id="postal-code" name="p_code" />
            <p Style = "color : red;"><?php echo $errors['p_code']; ?></p>
          </div>
          <div class="input-container">
            <label for="rental-duration">Rental Duration (in hours)</label>
            <input
              type="number"
              id="rental-duration"
              name="rental_d"
              min="1"
              max="24"
            />
            <p Style = "color : red;"><?php echo $errors['rental_d']; ?></p>
          </div>
          <div class="input-container">
            <label for="final-cost">Final Cost</label>
            <input type="text" id="final-cost" name="final_cost" readonly />
          </div>
          <button type="submit" name = "pay">Pay Now</button>
        </form>
      </div>
    </div>
    <!-- End Payment Form -->

    <footer>
      <span class="policy">Privacy Policy</span>
      <span class="terms">Terms of use</span>
      <span class="copyright"
        ><i class="fa-regular fa-copyright"></i> 2023 All rights reserved</span
      >
    </footer>

    <script src="js/jQuery.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script>
      $(document).ready(function () {
        $("#expiry-date").datepicker();
      });
    </script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const rentalDurationInput = document.getElementById("rental-duration");
        const finalCostInput = document.getElementById("final-cost");

        rentalDurationInput.addEventListener("input", function () {
          const rentalDuration = parseInt(rentalDurationInput.value);
          const hourlyRate = <?php echo $price;?>;
          const finalCost = rentalDuration * hourlyRate;
          finalCostInput.value = finalCost.toFixed(2);
        });
      });
    </script>
  </body>
</html>
