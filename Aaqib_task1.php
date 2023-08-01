<?php
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login and Signup Page</title>
<style>
  
  @media only screen and (min-width: 801px) and (max-width: 3000px) {
       body {
    margin-top: 100px;
      background-color: #363945;
    }
    
    .container {
      display: flex;
      justify-content: space-between;
      width: 800px;
      margin: 0 auto;
      padding: 20px;
    }
    
    .login-container, .signup-container {
      width: 45%;
      height: 40vh;
      padding: 20px;
      background-color: white;
      border: 2px solid black;
      border-radius: 5px;
      box-shadow: 0 0 10px black;
    }

    .signup-container {
        margin-top: -61px;
        height: 49vh;
    }
  
    
    .container h2 {
      text-align: center;
    }
    
    .container input[type="text"],
    .container input[type="password"] {
      width: 90%;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 3px;
      border: 1px solid #ccc;
      margin-top: 5px;
    }
    
    .container input[type="submit"] {
      width: 100%;
      padding: 10px;
      border-radius: 3px;
      border: none;
      background-color: rgb(12, 132, 36);
      color: white;
      font-weight: bold;
      cursor: pointer;
    }
    
    .container .signup-container {
      margin-left: 20px;
    }
    
    .container .signup-container h2,
    .container .login-container p {
      margin-bottom: 10px;
    }
    
    .container .login-container .signup-link,
    .container .signup-container .login-link {
      text-align: center;
      margin-top: 10px;
    }
    a {
         color: rgb(12, 132, 36);
         text-decoration: none;
         font-weight: bold;
    }
  }
    @media only screen and (min-width: 1px) and (max-width: 800px) {
  body {
      margin-top: 100px;
      background-color: #121A1D;
    }
 
    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin: 0 auto;
      padding: 20px;
      max-width: 600px;
    }
    
    .login-container, .signup-container {
      width: 100%;
      height: auto;
      padding: 20px;
      background-color: white;
      border: 2px solid rgb(12, 132, 36);
      border-radius: 5px;
      box-shadow: 0 0 10px rgb(12, 132, 36);
      margin-bottom: 20px;
       min-height: 30vh;
    }
  
    .container h2 {
      text-align: center;
    }
    
    .container input[type="text"],
    .container input[type="password"] {
      width: 95%;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 3px;
      border: 1px solid #ccc;
    }
    
    .container input[type="submit"] {
      width: 100%;
      padding: 10px;
      border-radius: 3px;
      border: none;
      background-color: rgb(12, 132, 36);
      color: white;
      font-weight: bold;
      cursor: pointer;
    }
    
    .container .signup-container {
      margin-top: 20px;
    }
    
    .container .signup-container h2,
    .container .login-container p {
      margin-bottom: 10px;
    }
    
    .container .login-container .signup-link,
    .container .signup-container .login-link {
      text-align: center;
      margin-top: 10px;
    }
    
    a {
      color: rgb(12, 132, 36);
      text-decoration: none;
      font-weight: bold;
    }  } 
</style>
</head>
<body>
    <h2 style="margin-bottom: 120px; margin-top: -60px; display: block; padding: 20px; text-decoration: bold; text-align: center; background-color: #9A8B4F; color: black; border: 11px solid black;">Welcome to Posting with Aaqib</h2>

  <div class="container">
   
    <div class="login-container">
      <h2>Login</h2>
      <form action="insert.php" method="POST">
        <input type="text" name="email" placeholder="Enter your email" required= true>
        <input type="password" name="password" placeholder="Enter your password" required= true >
        <a href="#">Forgot password?</a>
        <br>
        <br>
        <input type="hidden" name="login" value="1"> <!-- Hidden input field for login form submission -->
        <input type="submit" value="Login">
        <div class="signup-link">Don't have an account? <a href="#">Signup</a></div>
      </form>
    </div>
    <div class="signup-container">
      <h2>Signup</h2>
      <br>
      <form action="insert.php" method="POST">
        <input type="text" name="email" placeholder="Enter your email" required= true>
        <input type="password" name="password" placeholder="Create a password" required= true>
        <input type="password" name="confirm_password"  placeholder="Confirm your password" required= true>
        <br>
        <br>
        <input type="submit" name="signup" value="Signup"> <!-- Named the submit button for signup form -->
        <div class="login-link">Already have an account? <a href="#">Login</a></div>
      </form>
    </div>
  </div>
</body>



</html>
