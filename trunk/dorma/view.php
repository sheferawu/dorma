<?php
session_start();
if(isset($_GET["lname"])&&isset($_GET["fname"])){

$con = mysql_connect("localhost","DORMA","dorm");
		
mysql_select_db("dormdatabase", $con);

$lname = $_GET["lname"] ;
$fname = $_GET["fname"] ;
$result = mysql_query("SELECT * FROM Resident

WHERE FirstName= '$fname' AND LastName= '$lname'");

while($row = mysql_fetch_array($result))
  {
  echo 
  	"FirstName: ".$row['FirstName'] ."<br/>". 
    "MiddleName: ".$row['MidName'] ."<br/>".
    "LastName: ".$row['LastName'] ."<br/>";
  
  echo "<br />";
  }
  


}


?>