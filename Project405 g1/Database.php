<?php
$servername="localhost";
$username="root";
$password="mysql";
 
 $conn= new mysqli($servername, $username, $password);
if($conn->connect_error)
{
die("Connection failed: ".$conn->connect_error);}
 
echo "Connected successfully";
 
//CREATE DATABASE
    $sql = "CREATE DATABASE IF NOT EXISTS fcitclubs";
    if ($conn->query($sql) === true) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }

// create users table
$conn->select_db("fcitclubs"); 
$sqld = "CREATE TABLE IF NOT EXISTS users (
    Fname VARCHAR(60) NOT NULL , 
    email VARCHAR(60) NOT NULL PRIMARY KEY,  
    pas1 VARCHAR(60) NOT NULL  
   
     );"; 
  
  if ($conn->query($sqld) === TRUE) {
      echo "table created successfully";
  } else {
      echo "Error creating database: " .$conn->error;
  }

//create table request 

$sql2 = "CREATE TABLE IF NOT EXISTS request(
  phoneNo INT(10) PRIMARY KEY, 
  firstname VARCHAR(150), 
  lastname VARCHAR(150), 
  gender VARCHAR(150), 
  major VARCHAR(150), 
  levelN VARCHAR(150), 
  interest VARCHAR(150),
  more VARCHAR(150), 
  email VARCHAR(150),
  club VARCHAR(150) 
   );"; 

if ($conn->query($sql2) === true) {
    echo "table created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}


$conn->close();
?>
