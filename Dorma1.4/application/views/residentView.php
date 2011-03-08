
<?php 
if (!isset($_SESSION['tally'])){

	echo "	<h3 class=\"view_title\" onclick=\"dropDown('view_info')\">Resident Info</h3>
			<div class=\"view_info\">".$q."</div><br/>";
	
	echo "<h3 class=\"balance_title\" onclick=\"dropDown('balanceTable')\">Balance</h3>
		<div class=\"balanceTable\">".$table."</div><br/>";
	
	echo "<h3 class=\"custodian_title\" onclick=\"dropDown('custodian_info')\">Custodian</h3>
		<div class=\"custodian_info\">".$custodian."</div><br/>";
	
	echo "<h3 class=\"otherInfo_title\" onclick=\"dropDown('other_info')\">Other information</h3>
		<div class=\"other_info\">".$other."</div><br/>";
	
	echo "<h3 class=\"appliance_title\" onclick=\"dropDown('appliance_info')\">Appliance(s)</h3>
		<div class=\"appliance_info\">".$app."</div><br/>";
	echo "<h3 class=\"payment_title\" onclick=\"dropDown2('payment_info')\">Payment Option</h3>
		<div class=\"payment_info\" id=\"pay\">"."</div><br/>";
	
	
}else{
	if(isset($q[0])){
	echo "
		<h3 class=\"accomodation_title\" onclick=\"dropDown('accomodation_info')\">I. ACCOMODATION</h3>
		<div class=\"accomodation_info\">
		<table class=\"tally\">
			<tr>
				<th>Male</th>
				<th>Female</th>
				<th>Total</th>
			</tr>
			
			";
	
	echo "<tr>
				<td>$q[0]</td>
				<td>$q[1]</td>
				<td>";
	echo $q[0] + $q[1];
	

	$rmMale = $q[53] - $q[0];
	$rmFemale = $q[54] - $q[1];
	$rmTotal = $rmMale + $rmFemale;
	
	echo "</td>
			</tr>
		</table>
		</div>
		
		
		<br/>
		<h3 class=\"vacancy_title\" onclick=\"dropDown('vacancy_info')\">II. VACANCY</h3>
		<div class=\"vacancy_info\">
		<table class=\"tally\">
			<tr>
				<th>Male</th>
				<th>Female</th>
				<th>Total</th>
			</tr>
			
			<tr>
				<td>$rmMale</td>
				<td>$rmFemale</td>
				<td>$rmTotal</td>
			</tr>
		</table>
		</div>
		
		
		<br/>
		<h3 class=\"classification_title\" onclick=\"dropDown('classification_info')\">III. CLASSIFICATION</h3>
		<div class=\"classification_info\">
		<table class=\"tally\">
			<tr>
				<th>Year Level</th>
				<th>Male</th>
				<th>Female</th>
			</tr>
			
			";
	
	echo "	<tr>
				<td>New Freshaman</td>
				<td>$q[2]</td>
				<td>$q[3]</td>
			</tr>
			
			<tr>
				<td>Sophomore</td>
				<td>$q[4]</td>
				<td>$q[5]</td>
			</tr>
			
			<tr>
				<td>Junior</td>
				<td>$q[6]</td>
				<td>$q[7]</td>
			</tr>
			
			<tr>
				<td>Senior</td>
				<td>$q[8]</td>
				<td>$q[9]</td>
			</tr>
			
			<tr>
				<td>Total</td>
				<td>";
	
	echo $q[2] + $q[4] + $q[6] + $q[8];
	echo '		</td>
				<td>';
	echo $q[3] + $q[5] + $q[7] + $q[9];
	echo '		</td>
			</tr>
		</table>
		</div>';
		
	echo "
		<br/>
		<h3 class=\"college_title\" onclick=\"dropDown('college_info')\">IV. COLLEGE</h3>
		<div class=\"college_info\">
		<table class=\"tally\">
			<tr>
				<th>CA</th>
				<th>CAS</th>
				<th>CA-CAS</th>
				<th>CDC</th>
				<th>CEAT</th>
				<th>CEM</th>
				<th>CFNR</th>
				<th>CHE</th>
				<th>CVM</th>
				<th>Total</th>
			</tr>";


	echo "	<tr>
				<td>$q[10]</td>
				<td>$q[11]</td>
				<td>$q[12]</td>
				<td>$q[13]</td>
				<td>$q[14]</td>
				<td>$q[15]</td>
				<td>$q[16]</td>
				<td>$q[17]</td>
				<td>$q[18]</td>
				<td>";
	
	echo $q[10] + $q[11] + $q[12] + $q[13] + $q[14] + $q[15] + $q[16] + $q[17] + $q[18];
	echo	"	</td>
			</tr>
			
		</table>
		</div>";
	
	echo "
		<br/>
		<h3 class=\"regional_title\" onclick=\"dropDown('regional_info')\">V. REGIONAL DISTRIBUTION</h3>
		<div class=\"regional_info\">
		<table class=\"tally\">
			<tr>
				<th>Region</th>
				<th>Male</th>
				<th>Female</th>
				<th>Total</th>
			</tr>";
	
	echo "<tr>
			<td>I</td>
			<td>$q[19]</td>
			<td>$q[20]</td><td>";
	echo	$q[19] + $q[20];
	echo	"</td>
	</tr>";
	
	echo "<tr>
			<td>II</td>
			<td>$q[21]</td>
			<td>$q[22]</td><td>";
	echo	$q[21] + $q[22];
	echo	"</td>
	</tr>";
	
	echo "<tr>
			<td>III</td>
			<td>$q[23]</td>
			<td>$q[24]</td><td>";
	echo	$q[23] + $q[24];
	echo	"</td>
	</tr>";
	
	echo "<tr>
			<td>IV</td>
			<td>$q[25]</td>
			<td>$q[26]</td><td>";
	echo	$q[25] + $q[26];
	echo	"</td>
	</tr>";
	
	echo "<tr>
			<td>V</td>
			<td>$q[27]</td>
			<td>$q[28]</td><td>";
	echo	$q[27] + $q[28];
	echo	"</td>
	</tr>";
	
	echo "<tr>
			<td>VI</td>
			<td>$q[29]</td>
			<td>$q[30]</td><td>";
	echo	$q[29] + $q[30];
	echo	"</td>
	</tr>";
	
	echo "<tr>
			<td>VII</td>
			<td>$q[31]</td>
			<td>$q[32]</td><td>";
	echo	$q[31] + $q[32];
	echo	"</td>
	</tr>";
	
	echo "<tr>
			<td>VIII</td>
			<td>$q[33]</td>
			<td>$q[34]</td><td>";
	echo	$q[33] + $q[34];
	echo	"</td>
	</tr>";
	
	echo "<tr>
			<td>IX</td>
			<td>$q[35]</td>
			<td>$q[36]</td><td>";
	echo	$q[35] + $q[36];
	echo	"</td>
	</tr>";
	
	echo "<tr>
			<td>X</td>
			<td>$q[37]</td>
			<td>$q[38]</td><td>";
	echo	$q[37] + $q[38];
	echo	"</td>
	</tr>";
	
	echo "<tr>
			<td>XI</td>
			<td>$q[39]</td>
			<td>$q[40]</td><td>";
	echo	$q[39] + $q[40];
	echo	"</td>
	</tr>";
	
	echo "<tr>
			<td>XII</td>
			<td>$q[41]</td>
			<td>$q[42]</td><td>";
	echo	$q[41] + $q[42];
	echo	"</td>
	</tr>";
	
	echo "<tr>
			<td>XIII</td>
			<td>$q[43]</td>
			<td>$q[44]</td><td>";
	echo	$q[43] + $q[44];
	echo	"</td>
	</tr>";
	
	echo "<tr>
			<td>NCR</td>
			<td>$q[45]</td>
			<td>$q[46]</td><td>";
	echo	$q[45] + $q[46];
	echo	"</td>
	</tr>";
	
	echo "<tr>
			<td>CAR</td>
			<td>$q[47]</td>
			<td>$q[48]</td><td>";
	echo	$q[47] + $q[48];
	echo	"</td>
	</tr>";
	
	echo "<tr>
			<td>CARAGA</td>
			<td>$q[49]</td>
			<td>$q[50]</td><td>";
	echo	$q[49] + $q[50];
	echo	"</td>
	</tr>";
	
	echo "<tr>
			<td>ARMM</td>
			<td>$q[51]</td>
			<td>$q[52]</td><td>";
	echo	$q[51] + $q[52];
	echo	"</td>
	</tr>";
	
	echo "<tr>
			<td>Total</td><td>";
	echo	$q[19] + $q[21] + $q[23] + $q[25] + $q[27] + $q[29] + $q[31] + $q[33] + $q[35] + $q[37] + $q[39] + $q[41] + $q[43] + $q[45] + $q[47] + $q[49] + $q[51];
	echo	"</td><td>";
	
	echo	$q[20] + $q[22] + $q[24] + $q[26] + $q[28] + $q[30] + $q[32] + $q[34] + $q[36] + $q[38] + $q[40] + $q[42] + $q[44] + $q[46] + $q[48] + $q[50] + $q[52];
	echo	"</td><td>";
	
	echo	$q[20] + $q[22] + $q[24] + $q[26] + $q[28] + $q[30] + $q[32] + $q[34] + $q[36] + $q[38] + $q[40] + $q[42] + $q[44] + $q[46] + $q[48] + $q[50] + $q[52] + $q[19] + $q[21] + $q[23] + $q[25] + $q[27] + $q[29] + $q[31] + $q[33] + $q[35] + $q[37] + $q[39] + $q[41] + $q[43] + $q[45] + $q[47] + $q[49] + $q[51];
	echo	"</td>

	</tr>
	</table>
	</div>";
	}else{echo "No Record Found";}
	
	unset($_SESSION['tally']);

} 




?>
