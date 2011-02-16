<?php 

?>

<html>
	
	
<body>
<h3 class="workload" onclick="dropDown('workload')">Workload</h3>
	<form action="index.php?c=dorm&m=getWorkload" method="POST" name="projectForm"  onsubmit="return(validateForm(this))">
	<div class="workload">
	Nature of Work:
	&nbsp;
	<select name="workNature">
	<option>Repairs</option>
	<option>Maintenance Works</option>
	<option>Projects</option>
	</select>
	</div>
	<br>
	Specific Work:
	&nbsp;
	<input type="text" name="specWork" size="14">
	<br><br>
	Manpower:
	&nbsp;
	<input type="text" name="manpower" size="24">
	<br><br>
	Status:
	&nbsp;
	<br>
	<textarea name="status" rows="4" cols="25"></textarea>
	<br><br>
	Start Date:
	&nbsp;
	<select name="startMonth" id="startMonth" onchange="getStartMonth(this.options[this.selectedIndex].value)">
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
							<div style="display:inline;" id = "startDay">
								<select name="startDay">
									<option value="">Day</option>
								</select>
							</div>
						<div style="display:inline;" id = "startYear">
							<select name="startYear" >
								<option value="">Year</option>
								<option value=""></option>
							</select>


						</div>
	<br><br>
	Completion Date:
	&nbsp;
	<select name="compMonth" onchange="getCompMonth(this.options[this.selectedIndex].value)">
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
							<div style="display:inline;" id="compDay">
								<select name="compDay">
									<option value="">Day</option>
								</select>
							</div>
						<div style="display:inline;" id="compYear">
							<select name="compYear">
								<option value="">Year</option>
								<option value=""></option>
							</select>
							</div>
	<br><br>						
	Remarks:
	&nbsp;
	<br>	
	<textarea name="remarks" rows="4" cols="25"> </textarea>
	<br><br>
	<input type="submit" value="Submit" name="workload"/>
	<br>
	</form>
</body>
</html>