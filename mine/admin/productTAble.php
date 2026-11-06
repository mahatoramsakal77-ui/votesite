<?php
session_start();
require_once "../database/connection.php";

if(isset($_SESSION['user_id'])){

    if($_SESSION['user_role'] == "admin"){
        // $user_id = $_SESSION['user_id'];

        $sql = "SELECT * FROM products";
        $stmt = mysqli_prepare($conn,$sql);
        if($stmt){
            $execute = mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

                    }
            else{
                    die("Error : SQL error!");
            }

    }
    else{
       header("Location: ../user/dashboard.php");
       exit;
    }

}
else{
        header("Location: index.php");
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dahsboard</title>
    <style>
        
        *{
            margin: 0;
            padding: 0;
        }
        body{
            background-color: rgb(216, 202, 202);
            }

            .dashboard_sidebar{
            position: fixed;
            top: 0;
            background-color: rgba(248, 106, 71, 0.945);
            width: 200px;
            height: 100%;
        }

        .dashboard_sidebar ul li{
            list-style: none;
            text-align: center;
          
        }
        .dashboard_sidebar ul li a{
              padding: 10px;
            display: block;
            color: white;
            text-decoration : none;
        }

         .dashboard_sidebar ul li a:hover{
            background-color: orange;
         }
             .dashboard_sidebar ul  .admin {
            position: absolute;
            bottom: 0%;
            text-align: center;
        }
         .dashbord_main{
            padding: 30px;
            margin-left: 200px;
         }
    </style>
</head>
<body>

<div class="dashboard_sidebar">
    <ul>
        <li><a href="addProduct.php">Add Products</a></li>
        <li><a href="productTAble.php">Product Details</a></li>
        <li><a href="userOrder.php">Orders Details</a></li>
        <li><a href="../logout.php">Logout</a></li>
        <li><a href="../index.php">Go to website</a></li>
        <li class="admin"><a href="dashboard.php">Admin Details</a></li>
    </ul>
</div>

<div class="dashbord_main">
   
<table border="1" celllspacing="7">
   <thead>
     <tr>
      <th>product_id</th>
      <th>Title</th>
      <th>Description</th>
      <th>Price</th>
      <th>product_quantity</th>
      <th colspan="4">Product_Image</th>
      <th>Product_Type</th>
      <th>Operation Perform</th>
    </tr>
   </thead>
   <tbody>
   
   <?php
      while($row = mysqli_fetch_assoc($result))
        {
          ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['stock']; ?></td>
                <td colspan="4"><img src="<?php echo $row['product_image']; ?>" alt="product images" width="100px" height="100px"></td>
                <td><?php echo $row['product_type']; ?></td>

                <td>
                    <a href="updateProduct.php?id=<?php echo $row['id'];?>">Update</a>
                    <a href="deleteProduct.php?id=<?php echo $row['id'];?>">Delete</a>
                </td>

              </tr>
          <?php
        }

    ?>

   </tbody>
  </table>


</div>

</body>
</html>