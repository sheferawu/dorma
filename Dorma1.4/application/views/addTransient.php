
<html>
	<head>
	
		<script type="text/javascript" src='<?php echo base_url()."JS/addJS.js"?>'></script>
		<script type="text/javascript" src='<?php echo base_url()."JS/searchJS.js"?>'></script>
		
		<script type="text/javascript" src="JS/option.js"></script>
		<script type="text/javascript" src="JS/jquery_2.js"></script>
		
		
	</head>
	
	<body>
		<form action="index.php?c=resident&m=getTransientData" method="POST" name="transientForm"  onsubmit="return(validateTransForm(this))">
			<h3 class="resident_title" onclick="dropDown('resident_info')">Transient's Information</h3>
			<div class="transient_info">
				<table class="addTransient">
				
				<tr>
				<td> Control Number:  </td>
				<td> <input type="text" name="ControlNum" size="25"></td>
				<td id="cno" class="error"></td>
				</tr>

				<tr>
				<td> Date: </td>
				<td> <input type="text" name="Date" size="25"></td>
				<td id="date" class="error"></td>
				</tr>
		
					<tr>
						<td>Last Name:</td>					
						<td><input type="text" name="lastname" id="lastname" size="35"></td>					
						<td id="ln" class="error"></td>
					</tr>
					
					<tr>
						<td> First Name: </td>
						<td><input type="text" name="firstname" size="35"></td>
						<td id="fn" class="error"></td>
					</tr>
					
					<tr>
						<td>Middle Name: </td>
						<td><input type="text" name="middlename" size="35"></td>
						<td id="mn" class="error"></td>
					</tr>
					<tr>
						<td>Purpose:</td>
						<td><input type="text" name="purpose" size="35"></td>
						<td id="purpose" class="error"></td>
					</tr>
					<tr>
						<td>Person to Notify in case of emergency:</td>
						<td><input type="text" name="Emergency" size="35"></td>
						<td id="emergency" class="error"></td>
					</tr>
					
					<tr>
					<th colspan="3"> RECORD OF STAY</th>
					</tr>
					<tr>
						<td>Dorm: </td>
						<td><input type="text" name="dormName" size="35"></td>
						<td id="dorm" class="error"></td>
					</tr>
					
					<tr>
						<td>Date check-in:</td>
						<td>
							<select name="MonthIn"  onchange="getMonth(this.options[this.selectedIndex].value,'DayIn','YearIn')">
								<option value="0" >Month</option>
								<?php 
									for($i=1;$i<=12;$i++){
										echo "<option value=\"$i\" >$i</option>";
									}
								?>
							</select>
							<div style="display:inline;" id = "DayIn">
								<select name="DayIn" >
									<option value="">Day</option>
								</select>
							</div>
						<div style="display:inline;" id = "YearIn">
							<select name="YearIn">
								<option value="">Year</option>
								<option value=""></option>
							</select>
						</div>
						</td>
						<td class="error"></td>
					</tr>	
					<tr>
						<td>Time check-in: </td>
						<td><input type="text" name="tcheckin"></td>
						<td id="tin" class="error"></td>
					</tr>
					<tr>
						<td>Date check-out:</td>
						<td>
							<select name="MonthOut"  onchange="getMonth(this.options[this.selectedIndex].value,'DayOut','YearOut')">
								<option value="0" >Month</option>
								<?php 
									for($i=1;$i<=12;$i++){
										echo "<option value=\"$i\" >$i</option>";
									}
								?>
							</select>
							<div style="display:inline;" id = "DayOut">
								<select name="DayOut" >
									<option value="">Day</option>
								</select>
							</div>
						<div style="display:inline;" id = "YearOut">
							<select name="YearOut">
								<option value="">Year</option>
								<option value=""></option>
							</select>
						</div>
						</td>
						<td class="error"></td>
					</tr>
					<tr>
						<td>Time check-out: </td>
						<td><input type="text" name="tcheckout"></td>
						<td id="tout" class="error"></td>
					</tr>
					
					<tr>
					<td>
					<input type="radio" name="bedding" checked="checked" value="withBed"> with bedding</td>
					<td>
					<input type="radio" name="bedding" value="withoutBed"> without bedding</td>
					<td></td>
					</tr>

					<tr>
						<td>Room Assignment: </td>
						<td><input type="text" name="roomassign"></td>
						<td id="room" class="error"></td>
						
					</tr>
					
					<tr>
						<td> Amount Paid: </td>
						<td><input type="text" name="amount" size="35"></td>
						<td id="amnt" class="error"></td>
					</tr>
					
					<tr>
						<td>O.R. Number: </td>
						<td><input type="text" name="ornum" size="35"></td>
						<td id="or" class="error"></td>
					</tr>
					
					<tr>
						<td>Guarantor/Endorser: </td>
						<td>
						<input type="text" name="guarantor" id="guarantor" size="35" onkeyup="suggestG(this.value)" onkeydown="suggestG(this.value)">
						<div  id="gsearch"></div></td>
						<td id="grt" class="error"></td>
					</tr>
					<tr>
					<td>Rates</td>
					<td>
					<input type="radio" name="rates" checked="checked" value="UP"> UP</td>
					<td>
					<input type="radio" name="rates" value="NON-UP"> NON-UP</td>
					
					</tr>
					<tr>
					<td>Type</td>
					<td>
					<input type="radio" name="type" checked="checked" value="Individual"> Individual</td>
					<td>
					<input type="radio" name="type" value="Group"> Group</td>
					
					</tr>
					<tr>
						<td colspan="3"><input type="submit" value="Submit" name="submitTransient"/></td>
					</tr>
				</table>
			</div>
		</form>
	</body>
</html>	
					