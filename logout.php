<?php
session_start();

session_unset();
session_destroy();

// cookies
setcookie('email', '', time() - 360, '/');
setcookie('password', '', time() - 360, '/');
// cookies

header("Location: signIn.php");
?>