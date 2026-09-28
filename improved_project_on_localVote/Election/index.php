<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Election page</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="responsive.css">
     <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css"
      rel="stylesheet"
    />
</head>
<body>
  
   <section class="nav">
    <div class="left-nav">
      <img src="../Home/img/logo.png" alt="logo" class="nav-logo">
      <h2>Nepal<br><span>online voting system</span>
      </h2>
    </div>
    <div class="right-nav">
     <div class="menu">
       <ul class="menus">
        <li><a href="../Home/home.php">Home</a></li>
        <li><a href="#"  class="election-active">Election</a></li>
        <li><a href="../Candidate/index.php">Candidates</a></li>
        <li><a href="../Results/results.php#">Results</a></li>
        <li><a href="#contact">Contact</a></li>
        </ul>
        <button class="register" onclick="location.href='../form/regist.php'">Register</button>
         <?php if (isset($_SESSION['email'])) { ?>
            <!-- Show profile photo after login -->
            <img
                src="../form/<?php
                    echo htmlspecialchars(
                        $_SESSION['user_photo']
                    );
                ?>"
                onclick="location.href='../form/profile.php'"
                alt="Profile"
                class="nav-avatar"
            >
        <?php } else { ?>
            <!-- Show Login button when user is not logged in -->
            <button
                class="login"
                onclick="location.href='../form/login.php'">
                Login
            </button>
            <img
                src="../Home/img/avatar1.png"
                onclick="location.href='../form/login.php'"
                alt="Profile"
                class="nav-avatar" >

        <?php } ?>
        <i class="ri-menu-line burger"></i>
        <i class="ri-close-fill close"></i>
     </div>
    </div>
    </section>


     <section class="hero-section">
       <div class="left-hero">
        <h1>Elections</h1>
        <p>choose an election to view details,candidates and cast your vote for a better nepal</p>
      </div>
      <div class="right-hero">
        <img src="./img/votebox-removebg-preview.png" alt="votbox pic" class="votebox">
      </div>
     </section>

     <section class="election-type">
      <div class="local">
         <div class="demo-circle">
           <div class="dot"></div>
          <span>upcoming</span>
         </div>
        <h1>Local Election 2083</h1>
         <p>start : 2084-1-19</p>
         <p>Result : 2084-1-25</p>
         <p>Province : All Province</p>
         <p>Municipality : all Municipality</p>
         <p>Ward : All Ward</p>
      </div>

      <div class="province">
         <div class="demo-circle">
           <div class="dot"></div>
          <span>upcoming</span>
         </div>
        <h1>Province Election 2083</h1>
         <p>start  : 2083-09-03</p>
         <p>Result : 2083-09-09</p>
         <p>Province : All Province</p>
         <p>Municipality : All Municipality</p>
         <p>Ward : All Ward</p>
      </div>

      <div class="federal">
          <div class="demo-circle">
            <div class="dot"></div>
          <span>completed</span>
          </div>
        <h1>Federal Election 2082</h1>
        <p>start : 2082-11-21</p>
         <p>Province : All Province</p>
         <p>Municipality : All Municipality</p>
         <p>Ward : All Ward</p>
        <p>Winner : Ghanti Chhap</p>
      </div>
     </section>














       <section class="footer-up">
      <div class="main">
        <img src="../Home/img/logo.png" alt="logo">
        <h2>NEAPL</h2>
        <h4>online voting system</h4>
        <p>mpowring citizens through technology <br> for a better and transparent election</p>
        <i class="ri-facebook-circle-fill"></i>
        <i class="ri-instagram-line"></i>
        <i class="ri-youtube-fill"></i>
      </div>
      <div class="links">
        <h2>Quick Links</h2>
         <li><a href="#">Home</a></li>
        <li><a href="#">Election</a></li>
        <li><a href="#">Candidates</a></li>
        <li><a href="#">Results</a></li>
        <li><a href="#">Notices</a></li>
        <li><a href="#">FAQs</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Location</a></li>
      </div>
      <div class="contact" id="contact">
        <h2>Contact Us</h2>
        <li><a href="https://election.gov.np/"><i class="ri-map-pin-fill"></i>Election Commission Nepal,jnk</a></li>
       <li> <a href="#"><i class="ri-phone-line"></i>+977 410 524896</a></li>
       <li> <a href="#"><i class="ri-mail-line"></i>info@neaploffice.gov.np</a></li>
        <li><a href="#"><i class="ri-global-line"></i>www.nealoffice.gov.np</a></li>
      </div>

      <div class="download">
        <h1>Mobile App</h1>
        <a href="#"><img src="./img/getit-removebg-preview.png" alt="" class="getapp"></a>
      </div>
    </section>

    <footer>
     <div> <i class="ri-copyright-line"></i>2083 Nepal. All rights Reserved.</div>
    </footer>

    <script>
const burger = document.querySelector(".burger");
const close = document.querySelector(".close");
const menus = document.querySelector(".menus");


/* OPEN MENU */

burger.addEventListener("click", function () {

    menus.classList.add("active");

    burger.style.display = "none";

    close.style.display = "block";

});


/* CLOSE MENU */

close.addEventListener("click", function () {

    menus.classList.remove("active");

    close.style.display = "none";

    burger.style.display = "block";

});

    </script>
</body>
</html>