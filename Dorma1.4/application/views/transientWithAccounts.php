<?php 
unset($_SESSION['report_upper']);
unset($_SESSION['apt']);
unset($_SESSION['report_header']);
unset($_SESSION['report_values']);
if($transRec != "NO RECORDS FOUND!"){
if(isset($header)){
$period = explode("/",$time);
$month ="";
switch($period[0]-1){
	case 1 : $month = "January"; break;
	case 2 : $month = "Febuary"; break;
	case 3 : $month = "March"; break;
	case 4 : $month = "April"; break;
	case 5 : $month = "May"; break;
	case 6 : $month = "June"; break;
	case 7 : $month = "July"; break;
	case 8 : $month = "August"; break;
	case 9 : $month = "September"; break;
	case 10 : $month = "October"; break;
	case 11 : $month = "November"; break;
	case 12 : $month = "December"; break;
}

$_SESSION['report_upper'] = $header."$month $period[2]<br/></center>";
echo $header."$month $period[2]<br/></center>";

}else{
	
	if(isset($header1)){
		$_SESSION['report_upper'] = $header1;
		echo $header1;
	}
	
}


$_SESSION['report_header']=array("NAME","CHECK IN","CHECK OUT","TYPE","RATES","AMOUNT PAID"); 
$table= "<table border =\"1\"><tr><th>NAME</th>
<th>CHECK IN</th><th>CHECK OUT</th><th>TYPE</th><th>RATES</th><th>AMOUNT PAID</th></tr>";
$residentFeeTotal = "0";

$info = array_keys($transRec);
$cnt =0;
$sum = 0;
foreach($transRec as $res){
	$table.="<tr>";
	$name = "";
	$nameArr = explode("@",$info[$cnt]);		
	foreach($nameArr as $na){
	$name.=$na." ";	
	}
	$profile = explode("@",$res);
	$table.="<td>$name</td>"; //name
	$table.="<td>$profile[0]</td>";//checkin
	$table.="<td>$profile[1]</td>";//checkout
	$table.="<td>$profile[2]</td>";//type
	$table.="<td>$profile[3]</td>";//rates	
	$table.="<td>$profile[4]</td>"; //total
	$table.="</tr>";
	$sum+=$profile[4];
	$_SESSION['report_values'][$cnt][0] = $name;
	$_SESSION['report_values'][$cnt][1] = $profile[0];
	$_SESSION['report_values'][$cnt][2] = $profile[1];
	$_SESSION['report_values'][$cnt][3] = $profile[2];
	$_SESSION['report_values'][$cnt][4] = $profile[3];
	$_SESSION['report_values'][$cnt][5] = $profile[4];
	$cnt++;
}



$table.="<tr>";
$cnt1 =$cnt;
for($cnt=0;$cnt<5;$cnt++){$table.="<td></td>";
$_SESSION['report_values'][$cnt1][$cnt]="\t";}



//$table.="<td>$residentFeeTotal</td>";
//$sum =bcadd($temp,$residentFeeTotal);
$_SESSION['report_values'][$cnt1][$cnt] = $sum;
$table.="<td>".$sum."</td>";


$table.="</tr>";

echo $table."</table>";
echo "<br/><a class=\"genRepTxt\" href=\"index.php?c=option&m=excel&fn=transientreport$month$period[2]\">Click here to generate report</a>";
}else{
	
	echo $residentWithAccounts;
}
?>