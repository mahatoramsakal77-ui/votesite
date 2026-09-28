<?php

session_start();
// 
// LOCATION SELECTION
// 

$location_selected = false;

$province = $_GET['province'] ?? '';
$district = $_GET['district'] ?? '';
$municipality = $_GET['municipality'] ?? '';
$ward = $_GET['ward'] ?? '';


// Check whether ALL location fields are selected
if (
    !empty($province) &&
    !empty($district) &&
    !empty($municipality) &&
    !empty($ward)
) {
    $location_selected = true;
}


// 
// AVAILABLE CANDIDATE LOCATION
// 

$candidate_province = "madhesh";
$candidate_district = "Dhanusha";
$candidate_municipality = "Nagarain Municipality";
$candidate_ward = "4";


// 
// CHECK WHETHER CANDIDATES EXIST FOR SELECTED LOCATION
// 

$show_candidates = false;

if (
    $location_selected &&
    $province === $candidate_province &&
    $district === $candidate_district &&
    $municipality === $candidate_municipality &&
    $ward === $candidate_ward
) {
    $show_candidates = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Candidate Page</title>

  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="responsive.css">

  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css"
    rel="stylesheet"
  />
</head>

<body>

  <!-- 
       NAVBAR
   -->

  <section class="nav">

    <div class="left-nav">

      <img
        src="../Home/img/logo.png"
        alt="logo"
        class="nav-logo"
      >

      <h2>
        Nepal<br>
        <span>online voting system</span>
      </h2>

    </div>


    <div class="right-nav">

      <div class="menu">

        <ul class="menus">

          <li>
            <a href="../Home/home.php">
              Home
            </a>
          </li>

          <li>
            <a href="../Election/index.php">
              Election
            </a>
          </li>

          <li>
            <a href="#" class="active">
              Candidates
            </a>
          </li>

          <li>
            <a href="../Results/results.php">
              Results
            </a>
          </li>

          <li>
            <a href="#contact">
              Contact
            </a>
          </li>

        </ul>


        <button
          class="register"
          onclick="location.href='../form/regist.php'"
        >
          Register
        </button>


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
                onclick="location.href='../form/login.php'"
            >
                Login
            </button>

            <img
                src="../Home/img/avatar1.png"
                onclick="location.href='../form/login.php'"
                alt="Profile"
                class="nav-avatar"
            >

        <?php } ?>


        <i class="ri-menu-line burger"></i>

        <i class="ri-close-fill close"></i>

      </div>

    </div>

  </section>



  <!-- 
       SEARCH
   -->

  <section class="search">

    <h1>
      See your Areas Candidates
    </h1>


    <form action="#" method="GET" id="locationForm">

      <label>
        Province
      </label>

      <select id="province" name="province" required>

        <option value="">
          Select Province
        </option>

        <option value="koshi">
          Koshi
        </option>

        <option value="madhesh">
          Madhesh
        </option>

        <option value="bagmati">
          Bagmati
        </option>

        <option value="gandaki">
          Gandaki
        </option>

        <option value="lumbani">
          Lumbani
        </option>

        <option value="sudurpaschim">
          Sudurpaschim
        </option>

        <option value="karnali">
          Karnali
        </option>

      </select>


      <label for="district">
        District
      </label>

      <select
        id="district"
        name="district"
        required
      >

        <option>
          Select District
        </option>

      </select>


      <label>
        Municipality
      </label>

      <select id="municipality" name="municipality" required>

        <option>
          Select Municipality
        </option>

      </select>


      <label>
        Ward
      </label>

      <select id="ward" name="ward" required>

        <option>
          Select Ward
        </option>

      </select>


      <input
        type="submit"
        value="submit"
        name="info_submit"
        class="submit_btn"
      >

    </form>

  </section>



  <!-- 
       CANDIDATES
   -->
<?php if ($show_candidates): ?>
  <section class="candidates">

    <div class="ward_4">

      <h1>
        The Candidates of Phulgam Nagrain Municipality ward 4
      </h1>


      <!-- 
           MAYOR
       -->

      <div class="for_mayer">

        <h2>
          Candidates For Mayer Election
        </h2>


        <div class="mayer">


          <!-- ================= CHANDRA ================= -->

          <div class="one_candidate">

            <h2>
              Chandra Neupane
            </h2>

            <img
              src="./img/ele1.jfif"
              alt=""
              class="mayer_pic"
            >

            <h3>
              Party A
            </h3>

            <img
              src="./img/sun.jpg"
              alt="logo"
              class="mayer_chhap"
            >


            <form
              action="voter_login.php"
              method="POST"
            >

              <input type="hidden" name="candidate_id" value="1">

              <input
                type="hidden"
                name="candidate_name"
                value="Chandra Neupane"
              >

              <input
                type="hidden"
                name="party_name"
                value="Party A"
              >

              <input
                type="hidden"
                name="position"
                value="Mayor"
              >

              <!-- LOCATION -->

              <input
                type="hidden"
                name="province"
                value="<?php echo htmlspecialchars($province); ?>"
              >

              <input
                type="hidden"
                name="district"
                value="<?php echo htmlspecialchars($district); ?>"
              >

              <input
                type="hidden"
                name="municipality"
                value="<?php echo htmlspecialchars($municipality); ?>"
              >

              <input
                type="hidden"
                name="ward"
                value="<?php echo htmlspecialchars($ward); ?>"
              >

              <button
                type="submit"
                name="select_candidate"
                class="vote_button"
              >
                Vote
              </button>

            </form>

          </div>



          <!-- ================= AAKASH ================= -->

          <div class="two_candidate">

            <h2>
              Aakash Gupta
            </h2>

            <img
              src="./img/phekan.jpeg"
              alt=""
              class="mayer_pic"
            >

            <h3>
              Party B
            </h3>

            <img
              src="./img/paddy.jpg"
              alt="logo"
              class="mayer_chhap"
            >


            <form
              action="voter_login.php"
              method="POST"
            >

              <input type="hidden" name="candidate_id" value="2">

              <input
                type="hidden"
                name="candidate_name"
                value="Aakash Gupta"
              >

              <input
                type="hidden"
                name="party_name"
                value="Party B"
              >

              <input
                type="hidden"
                name="position"
                value="Mayor"
              >

              <!-- LOCATION -->

              <input
                type="hidden"
                name="province"
                value="<?php echo htmlspecialchars($province); ?>"
              >

              <input
                type="hidden"
                name="district"
                value="<?php echo htmlspecialchars($district); ?>"
              >

              <input
                type="hidden"
                name="municipality"
                value="<?php echo htmlspecialchars($municipality); ?>"
              >

              <input
                type="hidden"
                name="ward"
                value="<?php echo htmlspecialchars($ward); ?>"
              >

              <button
                type="submit"
                name="select_candidate"
                class="vote_button"
              >
                Vote
              </button>

            </form>

          </div>



          <!-- ================= SADHU ================= -->

          <div class="three_candidate">

            <h2>
              Sadhu Mahato
            </h2>

            <img
              src="./img/image.png"
              alt=""
              class="mayer_pic"
            >

            <h3>
              Party B
            </h3>

            <img
              src="./img/paddy.jpg"
              alt="logo"
              class="mayer_chhap"
            >


            <form
              action="voter_login.php"
              method="POST"
            >

              <input type="hidden" name="candidate_id" value="3">

              <input
                type="hidden"
                name="candidate_name"
                value="Sadhu Mahato"
              >

              <input
                type="hidden"
                name="party_name"
                value="Party B"
              >

              <input
                type="hidden"
                name="position"
                value="Mayor"
              >

              <!-- LOCATION -->

              <input
                type="hidden"
                name="province"
                value="<?php echo htmlspecialchars($province); ?>"
              >

              <input
                type="hidden"
                name="district"
                value="<?php echo htmlspecialchars($district); ?>"
              >

              <input
                type="hidden"
                name="municipality"
                value="<?php echo htmlspecialchars($municipality); ?>"
              >

              <input
                type="hidden"
                name="ward"
                value="<?php echo htmlspecialchars($ward); ?>"
              >

              <button
                type="submit"
                name="select_candidate"
                class="vote_button"
              >
                Vote
              </button>

            </form>

          </div>

        </div>

      </div>



      <!-- 
           DEPUTY MAYOR
       -->

      <div class="for_deputy">

        <h2>
          Candidates For Deputy Mayer Election
        </h2>


        <div class="mayer">


          <!-- ================= RAHUL ================= -->

          <div class="one_candidate">

            <h2>
              Rahul Sah
            </h2>

            <img
              src="./img/ele2.jfif"
              alt=""
              class="mayer_pic"
            >

            <h3>
              Party A
            </h3>

            <img
              src="./img/sun.jpg"
              alt="logo"
              class="mayer_chhap"
            >


            <form
              action="voter_login.php"
              method="POST"
            >

              <input type="hidden" name="candidate_id" value="4">

              <input
                type="hidden"
                name="candidate_name"
                value="Rahul Sah"
              >

              <input
                type="hidden"
                name="party_name"
                value="Party A"
              >

              <input
                type="hidden"
                name="position"
                value="Deputy Mayor"
              >

              <!-- LOCATION -->

              <input
                type="hidden"
                name="province"
                value="<?php echo htmlspecialchars($province); ?>"
              >

              <input
                type="hidden"
                name="district"
                value="<?php echo htmlspecialchars($district); ?>"
              >

              <input
                type="hidden"
                name="municipality"
                value="<?php echo htmlspecialchars($municipality); ?>"
              >

              <input
                type="hidden"
                name="ward"
                value="<?php echo htmlspecialchars($ward); ?>"
              >

              <button
                type="submit"
                name="select_candidate"
                class="vote_button"
              >
                Vote
              </button>

            </form>

          </div>



          <!-- ================= RAJAN ================= -->

          <div class="two_candidate">

            <h2>
              Rajan Gupta
            </h2>

            <img
              src="./img/image.png"
              alt=""
              class="mayer_pic"
            >

            <h3>
              Party B
            </h3>

            <img
              src="./img/paddy.jpg"
              alt="logo"
              class="mayer_chhap"
            >


            <form
              action="voter_login.php"
              method="POST"
            >

              <input type="hidden" name="candidate_id" value="5">

              <input
                type="hidden"
                name="candidate_name"
                value="Rajan Gupta"
              >

              <input
                type="hidden"
                name="party_name"
                value="Party B"
              >

              <input
                type="hidden"
                name="position"
                value="Deputy Mayor"
              >

              <!-- LOCATION -->

              <input
                type="hidden"
                name="province"
                value="<?php echo htmlspecialchars($province); ?>"
              >

              <input
                type="hidden"
                name="district"
                value="<?php echo htmlspecialchars($district); ?>"
              >

              <input
                type="hidden"
                name="municipality"
                value="<?php echo htmlspecialchars($municipality); ?>"
              >

              <input
                type="hidden"
                name="ward"
                value="<?php echo htmlspecialchars($ward); ?>"
              >

              <button
                type="submit"
                name="select_candidate"
                class="vote_button"
              >
                Vote
              </button>

            </form>

          </div>



          <!-- ================= KARAN ================= -->

          <div class="three_candidate">

            <h2>
              Karan Yadav
            </h2>

            <img
              src="./img/Hark.png"
              alt=""
              class="mayer_pic"
            >

            <h3>
              Party B
            </h3>

            <img
              src="./img/paddy.jpg"
              alt="logo"
              class="mayer_chhap"
            >


            <form
              action="voter_login.php"
              method="POST"
            >

              <input type="hidden" name="candidate_id" value="6">

              <input
                type="hidden"
                name="candidate_name"
                value="Karan Yadav"
              >

              <input
                type="hidden"
                name="party_name"
                value="Party B"
              >

              <input
                type="hidden"
                name="position"
                value="Deputy Mayor"
              >

              <!-- LOCATION -->

              <input
                type="hidden"
                name="province"
                value="<?php echo htmlspecialchars($province); ?>"
              >

              <input
                type="hidden"
                name="district"
                value="<?php echo htmlspecialchars($district); ?>"
              >

              <input
                type="hidden"
                name="municipality"
                value="<?php echo htmlspecialchars($municipality); ?>"
              >

              <input
                type="hidden"
                name="ward"
                value="<?php echo htmlspecialchars($ward); ?>"
              >

              <button
                type="submit"
                name="select_candidate"
                class="vote_button"
              >
                Vote
              </button>

            </form>

          </div>

        </div>

      </div>



      <!-- 
           WARD CHAIRPERSON
       -->

      <div class="for_wardchairperson">

        <h2>
          Candidates For ward chairperson Election
        </h2>


        <div class="mayer">


          <!-- ================= PREM ================= -->

          <div class="one_candidate">

            <h2>
              Prem Bhandari
            </h2>

            <img
              src="./img/Hark.png"
              alt=""
              class="mayer_pic"
            >

            <h3>
              Party A
            </h3>

            <img
              src="./img/sun.jpg"
              alt="logo"
              class="mayer_chhap"
            >


            <form
              action="voter_login.php"
              method="POST"
            >

              <input type="hidden" name="candidate_id" value="7">

              <input
                type="hidden"
                name="candidate_name"
                value="Prem Bhandari"
              >

              <input
                type="hidden"
                name="party_name"
                value="Party A"
              >

              <input
                type="hidden"
                name="position"
                value="Ward Chairperson"
              >

              <!-- LOCATION -->

              <input
                type="hidden"
                name="province"
                value="<?php echo htmlspecialchars($province); ?>"
              >

              <input
                type="hidden"
                name="district"
                value="<?php echo htmlspecialchars($district); ?>"
              >

              <input
                type="hidden"
                name="municipality"
                value="<?php echo htmlspecialchars($municipality); ?>"
              >

              <input
                type="hidden"
                name="ward"
                value="<?php echo htmlspecialchars($ward); ?>"
              >

              <button
                type="submit"
                name="select_candidate"
                class="vote_button"
              >
                Vote
              </button>

            </form>

          </div>



          <!-- ================= RAVI ================= -->

          <div class="two_candidate">

            <h2>
              Ravi Sah
            </h2>

            <img
              src="./img/Hark.png"
              alt=""
              class="mayer_pic"
            >

            <h3>
              Party B
            </h3>

            <img
              src="./img/paddy.jpg"
              alt="logo"
              class="mayer_chhap"
            >


            <form
              action="voter_login.php"
              method="POST"
            >

              <input type="hidden" name="candidate_id" value="8">

              <input
                type="hidden"
                name="candidate_name"
                value="Ravi Sah"
              >

              <input
                type="hidden"
                name="party_name"
                value="Party B"
              >

              <input
                type="hidden"
                name="position"
                value="Ward Chairperson"
              >

              <!-- LOCATION -->

              <input
                type="hidden"
                name="province"
                value="<?php echo htmlspecialchars($province); ?>"
              >

              <input
                type="hidden"
                name="district"
                value="<?php echo htmlspecialchars($district); ?>"
              >

              <input
                type="hidden"
                name="municipality"
                value="<?php echo htmlspecialchars($municipality); ?>"
              >

              <input
                type="hidden"
                name="ward"
                value="<?ph echo htmlspecialchars($ward); ?>"
              >

              <button
                type="submit"
                name="select_candidate"
                class="vote_button"
              >
                Vote
              </button>

            </form>

          </div>



          <!-- ================= DEVA ================= -->

          <div class="three_candidate">

            <h2>
              Deva Aacharya
            </h2>

            <img
              src="./img/Hark.png"
              alt=""
              class="mayer_pic"
            >

            <h3>
              Party B
            </h3>

            <img
              src="./img/paddy.jpg"
              alt="logo"
              class="mayer_chhap"
            >


            <form
              action="voter_login.php"
              method="POST"
            >

              <input type="hidden" name="candidate_id" value="9">

              <input
                type="hidden"
                name="candidate_name"
                value="Deva Aacharya"
              >

              <input
                type="hidden"
                name="party_name"
                value="Party B"
              >

              <input
                type="hidden"
                name="position"
                value="Ward Chairperson"
              >

              <!-- LOCATION -->

              <input
                type="hidden"
                name="province"
                value="<?php echo htmlspecialchars($province); ?>"
              >

              <input
                type="hidden"
                name="district"
                value="<?php echo htmlspecialchars($district); ?>"
              >

              <input
                type="hidden"
                name="municipality"
                value="<?php echo htmlspecialchars($municipality); ?>"
              >

              <input
                type="hidden"
                name="ward"
                value="<?php echo htmlspecialchars($ward); ?>"
              >

              <button
                type="submit"
                name="select_candidate"
                class="vote_button"
              >
                Vote
              </button>

            </form>

          </div>

        </div>

      </div>

    </div>

  </section>
  <?php else: ?>

<section class="candidates">

    <div class="no_candidates">

        <?php if (!$location_selected): ?>

            <h2>
                Please select your location
            </h2>

            <p>
                Select Province, District, Municipality and Ward
                to see the candidates.
            </p>

        <?php else: ?>

            <h2>
                No candidates available
            </h2>

            <p>
                There are no candidates available for
                <?php echo htmlspecialchars($province); ?>,
                <?php echo htmlspecialchars($district); ?>,
                <?php echo htmlspecialchars($municipality); ?>,
                Ward <?php echo htmlspecialchars($ward); ?>.
            </p>

        <?php endif; ?>

    </div>

</section>

<?php endif; ?>


  <!-- 
       CURRENT GOVERNMENT
   -->

  <section class="current">

    <h1>
      Current Government
    </h1>


    <div class="current_government">

      <div class="pm box">

        <h2>
          Prime Minister
        </h2>

        <img
          src="img/balen.jfif"
          alt="balen"
        >

        <h2>
          Balendra Sah
        </h2>

        <span>
          Elected at 2083-02-91
        </span>

      </div>


      <div class="president box">

        <h2>
          President
        </h2>

        <img
          src="img/ram.jfif"
          alt="ramchandra"
        >

        <h2>
          Ram Chandra Poundel
        </h2>

        <span>
          Elected at 2083-02-91
        </span>

      </div>

    </div>

  </section>



  <!-- 
       FOOTER
   -->

  <section class="footer-up">

    <div class="main">

      <img
        src="../Home/img/logo.png"
        alt="logo"
      >

      <h2>
        NEAPL
      </h2>

      <h4>
        online voting system
      </h4>

      <p>
        mpowring citizens through technology
        <br>
        for a better and transparent election
      </p>


      <i class="ri-facebook-circle-fill"></i>

      <i class="ri-instagram-line"></i>

      <i class="ri-youtube-fill"></i>

    </div>



    <div class="links">

      <h2>
        Quick Links
      </h2>

      <li>
        <a href="#">
          Home
        </a>
      </li>

      <li>
        <a href="#">
          Election
        </a>
      </li>

      <li>
        <a href="#">
          Candidates
        </a>
      </li>

      <li>
        <a href="../Results/results.php">
          Results
        </a>
      </li>

      <li>
        <a href="#">
          Notices
        </a>
      </li>

      <li>
        <a href="#">
          FAQs
        </a>
      </li>

      <li>
        <a href="#contact">
          Contact
        </a>
      </li>

      <li>
        <a href="#">
          Location
        </a>
      </li>

    </div>



    <div
      class="contact"
      id="contact"
    >

      <h2>
        Contact Us
      </h2>

      <li>

        <a href="https://election.gov.np/">

          <i class="ri-map-pin-fill"></i>

          Election Commission Nepal, jnk

        </a>

      </li>


      <li>

        <a href="#">

          <i class="ri-phone-line"></i>

          +977 410 524896

        </a>

      </li>


      <li>

        <a href="#">

          <i class="ri-mail-line"></i>

          info@neaploffice.gov.np

        </a>

      </li>


      <li>

        <a href="#">

          <i class="ri-global-line"></i>

          www.nealoffice.gov.np

        </a>

      </li>

    </div>

  </section>



  <footer>

    <div>

      <i class="ri-copyright-line"></i>

      2083 Nepal. All rights Reserved.

    </div>

  </footer>



  <!-- 
       YOUR EXISTING JAVASCRIPT
   -->

  <script src="script.js"></script>


  <script>
const burger = document.querySelector(".burger");
const close = document.querySelector(".close");
const menus = document.querySelector(".menus");


/* =========================
   OPEN MOBILE MENU
========================= */

if (burger) {

    burger.addEventListener("click", function () {

        menus.classList.add("active");

        burger.style.display = "none";

        close.style.display = "block";

    });

}
/* =========================
   CLOSE MOBILE MENU
========================= */

if (close) {

    close.addEventListener("click", function () {

        menus.classList.remove("active");

        close.style.display = "none";

        burger.style.display = "block";

    });

}

  </script>


</body>

</html>

