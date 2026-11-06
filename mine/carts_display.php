<?php
session_start();
require_once "database/connection.php";

$sql = "SELECT * FROM products";
$stmt = mysqli_prepare($conn,$sql);
$execute = mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>

    <style>
        .carts-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .carts-images {
            border: 2px solid red;
            width: 200px;
        }

        .carts-images img {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }

        .carts-images button {
            width: 100%;
            background-color: blue;
            color: white;
            height: 40px;
            font-size: 19px;
        }
         .carts-images button:hover{
          cursor: pointer;
          background-color: grey;
         }
    </style>
</head>
<body>

<h2>My Shopping Cart</h2>

<div class="carts-container">

<?php if (!empty($_SESSION['cart'])) { ?>

    <?php foreach ($_SESSION['cart'] as $item) { ?>

        <div class="carts-images">
            <img src="admin/<?php echo htmlspecialchars($item['product_image']); ?>" alt="">
            <?php
            if(mysqli_num_rows($result) > 0){
             while($rows = mysqli_fetch_array($result)){
             ?>
            <a href="see.php?type=<?php echo $rows['product_type']; ?>"><button>See More</button>
            </a>
            <?php
          }
        }
        ?>
        </div>

    <?php } ?>

<?php } else { ?>

    <p>Your cart is empty.</p>

<?php } ?>

</div>

</body>
</html>