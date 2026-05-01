<?php
session_start();
include("../config/db.php");

/* 1. LOGIN CHECK */
if(!isset($_SESSION['user_id'])){
    die("Login first");
}

/* 2. PRODUCT ID CHECK */
if(!isset($_GET['id'])){
    die("No product id found");
}

$user_id = $_SESSION['user_id'];
$product_id = intval($_GET['id']);

/* 3. CHECK IF PRODUCT EXISTS */
$check = $conn->query("SELECT id FROM products WHERE id='$product_id'");
if($check->num_rows == 0){
    die("Product not found");
}

/* 4. INSERT INTO CART */
$conn->query("INSERT INTO cart(user_id, product_id, quantity)
              VALUES('$user_id','$product_id',1)");

/* 5. REDIRECT */
header("Location: view_cart.php");
exit();
?>