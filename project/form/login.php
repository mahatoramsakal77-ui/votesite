
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login page</title>
  <style>
    form h2
    {
      text-align: center;
    }

    body
    {
      background-color: rgba(116, 108, 108, 0.116);
    }
    form
    {
    position: relative;
    width: 40%;
    margin: auto;
    background-color: white;
    padding: 1vh;
    padding-left: 1vw;
    padding-right: 1.5vw;
    font-size: 18px;
    z-index: 10000;
    margin-top: 50px;
    border-radius: 10px;
    }

    .log_in_form
    {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }
    form .log_in_form input
    {
      width: 100%;
      height: 35px;
      border: 1px solid black;
      border-radius: 5px;
      padding-left: 0.5vw;
    }
   

     input[type = 'submit']
    {
      width: 100%;
     height: 40px;
     font-size: 20px;
     cursor: pointer;
     background-color: rgba(65, 105, 225, 0.712);
     color: white;
    }
    input[type = 'submit']:hover
    {
       background-color: royalblue; 
    }

    .forget_password 
    {
      text-align: right;
      font-size: 12px;
      text-decoration: none;
    }

    .register
    {
      margin-top: 20px;
      text-align: center;
      text-decoration: none;
    }
  </style>  
</head>
<body>
  
  <form action="" method="post">
    <h2>Login Form</h2>

    <div class="log_in_form">
      <div class="email">
        <label for="email">Username</label>
        <input type="text" name="username" id="email" placeholder="Enter your username">
      </div>

      <div class="password">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter your password">
      </div>

       <div class="voter_id_number">
          <label for="voter_id_number">Voter ID Number</label>
          <input type="number" name="voter_id_number" id="voter_id_number" placeholder="Voter ID Number">
        </div>

        <div class="forget_password">
          <a href="forget_password.php">Forget Password</a>
        </div>

        <input type="submit" value="Login" name="login" class="btn">
      </div>

      <div class="register">
          <p>if you don't have Registeration ? click on <a href="regist.php">Register</a></p>
        </div>
  </form>
  

</body>
</html>
<?php
// session_start();

include("conection.php");

if(isset($_POST['login']))
  {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $voter_id_number = $_POST['voter_id_number'];

    $login_query = "SELECT * FROM voter_register_table where email='$username'&& password='$password'&& voter_id_number='$voter_id_number'";

    $run_login = mysqli_query($conn,$login_query);

    $rows = mysqli_num_rows($run_login);
    
    if($rows == 1)
      {
        // echo "<script> alert('login success')</script>";
        
        // $_SESSION["user_name"] = $username;
        // header("location:../Home/home.php");

         $row = mysqli_fetch_assoc($run_login);

        // CREATE LOGIN SESSION
        $_SESSION['user_name'] = $row['first_name'] . " " .
                                 $row['middle_name'] . " " .
                                 $row['last_name'];
         $_SESSION['email'] = $row['email'];          

        $_SESSION['user_photo'] = $row['user_photo'];

        $_SESSION['citizen_card'] = $row['citizenship_card'];
        $_SESSION['citizen_card_number'] = $row['citizen_card_number'];

        $_SESSION['voter_id'] = $row['voter_id'];
        $_SESSION['voter_id_number'] = $row['voter_id_number'];
        

        // Go to profile
        header("Location: ../Home/home.php");
        exit();
      }
      else
        {
          echo "<script> alert('failed login')</script>";
        }
  }

?>