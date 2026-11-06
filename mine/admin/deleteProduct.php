<?php
session_start();
require_once "../database/connection.php";

if(isset($_GET['id'])){

  if($_SESSION['user_role'] === 'admin'){

    $product_id = $_GET['id'];
    $sql = "DELETE FROM products WHERE id = '$product_id'";
    $execute = mysqli_query($conn,$sql);

    if($execute){
      header("Location: orders.php");
      exit;
      }
      else{
        echo "Error---- products not deleted";
    }


  }else{
    header("Location: ../user/dashboard.php");
    exit;
  }

}

?>