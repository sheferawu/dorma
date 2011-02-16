<?php 
if($residentWithAccounts!="NO RECORDS FOUND!"){
if(isset($header)){
$period = explode("/",$time);
$month ="";
switch($period[0]){
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


echo $header."$month $period[2]<br/></center>";

}else{
	
	if(isset($header1)){
		
		echo $header1;
	}
	
}
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
	
	$cnt++;
}
$table.="<tr>";

for($cnt=0;$cnt<5;$cnt++){$table.="<td>";
$table.="</td>";}



$table.="<td>$residentFeeTotal</td>";
$table.="<td>$appFeeTotal</td>";
$sum =bcadd($residentFeeTotal,$appFeeTotal);
$table.="<td>".$sum."</td>";


$table.="</tr>";

echo $table."</table>";
}else{
	
	echo $residentWithAccounts;
}
?>