<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['user_id'])){
    die("Login required");
}

$user_id = $_SESSION['user_id'];
$cart_id = $_GET['id'];

// DELETE using cart_id + user check (VERY IMPORTANT)
$sql = "DELETE FROM cart WHERE id='$cart_id' AND user_id='$user_id'";

if(mysqli_query($conn, $sql)){
    header("Location: view_cart.php");
    exit();
} else {
    echo "Error deleting: " . mysqli_error($conn);
}
?>