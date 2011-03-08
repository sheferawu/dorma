
<html>
	<head>
	
		<script type="text/javascript" src='<?php echo base_url()."JS/addJS.js"?>'></script>
		<script type="text/javascript" src='<?php echo base_url()."JS/searchJS.js"?>'></script>
		
		<script type="text/javascript" src="JS/option.js"></script>
		<script type="text/javascript" src="JS/jquery_2.js"></script>
		
		
	</head>
	
	<body>
	<?php print_r($arrTrans);

	?>
		<form action="index.php?c=resident&m=updateTransient" method="POST" name="editTransientForm"  onsubmit="return(validateTransForm(this))">
			<h3 class="resident_title" onclick="dropDown('resident_info')">Transient's Information</h3>
			<div class="transient_info">
				<table class="addTransient">
				
				<tr>
				<td> Control Number:  </td>
				<td> <input type="text" name="ControlNum" size="25"  value='<?php if(isset($arrTrans["ControlNumber"])) echo $arrTrans["ControlNumber"];?>' /></td>
				<td id="cno" class="error"></td>
				</tr>

				<tr>
				<td> Date: </td>
				<td> <input type="text" name="Date" size="25" value='<?php if(isset($arrTrans["FillUpDate"])) echo $arrTrans["FillUpDate"];?>'></td>
				<td id="date" class="error"></td>
				</tr>
		
					<tr>
						<td>Last Name:</td>					
						<td><input type="text" name="lastname" id="lastname" size="35" value='<?php if(isset($arrTrans["LastName"])) echo $arrTrans["LastName"];?>'></td>					
						<td id="ln" class="error"></td>
					</tr>
					
					<tr>
						<td> First Name: </td>
						<td><input type="text" name="firstname" size="35" value='<?php if(isset($arrTrans["FirstName"])) echo $arrTrans["FirstName"];?>'></td>
						<td id="fn" class="error"></td>
					</tr>
					
					<tr>
						<td>Middle Name: </td>
						<td><input type="text" name="middlename" size="35" value='<?php if(isset($arrTrans["MidName"])) echo $arrTrans["MidName"];?>'></td>
						<td id="mn" class="error"></td>
					</tr>
					<tr>
						<td>Purpose:</td>
						<td><input type="text" name="purpose" size="35" value='<?php if(isset($arrTrans["Purpose"])) echo $arrTrans["Purpose"];?>'></td>
						<td id="purpose" class="error"></td>
					</tr>
					<tr>
						<td>Person to Notify in case of emergency:</td>
						<td><input type="text" name="Emergency" size="35" value='<?php if(isset($arrTrans["Emergency"])) echo $arrTrans["Emergency"];?>'></td>
						<td id="emergency" class="error"></td>
					</tr>
					
					<tr>
					<th colspan="3"> RECORD OF STAY</th>
					</tr>
					<tr>
						<td>Dorm: </td>
						<td><input type="text" name="dormName" size="35" value='<?php if(isset($arrTrans["Dorm"])) echo $arrTrans["Dorm"];?>'></td>
						<td id="dorm" class="error"></td>
					</tr>
					
					<tr>
						<td>Date check-in:</td>
						<td>
							<select name="MonthIn"  onchange="getMonth(this.options[this.selectedIndex].value,'DayIn','YearIn')">
								<option value="0" >Month</option>
								<?php
									$checkIn = $arrTrans["CheckIn"];
									$checkInArray = explode("/", $checkIn);
								
									$bool="";
							
									for($i=0;$i<12;$i++){
										$bool[$i] ="";
									}
									

										if(trim($checkInArray[0]) == "1") $bool[0]="selected=\"selected\"" ;
										else if(trim($checkInArray[0]) == "2") $bool[1]="selected=\"selected\"" ;
										else if(trim($checkInArray[0]) == "3") $bool[2]="selected=\"selected\"" ;
										else if(trim($checkInArray[0]) ==  "4") $bool[3]="selected=\"selected\"" ;
										else if(trim($checkInArray[0]) == "5") $bool[4]="selected=\"selected\"" ;
										else if(trim($checkInArray[0]) == "6") $bool[5]="selected=\"selected\"" ;
										else if(trim($checkInArray[0]) == "7") $bool[6]="selected=\"selected\"" ;
										else if(trim($checkInArray[0]) == "8") $bool[7]="selected=\"selected\"" ;
										else if(trim($checkInArray[0]) == "9") $bool[8]="selected=\"selected\"" ;
										else if(trim($checkInArray[0]) == "10") $bool[9]="selected=\"selected\"" ;
										else if(trim($checkInArray[0]) == "11") $bool[10]="selected=\"selected\"" ;
										else if(trim($checkInArray[0]) == "12") $bool[11]="selected=\"selected\"" ;
									
									
									for($i=1;$i<=12;$i++){
										echo "<option value=\"$i\"".$bool[$i-1].">$i</option>";
									}
								?>
							</select>
							<div style="display:inline;" id = "DayIn">
								<select name="DayIn" >
									<?php 
									echo "<option value=\"$checkInArray[1]\">$checkInArray[1]</option>";
									?>
								</select>
							</div>
						<div style="display:inline;" id = "YearIn">
							<select name="YearIn">
								<?php 
									echo "<option value=\"$checkInArray[2]\">$checkInArray[2]</option>";
									?>
							</select>
						</div>
						</td>
						<td class="error"></td>
					</tr>	
					<tr>
						<td>Time check-in: </td>
						<td><input type="text" name="tcheckin" value='<?php if(isset($arrTrans["TCheckIn"])) echo $arrTrans["TCheckIn"];?>'></td>
						<td id="tin" class="error"></td>
					</tr>
					<tr>
						<td>Date check-out:</td>
						<td>
							<select name="MonthOut"  onchange="getMonth(this.options[this.selectedIndex].value,'DayOut','YearOut')">
								<option value="0" >Month</option>
								<?php 
									$checkOut = $arrTrans["CheckOut"];
									$checkOutArray = explode("/", $checkOut);
								
									$bool="";
									for($i=0;$i<12;$i++){
										$bool[$i] ="";
									}
									

										if(trim($checkOutArray[0]) == "1") $bool[0]="selected=\"selected\"" ;
										else if(trim($checkOutArray[0]) == "2") $bool[1]="selected=\"selected\"" ;
										else if(trim($checkOutArray[0]) == "3") $bool[2]="selected=\"selected\"" ;
										else if(trim($checkOutArray[0]) ==  "4") $bool[3]="selected=\"selected\"" ;
										else if(trim($checkOutArray[0]) == "5") $bool[4]="selected=\"selected\"" ;
										else if(trim($checkOutArray[0]) == "6") $bool[5]="selected=\"selected\"" ;
										else if(trim($checkOutArray[0]) == "7") $bool[6]="selected=\"selected\"" ;
										else if(trim($checkOutArray[0]) == "8") $bool[7]="selected=\"selected\"" ;
										else if(trim($checkOutArray[0]) == "9") $bool[8]="selected=\"selected\"" ;
										else if(trim($checkOutArray[0]) == "10") $bool[9]="selected=\"selected\"" ;
										else if(trim($checkOutArray[0]) == "11") $bool[10]="selected=\"selected\"" ;
										else if(trim($checkOutArray[0]) == "12") $bool[11]="selected=\"selected\"" ;
									
									
									for($i=1;$i<=12;$i++){
										echo "<option value=\"$i\"".$bool[$i-1].">$i</option>";
									}
								
								?>
							</select>
							<div style="display:inline;" id = "DayOut">
								<select name="DayOut" >
									<?php 
									echo "<option value=\"$checkOutArray[1]\">$checkOutArray[1]</option>";
									?>
								</select>
							</div>
						<div style="display:inline;" id = "YearOut">
							<select name="YearOut">
								<?php 
									echo "<option value=\"$checkOutArray[2]\">$checkOutArray[2]</option>";
									?>
							</select>
						</div>
						</td>
						<td class="error"></td>
					</tr>
					<tr>
						<td>Time check-out: </td>
						<td><input type="text" name="tcheckout" value='<?php if(isset($arrTrans["TCheckOut"])) echo $arrTrans["TCheckOut"];?>'></td>
						<td id="tout" class="error"></td>
					</tr>
					
					<tr>
					<td>
					
					<?php 
						$bool="";
						$bool[0]="";
						$bool[1]="";
						if(trim(strtoupper($arrTrans["Bedding"])) == "WITHBED")
							$bool[0] = "checked=\"checked\"";
						else if (trim(strtoupper($arrTrans["Bedding"])) == "WITHOUTBED")
							$bool[1] = "checked=\"checked\"";
					?>
					
					<input type="radio" name="bedding" <?php echo $bool[0];?> value="withBed"> with bedding</td>
					<td>
					<input type="radio" name="bedding" <?php echo $bool[1];?> value="withoutBed"> without bedding</td>
					<td></td>
					</tr>

					<tr>
						<td>Room Assignment: </td>
						<td><input type="text" name="roomassign" value='<?php if(isset($arrTrans["RoomAssign"])) echo $arrTrans["RoomAssign"];?>'></td>
						<td id="room" class="error"></td>
						
					</tr>
					
					<tr>
						<td> Amount Paid: </td>
						<td><input type="text" name="amount" size="35" value='<?php if(isset($arrTrans["AmountPaid"])) echo $arrTrans["AmountPaid"];?>'></td>
						<td id="amnt" class="error"></td>
					</tr>
					
					<tr>
						<td>O.R. Number: </td>
						<td><input type="text" name="ornum" size="35" value='<?php if(isset($arrTrans["OrNum"])) echo $arrTrans["OrNum"];?>'></td>
						<td id="or" class="error"></td>
					</tr>
					
					<tr>
						<td>Guarantor/Endorser: </td>
						<td>
						<input type="text" name="guarantor" id="guarantor" size="35" onkeyup="suggestG(this.value)" onkeydown="suggestG(this.value)" value='<?php if(isset($arrTrans["Guarantor"])) echo $arrTrans["Guarantor"];?>'>
						<div  id="gsearch"></div></td>
						<td id="grt" class="error"></td>
					</tr>
					<tr>
					<td>Rates</td>
					<?php 
						$bool = "";
						$bool[0] = "";
						$bool[1] = "";
					
						if (trim(strtoupper($arrTrans["Rates"])) == "UP")
							$bool[0] = "checked=\"checked\"" ;
						else if (trim(strtoupper($arrTrans["Rates"])) == "NON-UP")
							$bool[1] = "checked=\"checked\"" ;
						
					?>
					
					<td>
					<input type="radio" name="rates" <?php echo $bool[0];?>value="UP"> UP</td>
					<td>
					<input type="radio" name="rates"  <?php echo $bool[1];?>value="NON-UP"> NON-UP</td>
					
					</tr>
					<tr>
					<td>Type</td>
					<?php 
						$bool = "";
						$bool[0] = "";
						$bool[1] = "";
					
						if (trim(strtoupper($arrTrans["Type"])) == "INDIVIDUAL")
							$bool[0] = "checked=\"checked\"" ;
						else if (trim(strtoupper($arrTrans["Type"])) == "GROUP")
							$bool[1] = "checked=\"checked\"" ;
						
					?>
					
					<td>
					<input type="radio" name="type" <?php echo $bool[0];?> value="Individual"> Individual</td>
					<td>
					<input type="radio" name="type" <?php echo $bool[1];?> value="Group"> Group</td>
					
					</tr>
					<tr>
						<td colspan="3"><input type="submit" value="Submit" name="submitEditTransient"/></td>
					</tr>
				</table>
			</div>
		</form>
	</body>
</html>	
					