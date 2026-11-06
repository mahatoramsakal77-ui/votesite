<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>singup</title>
    <link rel="stylesheet" href="singup.css">
    <link rel="stylesheet" href="signup_responsive.css">

    <style>
        .container{
            margin-top: 0px;
        }
        .order_days{
            text-align: center;
            color: red;
            margin-bottom: 0px;
        }
        .container h3{
            text-align: center;
        }
        .container h3 span{
            color: red;
        }

        @media screen and (max-width: 768px){
        .order_days{
            font-size: 4vw;
        }
        .container h3{
            font-size: 4vw;
        }
        button[type='submit']{
            height: 8vw;
            font-size: 4vw;
        }

        }
    </style>

</head>
<body>
<?php
session_start();
error_reporting(E_ALL);
require_once "database/connection.php";

$product = null;
$total_price = 0;
$message = "";

if(isset($_GET['product_id'])){
  $id = (int) $_GET['product_id'];
  $sqlProduct = "SELECT * FROM products WHERE id = '$id'";
  $execute = mysqli_query($conn,$sqlProduct);
  $product = mysqli_fetch_array($execute);
}

if(isset($_POST['total']) || isset($_POST['buy'])){
   $id = (int) $_POST['product_id'];
   $product_quantity = (int) $_POST['nop'];

   if($product_quantity > 0){

    $sql = "SELECT title,price,stock FROM products WHERE id = ?";
    $stmt = mysqli_prepare($conn,$sql);
    $bind = mysqli_stmt_bind_param($stmt,"i",$id);
    $execute2 = mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $productData = mysqli_fetch_array($result);

    if($productData && $product_quantity <= $productData['stock']){
      $total_price = $product_quantity * $productData['price'];
    }else{
      echo "product not available";
    }
   }

  //  ....................................buying code
   if (isset($_POST['buy'])) {

    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != "user") {
        header("Location: login.php");
        exit;
    }

    if (!$productData || $product_quantity <= 0 ||
        $product_quantity > $productData['stock']) {
        die("Invalid quantity or product is out of stock.");
    }

    // Get trusted product details from database
    $product_id = $id;
    $product_title = $productData['title'];
    $product_price = $productData['price'];
    $total_price = $product_quantity * $product_price;

    $full_name = trim($_POST['name'] ?? '');
    $contact = trim($_POST['contact'] ?? '');
    $address = trim($_POST['address'] ?? '');

    if ($full_name == '' || $contact == '' || $address == '') {
        die("Please fill all required fields.");
    }

    mysqli_begin_transaction($conn);

    try {

        // 1. Insert order
        $sql_order = "INSERT INTO purchase_order
        (product_id, product_title, product_price, product_quantity,
        total_price, full_name, contact, address)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt_order = mysqli_prepare($conn, $sql_order);

        if (!$stmt_order) {
            throw new Exception(mysqli_error($conn));
        }

        mysqli_stmt_bind_param(
            $stmt_order,
            "isdidsss",
            $product_id,
            $product_title,
            $product_price,
            $product_quantity,
            $total_price,
            $full_name,
            $contact,
            $address
        );

        if (!mysqli_stmt_execute($stmt_order)) {
            throw new Exception(mysqli_stmt_error($stmt_order));
        }

        // 2. Get generated order ID immediately after INSERT
        $order_id = mysqli_insert_id($conn);

        if ($order_id <= 0) {
            throw new Exception("Order ID was not generated.");
        }

        mysqli_stmt_close($stmt_order);

        // 3. Update product stock
        $sql_product_update = "
            UPDATE products
            SET stock = stock - ?
            WHERE id = ? AND stock >= ?
        ";

        $stmt_product_update = mysqli_prepare($conn, $sql_product_update);

        if (!$stmt_product_update) {
            throw new Exception(mysqli_error($conn));
        }

        mysqli_stmt_bind_param(
            $stmt_product_update,
            "iii",
            $product_quantity,
            $product_id,
            $product_quantity
        );

        if (!mysqli_stmt_execute($stmt_product_update)) {
            throw new Exception(mysqli_stmt_error($stmt_product_update));
        }

        if (mysqli_stmt_affected_rows($stmt_product_update) != 1) {
            throw new Exception("Stock update failed.");
        }

        mysqli_stmt_close($stmt_product_update);

        // 4. Commit transaction
        mysqli_commit($conn);

        // 5. Store order ID in session
        $_SESSION['order_id'] = $order_id;

        // 6. Redirect
        header("Location: user/userOrderDetail.php");
        exit;

    } catch (Exception $e) {

        mysqli_rollback($conn);

        die("Order failed: " . $e->getMessage());
    }
}

}

  $sql_purchase = "SELECT * FROM purchase_order";
  $execute = mysqli_query($conn,$sql_purchase);
  $purchase_row = mysqli_fetch_assoc($execute);

?>

        <h2 class="order_days">Order Will Be Deliver Within 2 Days</h2>

      <div class="container">
        <h2>Confirmatin For Purchase </h2>
        <h3>Payment Method is <span>Cash on Delivery</span> </h3>
        <form action="?product_id=<?php echo $product['id'];?>" method="post">

        <input type="hidden" name="product_id" value="<?php echo $product['id'];?>">

        <div class="form-field">
            <label>Product Name</label>
            <input type="text" name="product_title" value="<?php echo htmlspecialchars($product['title']); ?>" readonly>
        </div>

        <div class="form-field">
            <label>Price Per Product</label>
            <input type="text" name="product_price" value="<?php echo htmlspecialchars($product['price']); ?>" readonly>
        </div>

        <div class="form-field">
            <label for="product">Number Of Product</label>
            <input type="number" name="nop" min="1" placeholder="Enter product quantity">
        </div>

        <div class="form-field">
            <label for="name">FullName</label>
            <input type="text" name="name" placeholder="Enter First name">
        </div>

        <div class="form-field">
            <label for="contact">Contact</label>
            <input type="contact" name="contact" placeholder="Enter contact">
        </div>

         <div class="form-field">
            <label for="address">Address</label>
            <textarea name="address"></textarea>
        </div>

       

         <div class="form-field">
          <button type="submit" name="total">Calculate Total</button>
          <input  type="submit" name="buy" value="Confirm Buying" >
        </div>

         <div class="form-field">
           <p>you can Login from here <a href="login.php">Login</a></p>
        </div>
       </form>
    <?php 
    if(isset($_POST['total']) && $total_price > 0){
      ?>
      <h2>Total Price : Rs. <?php echo $total_price;?></h2>
      <?php
    }
    // else{
    //   echo "please enter valid number";
    // }
    ?>
      </div>

</body>
</html>

