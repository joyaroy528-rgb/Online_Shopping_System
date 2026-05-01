<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Shopping System</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="center-box">

    <h1>Online Shopping System</h1>

    <?php if(isset($_SESSION['user_id'])) { ?>

        <h3>Welcome, <?php echo $_SESSION['email']; ?></h3>

        <a href="product/view.php">View Products</a>
        <a href="cart/view_cart.php">My Cart</a>
        <a href="order/my_orders.php">My Orders</a>
        <a href="user/profile.php">Profile</a>
        <a href="auth/logout.php">Logout</a>

    <?php } else { ?>

        <h3>Create Account or Login</h3>

        <a href="auth/register.php">Create Account</a>
        <a href="auth/login.php">Login</a>

    <?php } ?>

</div>

</body>
</html>