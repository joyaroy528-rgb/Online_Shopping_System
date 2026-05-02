<?php
session_start();
include("../config/db.php");


if(!isset($_SESSION['email'])){
    die("Login first");
}

$email = $_SESSION['email'];


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

    <h2>My Profile</h2>

    
    <img src="../images/<?php echo ($u['image'] != '') ? $u['image'] : 'default.png'; ?>" 
         width="120" 
         style="border-radius:50%; border:3px solid #6c63ff;"><br><br>

    
    <p><b>Name:</b> <?php echo $u['name']; ?></p>
    <p><b>Email:</b> <?php echo $u['email']; ?></p>

    <hr>

    
    <form action="update_profile.php" method="POST" enctype="multipart/form-data">

        <input type="text" name="name" value="<?php echo $u['name']; ?>" required><br>
        <input type="email" name="email" value="<?php echo $u['email']; ?>" required><br>

        <input type="file" name="image"><br><br>

        <button type="submit">Update Profile</button>

    </form>

    <br>

    
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