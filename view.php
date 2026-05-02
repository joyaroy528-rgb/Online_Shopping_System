<?php
session_start();
include("../config/db.php");
?>

<link rel="stylesheet" href="../css/style.css">

<h2>Products</h2>

<a href="add.php"><button>Add Product</button></a>
<br><br>

<?php
$res = $conn->query("SELECT * FROM products");

while($row = $res->fetch_assoc()){
?>

<p>

    
    <img src="../images/<?php echo $row['image']; ?>" width="100"><br>

    <?php echo $row['name']; ?> - <?php echo $row['price']; ?>৳

    <br><br>

    
    <a href="../cart/add_cart.php?id=<?= $row['id'] ?>">
        Add to Cart
    </a>

    |

    
    <a href="edit_image.php?id=<?php echo $row['id']; ?>">
        Add / Update Image
    </a>

    |

    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
    <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>

</p>

<hr>

<?php } ?>

<br>
<a href="../index.php">Back</a>