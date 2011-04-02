<html>
<head><title>Houseman|Option</title>
<script type="text/javascript" src='<?php echo base_url()."JS/house.js"?>'></script>
		
</head>
<body>
<h4>Option</h4>
<hr/><br/>
<form name="houseForm" method="POST" action="index.php?c=house&m=saveChanges">
<table border id="dorm">
<tr><th>DormName</th><th>Alias</th><th>Location</th><th>Manager</th><th>Password</th><th>Info</th><th>OPTION</th></tr>
<?php 
$cnt = 0;
 $fields= array ("DormName","Alias","Location","Manager","Password","Info");
if($dormArr!=""){
	$len = count($dormArr);
	for($cnt = 0;$cnt<$len;$cnt++){
		
		$arr = explode("@",$dormArr[$cnt]);
		echo "<tr>";
		$cnt1 = 0;
		$alias="";
		foreach($arr as $ar){
			echo "<td><input type=\"text\" value=\"$ar\" name =\"$fields[$cnt1]$cnt\"/></td>";
			if($cnt1 ==1 ){
				$alias = $ar; 
			}
			$cnt1++;
		}
		$alias = strtolower($alias);
		echo "<td><input type=\"checkbox\" name =\"check[]\" value=\"".$alias."database\"/>delete</td></tr>";
		
	}
	$_SESSION["numdorm"] =$cnt;
}


?>
</table>
<input type="Button" value="Add Row" onclick="addRow('dorm')"/><br/>
<input type="submit" value="Save Changes"/>
</form>

</body>

</html>