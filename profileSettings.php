<?php
session_start();
include "connection.php";

if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
  $id = $_SESSION['id'];

  // Fetch the profile picture from the database
  $sql2 = "SELECT profile_picture FROM users WHERE id = $id";
  $result2 = mysqli_query($connection, $sql2);
  $row = mysqli_fetch_assoc($result2);

  if (isset($_POST['upload'])) {
    $file = $_FILES['image']['name'];
    $id = $_SESSION['id'];
    $sql = "UPDATE users
            SET profile_picture = '$file'
            WHERE id=$id;";
    $result = mysqli_query($connection, $sql);

    if ($result) {
      move_uploaded_file($_FILES['image']['tmp_name'], "images/profile/" . $file);
      $picture = $file;
    }
  } else {
    $picture = $row['profile_picture'];
    // Set the $picture variable with the existing profile picture
  }

  $sql3 = "SELECT * FROM booking b join cars c on b.car_id = c.car_id where b.user_id = '$id'";


  $result2 = $connection->query($sql3);

  if (!$result2) {
    die("Invalid query: " . $connection->error);
  }
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EeseRent | Profile Settings</title>
    <!--Custome Style -->
    <link rel="stylesheet" href="css/styleHome.css" />

    <!--FontAwesome Font Style -->
    <link rel="stylesheet" href="font6.4/css/all.css" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="bootstrab/css/bootstrap.min.css">
    <!-- bootstrab js -->
    <link rel="stylesheet" href="css/styleProfileSettings.css" />

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
    <!-- start profile Settings -->
    <div class="container">
      <div class="title">
        <h6>Profile Settings</h6>
      </div>
      <div class="info">
        <div class="insinfo">
          <div class="box1">
            <?php if (!empty($picture)) : ?>
              <img src="images/profile/<?= $picture ?>" alt="Profile Picture" class="nav-profile-pic">
            <?php elseif (empty($picture)) : ?>
              <img src="images/profile//profile.png" alt="Default Profile Picture" width="30" height="30" class="nav-profile-pic">
            <?php endif; ?>
            <h4><?php echo $_SESSION['f_name'] . " " . $_SESSION['l_name'] ?></h4>
            <p><?php echo $_SESSION['email'] ?></p>
          </div>

          <!-- Add picture button -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Add Picture
          </button>

          <!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Upload Image</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="imageInput">Choose Image:</label>
                      <input type="file" class="form-control-file" id="imageInput" name="image" accept=".jpg, .jpeg, .png">
                    </div>
                    <input type="submit" name="upload" class="btn btn-primary" value="Uplaod">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="options">
        <a href="AccountInfo.php">
          <div class="box">
            <div class="icon">
              <i class="fa-solid fa-user"></i>
            </div>
            <div class="details">
              <h4>Account Information</h4>
              <p>profile foto, and name</p>
            </div>
          </div>
        </a>
        <a href="LoginDetails.php">
          <div class="box">
            <div class="icon">
              <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div class="details">
              <h4>Login Details</h4>
              <p>password & security</p>
            </div>
          </div>
        </a>
      </div>
      <div class="book">
        <div class="list">
          <div class="search2">
            <p class="psec">My booking</p>
          </div>
        </div>





        <?php
        while ($row = $result2->fetch_assoc()) {
        ?>
          <div class="car3" id="car_<?php echo $row['car_id']; ?>">
            <a href="CarDetails.php?id=<?php echo $row["car_id"]; ?>" class="booktitle"><?php echo "Booking No. " . $row["booking_num"]; ?> </a>
            <div class="car2">
              <a href="CarDetails.php?id=<?php echo $row["car_id"]; ?>" class="imgCar">
                <img src="metronic_v6.1.0/theme/classic/demo1/uploads/<?php echo $row["img1"] ?>" alt="" />
              </a>
              <div class="box">
                <a href="CarDetails.php?id=<?php echo $row["car_id"]; ?>" class="cartitle"><?php echo $row["brand"] . " ,";
                                                                                            echo $row["model"]; ?></a>
                <div class="details">
                  <div class="pass">
                    <i class="fa-solid fa-clock"></i>
                    <p><?php echo $row["from_date"]; ?></p>
                  </div>
                  <div class="pass">
                    <i class="fa-solid fa-stopwatch"></i>
                    <p><?php echo $row["to_date"]; ?></p>
                  </div>
                </div>
              </div>
              <div class="done">
                <a href="CarDetails.php?id=<?php echo $row["car_id"]; ?>" class="details">Details</a>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
    <!-- end profile Settings -->
    <footer>
      <span class="policy">Privacy Policy</span>
      <span class="terms">Terms of use</span>
      <span class="copyright"><i class="fa-regular fa-copyright"></i>
        2023 All rights reserved</span>
    </footer>

    <!-- Bootstrap JS -->
    <!-- Include jQuery library -->
    <script src="js/jQuery.js"></script>
    <!-- Include jQuery UI library -->
    <script src="js/jquery-ui.js"></script>
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <!-- time picker -->
    <script src="/path/to/cdn/dayjs.min.js"></script>
    <script></script>
    <script type="text/javascript" src="bootstrab/js/bootstrap.min.js"></script>
  </body>

  </html>
<?php
} else {
  header("Location: signIn.php");
  exit;
}
?>