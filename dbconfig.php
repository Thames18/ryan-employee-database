<?php
 $mysql_hostname = "localhost";

 $mysql_user = "root";

 $mysql_password = "";

 $mysql_database = "registration";

 $dbconnect = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password,$mysql_database);
 
// Check connection
if (!$dbconnect) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS Employee (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
empid varchar(16),
firstname VARCHAR(50) NOT NULL,
midname VARCHAR(50) NOT NULL,
lastname VARCHAR(50) NOT NULL,
email VARCHAR(50),
phone varchar(30) NOT NULL,
reg_date TIMESTAMP,
hiredate date,
bdate date NOT NULL,
emp_status TINYINT(1) UNSIGNED NOT NULL DEFAULT '0'
)";


if (mysqli_query($dbconnect, $sql)) {
    //echo "Table Employee created successfully";
    
} else {
    echo "Error creating table: " . mysqli_error($dbconnect);
}



?>