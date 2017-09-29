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
      <title>Add New Employee </title>
      <script type="text/javascript">
        function validateForm(){
            var novalue = '';
            if(document.getElementsByName("fname").value != '' &&
               document.getElementsByName("mname").value != '' &&
               document.getElementsByName("lname").value != '' &&
               document.getElementsByName("email").value != '' &&
               document.getElementsByName("contact").value != '' &&
               document.getElementsByName("dob").value != '' &&
               document.getElementsByTagName("hiredate").value != ''){
                  novalue = "success"
            }
            if (novalue !="success") {
              return false;
            }else{
              document.getElementByID.innerHTML(novalue);
              return true;
            };
        }
      </script>
   </head>
<body>
  <center>
    <h1>Welcome <?php echo "<span style='color:red'>" . $login_session . "</span>"; ?></h1>
	  
    <h2>Add New Employee</h2>
   
      <form name="reg" action="insert.php" onsubmit="return validateForm(this);" method="post">
          <table width="274" border="0" align="center" cellpadding="2" cellspacing="0">
            <tbody>
            <tr>
                <td colspan="2"><span id="validation"></span></td>
            </tr>
            <tr>
              <td width="95"><div align="right">First Name:</div></td>
              <td width="171"><input type="text" name="fname" id="fname" value=""/></td>
            </tr>
            <tr>
              <td><div align="right">Middle Name:</div></td>
              <td><input type="text" name="mname"  value=""/></td>
            </tr>
            <tr>
              <td><div align="right">Last Name:</div></td>
              <td><input type="text" name="lname"  value=""/></td>
            </tr>
             <tr>
              <td><div align="right">Email:</div></td>
              <td><input type="text" name="email"  value=""/></td>
            </tr>
            <tr>
              <td><div align="right">Contact No.:</div></td>
              <td><input type="text" name="contact"  value=""/></td>
            </tr>
            <tr>
              <td><div align="right">Date of Birth:</div></td>
              <td><input type="text" name="dob" placeholder="YYYY-MM-DD"  value=""/></td>
            </tr>
           <tr>
              <td><div align="right">Hire Date:</div></td>
              <td><input type="text" name="hiredate" placeholder="YYYY-MM-DD"  value=""/></td>
            </tr>
            <tr>
              <td><div align="right"></div></td>
              <td><input type="reset" value="Clear" /> <input name="submit" type="submit" value="Submit" /></td>
            </tr>
          </tbody>
          </table>
      </form>
    <h3><a href = "index.php">Back to Main</a></h3>
    <h3><a href = "logout.php">Sign Out</a></h3>
  </center>
</body>
</html> 