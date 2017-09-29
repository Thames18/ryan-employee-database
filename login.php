<?php
require_once('dbconfig.php');
session_start();


if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($dbconnect,$_POST['uname']);
      $mypassword = mysqli_real_escape_string($dbconnect,$_POST['psw']); 
      
      $sql = "SELECT ID FROM Users WHERE Username = '$myusername' and Password = '$mypassword'";
      $result = mysqli_query($dbconnect,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
      if($count==1) {
         $_SESSION["login_user"]= $myusername;
         header('Location: index.php');
      }else {
         $error = "Your Login Name or Password is invalid";
		 printf($error);
      }
   }
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
</head>
<body>
<center>
 <form action="" method="post">
  <div class="imgcontainer">
    <h1>Employee Portal</h1>
  </div>

  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" id="uname" id="psw" required>
	<br>
    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
	<br>
    <button type="submit">Login</button>
    <input type="checkbox" checked="checked"> Remember me
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
  
</form> 
</center>
</body>
</html>