<?php 

?>

<html>
	
	
<body>
<h3 class="workload" onclick="dropDown('workload')">Workload</h3>
	<form action="index.php?c=dorm&m=getWorkload" method="POST" name="projectForm"  onsubmit="return(validateWorkloadForm(this))">
	<table>
		<tr>
			<td>
				Nature of Work:
			</td>
			<td>
				<select name="workNature">
					<option>Repairs</option>
					<option>Maintenance Works</option>
					<option>Projects</option>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>
				Specific Work:
			</td>
			
			<td>
				<input type="text" name="specWork" id="specWork" size="14">
			</td>
		</tr>
	
		<tr>
			<td>
				Manpower:
			</td>
			
			<td>
				<input type="text" name="manpower" id="manpower" size="24">
			</td>
		</tr>
	
		<tr>
			<td>
				Status:
			</td>
			
			<td>
				<textarea name="status" id="status" rows="4" cols="25"></textarea>
			</td>
		</tr>
	
		<tr>
			<td>
				Start Date:
			</td>
			
			<td>
				<select name="startMonth" id="startMonth" onchange="getMonth(this.options[this.selectedIndex].value,'startDay','startYear')">
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
			</td>
		</tr>
	
		<tr>
			<td>
				Completion Date:
			</td>
			
			<td>
				<select name="compMonth" onchange="getMonth(this.options[this.selectedIndex].value,'compDay','compYear')">
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
			</td>
		</tr>
	
		<tr>
			<td>
				Remarks:
			</td>
			
			<td>
				<textarea name="remarks" rows="4" cols="25"> </textarea>
			</td>
		</tr>		
		
		<tr>
			<td colspan="2">
				<input type="submit" value="Submit" name="workload"/>
			</td>

		</tr>

	
	</table>
	</form>
</body>
</html>