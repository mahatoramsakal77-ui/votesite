<?php
session_start();

if (!isset($_SESSION['registration'])) {
    header("Location: regist.php");
    exit();
}

include("inserted_into_database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body
    {
      background-color: rgba(116, 108, 108, 0.116);
    }
    form
    {
      width: 50%;
      border: 0.0001px solid white;
      border-radius: 10px;
      margin: auto;
      padding: 2vh 1vw;

      background-color: white;
      z-index: 10000;
    }
    form h2
    {
      text-align: center;
    }
    .u_photo , .citizen_card , .voter_id
    {
      text-align: center;
      font-size: 20px;
    
    }
    #user_photo, #citizen_card , #voter_id, label
    {
      cursor: pointer;
    }
     #user_photo, #citizen_card , #voter_id
    {
      display: none;
    }
   .user_image, .user_citizen_card , .user_voter_id
    {
      width: 200px;
      height: 200px;
      border: 1px solid black;
      border-radius: 10%;
      object-fit: cover;
      margin-top: 30px;
      /* margin-bottom: 30px; */

    }
    .user_citizen_card, .user_voter_id
    {
      width: 300px;
    }
  
    .citizen_card_number , .voter_id_number label
    {
      font-size: 18px;
          }
    form input
    {
     height: 35px;
     width: 50%;
     border: 1px solid black;
     border-radius: 5px;
    }

    input[type = 'submit']
    {
      width: 100%;
     height: 40px;
     font-size: 20px;
     cursor: pointer;
     background-color: white;
    }
    input[type = 'submit']:hover
    {
      background-color: rgba(116, 108, 108, 0.116);
      /* color: white; */
    }

    form p
    {
      margin-bottom: 20px;
      color: red;
      text-align: center;
    }

  </style>
</head>
<body>
  

  <form action="" method="post" enctype="multipart/form-data" onsubmit="return validation()">
   <h2>Registration for Voting</h2>
      <div class="u_photo">
          <label for="user_photo" id="file_label_center">Uplaod your photo</label>
          <input type="file" name="user_photo" id="user_photo" class="user_file"/>
         <div> <img src="" alt="pp size photo" class="user_image"></div>
         <p class="photo_err"></p>
        </div>

         <div class="citizen_card_number">
          <label for="citizen_card_number">citizen_card_number : </label>
          <input type="number" name="citizenship_card_number" />
          <p class="citizen_num_err"></p>
        </div>

        <div class="citizen_card">
          <label for="citizen_card">Upload Citizenship card</label>
          <input type="file" name="citizen_card" id="citizen_card" class="user_file"/>
           <div><img src="" alt="citizenship card" class="user_citizen_card"></div>
           <p class="citizen_err"></p>
        </div>

         <div class="voter_id_number">
          <label for="voter_id_number">voter_id_number : </label>
          <input type="number" name="voter_id_number" />
          <p class="voter_num_err"></p>
        </div>

        <div class="voter_id">
          <label for="voter_id">Upload voter id </label>
          <input type="file" name="voter_id" id="voter_id" class="user_file"/>
           <div><img src="" alt="voter card" class="user_voter_id"></div>
           <p class="voter_err"></p>
        </div>

                
        <input type="submit" name="register" value="Register">
  </form>

  
      <script>
    // .................................................voter card taking from the users
    let user_file = document.querySelector('#user_photo');
    let citizen_file = document.querySelector('#citizen_card');
    let voter_file = document.querySelector('#voter_id');

    let user_img = document.querySelector(".user_image");
    let user_citizen_card = document.querySelector(".user_citizen_card");
    let user_voter_id = document.querySelector(".user_voter_id");
        
    // user_img.style.display = "none";

    user_file.onchange = () => {
        user_img.src = URL.createObjectURL(user_file.files[0]);
            // user_img.style.display = "block";
      };
      citizen_file.onchange = () => {
        user_citizen_card.src = URL.createObjectURL(citizen_file.files[0]);
      };
      voter_file.onchange = () => {
        user_voter_id.src = URL.createObjectURL(voter_file.files[0]);
      };

// ...........................................validations

      let user_photo = document.querySelector("input[type = 'file'][name = 'user_photo']");
      let citizenship_number = document.querySelector("input[type = 'number'][name = 'citizenship_card_number']");
      let citizen_card = document.querySelector("input[type = 'file'][name = 'citizen_card']");

      let voter_number = document.querySelector("input[type = 'number'][name = 'voter_id_number']");
      let voter_id = document.querySelector("input[type = 'file'][name = 'voter_id']");


      let citizen_num_error = document.querySelector(".citizen_num_err");
      let voter_num_error = document.querySelector(".voter_num_err");
      let photo_error = document.querySelector(".photo_err");
      let citizen_error = document.querySelector(".citizen_err");
      let voter_error = document.querySelector(".voter_err");

      function validation()
{
    let isvalid = true;
    // ================= USER PHOTO =================
    if (user_photo.files.length === 0)
    {
        photo_error.innerText = "Upload your photo";
        isvalid = false;
    }
    else
    {
        const allowedTypes = ["image/jpeg", "image/png", "image/jpg"];

        if (!allowedTypes.includes(user_photo.files[0].type))
        {
            photo_error.innerText = "Only JPG, JPEG and PNG files are allowed";
            isvalid = false;
        }
        else
        {
            photo_error.innerText = "";
        }
    }
    // ================= CITIZENSHIP NUMBER =================
    if (citizenship_number.value.trim() === "")
    {
        citizen_num_error.innerText =
            "Enter citizenship card number";
        isvalid = false;
    }
    else if (citizenship_number.value.length > 15)
    {
        citizen_num_error.innerText =
            "Citizenship number cannot exceed 15 digits";
        isvalid = false;
    }
    else
    {
        citizen_num_error.innerText = "";
    }
   // ================= CITIZENSHIP CARD =================
    if (citizen_card.files.length === 0)
    {
        citizen_error.innerText =
            "Upload your citizenship card";
        isvalid = false;
    }
    else
    {
        const allowedTypes = ["image/jpeg", "image/png", "image/jpg"];

        if (!allowedTypes.includes(citizen_card.files[0].type))
        {
            citizen_error.innerText =
                "Only JPG, JPEG and PNG files are allowed";
            isvalid = false;
        }
        else
        {
            citizen_error.innerText = "";
        }
    }
    // ================= VOTER NUMBER =================
    if (voter_number.value.trim() === "")
    {
        voter_num_error.innerText =
            "Enter voter ID number";
        isvalid = false;
    }
    else if (voter_number.value.length > 15)
    {
        voter_num_error.innerText =
            "Voter ID number cannot exceed 15 digits";
        isvalid = false;
    }
    else
    {
        voter_num_error.innerText = "";
    }
    // ================= VOTER ID =================
    if (voter_id.files.length === 0)
    {
        voter_error.innerText =
            "Upload your voter ID";
        isvalid = false;
    }
    else
    {
        const allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
        if (!allowedTypes.includes(voter_id.files[0].type))
        {
            voter_error.innerText =
                "Only JPG, JPEG and PNG files are allowed";
            isvalid = false;
        }
        else
        {
            voter_error.innerText = "";
        }
    }
    return isvalid;
}
  </script>

</body>
</html>
