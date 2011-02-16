<?php 

if(isset($appRec)){
	
	echo "<center>".strtoupper($dormName)."<br/>";
	echo "STUDENT HOUSING DIVISION<br/>";
	echo "University Housing Office<br/><br/>";
	$strTerm ="";
	if($term=="1")$strTerm ="1st SEMESTER";
	if($term=="2")$strTerm ="2nd SEMESTER";
	if($term=="S")$strTerm ="SUMMER";
	
	echo "LIST OF APPLIANCES $strTerm $sy</center><br/>";
	
	
	
	
	$table ="";
	$table.="<table border =\"1\">";
	$table.="<tr>";
	$table.="<th></th>";
	$table.="<th>CRTL#</th>";
	$table.="<th>NAME</th>";
	$table.="<th>RM#</th>";
	$table.="<th>TYPE OF APPLIANCES</th>";
	$table.="<th>DATE INSTALLED</th>";
	$table.="<th>DATE CANCELLED</th>";
	$table.="<th>REMARKS</th>";
	$table.="</tr>";
	$cnt=1;
	$arrOfApp="";
	$appCnt=0;
	foreach($appRec as $ar){
		
	$eAr = explode("@",$ar);
	$table.="<tr>";
	$table.="<td>$cnt</td>";
	
	for($cnt1=0;$cnt1<count($eAr);$cnt1++){
		
		$table.="<td>$eAr[$cnt1]</td>";
		if($cnt1==3){
			$arrOfApp[$appCnt++] =$eAr[$cnt1]; 
		}
	
	}
	$table.="</tr>";
		
	$cnt++;
	}
	
	//$table.="</table>";
	//echo $table;
	sort($arrOfApp);


//$tableApp = "<table>";
$table .= "<tr><td></td><td></td><td>&nbsp</td><td></td><td></td><td></td><td></td><td></td></tr><tr><td></td><td></td><td>APPLIANCES</td><td></td><td></td><td></td><td></td><td></td></tr>";

$prev ="$arrOfApp[0]";
$cnt =1;
for($i=1;$i<count($arrOfApp);$i++){
	
	if($arrOfApp[$i] == $prev){
		$cnt++;
		
	}else{
		$table .= "<tr><td></td><td></td><td>$prev</td><td>$cnt</td><td></td><td></td><td></td><td></td></tr>";
		$cnt = 1;	
	}
$prev = $arrOfApp[$i];

}
$table .= "<tr><td></td><td></td><td>$prev</td><td>$cnt</td><td></td><td></td><td></td><td></td></tr>";
	
	
//$table.="</table>";
$table.="<tr><td></td><td></td><td>Prepared and Submitted by:</td><td></td><td></td><td></td><td></td><td></td></tr>";
$table.="<tr><td></td><td></td><td>&nbsp</td><td></td><td></td><td></td><td></td><td></td></tr>";
$table.="<tr><td></td><td></td><td><b>$dorma</b></td><td></td><td></td><td></td><td></td><td></td></tr>";
$table.="<tr><td></td><td></td><td>&nbsp</td><td></td><td></td><td></td><td></td><td></td></tr>";
$table.="<tr><td></td><td></td><td>&nbsp</td><td></td><td></td><td></td><td></td><td></td></tr>";
$table.="<tr><td></td><td></td><td>NOTED:</td><td></td><td></td><td></td><td></td><td></td></tr>";
$table.="<tr><td></td><td></td><td>&nbsp</td><td></td><td></td><td></td><td></td><td></td></tr>";
$table.="<tr><td></td><td></td><td>&nbsp</td><td></td><td></td><td></td><td></td><td></td></tr>";
$table.="<tr><td></td><td></td><td><b>$housingHead</b></td><td></td><td></td><td colspan=\"2\"><b>$housingChief</b></td><td></td></tr>";
$table.="<tr><td></td><td></td><td>Head, SHD</td><td></td><td></td><td >Chief, UPLB Housing Office</td><td></td><td></td></tr>";


$table.="</table>";

echo $table;
}
?>