<?php
  $server = "localhost";
  $username = "root";
  $password = "";
  $database = "rent_car";

  global $connection;
  $connection = mysqli_connect($server, $username, $password, $database);

  error_reporting(E_ERROR | E_PARSE);
  if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
  }

  
