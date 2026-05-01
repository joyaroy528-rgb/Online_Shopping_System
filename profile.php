<?php
session_start();
include("../config/db.php");

/* LOGIN CHECK */
if(!isset($_SESSION['email'])){
    die("Login first");
}

$email = $_SESSION['email'];

/* USER FETCH */
$u = $conn->query("SELECT * FROM users WHERE email='$email'")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="box">

    <h2>Profile</h2>

    <p><b>Name:</b> <?php echo $u['name']; ?></p>
    <p><b>Email:</b> <?php echo $u['email']; ?></p>

    <br>

    <!-- DELETE BUTTON -->
    <a href="delete.php"
       onclick="return confirm('Are you sure you want to delete your account?')"
       style="background:red; color:white; padding:10px; border-radius:5px; display:inline-block;">
       Delete Account
    </a>

    <br><br>

    <a href="../index.php">Back</a>

</div>

</body>
</html>