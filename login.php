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
<style type="text/css">
  button{
      padding:5px;
       cursor: pointer;
       font-size: 13px;
       text-transform: uppercase;
       width: 230px;
      }
  input{
    margin:5px 0;
          padding:5px;
          font-size: 13px;
          width: 215px;
  }
  .container{
text-align: left;
margin:auto;
width: 20%;
  }
</style>
</head>
<body>

 <form action="" method="post">


  <div class="container">
    <h1>Employee Portal</h1>
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" id="uname" id="psw" required>
	<br>
    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
	<br>
    <button type="submit">Login</button>
  </div>

  
</form> 

</body>
</html>