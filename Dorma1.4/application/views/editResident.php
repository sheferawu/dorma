<?php 
//problem: naming convention of variables specially the 'name' attribute of the html tags
//			Batch year is between 1950-2012 (possible solution: get current year)
?>
<html>
	<head>
		
	</head>
	
	<body>
		<form action="index.php?c=resident&m=updateData" method="POST" name="residentForm"  onsubmit="return(validateForm(this))">
			<h3 class="resident_title" onclick="dropDown('resident_info')">Resident's Information</h3>
			<div class="resident_info">
				<table class="addResi">
					<tr class="r1">
						<td>Last Name:</td>					
						<td><input type="text" name="lastname" id="lastname" size="35" value='<?php echo $resident["LastName"];?>'/></td>					
						<td id="ln" class="error"></td>
					</tr>
					
					<tr>
						<td> First Name: </td>
						<td><input type="text" name="firstname" size="35"  value='<?php echo $resident["FirstName"];?>'></td>
						<td id="fn" class="error"></td>
					</tr>
					
					<tr class="r1">
						<td>Middle Name: </td>
						<td><input type="text" name="middlename" size="35"  value='<?php echo $resident["MidName"];?>'></td>
						<td id="mn" class="error"></td>
					</tr>
					
					<tr>
						<td>Date of Birth:</td>
						<td>
						
							<?php 
									$bday = $resident["Bday"];
									$bdayArray = explode("/", $bday);					
							?>
						
							<select name="Month"  onchange="getMonth(this.options[this.selectedIndex].value,'Day','Year')">
								<?php 
									$bool="";
									for($i=0;$i<12;$i++){
										$bool[$i] ="";
									}
									

										if(trim($bdayArray[0]) == "jan") $bool[0]="selected=\"selected\"" ;
										else if(trim($bdayArray[0]) == "feb") $bool[1]="selected=\"selected\"" ;
										else if(trim($bdayArray[0]) == "mar") $bool[2]="selected=\"selected\"" ;
										else if(trim($bdayArray[0]) ==  "apr") $bool[3]="selected=\"selected\"" ;
										else if(trim($bdayArray[0]) == "may") $bool[4]="selected=\"selected\"" ;
										else if(trim($bdayArray[0]) == "jun") $bool[5]="selected=\"selected\"" ;
										else if(trim($bdayArray[0]) == "jul") $bool[6]="selected=\"selected\"" ;
										else if(trim($bdayArray[0]) == "aug") $bool[7]="selected=\"selected\"" ;
										else if(trim($bdayArray[0]) == "sep") $bool[8]="selected=\"selected\"" ;
										else if(trim($bdayArray[0]) == "oct") $bool[9]="selected=\"selected\"" ;
										else if(trim($bdayArray[0]) == "nov") $bool[10]="selected=\"selected\"" ;
										else if(trim($bdayArray[0]) == "dec") $bool[11]="selected=\"selected\"" ;
									
									
									?>
									<?php echo 
										"<option value=\"Jan\" $bool[0]>January</option>
										<option value=\"Feb\" $bool[1] >February</option>
										<option value=\"Mar\" $bool[2]>March</option>
										<option value=\"Apr\" $bool[3]>April</option>
										<option value=\"May\" $bool[4]>May</option>
										<option value=\"Jun\" $bool[5]>June</option>
										<option value=\"Jul\" $bool[6]>July</option>
										<option value=\"Aug\" $bool[7]>August</option>
										<option value=\"Sep\" $bool[8]>September</option>
										<option value=\"Oct\" $bool[9]>October</option>
										<option value=\"Nov\" $bool[10]>November</option>
										<option value=\"Dec\" $bool[11]>December</option>";
									?>
							</select>
							
							<div style="display:inline;" id = "Day">
								
								<select name="Day" >
								<?php 
									echo "<option value=\"$bdayArray[1]\">$bdayArray[1]</option>";					
								?>
								</select>
							</div>
						<div style="display:inline;" id = "Year">
							<select name="Year">
								<?php 
									echo "<option value=\"$bdayArray[2]\">$bdayArray[2]</option>";					
								?>
							</select>
						</div>
						</td>
						<td class="error" id="bday"></td>
					</tr>
					
					<tr class="r1">
						<td>Age: </td>
						<td><input type="text" name="Age" size="5" disabled value='<?php echo $resident["Age"];?>'></td>
						<td id="age" class="error"></td>
					</tr>
			
					<tr>
						
						<td>Gender:</td>
						<td><select name="Gender">
						<?php 
							$bool="";
							for($i=0;$i<2;$i++){
								$bool[$i] ="";
							}
							
							if($resident["Gender"] == "male") $bool[0] ="selected=\"selected\"";
							else if($resident["Gender"] == "female") $bool[1] ="selected=\"selected\"";
							
							
							echo "
								<option value=\"MALE\" $bool[0]>Male</option>
								<option value=\"FEMALE\" $bool[1]>Female</option>";
						
						
						?>
						</select></td>
						<td class="error"></td>
					</tr>
				
					<tr class="r1">
						<td>Civil Status:</td>
						<td><select name="CivilStatus">
						
						<?php 
							$bool="";
							for($i=0;$i<4;$i++){
								$bool[$i] ="";
							}
							
							if(trim($resident["CivStatus"]) == "single") $bool[0] ="selected=\"selected\"";
							else if(trim($resident["CivStatus"]) == "married") $bool[1] ="selected=\"selected\"";
							else if(trim($resident["CivStatus"]) == "separated") $bool[2] ="selected=\"selected\"";
							else if(trim($resident["CivStatus"]) == "widowed") $bool[3] ="selected=\"selected\"";
						
							echo "
								<option value=\"single\" $bool[0] >Single</option>
								<option value=\"married\" $bool[1] >Married</option>
								<option value=\"separated\" $bool[2] >Separated</option>
								<option value=\"widowed\" $bool[3] >Widowed</option>";
						
						?>
						</select></td>
						<td class="error"></td>
					</tr>
					
					<tr>
						<td>Last School Attended:</td>
						<td><input type="text" name="lastSchoolAttended" size="35"  value='<?php echo $resident["LastSchoolAttended"];?>'></td>
						<td id="lsa" class="error"></td>
					</tr>
					
					<tr class="r1">
						<td>School Type:</td>
						<td><select name="SchoolType">
						<?php 
							$bool="";
							for($i=0;$i<2;$i++){
								$bool[$i] ="";
							}
							
							if($resident["Gender"] == "male") $bool[0] ="selected=\"selected\"";
							else if($resident["Gender"] == "female") $bool[1] ="selected=\"selected\"";
							
							
							echo "
								<option value=\"Public\" $bool[0]>Public</option>
								<option value=\"Private\" $bool[1]>Private</option>";
						
						
						?>
						
						</select></td>
						<td class="error"></td>
					</tr>
					
					<tr>
						<td>Religion:</td>
						<td><input type="text" name="Religion" value='<?php if(isset($resident["Religion"])) echo $resident["Religion"];?>'></td>
						<td id="rel" class="error"></td>
					</tr>
					
					<tr class="r1">
						<td colspan="3">&nbsp;</td>
					</tr>
								
					<tr>
						<td>Student Number:</td>
						<td>
							<select name="Batch" onchange="setBatch(this.options[this.selectedIndex].value)">
								<?php
									if(isset($resident["StudentNumber"])){ 
									$studNo = $resident["StudentNumber"];
									
									$bool = "";
						
									$studNoArray = explode("-", $studNo);
									  $limit= strftime("%Y")+1;
							
									
									for($i = 1950;$i<=$ilmit;$i++) {
										$bool[$i] ="";
										
										if ($i == trim($studNoArray[0])) $bool[$i] ="selected=\"selected\"";
										
										echo "<option value=\"$i\" $bool[$i]>$i</option>";
									}
									}
								?>
							</select>
								- <input type="text" name="StudNumber" size="5" value='<?php echo $studNoArray[1];?>'>
						</td>
						<td id="std" class="error"></td>
					</tr>
					<tr class="r1">
						<td>
							College:
						</td>
						<td>
							<select  onchange="getCourse(this.options[this.selectedIndex].value)" name="college">
								<?php 	
									$bool="";
									for($i=0;$i<8;$i++){
										$bool[$i] ="";
									}
									if(isset($resident["College"])){
									
									if(trim($resident["College"]) == "ca") $bool[0] ="selected=\"selected\"";
									else if(trim($resident["College"]) == "cas") $bool[1] ="selected=\"selected\"";
									else if(trim($resident["College"]) == "cdc") $bool[2] ="selected=\"selected\"";
									else if(trim($resident["College"]) == "cem") $bool[3] ="selected=\"selected\"";
									else if(trim($resident["College"]) == "ceat") $bool[4] ="selected=\"selected\"";
									else if(trim($resident["College"]) == "cfnr") $bool[5] ="selected=\"selected\"";
									else if(trim($resident["College"]) == "che") $bool[6] ="selected=\"selected\"";
									else if(trim($resident["College"]) == "ca") $bool[7] ="selected=\"selected\"";
									}
									echo "<option value=\"CA\" $bool[0]>CA</option>
									<option value=\"CAS\" $bool[1]>CAS</option>
									<option value=\"CDC\" $bool[2]>CDC</option>
									<option value=\"CEM\" $bool[3]>CEM</option>
									<option value=\"CEAT\" $bool[4]>CEAT</option>
									<option value=\"CFNR\" $bool[5]>CFNR</option>
									<option value=\"CHE\" $bool[6]>CHE</option>
									<option value=\"CVM\" $bool[7]>CVM</option>";
								?>	
							</select>
						</td>	
						<td class="error"></td>
					
					</tr>
					<tr>
						<td>Course:</td>
						<td>
							<div id="courses" style="display:inline">
								<select name="course">
									<?php 
										if(isset($resident["Course"])){
										$course = strtoupper($resident["Course"]);
										echo "<option value=\"$course\">$course</option>";					
									}
									?>
								</select>
							</div>
						</td>
						<td class="error"></td>
					</tr>
					
					<tr class="r1">
						<td>Classification:</td>
						<td>
							<select name="classification">
								<?php 
									$bool="";
									for($i=0;$i<4;$i++){
										$bool[$i] ="";
									}
									if(isset($resident["Classification"])){
									if(trim($resident["Classification"]) == "freshman") $bool[0] ="selected=\"selected\"";
									else if(trim($resident["Classification"]) == "sophomore") $bool[1] ="selected=\"selected\"";
									else if(trim($resident["Classification"]) == "junior") $bool[2] ="selected=\"selected\"";
									else if(trim($resident["Classification"]) == "senior") $bool[3] ="selected=\"selected\"";
									}
									echo "<option value=\"Freshman\" $bool[0]>Freshman</option>
									<option value=\"Sophomore\" $bool[1]>Sophomore</option>
									<option value=\"Junior\" $bool[2]>Junior</option>
									<option value=\Senior\" $bool[3]>Senior</option>";
								
								?>
							</select>
						</td>
						<td id="cls" class="error"></td>
					</tr>
					
					<tr>
						<td>STFAP Bracket:</td>
						<td>
							<div style="display:inline" id="stfap">
								<select name="STFAPBracket">
									<?php 
										if(isset($resident["STFAPBracket"])){
										$STFAP = strtoupper($resident["STFAPBracket"]);
										echo "<option value=\"$STFAP\">$STFAP</option>";					
									}
									?>
								</select>
							</div>
						</td>
						<td class="error"></td>
					</tr>
					
					<tr class="r1">
						<td>Scholarship:</td>
						<td>
							<input type="text" name="Scholarship" size="40"  value='<?php if(isset($resident["ScholarshipName"])) echo $resident["ScholarshipName"];?>'>
						</td>
						<td id="scho" class="error"></td>
					</tr>
					
					<tr>
						<td>Monthly Stipend (Php):</td>
						<td>
							<input type="text" name="MonthlyStipend" class="digit" size="10" value='<?php if(isset($resident["MonthlyStipend"])) echo $resident["MonthlyStipend"];?>'>
						</td>
						<td id="stipend" class="error"></td>
					</tr>
					
					<tr class="r1">
						<td>Home Address:</td>
						<td>
							<textarea name="HomeAddress" rows="4" cols="25">
							<?php if(isset($resident["Address"])) echo $resident["Address"];?>
							</textarea>
						</td>
						<td id="ad" class="error"></td>
					</tr>
					
					<tr>
						<td>Region:</td>
						<td>
							<select name="Region">
								<?php 
									$bool="";
									for($i=0;$i<17;$i++){
										$bool[$i] ="";
									}
									if(isset($resident["Region"])){
									if(trim($resident["Region"]) == "ncr") $bool[0] ="selected=\"selected\"";
									else if(trim($resident["Region"]) == "car") $bool[1] ="selected=\"selected\"";
									else if(trim($resident["Region"]) == "region1") $bool[2] ="selected=\"selected\"";
									else if(trim($resident["Region"]) == "regionii") $bool[3] ="selected=\"selected\"";
									else if(trim($resident["Region"]) == "regioniii") $bool[4] ="selected=\"selected\"";
									else if(trim($resident["Region"]) == "regioniv-a") $bool[5] ="selected=\"selected\"";
									else if(trim($resident["Region"]) == "regioniv-b") $bool[6] ="selected=\"selected\"";
									else if(trim($resident["Region"]) == "regionv") $bool[7] ="selected=\"selected\"";
									else if(trim($resident["Region"]) == "regionvi") $bool[8] ="selected=\"selected\"";
									else if(trim($resident["Region"]) == "regionvii") $bool[9] ="selected=\"selected\"";
									else if(trim($resident["Region"]) == "regionviii") $bool[10] ="selected=\"selected\"";
									else if(trim($resident["Region"]) == "regionix") $bool[11] ="selected=\"selected\"";
									else if(trim($resident["Region"]) == "regionx") $bool[12] ="selected=\"selected\"";
									else if(trim($resident["Region"]) == "regionxi") $bool[13] ="selected=\"selected\"";
									else if(trim($resident["Region"]) == "regionxii") $bool[14] ="selected=\"selected\"";
									else if(trim($resident["Region"]) == "caraga") $bool[15] ="selected=\"selected\"";
									else if(trim($resident["Region"]) == "armm") $bool[16] ="selected=\"selected\"";
									}
									echo "<option value=\"NCR\" $bool[0]>NCR</option>
									<option value=\"CAR\" $bool[1]>CAR</option>
									<option value=\"Region1\" $bool[2]>Region I</option>
									<option value=\"RegionII\" $bool[3]>Region II</option>
									<option value=\"RegionIII\" $bool[4]>Region III</option>
									<option value=\"RegionIV-A\" $bool[5]>Region IV-A</option>
									<option value=\"RegionIV-B\" $bool[6]>Region IV-B</option>
									<option value=\"RegionV\" $bool[7]>Region V</option>
									<option value=\"RegionVI\" $bool[8]>Region VI</option>
									<option value=\"RegionVII\" $bool[9]>Region VII</option>
									<option value=\"RegionVIII\" $bool[10]>Region VIII</option>
									<option value=\"RegionIX\"  $bool[11]>Region IX</option>
									<option value=\"RegionX\"  $bool[12]>Region X</option>
									<option value=\"RegionXI\"  $bool[13]>Region XI</option>
									<option value=\"RegionXII\"  $bool[14]>Region XII</option>
									<option value=\"Caraga\"  $bool[15]>Caraga Region</option>
									<option value=\"ARMM\"  $bool[16]>ARMM</option></select></td>";
								?>
							</select>
						</td>	
						<td class="error"></td>
					</tr>
					
					<tr class="r1">
						<td>Telephone Number:</td>
						<td>
							<input type="text" name="TelephoneNumber" size="25"  value='<?php if(isset($resident["TelNo"])) echo $resident["TelNo"];?>'>
						</td>
						<td id="tel" class="error"></td>
					</tr>
									
					<tr>
						<td>Email:</td>
						<td>
							<input type="text" name="Email" size="25"  value='<?php if(isset($resident["Email"])) echo $resident["Email"];?>'>
						</td>
						<td id="mail" class="error"></td>
					</tr>
					
					<tr class="r1">
						<td> Marital Status: </td>
						<td> 
							<?php 
								$bool="";
								for($i=0;$i<4;$i++){
									$bool[$i] ="";
								}
								if(isset($resident["MarriageStatus"])){
								if(trim($resident["MarriageStatus"]) == "married") $bool[0] ="checked=\"checked\"";
								else if(trim($resident["MarriageStatus"]) == "separated") $bool[1] ="checked=\"checked\"";
								else if(trim($resident["MarriageStatus"]) == "remarried") $bool[2] ="checked=\"checked\"";
								else if(trim($resident["MarriageStatus"]) == "single") $bool[3] ="checked=\"checked\"";
								}
								echo "<input type=\"radio\" name=\"marriageStatus\" value=\"married\" $bool[0]> Parents still married <br/>
								 <input type=\"radio\" name=\"marriageStatus\" value=\"separated\" $bool[1]> Parents separated <br/>
								 <input type=\"radio\" name=\"marriageStatus\" value=\"remarried\" $bool[2]> Parents remarried <br/>
								 <input type=\"radio\" name=\"marriageStatus\" value=\"single\" $bool[3]> Single-Parent";
								
							?>
						</td>
						<td class="error"></td>
					</tr>
					
					<tr>
						<td>Parents: </td>
						<td>
							<?php 
								$bool="";
								for($i=0;$i<4;$i++){
									$bool[$i] ="";
								}
								if(isset($resident["LivingStat"])){
								if(trim($resident["LivingStat"]) == "both") $bool[0] ="checked=\"checked\"";
								else if(trim($resident["LivingStat"]) == "f_deceased") $bool[1] ="checked=\"checked\"";
								else if(trim($resident["LivingStat"]) == "m_deceased") $bool[2] ="checked=\"checked\"";
								else if(trim($resident["LivingStat"]) == "both_deceased") $bool[3] ="checked=\"checked\"";
								}
								echo "<input type=\"radio\" name=\"cmliving\" value=\"both\" $bool[0]> Both Living <br/>
								<input type=\"radio\" name=\"cmliving\" value=\"f_deceased\" $bool[1]> Father Deceased <br/>
								<input type=\"radio\" name=\"cmliving\" value=\"m_deceased\" $bool[2]> Mother Deceased <br/>
								<input type=\"radio\" name=\"cmliving\" value=\"both_deceased\" $bool[3]> Both Deceased <br/>";
							?>
						</td>
						<td id="cmliving" class="error"></td>
					</tr>
					
					<tr class="r1">
						<td>Father's Name:</td>					
						<td><input type="text" name="cfname" id="cfname" size="35"  value='<?php if(isset($resident["FatherName"])) echo $resident["FatherName"];?>'></td>					
						<td id="cfn" class="error"></td>
					</tr>
					
					<tr>
						<td>Occupation: </td>
						<td><input type="text" name="cfocc" size="35" value='<?php if(isset($resident["FatherOccupation"])) echo $resident["FatherOccupation"];?>'></td>
						<td id="cfo" class="error"></td>
					</tr>
					
					<tr class="r1">
						<td>Monthly Income: </td>
						<td><input type="text" name="cfincome" value='<?php if(isset($resident["FatherMonthlyIncome"])) echo $resident["FatherMonthlyIncome"];?>'></td>
						<td id="cfi" class="error"></td>
					</tr>
					
					<tr>
						<td>Employer: </td>
						<td><input type="text" name="cfemp" size="35"  value='<?php if(isset($resident["FatherEmployer"])) echo $resident["FatherEmployer"];?>'></td>
						<td id="cfe" class="error"></td>
					</tr>
					
					<tr class="r1">
						<td>Office Address: </td>
						<td><input type="text" name="cfadd" size="35"  value='<?php if(isset($resident["FatherOfficeAddress"])) echo $resident["FatherOfficeAddress"];?>'></td>
						<td id="cfa" class="error"></td>
					</tr>
					
					<tr>
						<td>Telephone Number: </td>
						<td><input type="text" name="cftelno"  value='<?php if(isset($resident["FTelNo"])) echo $resident["FTelNo"];?>'></td>
						<td id="cftn" class="error"></td>
					</tr>
					
					
					<tr class="r1">
						<td>Mother's Name:</td>					
						<td><input type="text" name="cmname" id="cmname" size="35"  value='<?php if(isset($resident["MotherName"])) echo $resident["MotherName"];?>'></td>					
						<td id="cmn" class="error"></td>
					</tr>
					
					<tr>
						<td>Occupation: </td>
						<td><input type="text" name="cmocc" size="35"  value='<?php if(isset($resident["MotherOccupation"])) echo $resident["MotherOccupation"];?>'></td>
						<td id="cmo" class="error"></td>
					</tr>
					
					<tr class="r1">
						<td>Monthly Income: </td>
						<td><input type="text" name="cmincome"  value='<?php if(isset($resident["MotherMonthlyIncome"])) echo $resident["MotherMonthlyIncome"];?>'></td>
						<td id="cmi" class="error"></td>
					</tr>
					
					<tr>
						<td>Employer: </td>
						<td><input type="text" name="cmemp" size="35"  value='<?php if(isset($resident["MotherEmployer"])) echo $resident["MotherEmployer"];?>'></td>
						<td id="cme" class="error"></td>
					</tr>
					
					<tr class="r1">
						<td>Office Address: </td>
						<td><input type="text" name="cmadd" size="35" value='<?php if(isset($resident["MotherOfficeAddress"])) echo $resident["MotherOfficeAddress"];?>'></td>
						<td id="cma" class="error"></td>
					</tr>
					
									
					<tr>
						<td>Telephone Number: </td>
						<td><input type="text" name="cmtelno"  value='<?php if(isset($resident["MTelNo"])) echo $resident["MTelNo"];?>'></td>
						<td id="cmtn" class="error"></td>
					</tr>
					
					<tr class="r1">
						<td>No.of Brother(s):</td>
						<td><input class="digit" type="text" name="NumBrothers" size="5" value='<?php if(isset($resident["NumBro"])) echo $resident["NumBro"];?>'></td>
						<td id="bro" class="error"></td> 
					</tr>
					
					<tr>
						<td>No.of Sister(s):</td>
						<td><input class="digit" type="text" name="NumSisters" size="5"  value='<?php if(isset($resident["NumSis"])) echo $resident["NumSis"];?>'></td>
						<td id="sis" class="error"></td>
					</tr>
					
					<tr class="r1">
						<td>Birth order:</td>
						<td><input type="text" name="BirthOrder" size="35"  value='<?php if(isset($resident["BirthOrder"])) echo $resident["BirthOrder"];?>'></td>
						<td id="bor" class="error"></td>
					</tr>
					
					<tr>
						<td>Other Sources of Income:</td>
						<td><input type="text" name="otherSourcesOfIncome" size="35" value='<?php if(isset($resident["OtherSources"])) echo $resident["OtherSources"];?>'></td>
						<td id="osi" class="error"></td>
					</tr>
					
					<tr class="r1">
						<td>Amount:</td>
						<td><input type="text" name="otherIncomeAmount" size="10"  value='<?php if(isset($resident["OtherSourceAmount"])) echo $resident["OtherSourceAmount"];?>'></td>
						<td id="oia" class="error"></td>
					</tr>
					
					
					<tr>
						<td>Hobbies:</td>
						<td><input type="text" name="Hobbies" size="35" value='<?php if(isset($resident["HobbyName"])) echo $resident["HobbyName"];?>'></td>
						<td id="hobby" class="error"></td>
					</tr>
					
					<tr class="r1">
						<td>Honors Received:</td>
						<td><input type="text" name="Honors" size="35"  value='<?php if(isset($resident["Honors"])) echo $resident["Honors"];?>'></td>
						<td id="honor" class="error"></td>
					</tr>
					
					<tr>
						<td>Talent(s):</td>
						<td><input type="text" name="Talents0" size="35"  value='<?php if(isset($resident["TalentName"])) echo $resident["TalentName"];?>'><div id="addTalent" style="display:inline;"></div><input type="button" value="+" onclick("")/></td>
						<td id="talent" class="error"></td>
					</tr>
					
					<tr class="r1">
						<td>Organization:</td>
						<td><input type="text" name="Org" size="35"  value='<?php if(isset($resident["OrgName"])) echo $resident["OrgName"];?>'/></td>
						<td id="orga" class="error"></td>
					
					</tr>
					
					<tr>
						<td>Ailments:</td>
						<td><input type="text" name="Ailments" size="35"  value='<?php if(isset($resident["Ailments"])) echo $resident["Ailments"];?>'></td>
						<td id="ail" class="error"></td>
					</tr>
					
					<tr class="r1">
						<td>Medications:</td>
						<td><input type="text" name="Medications" size="35"  value='<?php if(isset($resident["Medications"])) echo $resident["Medications"];?>'></td>
						<td id="med" class="error"></td>
					</tr>
					
					<tr>
						<td>Boyfriend/Girlfriend?:</td>
						<td>
							<?php 
								$bool="";
								for($i=0;$i<4;$i++){
									$bool[$i] ="";
								}
								if(isset($resident["BFGF"])){
								if(trim($resident["BFGF"]) == "0") $bool[0] ="checked=\"checked\"";
								else if(trim($resident["BFGF"]) == "1") $bool[1] ="checked=\"checked\"";
								else if(trim($resident["BFGF"]) == "2") $bool[2] ="checked=\"checked\"";
								else if(trim($resident["BFGF"]) == "3") $bool[3] ="checked=\"checked\"";
								}
								
								echo "<input type=\"radio\" name=\"bfgf\" value=\"Yes\" $bool[0]>Yes<br/>
								<input type=\"radio\" name=\"bfgf\" value=\"None\" $bool[1]>None<br/>
								
								<input type=\"radio\" name=\"bfgf\" value=\"Still Searching\" $bool[2]>Still Searching<br/>
								<input type=\"radio\" name=\"bfgf\" value=\"Not Applicable\" $bool[3]>Not Applicable<br/>";
							
							?>
						</td>
						<td id="med" class="error"></td>
					</tr>
					
					
					<tr class="r1">
						<td>Guardian 1:</td>					
						<td><input type="text" name="cg1name" id="cg1name" size="35"  value='<?php if(isset($resident["Guardian1"])) echo $resident["Guardian1"];?>'></td>					
						<td id="cg1" class="error"></td>
					</tr>
					
					<tr>
						<td>Telephone Number: </td>
						<td><input type="text" name="cg1telno"  value='<?php if(isset($resident["Guardian1tel"])) echo $resident["Guardian1tel"];?>'></td>
						<td id="cg1tn" class="error"></td>
					</tr>
					
					<tr class="r1">
						<td>Address: </td>
						<td><input type="text" name="cg1add" size="35"  value='<?php if(isset($resident["Guardian1add"])) echo $resident["Guardian1add"];?>'></td>
						<td id="cg1a" class="error"></td>
					</tr>
					
					<tr>
						<td>Guardian 2:</td>					
						<td><input type="text" name="cg2name" id="cg2name" size="35"  value='<?php if(isset($resident["Guardian2"])) echo $resident["Guardian2"];?>'></td>					
						<td id="cg2" class="error"></td>
					</tr>
					
					<tr class="r1">
						<td>Telephone Number: </td>
						<td><input type="text" name="cg2telno"  value='<?php if(isset($resident["Guardian2tel"]))  echo $resident["Guardian2tel"];?>'></td>
						<td id="cg2tn" class="error"></td>
					</tr>
					
					<tr>
						<td>Address: </td>
						<td><input type="text" name="cg2add" size="35"  value='<?php if(isset($resident["Guardian2add"])) echo $resident["Guardian2add"];?>'></td>
						<td id="cg2a" class="error"></td>
					</tr>
					
			</table>
		</div>
		
		<h3 class="appliance_title" onclick="dropDown('appliance_info')">Appliance</h3>
		<div class="appliance_info" id="appliance_info" >
			<table class="addApp">		
				<!--  	<td colspan="3"><input type="button" value="Load Appliances" id="loadApp" onclick='loadAppliances("index.php?c=resident&m=addAppliance")')/></td>
					-->
				<tr>	
					<td>
						<table class = "app" id = "app">
							<tr>
								<th>Appliance</th>
								<th>Control #</th>
								<th colspan="2">Date Installed</th>
							</tr>
							<?php 
							if($numApp>0){
										
									for($i=0;$i<$numApp;$i++){
							?>
							<tr>
							
								<td>
									<?php
									
										echo "	<select name=\"ApplianceName$i\" id=\"ApplianceName$i\" >"
									?>
								
										<?php 
											if(isset($resident["AppName$i"])&&isset($appData)){
											
											$appArr = explode("*",$appData);
											$bool="";
											$num = count($appArr)+1;
											for($j=0;$j<$num;$j++){
												$bool[$i] ="";
											}
											$j = 0;
											$appName = strtoupper(trim($resident["AppName$i"]));
											foreach($appArr as $app){
											if($appName == $app){ 
												$bool[$j] ="selected=\"selected\"";
												}
												
												echo "<option value = \"$app\" $bool[$j]>$app</option>"; 		
												$j++; 
											 }
											}
											
										echo "</select>";
										?>
									
									
								</td>
								<td><?php 
										$val = $resident["CTRLNum".$i];
										echo "<input type=\"text\" name=\"controlNum$i\" id=\"controlNum$i\" size=\"7\"  value='$val'/>";
									?>
								</td>
								<td>
									<?php 
										$date = $resident["DateInstalled".$i];
										$dateArr =explode("/",$date) ;
										echo "<select name =\"dateInstalledMonth$i\" id=\"dateInstalledMonth$i\" onchange=\"getMonth(this.options[this.selectedIndex].value,'dateInstalledDay$i','dateInstalledYear$i')\">";
										echo "<option value=\"0\">M</option>";
									
										for($j =1;$j<=12;$j++){
											if($j==$dateArr[0]){
											echo "<option value=\"$j\" selected=\"selected\" >$j</option>";		
												
											}else{
											echo "<option value=\"$j\">$j</option>";		
											}
										}
									echo "</select>";
									?>
									
									</td>
									<td>
									<?php 
										echo "<div id=\"dateInstalledDay$i\">
										<select name = \"dateInstalledDay$i\" >
										<option value=\"$dateArr[1]\">$dateArr[1]</option>
										</select>	
										</div>";
										
									?> 
									
									</td>
									
									<td>
									<?php 
										echo "<div id=\"dateInstalledYear$i\">
										<select name = \"dateInstalledYear$i\" >
										<option value=\"$dateArr[2]\">$dateArr[2]</option>
										</select>	
										</div>";
										
									?> 
									<?php 
									echo "</tr></td>";
									}
									}else{
										
									?>	
									<select name="ApplianceName0" id="ApplianceName0" > 
									
										<?php 
										$arrApp  = explode("*",$appData);
										foreach($arrApp as $aa){
											 $aa= str_replace("'","",$aa);
											echo "<option value = \"$aa\">$aa</option>";
											
										}
										?>
									</select>
									
								</td>
								<td>
									<input type="text" name="controlNum0" id="controlNum0" size="7"/>
								</td>
								<td>
									<!--<input type="text" name="dateInstalled0" id="dateInstalled0"/>
									-->
									<select name ="dateInstalledMonth0" id="dateInstalledMonth0" onchange="getMonth(this.options[this.selectedIndex].value,'dateInstalledDay0','dateInstalledYear0')">
									<option value="0">M</option>
									<?php 
										for($i =1;$i<=12;$i++){
											echo "<option value=\"$i\">$i</option>";		
										}
									?>
									</select></td>
									<td>
									<div id="dateInstalledDay0">
										<select name = "dateInstalledDay0" >
										<option value="0">D</option>
										</select>	
									</div></td>
									<td>
									<div id="dateInstalledYear0">
										<select name = "dateInstalledYear0">
										<option value="0">Y</option>
										</select>	
									</div>
										</td>
										</tr>
									<?php }?>
							
						</table>
				
				
						<?php 
						$appData = "'".$appData."'";
						echo "<input type=\"button\" value=\"Add Appliances\" onclick=\"addApp('app',$appData)\"/>";
						
						?><input type="button" value="Remove Appliance" onclick="removeApp()"/>
					</td>
				</tr>			
				
				<tr>
					<td colspan="3"><div style="inline" id="app"> </div></td>
				</tr>
			</table>
			</div>
			
			<h3 class="log_title" onclick="dropDown('log_info')">Log Info</h3>
			<div class="log_info">
				<table class="log_table">
					<tr>
						<td>Date Check-in</td>
						<td>Date Check-out</td>
						<td>Form 5</td>
						<td>Room Number</td>
					</tr>
				
					<tr>
						<td> 
							<select name="MonthLI1" id="MonthLI1" onchange="getMonth(this.options[this.selectedIndex].value,'DayLI1','YearLI1')">
								<?php $bool="";
									$cIn = $resident["DateCheckIn"];
									$cInArray = explode("/", $cIn);	
								
									for($i=0;$i<12;$i++){
										$bool[$i] ="";
									}
									

										if(trim($cInArray[0]) == "1") $bool[0]="selected=\"selected\"" ;
										else if(trim($cInArray[0]) == "2") $bool[1]="selected=\"selected\"" ;
										else if(trim($cInArray[0]) == "3") $bool[2]="selected=\"selected\"" ;
										else if(trim($cInArray[0]) ==  "4") $bool[3]="selected=\"selected\"" ;
										else if(trim($cInArray[0]) == "5") $bool[4]="selected=\"selected\"" ;
										else if(trim($cInArray[0]) == "6") $bool[5]="selected=\"selected\"" ;
										else if(trim($cInArray[0]) == "7") $bool[6]="selected=\"selected\"" ;
										else if(trim($cInArray[0]) == "8") $bool[7]="selected=\"selected\"" ;
										else if(trim($cInArray[0]) == "9") $bool[8]="selected=\"selected\"" ;
										else if(trim($cInArray[0]) == "10") $bool[9]="selected=\"selected\"" ;
										else if(trim($cInArray[0]) == "11") $bool[10]="selected=\"selected\"" ;
										else if(trim($cInArray[0]) == "12") $bool[11]="selected=\"selected\"" ;
									
									
								?>							
								<option value="0" >M</option>
								
										
								<?php 
									for ($i = 1; $i <= 12; $i++){
										echo "<option value=\"$i\"".$bool[$i-1].">$i</option>";
									}
								?>
								
							</select>
							<div style="display:inline;" id = "DayLI1">
								<select name="DayLI1" >
									<?php 
									echo "<option value=\"$cInArray[1]\">$cInArray[1]</option>";					
								?>
								</select>
							</div>
							<div style="display:inline;" id = "YearLI1">
								<select name="YearLI1">
									<?php 
									echo "<option value=\"$cInArray[2]\">$cInArray[2]</option>";					
								?>
								</select>
							</div>
						
						</td>
						<td> 
							<select name="MonthLI2" id="MonthLI2" onchange="getMonth(this.options[this.selectedIndex].value,'DayLI2','YearLI2')">
								
								<?php $bool="";
									$cOut = $resident["DateCheckOut"];
									$cOutArray = explode("/", $cOut);	
								
									for($i=0;$i<12;$i++){
										$bool[$i] ="";
									}
									

										if(trim($cOutArray[0]) == "1") $bool[0]="selected=\"selected\"" ;
										else if(trim($cOutArray[0]) == "2") $bool[1]="selected=\"selected\"" ;
										else if(trim($cOutArray[0]) == "3") $bool[2]="selected=\"selected\"" ;
										else if(trim($cOutArray[0]) ==  "4") $bool[3]="selected=\"selected\"" ;
										else if(trim($cOutArray[0]) == "5") $bool[4]="selected=\"selected\"" ;
										else if(trim($cOutArray[0]) == "6") $bool[5]="selected=\"selected\"" ;
										else if(trim($cOutArray[0]) == "7") $bool[6]="selected=\"selected\"" ;
										else if(trim($cOutArray[0]) == "8") $bool[7]="selected=\"selected\"" ;
										else if(trim($cOutArray[0]) == "9") $bool[8]="selected=\"selected\"" ;
										else if(trim($cOutArray[0]) == "10") $bool[9]="selected=\"selected\"" ;
										else if(trim($cOutArray[0]) == "11") $bool[10]="selected=\"selected\"" ;
										else if(trim($cOutArray[0]) == "12") $bool[11]="selected=\"selected\"" ;
									
									
								?>
																
								<option value="0" >M</option>
								<?php 
									for ($i = 1; $i <= 12; $i++){
										echo "<option value=\"$i\"".$bool[$i-1].">$i</option>";
									}
								?>
								
							</select>
							<div style="display:inline;" id = "DayLI2">
								<select name="DayLI2" >
										<?php 
									echo "<option value=\"$cOutArray[1]\">$cOutArray[1]</option>";					
								?>
								</select>
							</div>
							<div style="display:inline;" id = "YearLI2">
								<select name="YearLI2">
										<?php 
									echo "<option value=\"$cOutArray[2]\">$cOutArray[2]</option>";					
								?>
								</select>
							</div>
						
						</td>
						<td><input type="text" name="form5" id="form5" size="14" value='<?php if(isset($resident["FormFive"])) echo $resident["FormFive"];?>'/></td>
						<td><input type="text" name="room" id="room" size="14" value='<?php if(isset($resident["RoomNo"])) echo $resident["RoomNo"];?>'/></td>
						
					</tr>
					<!--tr>
						<td>Date Check-out:</td>
						<td>1st <input type="text" name="dateOutSem1" size="14"/> </td>
						<td>2nd <input type="text" name="dateOutSem2" size="14"/> </td>
						<td>S <input type="text"  name="dateOutSemS" size="14"/> </td>
					</tr>
					
					<tr>
						<td>Form 5:</td>
						<td>1st <input type="text" name="formSem1" size="14"/> </td>
						<td>2nd <input type="text" name="formSem2" size="14"/> </td>
						<td>S <input type="text"  name="formSemS" size="14"/> </td>
					</tr>
					
					<tr>
						<td>Room No:</td>
						<td>1st <input type="text" name="roomSem1" size="14"/> </td>
						<td>2nd <input type="text" name="roomSem2" size="14"/> </td>
						<td>S <input type="text"  name="roomSemS" size="14"/> </td>
					</tr-->
						
				</table>
			</div>
			
			<h3 class="reservation_title" onclick="dropDown('reservation_info')">Reservation</h3>
			<div class="reservation_info">
				<table class="reservation_table">
						<tr>
							<th>OR #</th>
							<th>Date</th>
							<th>Amount</th>
							<th>Remarks</th>
						</tr>
							
					<tr>					
						<td><input type="text" name="OrNum" id="OrNum" size="16" value='<?php if(isset($resident["ReserveOrnum"])) echo $resident["ReserveOrnum"];?>'/></td>
						<td>
							<select name="MonthR" id="MonthR" onchange="getMonth(this.options[this.selectedIndex].value,'DayR','YearR')">
								<?php $bool="";
									$rDate = $resident["ReserveDate"];
									$rDateArray = explode("/", $rDate);	
								
									for($i=0;$i<12;$i++){
										$bool[$i] ="";
									}
									

										if(trim($rDateArray[0]) == "1") $bool[0]="selected=\"selected\"" ;
										else if(trim($rDateArray[0]) == "2") $bool[1]="selected=\"selected\"" ;
										else if(trim($rDateArray[0]) == "3") $bool[2]="selected=\"selected\"" ;
										else if(trim($rDateArray[0]) ==  "4") $bool[3]="selected=\"selected\"" ;
										else if(trim($rDateArray[0]) == "5") $bool[4]="selected=\"selected\"" ;
										else if(trim($rDateArray[0]) == "6") $bool[5]="selected=\"selected\"" ;
										else if(trim($rDateArray[0]) == "7") $bool[6]="selected=\"selected\"" ;
										else if(trim($rDateArray[0]) == "8") $bool[7]="selected=\"selected\"" ;
										else if(trim($rDateArray[0]) == "9") $bool[8]="selected=\"selected\"" ;
										else if(trim($rDateArray[0]) == "10") $bool[9]="selected=\"selected\"" ;
										else if(trim($rDateArray[0]) == "11") $bool[10]="selected=\"selected\"" ;
										else if(trim($rDateArray[0]) == "12") $bool[11]="selected=\"selected\"" ;
									
									
								?>
								
								
															
								<option value="0" >M</option>
								<?php 
									for ($i = 1; $i <= 12; $i++){
										echo "<option value=\"$i\"".$bool[$i-1].">$i</option>";
									
									}
								?>
								
							</select>
							<div style="display:inline;" id = "DayR">
								<select name="DayR" >
									<?php 
									echo "<option value=\"$rDateArray[1]\">$rDateArray[1]</option>";					
								?>
								</select>
							</div>
							<div style="display:inline;" id = "YearR">
								<select name="YearR">
									<?php 
									echo "<option value=\"$rDateArray[2]\">$rDateArray[2]</option>";					
								?>
								</select>
							</div>
						</td>
						<td><input type="text" id="Amount" name="Amount" size="16" value='<?php if(isset($resident["ReserveAmount"])) echo $resident["ReserveAmount"];?>'/> </td>
						<td><input type="text" id="Remarks" name="Remarks" size="15" value='<?php if(isset($resident["ReserveRemarks"])) echo $resident["ReserveRemarks"];?>'/> </td>
					</tr>
					
					<!--tr>
						<td>2</td>
						<td> <input type="text" name="OrNum2" size="16"/> </td>
						<td> <input type="text" name="Date2" size="16"/> </td>
						<td> <input type="text"  name="Amount2" size="16"/> </td>
						<td> <input type="text"  name="Remarks2" size="15"/> </td>
					</tr>
	
					<tr>
						<td>S</td>
						<td> <input type="text" name="OrNumS" size="16"/> </td>
						<td> <input type="text" name="DateS" size="16"/> </td>
						<td> <input type="text"  name="AmountS" size="16"/> </td>
						<td> <input type="text"  name="RemarksS" size="15"/> </td>
					</tr-->
				
				</table>
			</div>
	
		
			<h3 class="key_title" onclick="dropDown('key_info')">Key</h3>
			<div class="key_info">
				<table class="key_table">
						<tr>
							<th>OR #</th>
							<th>Amount</th>
							<th>Date Received</th>
							<th>Date Returned</th>
							<th>Remarks</th>
						</tr>
							
					<tr>			
						<td><input type="text" name="OrNumKey" id="OrNumKey" size="8" value='<?php if(isset($resident["KeyOrnum"])) echo $resident["KeyOrnum"];?>'/> </td>
						<td><input type="text" name="AmountKey" id="AmountKey" size="12" value='<?php if(isset($resident["KeyAmount"])) echo $resident["KeyAmount"];?>'/> </td>
						<td><select name="MonthRec" id="MonthRec" onchange="getMonth(this.options[this.selectedIndex].value,'DayRec','YearRec')">
								<?php $bool="";
									$recDate = $resident["DateReceived"];
									$recDateArray = explode("/", $recDate);	
								
									for($i=0;$i<12;$i++){
										$bool[$i] ="";
									}
									

										if(trim($recDateArray[0]) == "1") $bool[0]="selected=\"selected\"" ;
										else if(trim($recDateArray[0]) == "2") $bool[1]="selected=\"selected\"" ;
										else if(trim($recDateArray[0]) == "3") $bool[2]="selected=\"selected\"" ;
										else if(trim($recDateArray[0]) ==  "4") $bool[3]="selected=\"selected\"" ;
										else if(trim($recDateArray[0]) == "5") $bool[4]="selected=\"selected\"" ;
										else if(trim($recDateArray[0]) == "6") $bool[5]="selected=\"selected\"" ;
										else if(trim($recDateArray[0]) == "7") $bool[6]="selected=\"selected\"" ;
										else if(trim($recDateArray[0]) == "8") $bool[7]="selected=\"selected\"" ;
										else if(trim($recDateArray[0]) == "9") $bool[8]="selected=\"selected\"" ;
										else if(trim($recDateArray[0]) == "10") $bool[9]="selected=\"selected\"" ;
										else if(trim($recDateArray[0]) == "11") $bool[10]="selected=\"selected\"" ;
										else if(trim($recDateArray[0]) == "12") $bool[11]="selected=\"selected\"" ;
									
									
								?>								
								<option value="0" >M</option>
								<?php 
									for ($i = 1; $i <= 12; $i++){
										echo "<option value=\"$i\"".$bool[$i-1].">$i</option>";
									}
								?>
								
							</select>
							<div style="display:inline;" id = "DayRec">
								<select name="DayRec" >
									<?php 
									echo "<option value=\"$recDateArray[1]\">$recDateArray[1]</option>";					
								?>
								</select>
							</div>
							<div style="display:inline;" id = "YearRec">
								<select name="YearRec">
									<?php 
									echo "<option value=\"$recDateArray[2]\">$recDateArray[2]</option>";					
								?>
								</select>
							</div></td>
						<td><select name="MonthRet" id="MonthRet" onchange="getMonth(this.options[this.selectedIndex].value,'DayRet','YearRet')">
								<?php $bool="";
									$retDate = $resident["DateReturned"];
									$retDateArray = explode("/", $retDate);	
								
									for($i=0;$i<12;$i++){
										$bool[$i] ="";
									}
									

										if(trim($retDateArray[0]) == "1") $bool[0]="selected=\"selected\"" ;
										else if(trim($retDateArray[0]) == "2") $bool[1]="selected=\"selected\"" ;
										else if(trim($retDateArray[0]) == "3") $bool[2]="selected=\"selected\"" ;
										else if(trim($retDateArray[0]) ==  "4") $bool[3]="selected=\"selected\"" ;
										else if(trim($retDateArray[0]) == "5") $bool[4]="selected=\"selected\"" ;
										else if(trim($retDateArray[0]) == "6") $bool[5]="selected=\"selected\"" ;
										else if(trim($retDateArray[0]) == "7") $bool[6]="selected=\"selected\"" ;
										else if(trim($retDateArray[0]) == "8") $bool[7]="selected=\"selected\"" ;
										else if(trim($retDateArray[0]) == "9") $bool[8]="selected=\"selected\"" ;
										else if(trim($retDateArray[0]) == "10") $bool[9]="selected=\"selected\"" ;
										else if(trim($retDateArray[0]) == "11") $bool[10]="selected=\"selected\"" ;
										else if(trim($retDateArray[0]) == "12") $bool[11]="selected=\"selected\"" ;
									
									
								?>								
								<option value="0" >M</option>
								<?php 
									for ($i = 1; $i <= 12; $i++){
										echo "<option value=\"$i\"".$bool[$i-1].">$i</option>";
									}
								?>
								
							</select>
							<div style="display:inline;" id = "DayRet">
								<select name="DayRet" >
									<?php 
									echo "<option value=\"$retDateArray[1]\">$retDateArray[1]</option>";					
								?>
								</select>
							</div>
							<div style="display:inline;" id = "YearRet">
								<select name="YearRet">
									<?php 
									echo "<option value=\"$retDateArray[2]\">$retDateArray[2]</option>";					
								?>
								</select>
							</div></td>
						<td> <input type="text"  name="RemarksKey" id="RemarksKey" size="10" value='<?php if(isset($resident["KeyOrnum"])) echo $resident["KeyRemarks"];?>'/> </td>
					</tr>
					
					<!--tr>
						<td>2</td>
						<td><input type="text" name="OrNumKey2" size="8"/> </td>
						<td><input type="text" name="AmountKey2" size="12"/> </td>
						<td><input type="text"  name="dateReceived2" size="12"/> </td>
						<td><input type="text"  name="dateReturned2" size="12"/> </td>
						<td> <input type="text"  name="RemarksKey2" size="10"/> </td>
					</tr>
	
					<tr>
						<td>S</td>
						<td><input type="text" name="OrNumKeyS" size="8"/> </td>
						<td><input type="text" name="AmountKeyS" size="12"/> </td>
						<td><input type="text"  name="dateReceivedS" size="12"/> </td>
						<td><input type="text"  name="dateReturnedS" size="12"/> </td>
						<td> <input type="text"  name="RemarksKeyS" size="10"/> </td>
					</tr-->
				
				</table>
			</div>
			
			<table>
				<tr>
					<td colspan="3"><input type="submit" value="Submit" name="editResident"/></td>
				</tr>
			</table>
			
		</form>
	</body>
</html>