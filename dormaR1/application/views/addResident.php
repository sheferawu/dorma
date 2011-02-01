<?php 
//problem: naming convention of variables specially the 'name' attribute of the html tags

?>
<html>
	<head>
		<title>Add Resident</title>
		<link rel="stylesheet" type="text/css" href="CSS/style.css" />
		<script type="text/javascript" src=JS/addJS.js></script>
		
	</head>
	
	<body>
		<form action="index.php?c=resident&m=getData" method="POST" name="residentForm"  onsubmit="return(validateForm(this))">
			<table class="addResi">
				<tr class="r1">
					<td>Last Name:</td>					
					<td><input type="text" name="lastname" id="lastname"></td>					
					<td id="ln" class="error"></td>
				</tr>
				
				<tr>
					<td> First Name: </td>
					<td><input type="text" name="firstname"></td>
					<td id="fn" class="error"></td>
				</tr>
				
				<tr class="r1">
					<td>Middle Name: </td>
					<td><input type="text" name="middlename"></td>
					<td id="mn" class="error"></td>
				</tr>
				
				<tr>
					<td>Date of Birth:</td>
					<td>
					<select name="Month"  onchange="getMonth(this.options[this.selectedIndex].value)">
					<option value="0" >Month</option>
					<option value="Jan"  >January</option>
					<option value="Feb" >February</option>
					<option value="Mar" >March</option>
					<option value="Apr" >April</option>
					<option value="May" >May</option>
					<option value="Jun" >June</option>
					<option value="Jul" >July</option>
					<option value="Aug" >August</option>
					<option value="Sep" >September</option>
					<option value="Oct" >October</option>
					<option value="Nov" >November</option>
					<option value="Dec" >December</option>
					</select>
					<div style="display:inline;" id = "Day">
					<select name="Day" >
					<option value="">Day</option>
					</select>
					</div>
					<div style="display:inline;" id = "Year">
					<select name="Year">
					<option value="">Year</option>
					<option value=""></option>
					</select>
					</div>
					</td>
					<td class="error"></td>
				</tr>
				
				<tr class="r1">
					<td>Age: </td>
					<td><input type="text" name="Age" size="5"></td>
					<td id="age" class="error"></td>
				</tr>
		
				<tr>
					<td>Gender:</td>
					<td><select name="Gender">
					<option value="M">Male</option>
					<option value="F">Female</option>
					</select></td>
					<td class="error"></td>
				</tr>
			
				<tr class="r1">
					<td>Civil Status:</td>
					<td><select name="CivilStatus">
					<option value="single">Single</option>
					<option value="married">Married</option>
					<option value="separated">Separated</option>
					<option value="widowed">Widowed</option>
					</select></td>
					<td class="error"></td>
				</tr>
				
				<tr>
					<td>Last School Attended:</td>
					<td><input type="text" name="lastSchoolAttended" size="25"></td>
					<td id="lsa" class="error"></td>
				</tr>
				
				<tr class="r1">
					<td>School Type:</td>
					<td><select name="SchoolType">
					<option value="Public">Public</option>
					<option value="Private">Private</option>
					</select></td>
					<td class="error"></td>
				</tr>
				
				<tr>
					<td>Religion:</td>
					<td><input type="text" name="Religion"></td>
					<td id="rel" class="error"></td>
				</tr>
				
				<tr class="r1">
					<td colspan="3">&nbsp;</td>
				</tr>
							
				<tr>
					<td>Student Number:</td>
					<td><select name="Batch" onchange="setBatch(this.options[this.selectedIndex].value)">
						<?php 
						for($i = 1950;$i<=2012;$i++) {echo "<option value=\"$i\">$i</option>";}
							?>
</select>
					- <input type="text" name="StudNumber" size="5"></td>
					<td id="std" class="error"></td>
				</tr>
				<tr class="r1">
				<td>
				College:
				</td>
				<td>
			<select  onchange="getCourse(this.options[this.selectedIndex].value)" name="college">
			<option value="CA" >CA</option>
			<option value="CAS">CAS</option>
			<option value="CDC">CDC</option>
			<option value="CEM">CEM</option>
			<option value="CEAT">CEAT</option>
			<option value="CFNR">CFNR</option>
			<option value="CHE">CHE</option>
			<option value="CVM">CVM</option>		
			</select>

					</td>	<td class="error"></td>
				
				</tr>
				<tr>
					<td>Course:</td>
					<td>
					<div id="courses" style="display:inline">
					<select name="course">
					<option value="0">Please select a College</option></select>
					</div></td>
					<td class="error"></td>
				</tr>
				
				<tr class="r1">
					<td>Classification:</td>
					<td><select name="classification">
					<option value="Freshman">Freshman</option>
					<option value="Sophomore">Sophomore</option>
					<option value="Junior">Junior</option>
					<option value="Senior">Senior</option></select></td>
					<td id="cls" class="error"></td>
				</tr>
				
				<tr>
					<td>STFAP Bracket:</td>
					<td><div style="display:inline" id="stfap">
					<select name="STFAPBracket">
					<option value="0">Please select a batch</option>
					</select>
					</div>
					</td>
					<td class="error"></td>
				</tr>
				
				<tr class="r1">
					<td>Scholarship:</td>
					<td><input type="text" name="Scholarship" size="40"></td>
					<td id="scho" class="error"></td>
				</tr>
				
				<tr>
					<td>Monthly Stipend (Php):</td>
					<td><input type="text" name="MonthlyStipend" class="digit" size="20"></td>
					<td id="stipend" class="error"></td>
				</tr>
				
				<tr class="r1">
					<td>Home Address:</td>
					<td><input type="text" name="HomeAddress" size="40"></td>
					<td id="ad" class="error"></td>
				</tr>
				
				<tr>
					<td>Region:</td>
					<td><select name="Region">
					<option value="NCR">NCR</option>
					<option value="CAR">CAR</option>
					<option value="Region1">Region I</option>
					<option value="RegionII">Region II</option>
					<option value="RegionIII">Region III</option>
					<option value="RegionIV-A">Region IV-A</option>
					<option value="RegionIV-B">Region IV-B</option>
					<option value="RegionV">Region V</option>
					<option value="RegionVI">Region VI</option>
					<option value="RegionVII">Region VII</option>
					<option value="RegionVIII">Region VIII</option>
					<option value="RegionIX">Region IX</option>
					<option value="RegionX">Region X</option>
					<option value="RegionXI">Region XI</option>
					<option value="RegionXII">Region XII</option>
					<option value="Caraga">Caraga Region</option>
					<option value="ARMM">ARMM</option></select></td>
					<td class="error"></td>
				</tr>
				
				<tr class="r1">
					<td>Telephone Number:</td>
					<td><input type="text" name="TelephoneNumber" size="25"></td>
					<td id="tel" class="error"></td>
				</tr>
								
				<tr>
					<td>Email:</td>
					<td><input type="text" name="Email" size="25"></td>
					<td id="mail" class="error"></td>
				</tr>
				
				<tr class="r1">
					<td> Marital Status: </td>
					<td> <input type="radio" name="marriageStatus" value="married" checked="checked"> Parents still married <br/>
						 <input type="radio" name="marriageStatus" value="separated"> Parents separated <br/>
						 <input type="radio" name="marriageStatus" value="remarried"> Parents remarried <br/>
						 <input type="radio" name="marriageStatus" value="single"> Single-Parent
					</td>
					<td class="error"></td>
				</tr>
				
				<tr>
					<td>Parents: </td>
					<td>
					<input type="radio" name="cmliving" checked="checked" value="both"> Both Living <br/>
					<input type="radio" name="cmliving" value="f_deceased"> Father Deceased <br/>
					<input type="radio" name="cmliving" value="m_deceased"> Mother Deceased <br/>
					<input type="radio" name="cmliving" value="both_deceased"> Noth Deceased <br/>
					
					</td>
					<td id="cmliving" class="error"></td>
				</tr>
				
				<tr class="r1">
					<td>Father's Name:</td>					
					<td><input type="text" name="cfname" id="cfname"></td>					
					<td id="cfn" class="error"></td>
				</tr>
				
				<tr>
					<td>Occupation: </td>
					<td><input type="text" name="cfocc"></td>
					<td id="cfo" class="error"></td>
				</tr>
				
				<tr class="r1">
					<td>Monthly Income: </td>
					<td><input type="text" name="cfincome"></td>
					<td id="cfi" class="error"></td>
				</tr>
				
				<tr>
					<td>Employer: </td>
					<td><input type="text" name="cfemp"></td>
					<td id="cfe" class="error"></td>
				</tr>
				
				<tr class="r1">
					<td>Office Address: </td>
					<td><input type="text" name="cfadd"></td>
					<td id="cfa" class="error"></td>
				</tr>
				
				<tr>
					<td>Telephone Number: </td>
					<td><input type="text" name="cftelno"></td>
					<td id="cftn" class="error"></td>
				</tr>
				
				
				<tr class="r1">
					<td>Mother's Name:</td>					
					<td><input type="text" name="cmname" id="cmname"></td>					
					<td id="cmn" class="error"></td>
				</tr>
				
				<tr>
					<td>Occupation: </td>
					<td><input type="text" name="cmocc"></td>
					<td id="cmo" class="error"></td>
				</tr>
				
				<tr class="r1">
					<td>Monthly Income: </td>
					<td><input type="text" name="cmincome"></td>
					<td id="cmi" class="error"></td>
				</tr>
				
				<tr>
					<td>Employer: </td>
					<td><input type="text" name="cmemp"></td>
					<td id="cme" class="error"></td>
				</tr>
				
				<tr class="r1">
					<td>Office Address: </td>
					<td><input type="text" name="cmadd"></td>
					<td id="cma" class="error"></td>
				</tr>
				
								
				<tr>
					<td>Telephone Number: </td>
					<td><input type="text" name="cmtelno"></td>
					<td id="cmtn" class="error"></td>
				</tr>
				
				<tr class="r1">
					<td>No.of Brother(s):</td>
					<td><input class="digit" type="text" name="NumBrothers" size="5"></td>
					<td id="bro" class="error"></td>
				</tr>
				
				<tr>
					<td>No.of Sister(s):</td>
					<td><input class="digit" type="text" name="NumSisters" size="5"></td>
					<td id="sis" class="error"></td>
				</tr>
				
				<tr class="r1">
					<td>Birth order:</td>
					<td><input type="text" name="BirthOrder" size="10"></td>
					<td id="bor" class="error"></td>
				</tr>
				
				<tr>
					<td>Other Sources of Income:</td>
					<td><input type="text" name="otherSourcesOfIncome" size="10"></td>
					<td id="osi" class="error"></td>
				</tr>
				
				<tr class="r1">
					<td>Amount:</td>
					<td><input type="text" name="otherIncomeAmount" size="10"></td>
					<td id="oia" class="error"></td>
				</tr>
				
				
				<tr>
					<td>Hobbies:</td>
					<td><input type="text" name="Hobbies" size="25"></td>
					<td id="hobby" class="error"></td>
				</tr>
				
				<tr class="r1">
					<td>Honors Received:</td>
					<td><input type="text" name="Honors" size="25"></td>
					<td id="honor" class="error"></td>
				</tr>
				
				<tr>
					<td>Talent(s):</td>
					<td><input type="text" name="Talents[0]" size="25"><div id="addTalent" style="display:inline;"></div><input type="button" value="+" onclick("")/></td>
					<td id="talent" class="error"></td>
				</tr>
				
				<tr class="r1">
					<td>Organization:</td>
					<td><input type="text" name="Org"></td>
					<td id="orga" class="error"></td>
				
				</tr>
				
				<tr>
					<td>Ailments:</td>
					<td><input type="text" name="Ailments" size="25"></td>
					<td id="ail" class="error"></td>
				</tr>
				
				<tr class="r1">
					<td>Medications:</td>
					<td><input type="text" name="Medications" size="25"></td>
					<td id="med" class="error"></td>
				</tr>
				
				<tr>
					<td>Boyfriend/Girlfriend?:</td>
					<td><input type="radio" name="bfgf" checked="checked" value="1">Yes
						<input type="radio" name="bfgf" value="0">None<br/>
						<input type="radio" name="bfgf" value="2">Still Searching
						<input type="radio" name="bfgf" value="3">Not Applicable
					</td>
					<td id="med" class="error"></td>
				</tr>
				
				
				<tr class="r1">
					<td>Guardian 1:</td>					
					<td><input type="text" name="cg1name" id="cg1name"></td>					
					<td id="cg1" class="error"></td>
				</tr>
				
				<tr>
					<td>Telephone Number: </td>
					<td><input type="text" name="cg1telno"></td>
					<td id="cg1tn" class="error"></td>
				</tr>
				
				<tr class="r1">
					<td>Address: </td>
					<td><input type="text" name="cg1add"></td>
					<td id="cg1a" class="error"></td>
				</tr>
				
				<tr>
					<td>Guardian 2:</td>					
					<td><input type="text" name="cg2name" id="cg2name"></td>					
					<td id="cg2" class="error"></td>
				</tr>
				
				<tr class="r1">
					<td>Telephone Number: </td>
					<td><input type="text" name="cg2telno"></td>
					<td id="cg2tn" class="error"></td>
				</tr>
				
				<tr>
					<td>Address: </td>
					<td><input type="text" name="cg2add"></td>
					<td id="cg2a" class="error"></td>
				</tr>
				
					
				<tr>
					<td>RoomNumber: </td>
					<td><input type="text" name="RoomNumber"></td>
					<td id="rn" class="error"></td>
				</tr>
				
				<tr>
					<td colspan="3"><input type="button" value="Load Appliances" id="loadApp" onclick='loadAppliances("index.php?c=resident&m=addAppliance")')/></td>
					
				</tr>
				<tr>
					<td colspan="3"><div style="inline" id="app"> </div></td>
				</tr>
				<tr>
					<td colspan="3"><input type="submit" value="Submit" name="submitResident"/></td>
				</tr>
				
			</table>
		</form>
	</body>
</html>