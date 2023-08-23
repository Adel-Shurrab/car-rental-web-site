<?php
include "connection.php";
?>

<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    $id = $_SESSION['id'];

    // Fetch the profile picture from the database
    $sql3 = "SELECT profile_picture FROM users WHERE id = $id";
    $result3 = mysqli_query($connection, $sql3);
    $row3 = mysqli_fetch_assoc($result3);

    // Assign the profile picture to the $picture variable
    $picture = $row3['profile_picture'];

    $sql2 = "SELECT * FROM cars where car_id > 0 and quantity > 0";

    if (isset($_GET['Category'])) {
        $_SESSION['Category'] = $_GET['Category'];
        $_SESSION['make'] = "";
        $_SESSION['model'] = "";
    }



    if (isset($_GET['make'])) {
        $_SESSION['make'] = $_GET['make'];
        $_SESSION['Category'] = "";
    }

    if (isset($_GET['model'])) {
        $_SESSION['model'] = $_GET['model'];
        $_SESSION['Category'] = "";
    }
    $car = $_SESSION['Category'];
    $make = $_SESSION['make'];
    $model = $_SESSION['model'];

    if ($model !== "" && $make !== "") {
        $sql2 = "SELECT * FROM cars WHERE brand = '$make' AND model like '$model%' and quantity > 0";
    }
    if ($model !== "" && $make == "select") {
        $sql2 = "SELECT * FROM cars WHERE model like '$model%' and quantity > 0";
    }
    if ($make !== "select" && $model == "") {
        $sql2 = "SELECT * FROM cars WHERE brand = '$make' and quantity > 0";
    }
    if ($car !== "") {
        $sql2 = "SELECT * FROM cars where category = '$car' and quantity > 0";
        $result2 = $connection->query($sql2);
    }



    $minPrice = $_GET['min'];
    $maxPrice = $_GET['max'];
    if (empty($minPrice) && empty($maxPrice)) {
        $sql2 .= " AND price_per_hour BETWEEN 0 And 100000";
    } else if (empty($minPrice)) {
        $sql2 .= " AND price_per_hour BETWEEN 0 And '$maxPrice'";
    } else if (empty($maxPrice)) {
        $sql2 .= " AND price_per_hour BETWEEN '$minPrice' And 100000";
    } else {
        $sql2 .= " AND price_per_hour BETWEEN '$minPrice' And '$maxPrice'";
    }

    $selectedSeats = [];
    if (!empty($_GET['two'])) {
        $selectedSeats[] = 2;
    }
    if (!empty($_GET['four'])) {
        $selectedSeats[] = 4;
    }
    if (!empty($_GET['six'])) {
        $selectedSeats[] = 6;
    }
    if (!empty($_GET['seven'])) {
        $selectedSeats[] = 7;
    }

    if (!empty($selectedSeats)) {
        $seatsCondition = implode(',', $selectedSeats);
        $sql2 .= " AND seats_num IN ($seatsCondition)";
    }

    $manual = $_GET['man'];
    $automatic = $_GET['auto'];
    if (!empty($manual) && !empty($automatic)) {
    } elseif (!empty($manual)) {
        $sql2 .= " AND gear = 'Manual'";
    } elseif (!empty($automatic)) {
        $sql2 .= " AND gear = 'Automatic'";
    }


    $result2 = $connection->query($sql2);

    if (!$result2) {
        die("Invalid query: " . $connection->error);
    }

    $total = mysqli_num_rows($result2);

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

        <title>Car List</title>
        <!--Custome Style -->
        <link rel="stylesheet" href="css/styleHome.css" />

        <!--FontAwesome Font Style -->
        <link rel="stylesheet" href="font6.4/css/all.css" />
        <!-- bootstrap css -->
        <!-- <link rel="stylesheet" href="bootstrab/css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="css/styleCarList.css" />
        <!-- bootstrab js -->

    </head>

    <body>
        <!-- Start Header -->
        <header>
            <div class="container">
                <a href="./Home.php" class="logo">
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
        <!-- start car List  -->
        <form action="" method="get">
            <div class="container inside">
                <div class="filter">
                    <h5>Filter By</h5>
                    <div class="filllter">
                        <div class="price">
                            <h6>Price range</h6>
                            <div class="range">
                                <input type="text" name="min" placeholder="Min">
                                <p>-</p>
                                <input type="text" name="max" placeholder="Max">
                            </div>
                        </div>
                        <div class="passengers">
                            <h6>Number of passengers</h6>
                            <div class="seat">
                                <input type="checkbox" name="two" value="2">
                                <p>2 seats</p>
                            </div>
                            <div class="seat">
                                <input type="checkbox" name="four" value="4">
                                <p>4 seats</p>
                            </div>
                            <div class="seat">
                                <input type="checkbox" name="six" value="6">
                                <p>6 seats</p>
                            </div>
                            <div class="seat">
                                <input type="checkbox" name="seven" value="7">
                                <p>7 seats</p>
                            </div>
                        </div>
                        <div class="gear">
                            <h6>Gear</h6>
                            <div class="gear1">
                                <input type="checkbox" name="auto" value="Automatic">
                                <p>Automatic</p>
                            </div>
                            <div class="gear1">
                                <input type="checkbox" name="man" value="Manual">
                                <p>Manual</p>
                            </div>
                        </div>
                        <button type="submit">Apply Filters</button>
                    </div>
                </div>
                <div class="right">
                    <div class="list">
                        <div class="search2">
                            <p class="psec"><?php echo $total ?> Cars Total</p>
                            <div class="sel">
                                <p>sort by</p>
                                <select name="sort" id="">
                                    <option value="Recommended">Recommended</option>
                                    <option value="Price" <?php if ($_GET['sort'] == "Price") {
                                                                echo "selected";
                                                            } ?>>Price</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <?php
                    if ($_GET['sort'] == "Price") {
                        $sql2 .= " order by price_per_hour";
                        $result2 = $connection->query($sql2);


                        if (!$result2) {
                            die("Invalid query: " . $connection->error);
                        }
                    }
                    ?>

                    <?php


                    while ($row = $result2->fetch_assoc()) {
                    ?>
                        <div class="car2">
                            <div class="imgCar">
                                <img src="metronic_v6.1.0/theme/classic/demo1/uploads/<?php echo $row["img1"] ?>" alt="">
                            </div>
                            <div class="box">
                                <div class="cartitle"><?php echo $row["brand"] ?> , <?php echo $row["model"] ?></div>
                                <div class="details">
                                    <div class="pass">
                                        <i class="fa-solid fa-user"></i>
                                        <p><?php echo $row["seats_num"] ?> passengers</p>
                                    </div>
                                    <div class="pass">
                                        <i class="fa-solid fa-gauge"></i>
                                        <p><?php echo $row["gear"] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="done">
                                <a href="CarDetails.php?id=<?php echo $row['car_id'] ?>">Reserve</a>
                                <div class="price">
                                    <h6><?php echo $row["price_per_hour"] ?>$</h6>
                                    <p>per day</p>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </form>
        <!-- <footer>
            <span class="policy">Privacy Policy</span>
            <span class="terms">Terms of use</span>
            <span class="copyright"><i class="fa-regular fa-copyright"></i> 2023 All rights reserved</span>
        </footer> -->

        <!-- <script type="text/javascript" src="bootstrab/js/bootstrap.min.js"></script> -->
    </body>

    </html>

<?php
} else {
    header("Location: ../../../../signIn.php");
    exit;
}
?>