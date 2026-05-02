<?php
session_start();
include("../config/db.php");

/* LOGIN CHECK */
if(!isset($_SESSION['user_id'])){
    die("Login required");
}

$user_id = $_SESSION['user_id'];

/* GET CART */
$sql = "SELECT c.product_id, c.quantity, p.price 
        FROM cart c 
        JOIN products p ON c.product_id = p.id 
        WHERE c.user_id='$user_id'";

$result = $conn->query($sql);

if($result->num_rows == 0){
    die("Cart is empty");
}


$total = 0;
$data = [];

while($row = $result->fetch_assoc()){
    $total += $row['price'] * $row['quantity'];
    $data[] = $row;
}


$conn->query("INSERT INTO orders(user_id, total_price)
              VALUES('$user_id','$total')");

$order_id = $conn->insert_id;


foreach($data as $row){
    $conn->query("INSERT INTO order_items(order_id, product_id, quantity, price)
                  VALUES('$order_id',
                         '".$row['product_id']."',
                         '".$row['quantity']."',
                         '".$row['price']."')");
}


$conn->query("DELETE FROM cart WHERE user_id='$user_id'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Success</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="success-box">

    <h2>Order Placed Successfully ✔</h2>

    <h3>Total: <?php echo $total; ?> ৳</h3>

    <a href="../order/my_orders.php">Go to My Orders</a>

</div>

</body>
</html>