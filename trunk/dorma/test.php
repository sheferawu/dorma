<?php

$con = mysql_connect("localhost","DORMA","dorm");
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		
		mysql_select_db("dormdatabase",$con);
		

$qColumnNames = mysql_query("SHOW COLUMNS FROM resident",$con) or die("mysql error"); 
$numColumns = mysql_num_rows($qColumnNames); 
$x = 0; 
while ($x < $numColumns) 
{ 	
	
    $colname = mysql_fetch_row($qColumnNames); 
    $col[$x++] = $colname[0]; 
    
} 


?>