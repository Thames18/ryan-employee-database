<h1>List of Employees</h1>
<?php
 require_once('dbconfig.php');
 session_start();
 
  $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select Username from Users where Username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }

 // get the records from the database
if ($result = $dbconnect->query("SELECT * FROM Employee ORDER BY id"))
{
// display records if there are records to display
if ($result->num_rows > 0)
{
// display records in a table
echo "<table border='1' cellpadding='10'>";

	// set table headers
	echo "<tr>";
	echo "<th>ID</th><th>Employee ID</th>";
	echo "<th>First Name</th>";
	echo "<th>Middle Name</th>";
	echo "<th>Last Name</th>";
	echo "<th>Email</th>";
	echo "<th>Contact No</th>";
	echo "<th>Date of Birth</th>";
	echo "<th>Hire Date</th>";
	echo "<th>Employment Status</th>";
	echo "<th></th>";
	echo "</tr>";

while ($row = $result->fetch_object())
{
// set up a row for each record
	echo "<tr>";
	echo "<td>" . $row->id . "</td>";
	echo "<td>" . $row->empid . "</td>";
	echo "<td>" . $row->firstname . "</td>";
	echo "<td>" . $row->midname . "</td>";
	echo "<td>" . $row->lastname . "</td>";
	echo "<td>" . $row->email . "</td>";
	echo "<td>" . $row->phone . "</td>";
	echo "<td>" . $row->bdate . "</td>";
	echo "<td>" . $row->hiredate . "</td>";
	echo "<td>" . ($row->emp_status ? 'Active':'Inactive') . "</td>";
	echo "<td><a href='update.php?id=" . $row->id . "'>Edit</a></td>";
	echo "</tr>";
}

echo "</table>";
}
// if there are no records in the database, display an alert message
else
{
echo "No results to display!";
}
}
// show an error if there is an issue with the database query
else
{
echo "Error: " . $dbconnect->error;
}
echo '<br><a href="index.php">Add Employee</a>';

// close database connection
$dbconnect->close();

?>