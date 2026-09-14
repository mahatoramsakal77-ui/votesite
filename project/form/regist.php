<?php
session_start();
// storing register form's data into session and move to the file.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_SESSION['registration'] = [
        'fname' => $_POST['fname'],
        'mname' => $_POST['mname'],
        'lname' => $_POST['lname'],
        'gender' => $_POST['gender'],
        'tadd' => $_POST['tadd'],
        'padd' => $_POST['padd'],
        'father_name' => $_POST['father_name'],
        'mother_name' => $_POST['mother_name'],
        'grand_father_name' => $_POST['grand_father_name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'contact' => $_POST['contact']
    ];

    header("Location: file.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registraton Form</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validation()">
      <h2>Registration for Voting</h2>

      <div class="full-form">

        <div class="first-section-form">
        <div class="fname">
          <label for="fname">First Name</label>
          <input type="text" name="fname" placeholder="Enter your first name" />
          <p class="firstn"></p>
        </div>

        <div class="mname">
          <label for="mname">Middle Name</label>
          <input
            type="text"
            name="mname"
            placeholder="Enter your middle name"
          />
          <p class="middlen"></p>
        </div>

        <div class="lname">
          <label for="lname">Last Name</label>
          <input type="text" name="lname" placeholder="Enter your last name" />
          <p class="lastn"></p>
        </div>

        <div class="gender">
          <label for="gender">Gender: </label>
          <input type="radio" name="gender" value="male" class="gen" />Male
          <input type="radio" name="gender" value="female" class="gen"/>Female
          <input type="radio" name="gender" value="other" class="gen"/>Other
        </div>
        <p class="gen_error"></p>

        <div class="tadd">
          <label for="tadd">Temporary address </label>
          <input
            type="text"
            name="tadd"
            placeholder="Enter your temporary address"
          />
          <p class="t-add"></p>
        </div>

        <div class="padd">
          <label for="padd">parmanent address</label>
          <input
            type="text"
            name="padd"
            placeholder="Enter your parmanent address"
          />
        <p class="p-add"></p>
        </div>

          
        </div> 
        <!-- -------------------------------------------ending of first secion div  -->
        <div class="second-setion-form">
             <div class="father_name">
          <label for="father_name">father_name</label>
          <input
            type="text"
            name="father_name"
            placeholder="Enter your father name"
          />
          <p class="father_n"></p>
        </div>
           <div class="mother_name">
          <label for="mother_name">mother_name</label>
          <input
            type="text"
            name="mother_name"
            placeholder="Enter your mother name"
          />
          <p class="mother_n"></p>
        </div>
        <div class="grand_f_name">
          <label for="grand_father_name">grand_father_name</label>
          <input
            type="text"
            name="grand_father_name"
            placeholder="Enter your grand father name"
          />
          <p class="grand_father_n"></p>
        </div>
                    <div class="email">
          <label for="email">Email</label>
          <input
            type="email"
            name="email"
            placeholder="Enter your personal email"/>
            <p class="em"></p>
            </div>
          <div class="password">
          <label for="password">Password</label>
          <input
            type="password"
            name="password"
            placeholder="Enter your email password"
          />
          <p class="pswd"></p>
        </div>
        <div class="contact">
          <label for="contact">Contact No.</label>
          <input
            type="text"
            name="contact"
            placeholder="Enter your contact No."
          />
          <p class="cont"></p>
        </div>
        <!-- ------------------------------endiing of second secion  form div -->
       </div>
<!-- -------------------------------ending of full form div -->
        </div>


      <input type="submit" value="Next >" />
      <div class="log_in">
        <p>if already have Registeration then <a href="login.php">Login</a></p>
      </div>
    </form>

    <script src="script.js"></script>
  </body>
</html>




