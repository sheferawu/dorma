<?php 
if(isset($appName)){
	$_SESSION["appNameClus"] = $appName;
	
	echo "<h3>Appliance name: $appName</h3>";
	echo "<form name=\"changeAppClus\" method=\"POST\" action=\"index.php?c=option&m=changeAppClus\">";
	
	if(isset($clusters)){
		$_SESSION["numClus"] = count($clusters);
		echo "<table><tr><th>Cluster</th><th>Payment</th></tr>";
		
		if(!isset($arrayOfClus)){
		for($i=0;$i<$_SESSION["numClus"];$i++){
			echo "<tr><td>$clusters[$i]</td><td><input type=\"text\" name=\"appClus$i\"></td></tr>"; 
			
		}
		}else{
			
		for($i=0;$i<$_SESSION["numClus"];$i++){
			echo "<tr><td>$clusters[$i]</td><td><input type=\"text\" name=\"appClus$i\" value=\"$arrayOfClus[$i]\"></td></tr>"; 
			
		}	
		}
	}
	echo"</table><input type=\"submit\" name=\"appClusSubmit\"></form>";
}

?>