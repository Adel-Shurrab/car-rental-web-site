<?php
session_start();
include "connection.php";
require "functions.php";
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {

    $id = $_SESSION['id'];
    // Fetch the profile picture from the database
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);

    // Assign the profile picture to the $picture variable
    $picture = $row['profile_picture'];
    $f_name = $row['f_name'];
    $l_name = $row['l_name'];
    $gender = $row['gender'];
    $dob = $row['dob'];
    $phone_num = $row['phone_num'];
    $address = $row['address'];
?>


    <!DOCTYPE html>
    <html lang="en" dir="ltr">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>EeseRent | Home</title>
        <!--Custome Style -->
        <link rel="stylesheet" href="css/styleHome.css" />
        <link rel="stylesheet" href="css/styleAccountInfo.css" />
        <!--FontAwesome Font Style -->
        <link rel="stylesheet" href="font6.4/css/all.css" />
        <!-- bootstrap css -->
        <!-- <link rel="stylesheet" href="bootstrab/css/bootstrap.min.css"> -->
        <!-- bootstrab js -->
        <script type="text/javascript" src="bootstrab/js/bootstrap.min.js"></script>
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
                <a href="#" class="logo">
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

        <?php
        $id = $_SESSION['id'];


        $errors = array(
            'f_name' => '',
            'l_name' => '',
            'gender' => '',
            'dob' => '',
            'phone_num' => '',
            'address' => '',
        );

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $f_name = $_POST["f_name"];
            $l_name = $_POST["l_name"];
            $gender = $_POST["gender"];
            $dob = $_POST["dob"];
            $phone_num = $_POST["phone_num"];
            $address = $_POST["address"];

            $isValid = true; // Flag to check if all input values are valid

            if (empty($f_name)) {
                $errors['f_name'] = "Please enter your first name.";
                $isValid = false;
            } elseif (validateUserName($f_name)) {
                $errors['f_name'] = "Must start and end with letters.";
                $isValid = false;
            }

            if (empty($l_name)) {
                $errors['l_name'] = "Please enter your last name.";
                $isValid = false;
            } elseif (validateUserName($l_name)) {
                $errors['l_name'] = "Must start and end with letters.";
                $isValid = false;
            }

            if (empty($phone_num)) {
                $errors['phone_num'] = "Please enter your phone number.";
                $isValid = false;
            } elseif (validatePhone($phone_num)) {
                $errors['phone_num'] = "Invalid input!";
                $isValid = false;
            }

            if (empty($dob)) {
                $errors['dob'] = "Please enter your date of birth.";
                $isValid = false;
            } elseif (validateDOB($dob)) {
                $errors['dob'] = "Must be 18 years or older.";
                $isValid = false;
            }

            if (empty($gender)) {
                $errors['gender'] = "Please select your gender.";
                $isValid = false;
            }

            if (empty($address)) {
                $errors['address'] = "Please enter your address.";
                $isValid = false;
            }

            if ($isValid) {
                $sql = "UPDATE users
                      SET f_name = '$f_name',                   
                          l_name = '$l_name',
                          phone_num = '$phone_num',
                          gender = '$gender',
                          dob = '$dob',
                          address = '$address'
                      WHERE id = '$id'";

                $result = $connection->query($sql);

                if (!$result) {
                    $errorMessage = "Invalid query: " . $connection->error;
                } else {
                    header('Location: profileSettings.php');
                    exit;
                }
            }
        }
        ?>

        <!-- start  section -->
        <section>
            <div class="container">
                <h1 class="f-title">Profile Settings</h1>

                <div class="landing">
                    <div class="overlay">
                        <div class="con">
                            <a href="profileSettings.php">
                                <div class="bot"> <i class="fa-solid fa-angle-left" style="color: #466267"></i>
                                </div>
                            </a>
                            <div class="texxt">
                                <h1>Account information</h1>
                                <h3>Profile photo & name</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ac-sec">
                    <form method="post" class="ac-form">
                        <div class="row row1">
                            <div class="box">
                                <input type="text" name="f_name" placeholder="First name" value="<?php echo $f_name ?>" />
                                <p class="text-danger"><?php echo $errors['f_name']; ?></p>
                            </div>
                            <div class="box">
                                <input type="text" name="l_name" placeholder="Last name" value="<?php echo $l_name ?>" />
                                <p class="text-danger"><?php echo $errors['l_name']; ?></p>
                            </div>
                        </div>

                        <div class="data">
                            <div class="row row2">
                                <div class="box box1">
                                    <label for="gender">Gender</label>
                                    <div class="cho y">
                                        <div class="bo x">
                                            <input type="radio" id="m" name="gender" value="male" <?php if ($gender == "male") echo "checked"; ?> />
                                            <label for="m">male</label>
                                        </div>

                                        <div class="bo x">
                                            <input type="radio" id="f" name="gender" value="female" <?php if ($gender == "female") echo "checked"; ?> />
                                            <label for="f">female</label>
                                        </div>
                                    </div>
                                    <p class="text-danger"><?php echo $errors['gender']; ?></p>
                                </div>
                            </div>
                            <div class="row row2">
                                <div class="box box1">
                                    <label for="datepicker">Date of birth</label>
                                    <div class="inner2">
                                        <input type="text" id="datepicker" name="dob" value="<?php echo $dob; ?>" />
                                        <i class="fa-solid fa-calendar-days .id"></i>
                                    </div>
                                    <p class="text-danger"><?php echo $errors['dob']; ?></p>
                                </div>
                            </div>
                            <div class="row row2">
                                <div class="box box1">
                                    <label for="Email">Email address</label>
                                    <input type="email" id="Email" value="<?php echo $_SESSION['email'] ?>" disabled />
                                </div>
                            </div>
                            <div class="row row2">
                                <div class="box box1">
                                    <label for="Phone">Phone number</label>
                                    <input type="text" id="Phone" name="phone_num" value="<?php echo $phone_num ?>" />
                                </div>
                                <p class="text-danger"><?php echo $errors['phone_num']; ?></p>
                            </div>
                            <div class="row row2">
                                <div class="box box1">
                                    <label for="Address">Address</label>
                                    <input type="text" id="Address" name="address" value="<?php echo $address ?>" />
                                </div>
                                <p class="text-danger"><?php echo $errors['address']; ?></p>
                            </div>
                        </div>

                        <div class="button">
                            <button type="submit">Update Settings</button>
                            <div class="a"><a href="profileSettings.php">Cancel</a></div>
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
            <span class="copyright"><i class="fa-regular fa-copyright"></i>
                2023 All rights reserved</span>
        </footer>
        <!-- end footer -->
        <script>
            $(document).ready(function() {
                $("#datepicker").datepicker({
                    minDate: new Date(1700, 1 - 1, 1),
                });
            });

            $("#timepicker").on("click", function() {
                $("#timepicker").removeClass("time");
            });
        </script>
        <script src="js/search.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location: signIn.php");
    exit;
}
