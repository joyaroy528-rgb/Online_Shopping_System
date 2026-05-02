<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['user_id'])){
    die("Login required");
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="order-box">

<h2 style="text-align:center;">My Orders</h2>

<?php

$orders = $conn->query("SELECT * FROM orders 
                        WHERE user_id='$user_id' 
                        ORDER BY id DESC");

while($order = $orders->fetch_assoc()){

    echo "<div class='order-card'>";

    echo "<b>Order ID:</b> ".$order['id']."<br>";
    echo "<b>Total:</b> ".$order['total_price']." ৳<br>";
    echo "<b>Date:</b> ".$order['order_date']."<br><br>";

    $order_id = $order['id'];

    $items = $conn->query("SELECT oi.quantity, oi.price, p.name 
                           FROM order_items oi
                           JOIN products p ON oi.product_id = p.id
                           WHERE oi.order_id='$order_id'");

    echo "<b>Products:</b><br>";

    while($item = $items->fetch_assoc()){
        echo "• ".$item['name'].
             " | Qty: ".$item['quantity'].
             " | Price: ".$item['price']." ৳<br>";
    }

    echo "</div><hr>";
}

?>

<br>
<a href="../index.php"> Back</a>

</div>

</body>
</html>