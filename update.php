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

 if(isset($_SESSION['lname'])){
 
$lname = $_SESSION['lname'];
$fname = $_SESSION['fname'];
$dob = $_SESSION['bday'];



// Now search the DB to see if a record with this email already exists:

$result = $dbconnect->query(" SELECT * FROM Employee WHERE (lastname = '".$lname."' AND firstname = '".$fname."') AND bdate ='".$dob."'");

if($result != null)
{
// display records if there are records to display
if ($result->num_rows > 0)
{
	
// display records in a table
echo "<h2>Update Employee</h2>";
echo "<fieldset>";
echo '<form name="reg" action="" onsubmit="return validateForm(this);" method="post">';
echo "<table border='1' width='100%' cellpadding='10'><tbody>";

while ($row = $result->fetch_object())
{
// set up a row for each record
	echo "<tr><th>Employee ID</th><td>" . $row->empid . "</td>";
	echo "<tr><th>First Name</th><td><input type='text' name='fname'  value='" . $row->firstname . "'/></td></tr>";
	echo "<tr><th>Middle Name</th><td><input type='text' name='mname'  value='" . $row->midname . "'/></td></tr>";
	echo "<tr><th>Last Name</th><td><input type='text' name='lname'  value='" . $row->lastname . "'/></td></tr>";
	echo "<tr><th>Email</th><td><input type='text' name='email'  value='" . $row->email . "'/></td></tr>";
	echo "<tr><th>Contact No</th><td><input type='text' name='contact'  value='" . $row->phone . "'/></td></tr>";
	echo "<tr><th>Date of Birth</th><td><input type='text' name='dob'  value='" . $row->bdate . "'/></td></tr>";
	echo "<tr><th>Hire Date</th><td><input type='text' name='hiredate'  value='" . $row->hiredate . "'/></td></tr>";
	echo "<tr><th>Employment Status</th>
		  <td><select name='status'>
		  <option value=''>Please select</option>
		  <option value='1'>Active</option>
		  <option value='0'>Inactive</option>
		  </select></td></tr>";

}

echo "<tr><td colspan='2'><input type='submit' name='update' value='Update Employee' /></td>";
echo "</tbody></table>";
echo '</form>';
}
// if there are no records in the database, display an alert message
else
{
echo "No results to display!";
}
echo "</fieldset>";
}
// show an error if there is an issue with the database query
else
{
echo "Error: " . $dbconnect->error;
}
// close database connection
$dbconnect->close();
unset($_SESSION['lname']);
unset($_SESSION['fname']);
unset($_SESSION['bday']);
}else{
	header("location:index.php");
}
?>