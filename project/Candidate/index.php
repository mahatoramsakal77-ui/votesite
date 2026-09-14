<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Candidate Page</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css" rel="stylesheet" />
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
          <li><a href="../Election/index.php">Election</a></li>
          <li><a href="#" class="active">Candidates</a></li>
          <li><a href="#">Results</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <button class="register">Register</button>
        <button class="login">Login</button>
        <img src="../Home/img/avatar1.png" alt="" class="nav-avatar">
        <i class="ri-menu-line burger"></i>
        <i class="ri-close-fill close"></i>
      </div>
  </section>

  <section class="search">
    <h1>See your Areas Candidates</h1>
    <form action="#">
      <label>Province</label>
      <select id="province">
        <option value="">Select Province</option>
        <option value="koshi">Koshi</option>
        <option value="madhesh">Madhesh</option>
        <option value="bagmati">Bagmati</option>
        <option value="gandaki">Gandaki</option>
        <option value="lumbani">Lumbani</option>
        <option value="sudurpaschim">Sudurpaschim</option>
        <option value="karnali">Karnali</option>
      </select>
      
      <label for="district">District</label>
      <select id="district" name="district">
        <option>Select District</option>
      </select>
     
      <label>Municipality</label>
      <select id="municipality">
        <option>Select Municipality</option>
      </select>

      <label>Ward</label>
      <select id="ward">
        <option>Select Ward</option>
      </select>

      <input type="submit" value="submit" name="info_submit" class="submit_btn">
    </form>
  </section>


  <section class="candidates">
    <div class="ward_4">
      <h1>The Candidates of Phulgam Nagrain Municipality ward 4</h1>
<!-- .......................................for mayer -->
      <div class="for_mayer">
         <h2>Candidates For Mayer Election</h2>
        <div class="mayer">
          <div class="one_candidate">
          <h2>Chandra Neupane</h2>
          <img src="./img/Anime.jfif" alt="" class="mayer_pic">
          <h3>party A</h3>
          <img src="./img/sun.jpg" alt="logo" class="mayer_chhap">
          <button type="submit">click here</button>
        </div>
      <div class="two_candidate">
          <h2>Aakash Gupta</h2>
          <img src="./img/BLUE 💙 LOVER.jfif" alt="" class="mayer_pic">
          <h3>party B</h3>
          <img src="./img/paddy.jpg" alt="logo" class="mayer_chhap">
          <button type="submit">click here</button>
        </div>
         <div class="three_candidate">
          <h2>Sadhu Mahato</h2>
          <img src="./img/Hark.png" alt="" class="mayer_pic">
          <h3>party B</h3>
          <img src="./img/paddy.jpg" alt="logo" class="mayer_chhap">
          <button type="submit">click here</button>
        </div>
        </div>
       </div>
       <!-- ..................................for deputy mayer -->
       <div class="for_deputy">
         <h2>Candidates For Deputy Mayer Election</h2>
        <div class="mayer">
          <div class="one_candidate">
          <h2>Rahul sah</h2>
          <img src="./img/Hark.png" alt="" class="mayer_pic">
          <h3>party A</h3>
          <img src="./img/sun.jpg" alt="logo" class="mayer_chhap">
          <button type="submit">click here</button>
        </div>
      <div class="two_candidate">
          <h2>Rajan Gupta</h2>
          <img src="./img/Hark.png" alt="" class="mayer_pic">
          <h3>party B</h3>
          <img src="./img/paddy.jpg" alt="logo" class="mayer_chhap">
          <button type="submit">click here</button>
        </div>
         <div class="three_candidate">
          <h2>Karan yadav</h2>
          <img src="./img/Hark.png" alt="" class="mayer_pic">
          <h3>party B</h3>
          <img src="./img/paddy.jpg" alt="logo" class="mayer_chhap">
          <button type="submit">click here</button>
        </div>
        </div>
       </div>
<!-- ...................................................for ward chairperson -->
       <div class="for_wardchairperson">
         <h2>Candidates For ward chairperson Election</h2>
        <div class="mayer">
          <div class="one_candidate">
          <h2>Prem Bhandari</h2>
          <img src="./img/Hark.png" alt="" class="mayer_pic">
          <h3>party A</h3>
          <img src="./img/sun.jpg" alt="logo" class="mayer_chhap">
          <button type="submit">click here</button>
        </div>
      <div class="two_candidate">
          <h2>Ravi Sah</h2>
          <img src="./img/Hark.png" alt="" class="mayer_pic">
          <h3>party B</h3>
          <img src="./img/paddy.jpg" alt="logo" class="mayer_chhap">
          <button type="submit">click here</button>
        </div>
         <div class="three_candidate">
          <h2>Deva Aacharya</h2>
          <img src="./img/Hark.png" alt="" class="mayer_pic">
          <h3>party B</h3>
          <img src="./img/paddy.jpg" alt="logo" class="mayer_chhap">
          <button type="submit">click here</button>
        </div>
        </div>
       </div>

    </div>
  </section>


  <section class="current">
    <h1>Current Government</h1>
    <div class="current_government">
      <div class="pm box">
        <h2>Prime Minister</h2>
        <img src="img/balen.jfif" alt="balen">
        <h2>Balendra Sah</h2>
        <span>Elected at 2083-02-91</span>
      </div>
      <div class="president box">
        <h2>President</h2>
        <img src="img/ram.jfif" alt="ramchandra">
        <h2>Ram Chandra Poundel</h2>
        <span>Elected at 2083-02-91</span>
      </div>
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
  </section>

  <footer>
    <div> <i class="ri-copyright-line"></i>2083 Nepal. All rights Reserved.</div>
  </footer>



  <script src="script.js"></script>
  <script>
    const vote_button = document.querySelectorAll('button[type="submit"]');
    
    vote_button.forEach(button => {
      button.addEventListener("click", (e) => {
          e.preventDefault();
        window.location.href = "http://localhost/project/form/regist.php";
      });
    });
  </script>
</body>

</html>