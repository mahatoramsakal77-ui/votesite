<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="product_style.css">
    
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
         .dashboard_sidebar li .admin a{
            position: absolute;
            bottom: 0%;
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


<?php
session_start();
require_once "../database/connection.php";

if(isset($_SESSION['user_id']))
    {   

        if($_SESSION['user_role'] == "admin"){

        $user_id = (int)$_GET['id'];

        $sql1 = "SELECT * FROM products WHERE id = ?";
        $stmt1 = mysqli_prepare($conn,$sql1);
              $bind1 = mysqli_stmt_bind_param($stmt1,"i",$user_id);
                $execute1 = mysqli_stmt_execute($stmt1);
                $result1 = mysqli_stmt_get_result($stmt1);
                $rows = mysqli_fetch_assoc($result1);  
                if(!$rows){
                    die("product not found");
                }
       

        if(isset($_POST['Update_product'])){
            $id = $_GET['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $product_type = $_POST['product_type'];
            
            $tempFile = $_FILES['product_image']['tmp_name'];
            $fileName = $_FILES['product_image']['name'];
            $foler = "update-image/".$fileName;
            
            $sql = "UPDATE products SET title = ?, description = ?, price = ?, stock = ?, product_image = ?, product_type = ? WHERE id = ? ";
            $stmt = mysqli_prepare($conn,$sql);
            if($stmt){
                $bind  = mysqli_stmt_bind_param($stmt,"ssiissi",$title,$description,$price,$stmt,$foler,$product_type,$user_id);
                mysqli_stmt_execute($stmt);
                move_uploaded_file($tempFile,$foler);
                mysqli_stmt_close($stmt);

                echo "updated successfully";
            }
            else{
                    echo "failed to update";
                }
             
                header("Location: orders.php");
                exit;
        }

        }
        else{
            header("Location: ../user/dashboard.php");
            exit;
            }
 } else{
        header("Location: ../login.php");
        exit;
    }


?>

    <section class="container">
        <h2>Update Product</h2>
        <form action="updateProduct.php?id=<?php echo $user_id; ?>" method="post" enctype="multipart/form-data">

            <div class="form-field">
                <label for="title">Title</label>
                <input type="text" name="title" value="<?php echo $rows['title']; ?>">
            </div>

            <div class="form-field">
                <label for="description">Description</label>
               <input type="text" name="description"  value="<?php echo $rows['description']; ?>">
            </div>

            <div class="form-field">
                <label for="price">Price</label>
                <input type="number" name="price"  value="<?php echo $rows['price']; ?>">
            </div>

            <div class="form-field">
                <label for="stock">Stock</label>
                <input type="number" name="stock"  value="<?php echo $rows['stock']; ?>">
            </div>

            <div class="form-field">
                <label for="product_image" class="product">Product Image</label>
                <input type="file" name="product_image" placeholder="Enter your photo" id="product_image"
                    accept=".jpg,.jpeg,.png,.webp">
                <br>
                <div class="img">
                    <img src="<?php echo htmlspecialchars($rows['product_image']); ?>" alt="product_image" class="product_image">
                </div>
            </div>

            <div class="form-field">
                <h2>Product_Type : <?php echo $rows['product_type']; ?>"</h2>
                <label for="price">Product Type</label>
                <select name="product_type">
                    <option value="Jeans">Jeans</option>
                    <option value="Tshirts">Tshirts</option>
                    <option value="Shorts">Shorts</option>
                    <option value="Shoes">Shoes</option>
                    <option value="Watches">Watches</option>
                    <option value="Undies">Undies</option>
                    <option value="Mobile">Mobile</option>
                    <option value="Costmetics">Costmetics</option>
                </select>
            </div>



            <div class="form-field">
                <input class="submit-btn" type="submit" name="Update_product" value="Update Product">
            </div>

            <div class="form-field">
                <p>you can signup from here <a href="singup.hmtl">Singup</a></p>
            </div>

        </form>
    </section>





    <script>
     // ..............................admin photo
      var admin = document.querySelector("input[type='file'][name='product_image']");
    var admin_photo = document.querySelector(".product_image");

    admin.onchange = () => {
      admin_photo.src = URL.createObjectURL(admin.files[0]);
    }
  </script>
</body>

</html>