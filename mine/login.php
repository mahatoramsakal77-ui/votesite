<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login_style.css">
</head>
<body>

<?php
session_start();
error_reporting(0);
require_once "database/connection.php";
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ? ";
    $stmt = mysqli_prepare($conn,$sql);
    if($stmt){
        $bind = mysqli_stmt_bind_param($stmt,'s',$email);
        $execute = mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        if($password == $row['password']){

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_role'] = $row['user_role'];
        $_SESSION['fname'] = $row['first_name'];
        $_SESSION['mname'] = $row['middle_name'];
        $_SESSION['lname'] = $row['last_name'];
        $_SESSION['contact'] = $row['contact'];
        $_SESSION['address'] = $row['address'];

         echo "<script>alert('login sucessfull !!')</script>";

        if($_SESSION['user_role'] == "admin"){
            header("Location: admin/dashboard.php");
            exit;
        }else{
            header("Location: index.php");
            exit;
        }
            
        }
        else{
            echo "<script>alert('Error Password!!')</script>";
        }
    }else{
         echo "<script>alert('something goes wrong in SQL!')</script>";
    }
    
}

?>
    
    <div class="container">
        <h2>Login Form</h2>
        <form action="" method="post">

        <div class="form-field">
            <label for="username">Username/Email</label>
            <input type="text" name="email" placeholder="Enter email or name">
        </div>

         <div class="form-field">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter password">

             <div class="forget">
            <button>Password Forget</button>
        </div>

        </div>

       

         <div class="form-field">
            <input type="submit" name="login"  value="Login">
        </div>

         <div class="form-field">
           <p>you can signup from here <a href="signup.php">Singup</a></p>
        </div>
       </form>
    </div>


</body>
</html>