<?php
session_start();
include("../config/db.php");


if(!isset($_SESSION['email'])){
    die("Login first");
}

$email = $_SESSION['email'];


$conn->query("DELETE FROM users WHERE email='$email'");


session_unset();
session_destroy();


header("Location: ../index.php");
exit();
?>