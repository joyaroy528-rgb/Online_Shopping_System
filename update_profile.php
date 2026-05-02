<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../config/db.php");


if(!isset($_SESSION['email'])){
    die("Login first");
}

$email = $_SESSION['email'];


$name = $_POST['name'];
$new_email = $_POST['email'];

$image_name = "";


if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

    $image_name = time() . "_" . basename($_FILES['image']['name']);
    $tmp = $_FILES['image']['tmp_name'];

    $path = "../images/" . $image_name;

    if(!move_uploaded_file($tmp, $path)){
        die("Image upload failed");
    }

    $sql = "UPDATE users SET 
            name='$name',
            email='$new_email',
            image='$image_name'
            WHERE email='$email'";

} else {

    $sql = "UPDATE users SET 
            name='$name',
            email='$new_email'
            WHERE email='$email'";
}


if(!$conn->query($sql)){
    die("DB Error: " . $conn->error);
}


$_SESSION['email'] = $new_email;


header("Location: profile.php");
exit();
?>