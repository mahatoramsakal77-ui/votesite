<?php
session_start();
require_once 'database/connection.php';

$sql = "SELECT * FROM products";
$stmt = mysqli_prepare($conn,$sql);
$execute = mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
// $rows = mysqli_fetch_array($result);


// $searchResult = null;

if(isset($_POST['search_btn'])){
    $search = $_POST['search'];

    $sql = "SELECT * FROM products WHERE product_type LIKE ? ";
    $stmt = mysqli_prepare($conn,$sql);
  
    $searchValue = "%".$search."%";
    mysqli_stmt_bind_param($stmt,"s",$searchValue);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <nav>
            <div class="nav">
                <div class="left-nav">
                    <h1><a href="index.php">shopHere</a></h1>
                </div>
                <div class="center-nav">
                    <form action="" method="post">
                        <input type="search" name="search" placeholder="search here!!">
                        <input type="submit" name="search_btn" value="search">
                    </form>
                </div>

                <div class="right-nav">
                    <ul>
                    
                        <?php if(!isset($_SESSION['user_id'])){  ?>
                        <li><a href="login.php" class="login_nav">Login</a></li>
                        <li><a href="signup.php">Signup</a></li>
                    <?php
                        } else{ ?>
                            <li><a href="logout.php">Logout</a></li>
                           
                            <?php if($_SESSION['user_role'] == "user"){
                                ?>
                                 <li><a href="user/dashboard.php">Dashboard</a></li>
                                 <?php
                            }else{
                                ?>
                                 <li><a href="admin/dashboard.php">Dashboard</a></li>
                                 <?php
                            }
                                ?>
                            <?php
                        }  
                        ?>

                        <li><a href="carts_display.php">Carts</a></li>
                    </ul>
                </div>
                <!-- .............burger -->
                    <div class="burger-menu">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                <!-- end of burger -->

            </div>
        </nav>
    </header>
  

     <div class="collection-fits">
    <?php
        if(mysqli_num_rows($result) > 0){
             while($rows = mysqli_fetch_array($result)){
      ?>
        <div class="sample">
         <h2><?php echo $rows['title'];?></h2>
        <img src="admin/<?php echo htmlspecialchars($rows['product_image'])  ?>" alt="">
       <p>Description : <span> <?php echo $rows['description'];?></span>  </p>
          <p>Stock : <span> <?php echo $rows['stock'];?></span> </p>
          <p>Price : <span> <?php echo $rows['price'];?></span> </p>
          <a href="see.php?type=<?php echo $rows['product_type']; ?>"><button>See More</button></a>
         </div>
    <?php 
        }
    }else{
        echo "no related product found !!";
    }
    ?>
    </div>
    
   





    
  <div class="footer">
    <div class="info">
      <h2>ShopingHere</h2>
      <ul>
        <li><a href="#">Facebook</a></li>
        <li><a href="#">TikTok</a></li>
        <li><a href="#">dail no: 983564543</a></li>
      </ul>
    </div>
  </div>


  <script>
    const right_nav = document.querySelector(".right-nav");
    const burger_menu = document.querySelector(".burger-menu");

    burger_menu.addEventListener("click", () =>{
        right_nav.classList.toggle("show_right_nav");
        burger_menu.classList.toggle("show_right_nav");
    });
  </script>


</body>
</html>
