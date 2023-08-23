<?php 
include "../../../../connection.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "DELETE FROM cars WHERE car_id = $id";
    $connection->query($sql);
    $sql = "DELETE FROM `ex_booking` WHERE car_id = $id";
    $connection->query($sql);
}
header("location: ./car.php");

exit;
?>