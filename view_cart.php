<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['user_id'])){
    die("Please login first");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
</head>
<body>

<h2>Shopping Cart</h2>

<table border="1" width="100%">
<tr>
    <th>Product</th>
    <th>Price</th>
    <th>Action</th>
</tr>

<?php
$user_id = $_SESSION['user_id'];
$total = 0;

$sql = "SELECT c.id as cart_id, p.name, p.price
        FROM cart c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_id='$user_id'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){
        $total += $row['price'];
?>

<tr>
    <td><?= $row['name'] ?></td>
    <td><?= $row['price'] ?> ৳</td>

    <td>
        <a href="remove.php?id=<?= $row['cart_id'] ?>" style="color:red;">
            Remove
        </a>
    </td>
</tr>

<?php
    }

} else {
    echo "<tr><td colspan='3'>Cart is empty!</td></tr>";
}
?>

</table>

<h3>Total: <?= $total ?> ৳</h3>

<?php if($total > 0){ ?>
    <a href="../order/checkout.php">Proceed to Checkout</a>
<?php } ?>

<br><br>
<a href="../product/view.php">Back to Shopping</a>

</body>
</html>