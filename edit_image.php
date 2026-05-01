<?php
include("../config/db.php");

$id = $_GET['id'];

if(isset($_POST['update'])){

    if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        $newName = time().$image;

        $uploadPath = "../images/".$newName;

        if(move_uploaded_file($tmp, $uploadPath)){

            $sql = "UPDATE products SET image='$newName' WHERE id='$id'";

            if($conn->query($sql)){
                echo "<p style='color:green; text-align:center;'>Image Updated Successfully!</p>";
            } else {
                echo "<p style='color:red; text-align:center;'>Database update failed!</p>";
            }

        } else {
            echo "<p style='color:red; text-align:center;'>Upload failed!</p>";
        }

    } else {
        echo "<p style='color:red; text-align:center;'>Please select an image!</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Product Image</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="box">

    <h2>Update Product Image</h2>

    <form method="POST" enctype="multipart/form-data">

        <input type="file" name="image" required><br><br>

        <button name="update">Update Image</button>

    </form>

    <br>
    <a href="view.php">Back</a>

</div>

</body>
</html>