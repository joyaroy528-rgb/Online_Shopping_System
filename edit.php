<?php
include("../config/db.php");

$id = $_GET['id'];

$res = $conn->query("SELECT * FROM products WHERE id='$id'");
$row = $res->fetch_assoc();
?>

<link rel="stylesheet" href="../css/style.css">

<h2>Edit Product</h2>

<form method="POST">
    <input name="name" value="<?php echo $row['name']; ?>"><br><br>
    <input name="price" value="<?php echo $row['price']; ?>"><br><br>
    <button name="update">Update</button>
</form>

<?php
if(isset($_POST['update'])){
    $name = $_POST['name'];
    $price = $_POST['price'];

    $conn->query("UPDATE products 
                  SET name='$name', price='$price'
                  WHERE id='$id'");

    header("Location: view.php");
}
?>