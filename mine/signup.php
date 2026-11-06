<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>singup</title>
    <link rel="stylesheet" href="singup.css">
    <link rel="stylesheet" href="signup_responsive.css">
</head>
<body>
<?php
session_start();
require_once "database/connection.php";
// if(isset($_SESSION['user_role']== "admin")){
    
if(isset($_POST['signup'])){
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $user_role = "user";
    
    
    $sql = "INSERT INTO users(first_name,middle_name,last_name,email,password,contact,address,user_role)
    VALUES(?,?,?,?,?,?,?,?)";
    $stmt = mysqli_prepare($conn,$sql);
    if($stmt){
        mysqli_stmt_bind_param($stmt,'sssssiss',$fname,$mname,$lname,$email,$password,$contact,$address,$user_role);
        mysqli_stmt_execute($stmt);

        move_uploaded_file($tempFile,$foler);
        $_SESSION['status'] = 'success';
         echo "<script>alert('Singup successfull!!')</script>";
    }
    else{
        $_SESSION['status'] = 'failled';
            }
    header("Location: login.php");
    exit;
}

?>

      <div class="container">
        <h2>Signup Form</h2>
        <form action="" method="post">

        <div class="form-field">
            <label for="fname">FirstName</label>
            <input type="text" name="fname" placeholder="Enter First name">
        </div>

         <div class="form-field">
            <label for="mname">MiddleName</label>
            <input type="text" name="mname" placeholder="Enter middle name">
        </div>

         <div class="form-field">
            <label for="lname">LastName</label>
            <input type="text" name="lname" placeholder="Enter Last name">
        </div>

         <div class="form-field">
            <label for="email">email</label>
            <input type="text" name="email" placeholder="Enter your email">
        </div>

         <div class="form-field">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter password">
        </div>

        <div class="form-field">
            <label for="contact">Contact</label>
            <input type="contact" name="contact" placeholder="Enter contact">
        </div>

         <div class="form-field">
            <label for="address">Address</label>
            <textarea name="address"></textarea>
        </div>

       

         <div class="form-field">
            <input type="submit" name="signup"  value="Signup">
        </div>

         <div class="form-field">
           <p>you can Login from here <a href="login.php">Login</a></p>
        </div>
       </form>
    </div>

</body>
</html>