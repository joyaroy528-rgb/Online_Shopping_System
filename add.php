<?php
include("../config/db.php");

/* ADD PRODUCT */
if(isset($_POST['add'])){

    $name = $_POST['name'];
    $price = $_POST['price'];

    /* IMAGE CHECK */
    if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        // unique file name
        $newName = time().$image;

        // upload path
        $uploadPath = "../images/".$newName;

        if(move_uploaded_file($tmp, $uploadPath)){

            $sql = "INSERT INTO products(name, price, image)
                    VALUES('$name','$price','$newName')";

            if($conn->query($sql)){
                echo "<p style='color:green; text-align:center;'>Product Added Successfully!</p>";
            } else {
                echo "<p style='color:red; text-align:center;'>Database insert failed!</p>";
            }

        } else {
            echo "<p style='color:red; text-align:center;'>Image upload failed!</p>";
        }

    } else {
        echo "<p style='color:red; text-align:center;'>Please select an image!</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="box">

    <h2>Add Product</h2>

    <form method="POST" enctype="multipart/form-data">

        <input type="text" name="name" placeholder="Product Name" required><br><br>

        <input type="text" name="price" placeholder="Price" required><br><br>

        <input type="file" name="image" required><br><br>

        <button type="submit" name="add">Add Product</button>

    </form>

    <br>
    <a href="view.php">Back</a>

</div>

</body>
</html>