<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <style>
    body{
      background-color: rgba(116, 108, 108, 0.116);
    }
    .voter_profile
    {
      background-color: white;
      width: 60%;

      padding-top: 3vh;
      padding-bottom: 3vh;

      margin: auto;
      z-index: 100000;
    }
   .profile
  {
    text-align: center;
  }
  .profile span
  {
    font-size: 15px;
  }
  .profile img
  {
    width: 100px;
    height: 100px;
    border-radius: 50%;
  }


  .document
  {
    display: flex;
        justify-content: center;
    align-items: center;
    gap: 50px;
  }
  .document h2 , p
  {
    text-align: center;
    /* margin: auto; */
  }
  .document img
  {
     width: 200px;
    height: 200px;
  }
  .voter_profile a{
   text-align: center;
  }
  .back-home{
    text-align: center;
    margin-top: 30px;
  }
  button
  {
    padding: 2vh 4vh;
    background-color: rgba(117, 105, 240, 0.92);
    font-size: 18px;
    border-radius: 10px;
    color: white;
    cursor: pointer;
  }
  </style>
</head>
<body>
  
 
  <section class="voter_profile">

    <div class="profile">
       <img src="<?php echo htmlspecialchars($_SESSION['user_photo']); ?>" alt="profile"> 
        <h2> <?php echo htmlspecialchars($_SESSION['user_name']); ?> <br><span> <?php echo htmlspecialchars($_SESSION['email']); ?></span></h2>
       <p>status <input type="checkbox" name="vote_status" value="voted"></p>
    </div>

    <div class="document">
     <div class="citizenship_front">
       <h2>Citizenship Card</h2>
      <img src="<?php echo htmlspecialchars($_SESSION['citizen_card']); ?>" alt=""> <img src="<?php echo htmlspecialchars($_SESSION['citizen_card']); ?>" alt="">
      <p>citizenship number :  <?php echo htmlspecialchars($_SESSION['citizen_card_number']); ?> </p>
     </div>

      <div class="voterid">
       <h2>Voter Id</h2>
        <img src="<?php echo htmlspecialchars($_SESSION['voter_id']); ?>" alt="">
       <p>voter id number : <?php echo htmlspecialchars($_SESSION['voter_id_number']);?> </p>
    </div>
      
    </div>
 
     <div class="back-home">
    <a href="../Home/home.php">
        <button>Back to Home</button>
    </a>
    </div>
  </section>

</body>
</html>
