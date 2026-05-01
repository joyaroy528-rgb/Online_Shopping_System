<?php
session_start();
include("../config/db.php");

/* 1. LOGIN CHECK */
if(!isset($_SESSION['user_id'])){
    die("Login required");
}

$user_id = $_SESSION['user_id'];

/* 2. GET CART DATA */
$sql = "SELECT c.product_id, c.quantity, p.price 
        FROM cart c 
        JOIN products p ON c.product_id = p.id 
        WHERE c.user_id='$user_id'";

$result = $conn->query($sql);

if($result->num_rows == 0){
    die("Cart is empty");
}

/* 3. CALCULATE TOTAL */
$total = 0;
$data = [];

while($row = $result->fetch_assoc()){
    $total += $row['price'] * $row['quantity'];
    $data[] = $row;
}

/* 4. CREATE ORDER */
$conn->query("INSERT INTO orders(user_id, total_price)
              VALUES('$user_id','$total')");

$order_id = $conn->insert_id;

/* 5. INSERT ORDER ITEMS */
foreach($data as $row){
    $conn->query("INSERT INTO order_items(order_id, product_id, quantity, price)
                  VALUES('$order_id',
                         '".$row['product_id']."',
                         '".$row['quantity']."',
                         '".$row['price']."')");
}

/* 6. CLEAR CART */
$conn->query("DELETE FROM cart WHERE user_id='$user_id'");

echo "<h2>Order Placed Successfully ✔</h2>";
echo "<h3>Total: $total ৳</h3>";
echo "<a href='../order/my_orders.php'>Go to My Orders</a>";
?>