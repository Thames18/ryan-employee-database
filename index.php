<?php
require_once('dbconfig.php');

session_start();

 $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($dbconnect,"SELECT Username FROM Users WHERE Username='$user_check'");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $login_session = $row['Username'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>

<!DOCTYPE html>
<html>
<head>
<title>Landing Page</title>
<style type="text/css">
button{
   padding:10px;
   width: 200px;
   margin:5px;
   cursor: pointer;
   font-size: 15px;
   text-transform: uppercase;
}
button:hover{
   opacity: 0.7;
}
</style>
</head>
<body>

</body>

   <body>
      <center>
      <h1>Welcome <?php echo "<span style='color:red'>" . $login_session . "</span>"; ?></h1>

		<p>What would you like to do?</p>

		<div><a href="entry.php"><button>Add New Employee</button></a></div>
		<div><a href="search.php"><button>Employee Search</button></a></div>
  
      <h3><a href="logout.php">Sign Out</a></h3>
      </center>
   </body>
   
</html>
