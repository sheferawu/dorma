<?php 
unset($_SESSION['report_upper']);
unset($_SESSION['apt']);
unset($_SESSION['report_header']);
unset($_SESSION['report_values']);
if(isset($appRec)&&$appRec!=""){
	$header="";
	$header.= "<center>".strtoupper($dormName)."<br/>";
	$header.= "STUDENT HOUSING DIVISION<br/>";
	$header.= "University Housing Office<br/><br/>";
	
	$strTerm ="";
	if($term=="1")$strTerm ="1st SEMESTER";
	if($term=="2")$strTerm ="2nd SEMESTER";
	if($term=="S")$strTerm ="SUMMER";
	
	$header.="LIST OF APPLIANCES $strTerm $sy</center><br/>";
	
	$_SESSION['report_upper']= $header;
	echo $header;
	$_SESSION['report_header']=array(" ","CRTL#","NAME","RM#",	"TYPE OF APPLIANCES",	"DATE INSTALLED",	"DATE CANCELLED",	"REMARKS"); 
	
	
	
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
	$_SESSION['report_values'][$cnt-1][0] = $cnt;
	
	for($cnt1=0;$cnt1<count($eAr);$cnt1++){
		
		$table.="<td>$eAr[$cnt1]</td>";
		if($cnt1==3){
			$arrOfApp[$appCnt++] =$eAr[$cnt1]; 
			
		}
	$_SESSION['report_values'][$cnt-1][$cnt1+1] = "$eAr[$cnt1]";
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
$cnt1 = 0;
for($i=1;$i<count($arrOfApp);$i++){
	
	if($arrOfApp[$i] == $prev){
		$cnt++;
		
	}else{
		$table .= "<tr><td></td><td></td><td>$prev</td><td>$cnt</td><td></td><td></td><td></td><td></td></tr>";
		
		$_SESSION["apt"][$cnt1][0] = $prev;
		$_SESSION["apt"][$cnt1][1] = $cnt;
		$cnt1++;
		$cnt = 1;	
	}
$prev = $arrOfApp[$i];

}
$table .= "<tr><td></td><td></td><td>$prev</td><td>$cnt</td><td></td><td></td><td></td><td></td></tr>";
$_SESSION["apt"][$cnt1+1][0] = $prev;
$_SESSION["apt"][$cnt1+1][1] = $cnt;
		
	
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
echo "<br/><a class=\"genRepTxt\" href=\"index.php?c=option&m=excel&fn=appliancereport$strTerm$sy\">Click here to generate report</a>";

}else{
	
	echo "No Record Found";
}
?>