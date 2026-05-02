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
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="cart-page">

<div class="cart-box">

<h2>Shopping Cart</h2>

<table class="cart-table">
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
        <a href="remove.php?id=<?= $row['cart_id'] ?>" style="color:red;">Remove</a>
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

<hr>

<!-- CUSTOMER INFO FORM -->
<h3>Customer Information</h3>

<form action="../order/checkout.php" method="POST">

<input class="cart-input" type="text" name="name" placeholder="Your Name" required><br>
<input class="cart-input" type="email" name="email" placeholder="Email" required><br>
<input class="cart-input" type="text" name="location" placeholder="Location" required><br>

<input type="hidden" name="total" value="<?= $total ?>">

<button type="submit">Proceed to Checkout</button>

</form>

<br>

<?php if($total == 0){ ?>
    <p>Cart is empty!</p>
<?php } ?>

<br>

<a href="../product/view.php"> Back to Shopping</a>

</div>

</body>
</html>