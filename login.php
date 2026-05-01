<?php
session_start();
include("../config/db.php");

if(isset($_POST['login'])){

    $email = $conn->real_escape_string($_POST['email']);
    $pass = $conn->real_escape_string($_POST['password']);

    $res = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$pass'");

    if($res && $res->num_rows > 0){

        $row = $res->fetch_assoc();

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['email'] = $row['email'];

        header("Location: ../index.php");
        exit();

    } else {
        echo "<p style='color:red; text-align:center;'>Wrong email or password!</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="box">

    <h2>Login</h2>

    <form method="POST">

        <input name="email" placeholder="Email" required><br><br>

        <input type="password" name="password" placeholder="Password" required><br><br>

        <button name="login">Login</button>

    </form>

</div>

</body>
</html>