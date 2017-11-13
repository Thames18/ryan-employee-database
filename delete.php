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
?>

<html>
   
   <head>
      <title>Delete a Record from MySQL Database</title>
   </head>
   
   <body>
      <?php
         if(isset($_POST['delete'])) {
            
				
            $emp_id = $_POST['emp_id'];
            echo $emp_id;
            
            $delresult = "DELETE FROM Employee WHERE empid ='".$emp_id."'"; 
            if ($dbconnect->query($delresult) === TRUE) {
              echo " Record removed successfully <a href='search.php'>View Employees</a> | <a href='delete.php'>delete more</a>";
            } else {
              echo "Error deleting record: " . $dbconnect->error;
            }

         }else {
     	?>
               <form method = "post" action = "<?php $_PHP_SELF ?>">
                  <table width = "400" border = "0" cellspacing = "1" 
                     cellpadding = "2">
                     
                     <tr>
                        <td width = "100">Employee ID</td>
                        <td><input name = "emp_id" type = "text" 
                           id = "emp_id"></td>
                     </tr>
                     
                     <tr>
                        <td width = "100"> </td>
                        <td> </td>
                     </tr>
                     
                     <tr>
                        <td width = "100"> </td>
                        <td>
                           <input name = "delete" type = "submit" 
                              id = "delete" value = "Delete">
                        </td>
                     </tr>
                     
                  </table>
               </form>
        <?php
         }
      ?>
      
   </body>
</html>