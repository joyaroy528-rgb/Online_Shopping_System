<?php
session_start();
include("../config/db.php");


if(!isset($_SESSION['user_id'])){
    die("Login first");
}


if(!isset($_GET['id'])){
    die("No product id found");
}

$user_id = $_SESSION['user_id'];
$product_id = intval($_GET['id']);


$check = $conn->query("SELECT id FROM products WHERE id='$product_id'");
if($check->num_rows == 0){
    die("Product not found");
}


$conn->query("INSERT INTO cart(user_id, product_id, quantity)
              VALUES('$user_id','$product_id',1)");


header("Location: view_cart.php");
exit();
?>