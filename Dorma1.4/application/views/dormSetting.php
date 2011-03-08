<html>
	<head>
	
	</head>
	<body>
	
		<form action="index.php?c=dorm&m=saveSettings" method="POST" name="dormForm"  onsubmit="return(validateDormForm(this))">
			<h3 class="dorm_name" onclick="dropDown('dorm_info')">Dormitory Settings</h3>
			<div class="dormitory_info">
				<table class="addDorm">
					<tr class="d1">
						<td>Dorm Name: </td>					
						<td><!--input type="text" name="DormName" id="dname" size="35" value='<?php echo $dorm["DormNameS"];?>'-->
						<input type="text" name="DormName" id="dormname" size="35" <?php if(isset($dorm["DormName"])){echo 'value="'.ucwords($dorm["DormName"]).'"';} ?> ></td>					
						<td id="dname" class="error"></td>
					</tr>
					
					<tr>
						<td>Alias: </td>
						<td><input type="text" name="Alias" id="alias" size="35" <?php if(isset($dorm["Alias"])){echo 'value="'.$dorm["Alias"].'"';}  ?>/></td>
						<td id="als" class="error"></td>
					</tr>
					
					<tr class="d1">
						<td>Monthly Rent: </td>
						<td><input type="text" name="MonthlyRent" id="monthlyrent" size="35"  <?php if(isset($dorm["MonthlyRent"])){echo 'value="'.$dorm["MonthlyRent"].'"';}  ?> /></td>
						<td id="mrent" class="error"></td>
					</tr>
					
					<tr class="d1">
						<td>Daily Rent: </td>
						<td><input type="text" name="DailyRent" id="dailyrent" size="35" <?php if(isset($dorm["DailyRent"])){echo 'value="'.$dorm["DailyRent"].'"';}  ?> /></td>
						<td id="drent" class="error"></td>
					</tr>
					<tr class="d1">
						<td>Total Occupancy: </td>
						<td><input type="text" name="Occupancy" id="occ" size="35" <?php if(isset($dorm["Occupancy"])){echo 'value="'.$dorm["Occupancy"].'"';}  ?> /></td>
						<td id="docc" class="error"></td>
					</tr>
					
					<tr class="d1">
						<td>Male Occupant: </td>
						<td><input type="text" name="MaleOcc" id="MaleOcc" size="35" <?php if(isset($dorm["MaleOccupant"])){echo 'value="'.$dorm["MaleOccupant"].'"';}  ?> /></td>
						<td id="mocc" class="error"></td>
					</tr>
					
					<tr class="d1">
						<td>Female Occupant: </td>
						<td><input type="text" name="FemaleOcc" id="FemaleOcc" size="35" <?php if(isset($dorm["FemaleOccupant"])){echo 'value="'.$dorm["FemaleOccupant"].'"';}  ?> /></td>
						<td id="focc" class="error"></td>
					</tr>

					<tr>
						<td>Start Date:</td>
						<td>
							<select name="sMonth" id="sMonth" onchange="getMonth(this.options[this.selectedIndex].value,'sDay','sYear')">
								<?php 
								bcscale(0);
									$bool="";
									for($i=0;$i<12;$i++){
										$bool[$i] ="";
									}
									$sd = explode("/",strtolower($dorm["StartDate"]));
									
										for($i= 1;$i<=12;$i++){
											
										if(bcsub($sd[0], (string)$i) =="0") {$bool[$i-1]="selected=\"selected\"" ;
											break;
										}
										}
										
									
									?>
									<?php for($i= 1;$i<=12;$i++){
										
										echo "<option value=\"$i\"".$bool[$i-1].">$i</option>";
										
										}
									?></select>
							<div style="display:inline;" id = "sDay">
								<select name="sDay" >
									<?php 
									echo "<option value=\"$sd[1]\">$sd[1]</option>";					
								?>
								</select>
							</div>
						<div style="display:inline;" id = "sYear">
							<select name="sYear">
								<?php 
									echo "<option value=\"$sd[2]\">$sd[2]</option>";					
								?></select>
						</div>
						</td>
						<td class="error"></td>
					</tr>
					
					<tr>
						<td>End Date:</td>
						<td>
							<select name="eMonth"  onchange="getMonth(this.options[this.selectedIndex].value,'eDay','eYear')">
							<?php 
									$bool="";
									for($i=0;$i<12;$i++){
										$bool[$i] ="";
									}
									$sd = explode("/",strtolower($dorm["EndDate"]));
									
										for($i= 1;$i<=12;$i++){
											
										if(bcsub($sd[0], (string)$i) =="0") {$bool[$i-1]="selected=\"selected\"" ;
											break;
										}
										}
									
									
									?>
									<?php for($i= 1;$i<=12;$i++){
										
										echo "<option value=\"$i\"".$bool[$i-1].">$i</option>";
										
										}
									?>
									</select>
							<div style="display:inline;" id = "eDay">
								<select name="eDay"  >
								<?php 
									echo "<option value=\"$sd[1]\">$sd[1]</option>";					
								?></select>
							</div>
						<div style="display:inline;" id = "eYear">
							<select name="eYear">
							<?php 
									echo "<option value=\"$sd[2]\">$sd[2]</option>";					
								?></select>
						</div>
						</td>
						<td class="error"></td>
					</tr>
					
					<tr class="d1">
						<td>Number of Rooms: </td>
						<td><input type="text" name="NumberOfRooms" id="noRooms" size="5"  <?php if(isset($dorm["NumberOfRooms"])){echo 'value="'.$dorm["NumberOfRooms"].'"';}  ?> /></td>
						<td id="noRm" class="error"></td>
					</tr>
					
					<tr class="d1">
						<td>Max Residents per Room: </td>
						<td><input type="text" name="MaxResidentPerRoom" id="noPerRoom" size="5" <?php if(isset($dorm["MaxResidentPerRoom"])){echo 'value="'.$dorm["MaxResidentPerRoom"].'"';}  ?>  /></td>
						<td id="noPerRm" class="error"></td>
					</tr>
					<tr class="d1">
						<td>Transient Fee For UP Students: </td>
						<td><input type="text" name="TFUP" id="TFUP" size="5" <?php if(isset($dorm["TFUP"])){echo 'value="'.$dorm["TFUP"].'"';}  ?>  /></td>
						<td id="noTFUP" class="error"></td>
					</tr>
					<tr class="d1">
						<td>Transient Fee For Non UP Students/Residents: </td>
						<td><input type="text" name="TFNUP" id="TFNUP" size="5" <?php if(isset($dorm["TFNUP"])){echo 'value="'.$dorm["TFNUP"].'"';}  ?>  /></td>
						<td id="noTFNUP" class="error"></td>
					</tr>
					<tr class="d1">
						<td>School Year </td>
						<td><input type="text" name="SY" id="SY" size="5" <?php if(isset($dorm["SchoolYear"])){echo 'value="'.$dorm["SchoolYear"].'"';}  ?>  /></td>
						<td id="noSY" class="error"></td>
					</tr>
					<?php 
						$bool[0] = "";$bool[1] = "";$bool[2] = "";
						
						if(isset($dorm["Term"])){
							if($dorm["Term"]=='1'){
								$bool[0] ="selected=\"selected\"";
							}
							if($dorm["Term"]=='2'){
								$bool[1] ="selected=\"selected\"";
							}
							if($dorm["Term"]=='S'){
								$bool[2] ="selected=\"selected\"";
							}
						}
					
					?>
					<tr class="d1">
					<td>Term</td>
						<td>
					<select name="Term">	
					<option <?php echo $bool[0]; ?>  value="1">First Sem</option>
					
					<option  <?php echo $bool[1]; ?>  value="2">Second Sem</option>
					
					<option <?php echo $bool[2]; ?>  value="S"> Summer</option>
					</select>
					</td>
					
					</tr>
					
					<tr class="d1">
						<td>Clusters <br/>(Each clusters should be separated by '*'.<br/> Read the manual for more info): </td>
						<td><textarea name="Clusters" id="cluster" ><?php if(isset($dorm["Clusters"])){echo $dorm["Clusters"];}  ?>  </textarea></td>
						<td id="clstr" class="error"></td>
					</tr>
				
				</table>
			</div>
			<br>
			
			<table id='appSet' class='appSet'>
				
				<tr>
					<th><center>Appliances</center></th>
					<th><center>Montlhy Rent</center></th>
					<th><center>Daily Rent</center></th>
				</tr>
				<?php 
				$cnt = 0;
				if($dormApp!=""){
				foreach($dormApp as $da){
					
					$temp  = explode("*",$da);
					echo "<tr><td><input type=\"text\" name=\"App$cnt\" id=\"App$cnt\" value=\"$temp[0]\" size=\"20\"></td>";
					echo "<td><input type=\"text\" name=\"AppMonth$cnt\" id=\"AppMonth$cnt\" value=\"$temp[1]\" size=\"20\"></td>";
					echo "<td><input type=\"text\" name=\"AppDaily$cnt\" id=\"AppDaily$cnt\" value=\"$temp[2]\" size=\"20\"></td>";
				
					echo "</tr>";	
					$cnt++;					
				}
				}			
			$_SESSION["numAppSet"] = $cnt;
				?>
			</table>
			
			<table>
				<tr>
						
					<td colspan="3"><input type="button" value="Add Appliance" name="addApp" onclick="addAppSet('appSet')" /></td>
				
				</tr>
			
				<tr>
						
					<td colspan="3"><input type="submit" value="Submit" name="submitResident"/></td>
				</tr>
				
			</table>
			
		</form>
	</body>
	
</html>