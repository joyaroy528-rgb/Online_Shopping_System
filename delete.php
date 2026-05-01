<?php
session_start();
include("../config/db.php");

/* LOGIN CHECK */
if(!isset($_SESSION['email'])){
    die("Login first");
}

$email = $_SESSION['email'];

/* DELETE USER */
$conn->query("DELETE FROM users WHERE email='$email'");

/* CLEAR SESSION */
session_unset();
session_destroy();

/* REDIRECT */
header("Location: ../index.php");
exit();
?>