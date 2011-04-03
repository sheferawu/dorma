<?php
unset($_SESSION['report_upper']);
unset($_SESSION['report_header']);
unset($_SESSION['report_values']);
switch($month){
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

$header="<center>SHD Revised Accomplishment Report 2010<br/></center>";
$header.="<center>STUDENT HOUSING DIVISION<br/></center>";
$header.="<center>UPLB HOUSING OFFICE<br/></center>";
$header.="<center>UP LOS BANOS, COLLEGE, LAGUNA<br/></center>";
$header.="<center>Accomplishment Report for the Month of $month $year<br/></center><br/>";
//$_SESSION['main_header'] = $header;

echo $header;

echo "<center>Total Capacity of Occupancy: $occ<br/>";
$_SESSION['main_header'] = "";
$_SESSION['main_header']="SHD Revised Accomplishment Report 2010\n";
$_SESSION['main_header'].="STUDENT HOUSING DIVISION\n";
$_SESSION['main_header'].="UPLB HOUSING OFFICE\n";
$_SESSION['main_header'].="UP LOS BANOS, COLLEGE, LAGUNA\n";
$_SESSION['main_header'].="Accomplishment Report for the Month of $month $year\n\n";
$_SESSION['main_header'].="\nTotal Capacity of Occupancy: $occ\n";
//print_r($part1Table1);
//if(trim($part1Table1)!=""){

$_SESSION['report_header'][1] = "Sex\tNo.\tPercentage of Occupany\tChecked\t\tClassification\n\t\t\tIn\tOut\tFreshman\tSophomore\tJunior\tSenior\t\n";
$_SESSION['report_value'][1] =""; 
$table1 = "<table border = \"1\">";
$table1.="<tr><th rowspan=\"2\">Sex</td><th rowspan=\"2\">No.</th><th rowspan=\"2\">Percentage of Occupancy</th><th rowspan=\"1\" colspan =\"2\">Checked</th><th rowspan=\"1\" colspan =\"4\">Classification</th></tr>";
$table1.="<tr><th>In</th><th>Out</th><th>Freshman</th><th>Sophomore</th><th>Junior</th><th>Senior</th></tr>";
bcscale(2);
if(isset($part1Table1[0])){
$percent = $part1Table1[0]/$occ;
$percent = bcmul((string)$percent,"100");
$percent.="%";
$table1.="<tr><td>Male</td><td>$part1Table1[0]</td><td>$percent</td><td>$part2Table1[0]</td><td>$part2Table1[1]</td><td>$part1Table1[2]</td><td>$part1Table1[4]</td><td>$part1Table1[6]</td><td>$part1Table1[8]</td></tr>";
$_SESSION['report_value'][1].="Male\t$part1Table1[0]\t$percent\t$part2Table1[0]\t$part2Table1[1]\t$part1Table1[2]\t$part1Table1[4]\t$part1Table1[6]\t$part1Table1[8]";
$percent = $part1Table1[1]/$occ;
$percent = bcmul((string)$percent,"100");
$percent.="%";
$_SESSION['report_value'][1].="\nFemale\t$part1Table1[1]\t$percent\t$part2Table1[2]\t$part2Table1[3]\t$part1Table1[3]\t$part1Table1[5]\t$part1Table1[7]\t$part1Table1[9]";

$table1.="<tr><td>Female</td><td>$part1Table1[1]</td><td>$percent</td><td>$part2Table1[2]</td><td>$part2Table1[3]</td><td>$part1Table1[3]</td><td>$part1Table1[5]</td><td>$part1Table1[7]</td><td>$part1Table1[9]</td></tr>";
$prev = explode(",",$prevAccRe);


$acc = explode(",",$accRe);
}
echo $table1."</table>";
//}

echo "Note: Attach names of students who checked in/out<br>";
echo "Percentage of Occupancy=(Total # of accommodated students/total capacity of dormitory)*100%<br><br>";
$_SESSION['report_value'][1] .="\nNote: Attach names of students who checked in/out\n"; 
$_SESSION['report_value'][1].= "Percentage of Occupancy=(Total # of accommodated students/total capacity of dormitory)*100%\n";


if($appData!=""){
echo "B. Units of Appliances";
$_SESSION['report_header'][2] ="B. Units of Appliances\n";
$table2 = "<table border = \"1\">";
$cntApp = count($appData);
$table2.="<tr><th>Type</th>";

$appNames = array_keys($appData);
$_SESSION['report_value'][2] = "Type";
foreach($appNames as $an){
$_SESSION['report_value'][2].="\t$an";	
$table2.="<th>$an</th>";	
}
$_SESSION['report_value'][2].="\tTOTAL\n";
$table2.="<th>TOTAL</th></tr>";	
$cnt = 0;
$in = ""; $can = ""; $con = "";
foreach($appData as $ad){
	
	$temp = explode(",",$ad);
	$in[$cnt]=$temp[0]; $can[$cnt]=$temp[1]; $con[$cnt]=$temp[2];
$cnt++;
}

$table2.="<tr><th>INSTALLED</th>"; 
$_SESSION['report_value'][2].="INSTALLED";
$totalIn="0";
foreach ($in as $i){
	$_SESSION['report_value'][2].="\t$i";
	$table2.="<td>$i</td>";
	$temp = bcadd($totalIn,$i);
	$totalIn = $temp;
}

$table2.="<td>$totalIn</td></tr>";
$_SESSION['report_value'][2].="\t$totalIn\n";
		
$table2.="<tr><th>CANCELLED</th>"; 
$_SESSION['report_value'][2].="CANCELLED";

$totalIn="0";
foreach ($can as $i){
		$_SESSION['report_value'][2].="\t$i";
	
	$table2.="<td>$i</td>";
	$temp = bcadd($totalIn,$i);
	$totalIn = $temp;
}
$table2.="<td>$totalIn</td></tr>";

$_SESSION['report_value'][2].="\t$totalIn\n";	

	
$table2.="<tr><th>CONFISCATED</th>"; 
$_SESSION['report_value'][2].="CONFISCATED";

$totalIn="0";
foreach ($con as $i){
		$_SESSION['report_value'][2].="\t$i";
	
	$table2.="<td>$i</td>";
	$temp = bcadd($totalIn,$i);
	$totalIn = $temp;
}
$table2.="<td>$totalIn</td></tr>";
	
echo $table2."</table><br><br>";
$_SESSION['report_value'][2].="\t$totalIn\n";	

}
//table3 is for transient

echo "C. Transient Accomodation<br/>";
$_SESSION['report_header'][3] ="C. Transient Accomodation\n";	
if($transData!=""){
$table3 ="<table border=\"1\">";
$table3.="<tr><th rowspan=\"2\">Type</th><th rowspan=\"2\">Total</th><th colspan=\"2\">Rates</th><th rowspan=\"2\" >Total Amount Collected<th/></tr>";
$table3.="<tr><th>UP</th><th>Non-UP</th></tr>";
$_SESSION['report_header'][3].="Type\tTotal\tRates\tTotal Amount Collected\n\t\tUP\tNon-UP\n";

$sumIndi = 0;
if(trim($transData[4])!=""){
	$sumIndi = $transData[4];
}
$x = $transData[0]+$transData[1];
$table3.="<tr><td>INDIVIDUAL</td><td>$x</td><td>$transData[0]</td><td>$transData[1]</td><td>$sumIndi</td></tr>";
$_SESSION['report_value'][3] ="INDIVIDUAL\t$x\t$transData[0]\t$transData[1]\t$sumIndi\n";
$sumG = 0;
if(trim($transData[5])!=""){
	$sumG = $transData[5];
}
$x = $transData[2]+$transData[3];
$table3.="<tr><td>GROUP</td><td>$x</td><td>$transData[2]</td><td>$transData[3]</td><td>$sumG</td></tr>";
$_SESSION['report_value'][3] ="GROUP\t$x\t$transData[2]\t$transData[3]\t$sumG\n";

echo $table3."</table>";
}else{
	echo"No transient Found";
}
if($accCol!=""){
$accCol = explode(",",$accCol);
if($accCol[0]!=""){
	
$table4="<table border=\"1\">";
$table4.="<tr><th>Classification</th><th>Total Amount of collection for the<br/> Month</th><th>Percentage of Collection for the Month</th></tr>";
$_SESSION['report_value'][3] ="Classification\tTotal Amount of collection for the Month\tPercentage of Collection for the Month\n";
bcscale(2);
if(isset($acc)){
if(($accCol[0]+$acc[1]+$prev[1])!=0){
$dormPercent = bcdiv((string)$accCol[0],(string)($accCol[0]+$acc[1]+$prev[1]));
}else{
	$dormPercent="undefined";
}
if(($accCol[1]+$acc[2]+$prev[2])!=0){
$appPercent =  bcdiv((string)$accCol[1],(string)($accCol[1]+$acc[2]+$prev[2]));
}else{
	
	$appPercent ="undefined";
}
}
bcscale(0);
if(isset($dormPercent)){
$dormPercent = bcmul($dormPercent,"100");
$appPercent = bcmul($appPercent,"100");
$table4.="<tr><th>Dormitory</th><td>$accCol[0]php</td><td>$dormPercent%</td></tr>";
$table4.="<tr><th>Appliance</th><td>$accCol[1]php</td><td>$appPercent%</td></tr>";

$_SESSION['report_value'][3].="Dormitory\t$accCol[0]php\t$dormPercent%\n";
$_SESSION['report_value'][3].="Appliance\t$accCol[1]php\t$appPercent%\n";

echo "D.Actual Collections for Dormitory and Appliances Fees<br>";
$_SESSION['report_header'][3].="D.Actual Collections for Dormitory and Appliances Fees\n";
echo $table4."</table>";}

echo "*Percentage of Collection=(Total Amount of Collection)/(Total collection + Total amount of receivables)*100%<br><br>";
$_SESSION['report_header'][3].="*Percentage of Collection=(Total Amount of Collection)/(Total collection + Total amount of receivables)*100%<br><br>";
}
}
if(isset($acc)){
echo "E. Accounts Receivable<br>";
$_SESSION['report_header'][4] ="E. Accounts Receivable\n";
$table5 = "<table border=\"1\">";
$table5.= "<tr><th rowspan=\"2\">Type of<br/>Residents</th><th colspan=\"2\"><center>Fees</center></th><th rowspan=\"2\">Total</th></tr>";
$table5.="<tr><th>Dormitory</th><th>Appliance</th></tr>";
$_SESSION['report_value'][4] ="Type of Residents\tFees\t\tTotal\n\tDormitory\tAppliance\n";
$table5.="<tr><th>Current</th><td>$acc[1]</td><td>$acc[2]</td><td>$acc[0]</td></tr>";
$_SESSION['report_value'][4] ="Current\t$acc[1]\t$acc[2]\t$acc[0]\n";
$table5.="<tr><th>Previous</th><td>$prev[1]</td><td>$prev[2]</td><td>$prev[0]</td></tr>";
$_SESSION['report_value'][4] .="Previous\t$prev[1]\t$prev[2]\t$prev[0]\n";
echo $table5."</table>";
echo "<br/>F.Repairs, Maintenance Works and Projects <br/>";
$_SESSION['report_header'][5] = "\nF.Repairs, Maintenance Works and Projects\n";
echo $table6."</center>";


echo "<br/><a class=\"genRepTxt\" href=\"index.php?c=option&m=accomplishToExcel&fn=accomplishmentreport$month$year\">Click here to generate report</a>";
}
?>