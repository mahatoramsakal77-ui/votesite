<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>forget_password page</title>
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
    width: 30%;
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
    form input
    {
       width: 100%;
      height: 35px;
      border: 1px solid black;
      border-radius: 5px;
      padding-left: 0.5vw;
      margin-bottom: 20px;
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

  </style>
</head>
<body>
  
  <form action="" method="post">

    <h2>Forget Password</h2>
    <div class="email">
       <label for="email">Username</label>
        <input type="text" name="email" id="email" placeholder="Enter your username">
    </div>

  <div class="new_password">
        <label for="new_password">New Password</label>
        <input type="password" name="new_password" id="new_password" placeholder="Enter your new password">
      </div>

        <div class="confirm_password">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Enter your confirm password">
      </div>

      <input type="submit" value="Change Password" name="change_password">
  </form>

  <script>
    
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent form submission

      const newPassword = document.getElementById('new_password').value;
      const email = document.getElementById('email').value;
      const confirmPassword = document.getElementById('confirm_password').value;

      if (!email) {
        alert('Please enter your username.');
        return;
      }
      else if(!/^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/.test(email))
    {
      alert('please enter valid email address');
      return;
    }
      if(!newPassword || !confirmPassword) {
        alert('Please fill in both password fields.');
        return;
      }

      if (newPassword !== confirmPassword) {
        alert('New password and confirm password do not match.');
        return; // Stop further execution
      }

      // If passwords match, you can proceed with form submission or further processing
      alert('Password changed successfully!');
      form.submit(); // Submit the form if needed
    });
  </script>
</body>
</html>