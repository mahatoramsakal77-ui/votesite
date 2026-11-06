<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Details</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            background-color: rgb(216, 202, 202);
        }
        img{
            height: 100px;
            width: 100px;
            border-radius: 50%;
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
         .admin-detail{
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

<?php
    require_once "../database/connection.php";
    
    $sql = "SELECT * FROM users WHERE user_role = 'admin'";
    $result = mysqli_query($conn,$sql);
    $rows = mysqli_fetch_array($result);
?>
<div class="admin-detail">
    <h2>Welcome Admin,</h2>
    <img src="admin.jfif" alt="">
    <p>
     Mr. <?php echo $rows['first_name']." ".$rows['middle_name']." ".$rows['last_name']; ?>
    </p>

</div>

</body>
</html>