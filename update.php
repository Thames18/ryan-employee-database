<?php
 require_once('dbconfig.php');
 session_start();

  /* check if user logged in */
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($dbconnect,"select Username from Users where Username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['Username'];
   

   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }

   if(isset($_POST['updateform']) )
   {
   	 if(isset($_POST['lname']) && 
   	 	isset($_POST['fname']) && 
   	 	isset($_POST['mname']) && 
   	 	isset($_POST['dob']) && 
   	 	isset($_POST['email']) && 
   	 	isset($_POST['contact']) && 
   	 	isset($_POST['hiredate'])){

   	 	$lname = $_POST['lname'];
	    $fname = $_POST['fname'];
	    $mname = $_POST['mname'];
	    $dob = $_POST['dob'];
	    $email = $_POST['email'];
	    $phone = $_POST['contact'];
	    $hiredate = $_POST['hiredate'];

   	 	$changes = "UPDATE Employee SET 
   	 				firstname='".$fname."', 
   	 				midname='".$mname."', 
   	 				lastname='".$lname."', 
   	 				email='".$email."', 
   	 				phone='".$phone."', 
   	 				hiredate='".$hiredate."', 
   	 				bdate='".$dob."'
					WHERE id='".$_GET['id']."'";

		if ($dbconnect->query($changes) === TRUE) {
          echo "<center>Record update successfully <a href='search.php'>View Employees</a></center>";
        } else {
          echo "Error adding record: " . $dbconnect->error;
        }

   	 }
   
   }
?>

<!DOCTYPE html>
<html>
   <head>
      <title>Update Employee </title>
      <style type="text/css">
      input[type=submit]{
      	padding:5px;
		   margin:10px;
		   cursor: pointer;
		   font-size: 13px;
		   text-transform: uppercase;
      }
      input[type=text], [type=email]{
      	width: 95%;
      	border:0;
      	font-size: 14px;
      	font-family: Arial;

      }
      .disable{
      	background-color: #ddd;
      }
      th{
      	text-align: left;
      	padding:0 10px;
      	width: 50%;
      }
      td{
      	width: 50%;
      	font-size: 14px;
      	font-family: Arial;
      	padding:5px;

      }
      </style>
   </head>
   <body>
<?php
 

 if(isset($_GET['id'])){
 	$id = $_GET['id'];

 	$result = mysqli_query($dbconnect,"SELECT * FROM Employee WHERE id ='".$id."'"); 
 	echo '<center><h3>Update Employee Record</h3>';
 	if ($result->num_rows > 0)
    {	
    	
    	echo '<form name="updateform" action="" method="post">';
	 	echo "<table border='1' width='400' align='center' cellpadding='2' cellspacing='0'>";

	    while ($row = $result->fetch_object())
	    {
	    // set up a row for each record
	      echo "<tr>";
	      echo "<th>Employee ID</th><td class='disable'>" . $row->empid . "</td>";
	      echo "</tr>";
	      echo "<tr><th>First Name</th><td><input type='text' name='fname' id='fname' value='" . $row->firstname . "' /></td></tr>";
	      echo "<tr><th>Middle Name</th><td><input type='text' name='mname' id='mname' value='" . $row->midname . "' /></td></tr>";
	      echo "<tr><th>Last Name</th><td><input type='text' name='lname' id='lname' value='" . $row->lastname . "' /></td></tr>";
	      echo "<tr><th>Email</th><td><input type='text' name='email' id='email' value='" . $row->email . "' /></td></tr>";
	      echo "<tr><th>Contact No</th><td><input type='text' name='contact' id='contact' value='" . $row->phone . "' /></td></tr>";
	      echo "<tr><th>Date of Birth</th><td><input type='text' name='dob' id='dob' placeholder='YYYY-MM-DD' value='" . $row->bdate . "' /></td></tr>";
	      echo "<tr><th>Hire Date</th><td><input type='text' name='hiredate' id='hiredate' placeholder='YYYY-MM-DD' value='" . $row->hiredate . "' /></td></tr>";
	      echo "<tr><th>Employment Status</th><td class='disable'>" . ($row->emp_status ? 'Active':'Inactive') . "</td></tr>";
	    }

	    echo "</table>";
	    echo "<input name='updateform' type='submit' value='Save Changes' />";
	    echo '</form>';

	    

	}else{
    	echo "No results to display!";
    }
    echo '</center>';

 }else{
 	header("location:index.php");
 }
?>
</body>
</html>