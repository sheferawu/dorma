<?php
?>

<html>
	<head>
	</head>

	<body>
		
		<form name="violationForm" method="post" action="index.php?c=resident&m=getViolation" onsubmit="return(validateViolationForm(this))">
		<h3>Violation</h3>
		<table>
			<tr>
				<td>Last name:</td>
				<td><input type="text" name="lastname" size="30" id="lnameV" onkeyup="searchV('divlnameV')" onkeydown="searchV('divlnameV')"/></td>
				<td><div id="divlnameV"> </div></td>
			</tr>
			
			<tr>
				<td>First name:</td>
				<td><input type="text" name="firstname"  size="30" id="fnameV" onkeyup= "searchV('divfnameV')" onkeydown="searchV('divfnameV')" /></td>
				<td><div id="divfnameV"> </div></td>
			
			</tr>
			<tr>
				<td>Middle name:</td>
				<td><input type="text" name="middlename"  size="30" id="mnameV" onkeyup="searchV('divmnameV')" onkeydown="searchV('divmnameV')" /></td>
				<td><div id="divmnameV"> </div></td>
			
			</tr>
			<tr>
				<td>Nature:</td>
				<td><input type="text" name="violationNature" id="violationNature" size="30"></td>
			</tr>
			
			<tr>
				<td>Date of Violation:</td>
				<td>
					<select name="Month" id="Month" onchange="getMonth(this.options[this.selectedIndex].value,'Day','Year')">
						<option value="0" >Month</option>
						<option value="1"  >January</option>
						<option value="2" >February</option>
						<option value="3" >March</option>
						<option value="4" >April</option>
						<option value="5" >May</option>
						<option value="6" >June</option>
						<option value="7" >July</option>
						<option value="8" >August</option>
						<option value="9" >September</option>
						<option value="10" >October</option>
						<option value="11" >November</option>
						<option value="12" >December</option>
					</select>
					<div style="display:inline;" id = "Day">
						<select name="Day">
							<option value="">Day</option>
						</select>
					</div>
					<div style="display:inline;" id = "Year">
						<select name="Year" >
							<option value="">Year</option>
							<option value=""></option>
						</select>
					</div>
				</td>
			</tr>
			
			<tr>
				<td>Action Taken:</td>
				<td><input type="text" name="actionTaken" id="actionTaken" size="30"></td>
			</tr>
			
			<tr>
				<td>Date:</td>
				<td>
					<select name="MonthAction" id="MonthAction" onchange="getMonth(this.options[this.selectedIndex].value,'DayAction','YearAction')">
						<option value="0" >Month</option>
						<option value="1"  >January</option>
						<option value="2" >February</option>
						<option value="3" >March</option>
						<option value="4" >April</option>
						<option value="5" >May</option>
						<option value="6" >June</option>
						<option value="7" >July</option>
						<option value="8" >August</option>
						<option value="9" >September</option>
						<option value="10" >October</option>
						<option value="11" >November</option>
						<option value="12" >December</option>
					</select>
					<div style="display:inline;" id = "DayAction">
						<select name="DayAction">
							<option value="">Day</option>
						</select>
					</div>
					<div style="display:inline;" id = "YearAction">
						<select name="YearAction" >
							<option value="">Year</option>
							<option value=""></option>
						</select>
					</div>
				</td>
			</tr>
		</table>
		<br/>
		<input type="submit" name="addViolation" value="Submit"/>
		</form>
	
	</body>
</html>