<?php
session_start();
require_once "database/connection.php";



if(isset($_GET['product_id_carts'])){
  $product_id_carts = (int)$_GET['product_id_carts'];

  $sql = "SELECT * FROM products WHERE id = ?";
  $stmt = mysqli_prepare($conn,$sql);
  $bind = mysqli_stmt_bind_param($stmt,"i",$product_id_carts);
  $execute = mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt); 
  $product = mysqli_fetch_array($result);

  if($product){
    $_SESSION['cart'][$product_id] = [
      'product_id' => $product['id'],
      'title' => $product['title'],
      'price' => $product['price'],
      'product_image' => $product['product_image'],
      'quantity' => 1
    ];
      echo "product added successfully";
      header("Location: carts_display.php");
      exit;
    }
    else{
      echo "product not found";
    }

}
else{
  echo "something wrong in product type";
}

//   if user click twice then quantity will increase
if(isset($_SESSION['cart'][$product_id])){
  $_SESSION['carts'][$product_id]['quantity']++;
}
else{
    $_SESSION['cart'][$product_id_carts] = [
      'product_id' => $product['id'],
      'title' => $product['title'],
      'price' => $product['price'],
      'product_image' => $product['product_image'],
      'quantity' => 1
    ];
}

?>
