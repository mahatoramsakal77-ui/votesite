<?php
session_start();
require_once "database/connection.php";

$product = [];

if(isset($_GET['type'])){
  $type = $_GET['type'];
  
  $sql = "SELECT * FROM products WHERE product_type = ?";
  $stmt = mysqli_prepare($conn,$sql);
  $bind = mysqli_stmt_bind_param($stmt,"s",$type);
  $execute = mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt); 
  while($rows = mysqli_fetch_array($result)){
    $product[] = $rows;
  }

}
else{
   echo "<script>alert('something wrong in product !')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="see_style.css" >
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



  <!-- .............................   TRENDING CLOTHES ....................... -->
  <section class="trending-shorts">
   
    <div class="trending-samples">
      <!-- &#10094; prev -->
      <button class="prev"> &#10094 </button>

  <?php if (!empty($product)) { ?>

    <?php foreach ($product as $rows) { ?>

        <div class="slides">
            <img src="admin/<?php echo htmlspecialchars($rows['product_image']); ?>"alt="image"
            class="slide active">
        </div>

    <?php } ?>

<?php } else { ?>

    <p>No related products found.</p>

<?php } ?>
      <!-- &#10095; next -->
      <button class="next"> &#10095 </button>
    </div>
    <div class="dots">
    <?php foreach ($product as $index => $rows) { ?>
        <span class="dot <?php echo $index === 0 ? 'active' : ''; ?>"></span>
    <?php } ?>
</div>
  </section>


  
  <section class="detail">
      <?php 
        if(!empty($product))
       {
        // get the first product because previous were used
          $row = $product[0];
          ?>
    <div class="price_detail">
      <div class="left_detail">
      <h1> <?php echo $row['title']; ?> </h1>
      <div class="price">
        <h3 class="price">Price:  <?php echo $row['price']; ?></h3>
        <h3>Stock: <?php echo $row['stock']; ?> </h3>
      </div>
      <?php
        }
      ?>


      <div class="btn">
        <!-- <button class="carts-btn">addCarts</button> -->
        <?php if(!empty($product)){
            $row2 = $product[0];
          ?>
          <a href="carts_saved.php?product_id_carts=<?php echo $row2['id'];?>"><button class="carts-btn">addCarts</button></a>

          <a href="buy.php?product_id=<?php echo $row2['id'];?>"><button class="buy-btn">Buy</button></a>
          <?php
        }
        ?>
      </div>
    </div>

    <div class="right_detail">
      <h1>Customer Comments</h1>
      <ul>
        <li>I am more comfortable with it</li>
        <li>This is amazing quality fit my on body</li>
        <li>damn looking damnsl</li>
        <li>now I am trusting these qualities and websites</li>
        <li>I agree from all Customer</li>
      </ul>
    </div>
    </div>
   
  </section>


 
  <section class="footer">
    <div class="info">
      <h2>ShopingHere</h2>
      <ul>
        <li><a href="#">Facebook</a></li>
        <li><a href="#">TikTok</a></li>
        <li><a href="#">dail no: 983564543</a></li>
      </ul>
    </div>
  </section>











  <script>
    // --------------------burger menu
    const right_nav = document.querySelector(".right-nav");
    const burger_menu = document.querySelector(".burger-menu");

    burger_menu.addEventListener("click", () =>{
        right_nav.classList.toggle("show_right_nav");
        burger_menu.classList.toggle("show_right_nav");
    });

    // ......................image slides
    let slides = document.querySelectorAll(".slide");
    let dots = document.querySelectorAll(".dot");
    let index = 0;
    const prevbtn = document.querySelector(".prev");
    const nextbtn = document.querySelector(".next");

    function showSlide(i)
    {
      slides.forEach(slide => slide.classList.remove("active")); //removed active class
      dots.forEach(dot => dot.classList.remove("active"));
      slides[i].classList.add("active");//added active class
      dots[i].classList.add("active");
    }
//nextbtn
    nextbtn.addEventListener("click", () => {
      index = (index + 1) % slides.length;
      showSlide(index);
    });

    //prevbtn
    prevbtn.addEventListener("click", () => {
      index = (index - 1 + slides.length) % slides.length;
      showSlide(index);
    });

    setInterval(() => {
      index = (index + 1)% slides.length;
      showSlide(index);
    }, 2000);
  

  </script>
</body>
</html>