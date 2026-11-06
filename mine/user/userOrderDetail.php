<?php

session_start();
error_reporting(0);
require_once "../database/connection.php";

if(isset($_SESSION['order_id'])){
  $order_id = (int) $_SESSION['order_id'];

  $sql_user_order = "SELECT * FROM purchase_order WHERE order_id = ?";
  $stmt_user_order = mysqli_prepare($conn,$sql_user_order);

  if(!$stmt_user_order){
    echo "Error in accessing purchase order table";
  }
  else{
    $bind = mysqli_stmt_bind_param($stmt_user_order,"i",$order_id);
    $execute = mysqli_stmt_execute($stmt_user_order);
    $result = mysqli_stmt_get_result($stmt_user_order);
   
  }

}else{
  echo "buy first";
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
              /* display:none; */
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
            left: 20px;
        }
         .dashbord_main{
            padding: 30px;
            margin-left: 200px;
         }
        .dashbord_main  h2{
          margin: auto;
          text-align:center;
          margin-bottom: 20px;
         }
    </style>
</head>
<body>

<div class="dashboard_sidebar">
    <ul>
        <li><a href="userOrderDetail.php">Orders Details</a></li>
        <li><a href="../logout.php">Logout</a></li>
        <li><a href="../index.php">Go to website</a></li>
        <li class="admin"><a href="dashboard.php">User Details</a></li>
    </ul>
</div>

<div class="dashbord_main">
   
<table border="1" celllspacing="7">
  <h2>Purchased Table</h2>
   <thead>
     <tr>
      <th>order_id</th>
      <th>product_id</th>
      <th>Product_title</th>
      <th>Product_price</th>
      <th>product_quantity</th>
      <th>total_price</th>
      <th>FullName</th>
      <th>Contact</th>
      <th>Address</th>
    </tr>
   </thead>
   <tbody>
   
   <?php
      while($user_order_data = mysqli_fetch_assoc($result))
        {
          ?>
              <tr>
                <td><?php echo $user_order_data['order_id']; ?></td>
                <td><?php echo $user_order_data['product_id']; ?></td>
                <td><?php echo $user_order_data['product_title']; ?></td>
                <td><?php echo $user_order_data['product_price']; ?></td>
                <td><?php echo $user_order_data['product_quantity']; ?></td>
                <td><?php echo $user_order_data['total_price']; ?></td>
                <td><?php echo $user_order_data['full_name']; ?></td>
                <td><?php echo $user_order_data['contact']; ?></td>
                <td><?php echo $user_order_data['address']; ?></td>
              </tr>
          <?php
        }

    ?>

   </tbody>
  </table>


</div>

</body>
</html>