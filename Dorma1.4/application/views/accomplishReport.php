<?php
echo "<center>SHD Revised Accomplishment Report 2010<br/></center>";
echo "<center>STUDENT HOUSING DIVISION<br/></center>";
echo "<center>UPLB HOUSING OFFICE<br/></center>";
echo "<center>UP LOS BANOS, COLLEGE, LAGUNA<br/></center>";
echo "<center>Accomplishment Report for the Month of OCTOBER 2010<br/></center>";

echo "<center>Total Capacity of Occupancy: 288<br/>";

$table1 = "<table border = \"1\">";
$table1.="<tr><th rowspan=\"2\">Sex</td><th rowspan=\"2\">No.</th><th rowspan=\"2\">Percentage of Occupancy</th><th rowspan=\"1\" colspan =\"2\">Checked</th><th rowspan=\"1\" colspan =\"4\">Classification</th></tr>";
$table1.="<tr><th>In</th><th>Out</th><th>Freshman</th><th>Sophomore</th><th>Junior</th><th>Senior</th></tr>";
bcscale(2);
$percent = $part1Table1[0]/$occ;
$percent = bcmul((string)$percent,"100");
$percent.="%";
$table1.="<tr><td>Male</td><td>$part1Table1[0]</td><td>$percent</td><td>$part2Table1[0]</td><td>$part2Table1[1]</td><td>$part1Table1[2]</td><td>$part1Table1[4]</td><td>$part1Table1[6]</td><td>$part1Table1[8]</td></tr>";

$percent = $part1Table1[1]/$occ;
$percent = bcmul((string)$percent,"100");
$percent.="%";
$table1.="<tr><td>Female</td><td>$part1Table1[1]</td><td>$percent</td><td>$part2Table1[2]</td><td>$part2Table1[3]</td><td>$part1Table1[3]</td><td>$part1Table1[5]</td><td>$part1Table1[7]</td><td>$part1Table1[9]</td></tr>";
$prev = explode(",",$prevAccRe);


$acc = explode(",",$accRe);
echo $table1."</table>";


echo "Note: Attach names of students who checked in/out<br>";
echo "Percentage of Occupancy=(Total # of accommodated students/total capacity of dormitory)*100%<br><br>";
echo "B. Units of Appliances";

$table2 = "<table border = \"1\">";
$cntApp = count($appData);
$table2.="<tr><th>Type</th>";
$appNames = array_keys($appData);

foreach($appNames as $an){
	
$table2.="<th>$an</th>";	
}
$table2.="<th>TOTAL</th></tr>";	
$cnt = 0;
$in = ""; $can = ""; $con = "";
foreach($appData as $ad){
	
	$temp = explode(",",$ad);
	$in[$cnt]=$temp[0]; $can[$cnt]=$temp[1]; $con[$cnt]=$temp[2];
$cnt++;
}

$table2.="<tr><th>INSTALLED</th>"; 
$totalIn="0";
foreach ($in as $i){
	$table2.="<td>$i</td>";
	$temp = bcadd($totalIn,$i);
	$totalIn = $temp;
}
$table2.="<td>$totalIn</td></tr>";
	
$table2.="<tr><th>CANCELLED</th>"; 
$totalIn="0";
foreach ($can as $i){
	$table2.="<td>$i</td>";
	$temp = bcadd($totalIn,$i);
	$totalIn = $temp;
}
$table2.="<td>$totalIn</td></tr>";
	

	
$table2.="<tr><th>CONFISCATED</th>"; 
$totalIn="0";
foreach ($con as $i){
	$table2.="<td>$i</td>";
	$temp = bcadd($totalIn,$i);
	$totalIn = $temp;
}
$table2.="<td>$totalIn</td></tr>";
	
echo $table2."</table><br><br>";

//table3 is for transient

$accCol = explode(",",$accCol);
$table4="<table border=\"1\">";
$table4.="<tr><th>Classification</th><th>Total Amount of collection for the<br/> Month</th><th>Percentage of Collection for the Month</th></tr>";
bcscale(2);
$dormPercent = bcdiv((string)$accCol[0],(string)($accCol[0]+$acc[1]+$prev[1]));
$appPercent =  bcdiv((string)$accCol[1],(string)($accCol[1]+$acc[2]+$prev[2]));
bcscale(0);
$dormPercent = bcmul($dormPercent,"100");
$appPercent = bcmul($appPercent,"100");
$table4.="<tr><th>Dormitory</th><td>$accCol[0]php</td><td>$dormPercent%</td></tr>";
$table4.="<tr><th>Appliance</th><td>$accCol[1]php</td><td>$appPercent%</td></tr>";

echo "D.Actual Collections for Dormitory and Appliances Fees<br>";
echo $table4."</table>";
/*
$table5 ="<table border = \"1\" >" ;
$table5 ="<tr>"."<td>Type of Residents</td>"."<td>Current</td>".
"<td>Previous</td>".
"<td>Fees</td>".
"<td>Dormitory</td>".
"<td>Current</td>".
"<td>Previous</td>".
"<td>Appliance</td>".
"<td>Current</td>".
"<td>Previous</td>".

"<td>Total</td>".
"<td>Current</td>".
"<td>Previous</td>";
echo $table5."</tr></table>";
*/


echo "*Percentage of Collection=(Total Amount of Collection)/(Total collection + Total amount of receivables)*100%<br><br>";
echo "E. Accounts Receivable<br>";
$table5 = "<table border=\"1\">";
$table5.= "<tr><th rowspan=\"2\">Type of<br/>Residents</th><th colspan=\"2\"><center>Fees</center></th><th rowspan=\"2\">Total</th></tr>";
$table5.="<tr><th>Dormitory</th><th>Appliance</th></tr>";
$table5.="<tr><th>Current</th><td>$acc[1]</td><td>$acc[2]</td><td>$acc[0]</td></tr>";
$table5.="<tr><th>Previous</th><td>$prev[1]</td><td>$prev[2]</td><td>$prev[0]</td></tr>";
echo $table5."</table>";
echo "<br/>F.Repairs, Maintenance Works and Projects <br/>";
echo $table6."</center>";

?>