<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="style.css">
     <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css"
      rel="stylesheet"
    />
</head>
<body>
  
  <section class="nav">
    <div class="left-nav">
      <img src="img/logo.png" alt="logo" class="nav-logo">
      <h2>Nepal<br><span>online voting system</span>
      </h2>
      
    </div>
    <div class="right-nav">
     <div class="menu">
       <ul class="menus">
        <li><a href="#">Home</a></li>
        <li><a href="../Election/index.php">Election</a></li>
        <li><a href="../Candidate/index.php">Candidates</a></li>
        <li><a href="#">Results</a></li>
        <li><a href="#contact">Contact</a></li>
        </ul>
        <button class="register" onclick="location.href='../form/regist.php'">Register</button>
        <button class="login" onclick="location.href='../form/login.php'">Login</button>
        <img src="img/avatar1.png" onclick="location.href='../form/profile.php'" alt="profile" class="nav-avatar">
        <i class="ri-menu-line burger"></i>
        <i class="ri-close-fill close"></i>
     </div>
      
    </div>
  </section>

    <section class="hero">
            <!-- <img src="img/mountian.jfif" alt="" class="mountain-img"> -->
        <div class="left-hero">
      <h2>Welcome to</h2>
      <h1>NEPAL <br> ONLINE VOTING SYSTEM</h1>
        <a href="https://en.wikipedia.org/wiki/Nepali_language"><i class="ri-map-pin-fill">nepal</i></a>
        <p class="hero-paragraph">A secure,transparent and reliable platform for local elections. <br>Your vote is your voice for a better Nepal</p>
        <button class="hero-button" onclick="location.href='../form/login.php'">Login to vote</button>
        <button class="hero-button register" onclick="location.href='../form/regist.php'">Register as voter</button>
      </div>

       <div class="right-hero">
        <img src="img/mountian.jfif" alt="" class="hero-nepaloffice">
      </div>
    </section>

    <section class="notices">
      <div class="left">
          <h1><i class="ri-megaphone-line"></i>Important Notices</h1>
          <li><i class="ri-arrow-right-long-line"></i>Voter Registeration is open now</li>
          <li><i class="ri-arrow-right-long-line"></i>Voting will start from 2083/05/05</li>
          <li><i class="ri-arrow-right-long-line"></i>Make sure your details are correct</li>
          <li><i class="ri-arrow-right-long-line"></i>One person,one vote</li>
          <a href="#"><i class="ri-arrow-right-long-line"></i>view all notices</a>
      </div>
      <div class="right">
        <h1>Election Countdown <i class="ri-timer-flash-line"></i></h1>
        <p>Local Election 2083</p>
        <div class="boxes">
          <div class="box">           
            45<br>Days
          </div>
        <div class="box">4<br>Hour</div>
        <div class="box">54<br>Minutes</div>
        <div class="box"> 3<br>Seconds</div>
        </div>
      </div>
    </section>

    <section class="nepal_overview">
      <h1>Nepal Overview</h1>
      <div class="slide">
        <div class="boxes2">
        <div class="box">AREA <br>147517 s.q.</div>
       <div class="box">DISTRICT  <br>77</div>
       <div class="box">PROVINCE <br>7</div>
       <div class="box">SUB-METORPOLITAN  <br>11</div>
       <div class="box">METROPOLITAN <br>6</div>
       <div class="box">MINICIPALITY <br>276</div>
       <div class="box"> RURAL MUNICIPALITY <br> 460 </div>
       <div class="box">LOCAL LEVEL <br>753</div>
       <div class="box">WARD <br> 6743</div>
      </div>
      </div>
    </section>

    <section class="election_property">
      <div class="left-properties">
        <h2>ABOUT OUR ELECTION</h2>
        <span>Your Vote,Your Future</span>
        <p>This is online voting system design that every <br> neplese person can vote from anywhere.<br>
          It is completely secure,transparent and reliable.
        </p>
        <span>Make Your Government</span>
      </div>
      <div class="right-properties">
        <div class="box-secure">
          <i class="ri-shield-line"></i>
          <h2>Secure</h2>
          <p>advanced security measure to protect your vote and detail</p>
        </div>
        <div class="box-private">
          <i class="ri-lock-2-fill"></i>
          <h2>Private</h2>
          <p>Your identity and vote are always kept safe</p>
        </div>
        <div class="box-transparent">
          <i class="ri-search-eye-line"></i>
          <h2>Transparent</h2>
          <p>Real-time result and election clear process</p>
        </div>
        <div class="box-easy">
          <i class="ri-time-line"></i>
          <h2>Easy and Fast</h2>
          <p>simple step to vote from anywhere and anytime when vote has started</p>
        </div>
      </div>
    </section>

    <section class="footer-up">
      <div class="main">
        <img src="img/logo.png" alt="logo">
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
  </body>
</html>
