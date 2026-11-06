<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            /* background-color: black; */
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
         .dashbord_main{
            padding: 30px;
            margin-left: 200px;
         }
             .dashboard_sidebar ul  .admin {
            position: absolute;
            bottom: 0%;
            text-align: center;
        }


        


/* ............................singup responsive */
@media screen and (max-width: 768px){


.back_btn button{
    height: 10vw;
    width: 20vw;
    font-size: 4vw;
    border-radius: 5px;
}
.container
{

    transform: translate(0%, 0%);
    width: 100%;    
    border-radius: 10px;
}

.container h2{
    margin-bottom: 10px;
    font-size: 4vw;
}

.form-field input{
    height: 8vw;
    font-size: 3vw;
}

.form-field input[type='submit']{
    font-size: 4vw;
}

.form-field p{
    font-size: 2.5vw;
}
.form-field p a{
    font-size: 2.5vw;
}
label{
    font-size: 3vw;
}


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
            
        if(isset($_POST['Add_product'])){
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $product_type = $_POST['product_type'];
            
            $tempFile = $_FILES['product_image']['tmp_name'];
            $fileName = $_FILES['product_image']['name'];
            $foler = "product-image/".$fileName;
            
            $sql = "INSERT INTO products(title,description,price,stock,product_image,product_type)
            VALUES(?,?,?,?,?,?)";
            $stmt = mysqli_prepare($conn,$sql);
            if($stmt){
                mysqli_stmt_bind_param($stmt,'ssiiss',$title,$description,$price,$stock,$foler,$product_type);
                mysqli_stmt_execute($stmt);

                move_uploaded_file($tempFile,$foler);
                $_SESSION['status'] = 'success';
            }
            else{
                $_SESSION['status'] = 'failled';
                    }
            header("Location: ".$_SERVER['PHP_SELF']);
            exit;
        }

        }else{
                     header("Location: ../user/dashboard.php");
       exit;
            }
            


    }else{
        header("Location: ../login.php");
        exit;
    }
    
    if(isset($_SESSION['status'])){
        if($_SESSION['status'] == 'success'){
            echo "Added success";
            unset($_SESSION['status']);
        }
        else{
            echo "Error---";
            unset($_SESSION['status']);
        }
    }



?>

    <section class="container">
        <h2>Add Product</h2>
        <form action="addProduct.php" method="post" enctype="multipart/form-data">

            <div class="form-field">
                <label for="title">Title</label>
                <input type="text" name="title" placeholder="Enter product">
            </div>

            <div class="form-field">
                <label for="description">Description</label>
                <input type="text" name="description" placeholder="Enter product description">
            </div>

            <div class="form-field">
                <label for="price">Price</label>
                <input type="number" name="price" placeholder="Enter product price">
            </div>

            <div class="form-field">
                <label for="stock">Stock</label>
                <input type="number" name="stock" placeholder="Enter product stock">
            </div>

            <div class="form-field">
                <label for="product_image" class="product">Product Image</label>
                <input type="file" name="product_image" placeholder="Enter your photo" id="product_image"
                    accept=".jpg,.jpeg,.png,.webp,jfif">
                <br>
                <div class="img">
                    <img src="" alt="product_image" class="product_image">
                </div>
            </div>

            <div class="form-field">
                <label for="price">Product Type</label>
                <select name="product_type">
                    <option value="Jeans">Jeans</option>
                    <option value="Tshirts">Tshirts</option>
                    <option value="Shorts">Shorts</option>
                    <option value="Paints">Paints</option>
                    <option value="Shoes">Shoes</option>
                    <option value="Watches">Watches</option>
                    <option value="Undies">Undies</option>
                    <option value="Mobile">Mobile</option>
                    <option value="Costmetics">Costmetics</option>
                </select>
            </div>



            <div class="form-field">
                <input class="submit-btn" type="submit" name="Add_product" value="Add Product">
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