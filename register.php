<?php
session_start();
include("../config/db.php");

if(isset($_POST['reg'])){

    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $pass = $conn->real_escape_string($_POST['password']);

    // check duplicate email
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");

    if($check->num_rows > 0){
        echo "<p style='color:red; text-align:center;'>Email already exists!</p>";
    }
    else{
        $conn->query("INSERT INTO users(name,email,password)
        VALUES('$name','$email','$pass')");

        echo "<p style='color:green; text-align:center;'>Registered Successfully!</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="box">

    <h2>Register</h2>

    <form method="POST">

        <input name="name" placeholder="Name" required><br><br>

        <input name="email" placeholder="Email" required><br><br>

        <input type="password" name="password" placeholder="Password" required><br><br>

        <button name="reg">Register</button>

    </form>

</div>

</body>
</html>