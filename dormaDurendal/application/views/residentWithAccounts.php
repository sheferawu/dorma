<?php 
unset($_SESSION['report_upper']);
unset($_SESSION['apt']);
unset($_SESSION['report_header']);
unset($_SESSION['report_values']);
if($residentWithAccounts!="NO RECORDS FOUND!"){
if(isset($header)){
$period = explode("/",$time);
$month ="";

switch($period[0]){
	case 2 : $month = "January"; break;
	case 3 : $month = "Febuary"; break;
	case 4 : $month = "March"; break;
	case 5 : $month = "April"; break;
	case 6 : $month = "May"; break;
	case 7 : $month = "June"; break;
	case 8 : $month = "July"; break;
	case 9 : $month = "August"; break;
	case 10 : $month = "September"; break;
	case 11 : $month = "October"; break;
	case 12 : $month = "November"; break;
	case 1 : $month = "December"; break;
}


$_SESSION['report_upper'] = $header."$month $period[2]<br/></center>";
echo $header."$month $period[2]<br/></center>";

}else{
	
	if(isset($header1)){
		$_SESSION['report_upper'] = $header1;
	  	echo $header1;
	}
	
}

$_SESSION['report_header']=array("ST#","NAME","COLLEGE","COURSE","PERIOD COVERED","RESIDENT FEE","APP FEE","TOTAL"); 
$table= "<table border =\"1\"><tr><th>ST#</th><th>NAME</th><th>COLLEGE</th><th>COURSE</th>
<th>PERIOD COVERED</th><th>RESIDENT FEE</th><th>APP FEE</th><th>TOTAL</th></tr>";
$residentFeeTotal = "0";
$appFeeTotal = "0";
$info= array_keys($residentWithAccounts);
$cnt =0;
foreach($residentWithAccounts as $res){
	$pay = explode("&",$res);
	$table.="<tr>";
	$profile = explode("/",$info[$cnt]);		
	$name = str_replace("@"," ",$profile[0]);
	$table.="<td>$profile[1]</td>"; //stnum
	$table.="<td>$name</td>"; //name
	$table.="<td>$profile[3]</td>"; //college
	$table.="<td>$profile[2]</td>"; //course
	$table.="<td>$pay[0]</td>"; //period covered
	$table.="<td>$pay[1]</td>"; //Resident Fee
	$table.="<td>$pay[2]</td>"; //App fee
	$table.="<td>$pay[3]</td>"; //total
	$table.="</tr>";
	bcscale(2);
	$temp = bcadd((string)$residentFeeTotal,(string)$pay[1]);
	$residentFeeTotal=$temp;
	$temp = bcadd((string)$appFeeTotal,(string)$pay[2]);
	$appFeeTotal=$temp;
	 $_SESSION['report_values'][$cnt][0]=$profile[1];
	 $_SESSION['report_values'][$cnt][1]=$name;
	 $_SESSION['report_values'][$cnt][2]=$profile[3];
	 $_SESSION['report_values'][$cnt][3]=$profile[2];
	 $_SESSION['report_values'][$cnt][4]=$pay[0];
	 $_SESSION['report_values'][$cnt][5]=$pay[1];
	 $_SESSION['report_values'][$cnt][6]=$pay[2];
	 $_SESSION['report_values'][$cnt][7]=$pay[3];
	$cnt++;
}
$table.="<tr>";
$cnt1 = $cnt;
for($cnt=0;$cnt<5;$cnt++){$table.="<td></td>";
 $_SESSION['report_values'][$cnt1][$cnt]="\t";}

$table.="<td>$residentFeeTotal</td>";
$table.="<td>$appFeeTotal</td>";
$sum =bcadd($residentFeeTotal,$appFeeTotal);
$table.="<td>".$sum."</td>";
 $_SESSION['report_values'][$cnt1][$cnt+1]=$residentFeeTotal;
 $_SESSION['report_values'][$cnt1][$cnt+2]=$appFeeTotal;
  $_SESSION['report_values'][$cnt1][$cnt+3]=$sum;
 
$table.="</tr>";

echo $table."</table>";
echo "<br/><a class=\"genRepTxt\" href=\"index.php?c=option&m=excel&fn=residentreport$month$period[2]\">Click here to generate report</a>";
}else{
	
	echo $residentWithAccounts;
}
?>