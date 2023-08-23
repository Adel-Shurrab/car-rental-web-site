<?php
include "../../../../connection.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    $email = $row["email"];
    $f_name =  $row["f_name"];
    $l_name = $row["l_name"];
    $phone_num = $row["phone_num"];
    $gender = $row["gender"];
    $dob = $row["dob"];
    $address = $row["address"];
    $profile_picture = $row["profile_picture"];
    $type = $row["type"];

    $sql2 = "INSERT INTO `banned_users`(`id`, `email`, `f_name`, `l_name`, `phone_num`, `gender`, `dob`, `address`, `profile_picture`, `type`) VALUES ('$id','$email','$f_name','$l_name','$phone_num','$gender','$dob','$address','$profile_picture','$type')";
    $connection->query($sql2);

    $sql = "DELETE FROM users WHERE id = $id";
    $connection->query($sql);
}

header("location: ./user.php");
exit;
