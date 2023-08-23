<?php
session_start();
include "connection.php";
$php_errormsg = ""; // Initialize the error message variable



$now = date("m/d/Y",time());
$word1 = explode("/", $now);

$sql0 = "SELECT * FROM ex_booking ";

$result0 = mysqli_query($connection, $sql0);
$row0 = mysqli_fetch_assoc($result0);
$num = mysqli_num_rows($result0);
$from_date = $row0['to_date'];
if (!$result0) {
    $errorMessage = "Invalid query: " . $connection->error;
  }
while($num !=0){
    $word2 = explode("/", $from_date);
    $x0 = (int)$word2[0];
    $y0 = (int)$word1[0];
    $r0 = $x0 - $y0;
    $x1 = (int)$word2[1];
    $y1 = (int)$word1[1];
    $r1 = $x1 - $y1;
    $x2 = (int)$word2[2];
    $y2 = (int)$word1[2];
    $r2 = $x2 - $y2;
    
    if((($r2<=0)&&(($r0 == 0 && $r1 <= 0)||($r0 < 0)))){
        $car_id = $row0['car_id'];
        $sql22 = "SELECT `quantity` FROM `cars` JOIN `ex_booking` ON cars.car_id = ex_booking.car_id WHERE ex_booking.car_id = $car_id";
        $result22 = mysqli_query($connection, $sql22);
        $row22 = mysqli_fetch_assoc($result22);
        $quantity = (int)$row22['quantity'] + 1 ;
        
        if (!$result22) {
            $errorMessage = "Invalid query: " . $connection->error;
            }

        $sql33 = "UPDATE `cars` SET `quantity`='$quantity' WHERE `car_id` = '$car_id' ";
        $result33 = $connection->query($sql33);
        if (!$result33) {
            $errorMessage = "Invalid query: " . $connection->error;
            }

        $sql44 = "DELETE FROM `ex_booking` WHERE `car_id` = '$car_id' ";
        $result44 = $connection->query($sql44);
        if (!$result44) {
            $errorMessage = "Invalid query: " . $connection->error;
            }
        
    }
    $row0 = mysqli_fetch_assoc($result0);
    $from_date = $row0['to_date'];
    $num--;
}





if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    $id = $_SESSION['id'];
    // Fetch the profile picture from the database
    $sql = "SELECT profile_picture FROM users WHERE id = $id";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);

    // Assign the profile picture to the $picture variable
    $picture = $row['profile_picture'];

    $customer_support = "";
    $best_price = "";
    $location = "";
    $cancelation = "";


    $sql = "SELECT * FROM `about_us`";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        $why_choose = $row['why_choose'];
        $customer_support = $row['customer_support'];
        $best_price = $row['best_price'];
        $location = $row['location'];
        $cancelation = $row['cancelation'];
    }

    if (isset($_POST['search'])) {
        $make = $_POST['make'];
        $model = $_POST['model'];
    }
?>

    <!DOCTYPE html>
    <html lang="en" dir="ltr">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>EeseRent | Profile</title>
        <!--Custome Style -->
        <link rel="stylesheet" href="css/styleHome.css" />
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
                <a href="#" class="logo">
                    <img src="images/logo/logo.png" alt="logo" width="60" height="60" />
                </a>
                <nav>
                    <ul>
                        <li><a href="#about_us">About us</a></li>
                        <li><a href="#category">Categories</a></li>
                        <li><a href="#">Support</a></li>
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
        <!-- Start Landing -->
        <div class="landing">
            <div class="overlay"></div>
            <div class="container">
                <div class="text">
                    <div class="content">
                        <h2 class="land-title">Unlock your journey:<br /></h2>
                        <h2 class="land-title2">
                            Descover Seamless Car Rentals <br />with EeseRent
                        </h2>
                    </div>
                </div>
                <div class="search">
                    <form action="carList.php" method="GET">
                        <div class="make">
                            <label for="make">Make</label>
                            <div class="custom-select">
                                <select name="make" id="make" class="select-wrap">
                                    <option value="select">select company</option>
                                    <option value="Toyota">Toyota</option>
                                    <option value="Sonata">Sonata</option>
                                    <option value="BMW">BMW</option>
                                    <option value="Hyundai">Hyundai</option>
                                    <option value="Mercedes">Mercedes</option>
                                    <option value="Fiat">Fiat</option>
                                    <option value="Jeep">Jeep</option>
                                    <option value="Kia">Kia</option>
                                    <option value="Land Rover">Land Rover</option>
                                    <option value="Mazda">Mazda</option>
                                    <option value="Nissan">Nissan</option>
                                    <option value="Rolls-Royce">Rolls-Royce</option>
                                    <option value="Tesla">Tesla</option>
                                    <option value="Volvo">Volvo</option>
                                    <option value="Ferrari">Ferrari</option>
                                    <option value="Lamborghini">Lamborghini</option>
                                    <option value="McLaren">McLaren</option>
                                    <option value="Aston Martin">Aston Martin</option>
                                </select>
                            </div>
                        </div>
                        <div class="model">
                            <label for="model">Model</label>
                            <input type="text" name="model" id="model" />
                        </div>
                        <button type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Search
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Landing -->
        <!-- Start category -->
        <section id="category" class="category">
            <div class="container">
                <h2>Find car by model</h2>
                <div class="cards">
                    <a href="CarList.php?Category=Sedans">
                        <div class="sedan">
                            <div class="overlay"></div>
                            <div class="cat-txt">
                                <h5>Sedan</h5>
                            </div>
                        </div>
                    </a>
                    <a href="CarList.php?Category=SUVs">
                        <div class="suv">
                            <div class="overlay"></div>
                            <div class="cat-txt">
                                <h5>SUVs</h5>
                            </div>
                        </div>
                    </a>
                    <a href="CarList.php?Category=Luxury">
                        <div class="luxury">
                            <div class="overlay"></div>
                            <div class="cat-txt">
                                <h5>Luxury</h5>
                            </div>
                        </div>
                    </a>
                    <a href="CarList.php?Category=Sports">
                        <div class="sports">
                            <div class="overlay"></div>
                            <div class="cat-txt">
                                <h5>Sports</h5>
                            </div>
                        </div>
                    </a>
                    <a href="CarList.php?Category=Vans">
                        <div class="vans">
                            <div class="overlay"></div>
                            <div class="cat-txt">
                                <h5>Vans</h5>
                            </div>
                        </div>
                    </a>
                    <a href="CarList.php?Category=Electric">
                        <div class="elec">
                            <div class="overlay"></div>
                            <div class="cat-txt">
                                <h5>Electric</h5>
                            </div>
                        </div>
                    </a>
                    <a href="CarList.php?Category=Pickup_Truck">
                        <div class="truck">
                            <div class="overlay"></div>
                            <div class="cat-txt">
                                <h5>Truck</h5>
                            </div>
                        </div>
                    </a>
                    <a href="CarList.php?Category=Convertible">
                        <div class="convertible">
                            <div class="overlay"></div>
                            <div class="cat-txt">
                                <h5>Convertible</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <!-- End category -->
        <!-- Start about-us -->
        <section id="about_us" class="about-us">
            <div class="container">
                <div class="main-heading">
                    <h2>WHY <span>CHOOSE US</span></h2>
                    <p>
                        <?php echo $why_choose; ?>
                    </p>
                </div>
                <div class="about-us-container">
                    <div class="about-box">
                        <div class="squaree">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="text">
                            <h3>Customer Support</h3>
                            <p>

                                <?php echo $customer_support; ?>

                            </p>
                        </div>
                    </div>
                    <div class="about-box">
                        <div class="squaree">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="text">
                            <h3>Location</h3>
                            <p>
                                <?php echo $location; ?>
                            </p>
                        </div>
                    </div>
                    <div class="about-box">
                        <div class="squaree">
                            <i class="fa-solid fa-tag"></i>
                        </div>
                        <div class="text">
                            <h3>Best Price</h3>
                            <p>
                                <?php echo $best_price; ?>
                            </p>
                        </div>
                    </div>
                    <div class="about-box">
                        <div class="squaree">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </div>
                        <div class="text">
                            <h3>Free Cancelation</h3>
                            <p>
                                <?php echo $cancelation; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End about us -->

        <footer>
            <span class="policy">Privacy Policy</span>
            <span class="terms">Terms of use</span>
            <span class="copyright"><i class="fa-regular fa-copyright"></i> 2023 All rights reserved</span>
        </footer>

        <script src="js/search.js"></script>
    </body>

    </html>

<?php
} else {
    header("Location: signIn.php");
    exit;
}
?>