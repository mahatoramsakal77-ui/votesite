<?php
require_once "../database/connection.php";
session_start();
error_reporting(0);

if(isset($_SESSION['user_id'])){
  if($_SESSION['user_role'] === 'user'){
   $user_id = (int)$_SESSION['user_id'];

   $sql = "SELECT * FROM users WHERE id = ?";
   $stmt = mysqli_prepare($conn,$sql);
   
   $bind = mysqli_stmt_bind_param($stmt,"i",$user_id);
   $execute = mysqli_stmt_execute($stmt);

   $result = mysqli_stmt_get_result($stmt);
   $rows = mysqli_fetch_assoc($result);  
  }
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
             left: 20px;
            text-align: center;
        }
         .dashbord_main{
            padding: 30px;
            margin-left: 200px;
         }
         .nav{
          margin-left: 220px;
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

<div class="nav">
    <h1>Welcome , Mr. <?php echo htmlspecialchars($rows['first_name'])." ".htmlspecialchars($rows['middle_name'])." ".htmlspecialchars($rows['last_name']); ?></h1> 
</div>

</body>
</html>