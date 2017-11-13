
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
   error_reporting(0);


if(isset($_POST['search1']) && isset( $_POST['firstname'] ) && isset( $_POST['lastname'] ) )
{

    $fname = $_POST['firstname']; $lname = $_POST['lastname'];
    if(!empty($fname) || !empty($lname)){  
      $result = mysqli_query($dbconnect,"SELECT * FROM Employee WHERE (lastname = '".$lname."' AND firstname = '".$fname."')");    
    }else{
      $result = mysqli_query($dbconnect,"SELECT * FROM Employee ORDER BY id"); 
    }

}elseif(isset($_POST['search2']) && isset($_POST['empid']) ){
 
    $empid = $_POST['empid'];

    $result = mysqli_query($dbconnect,"SELECT * FROM Employee WHERE empid ='".$empid."'"); 

}else{
    $result = mysqli_query($dbconnect,"SELECT * FROM Employee ORDER BY id"); 
}

?>

<!DOCTYPE html>
<html>
   <head>
      <title>Search Employee </title>
      <style type="text/css">
      input[type=submit],button{
      	padding:5px;
		   margin:5px;
		   cursor: pointer;
		   font-size: 13px;
		   text-transform: uppercase;
      }
      input[type=text], select{
      		padding:5px;
      		font-size: 13px;
      }
      select{
        width: 200px;
      }
      fieldset{
      	width: 86%;
      	padding:15px 5px;
      	margin-bottom: 15px;
      }
      #employeeid{display: none;}
      </style>
      <script type="text/javascript">
        function changesearchform(searchtype){
          if (searchtype == 'employeeid'){
            document.getElementById('employeeid').style.display = 'block';
            document.getElementById('empname').style.display = 'none';
          } 
          else{
              document.getElementById('employeeid').style.display = 'none';
              document.getElementById('empname').style.display = 'block';
          }
        }
      </script>
   </head>
<body>
  <center>
    <h1>Welcome <?php echo "<span style='color:red'>" . $login_session . "</span>"; ?></h1> 
	  
    <h2>Search Employee</h2>

    <fieldset>
	<form action="" method="post">
    
		<table width="100%" border="0" align="left" cellpadding="5" cellspacing="0" >
			<tbody>
            <tr>
              <td>
                <label>Search By:</label>
                <select id="changesearch" onchange="changesearchform(this.value);">
                    <option value="empname">By Name</option>
                    <option value="employeeid">By ID</option>
                </select>
              </td>
              <td>
                <table>
                  <tr id="empname">
                    <td><div align="left">First Name:</div></td>
                    <td><input type="text" name="firstname" id="firstname" value=""/></td>
                    <td><div align="left">Last Name:</div></td>
                    <td><input type="text" name="lastname"  value=""/></td>
                    <td> <input name="search1" type="submit" value="Search Now" /></td>
                  </tr>
                  <tr id="employeeid">
                    <td><div align="left">Employee ID:</div></td>
                    <td><input type="text" name="empid"  value=""/></td>
                    <td> <input name="search2" type="submit" value="Search Now" /></td>
                  </tr>
                  </table>
              </td>
            </tr>
            
        </tbody>
          </table>

	</form>
	</fieldset>


<?php
if($result != null)
    {
    // display records if there are records to display
    if ($result->num_rows > 0)
    {
    // display records in a table
    echo "<h2>Search Results</h2>";
    echo "<fieldset>";
    echo "<table border='1' width='100%' cellpadding='10'>";

      // set table headers
      echo "<tr>";
      echo "<th>Employee ID</th>";
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
    echo "</fieldset>";
    }
    // show an error if there is an issue with the database query
    else
    {
    echo "Error: " . $dbconnect->error;
    }

// close database connection
$dbconnect->close();

 ?>


<h3><a href = "index.php">Back to Main</a></h3>
    <h3><a href = "logout.php">Sign Out</a></h3>
 	</center>
</body>
</html>