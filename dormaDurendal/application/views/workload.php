<?php 

?>

<html>
	<head>
		<title>Workload and Other Activities</title>
		<link rel="stylesheet" type="text/css" href="CSS/style.css" />
		<script type="text/javascript" src=JS/addJS.js></script>
		<script type="text/javascript" src="JS/jquery_2.js"></script>	
	</head>
	
<body>
<h3 class="workload" onclick="dropDown('workload')">Workload</h3>
			<div class="workload">
				<table class="workload">
					<tr>
						<td><center>Nature of Work</center></td>
						<td><center>Manpower</center></td>
						<td><center>Status</center></td>
						<td><center>Start Date</center></td>
						<td><center>Completion Date</center></td>
						<td><center>Remarks</center></td>
					</tr>
					<tr>
						<td colspan="6"><center>Repairs</center></td>
					</tr>
					<tr>
						<td>Carpentry</td>
						<td><input type="text" name="carpMan" size="14"/></td>
						<td><textarea id="carpStat" rows="4" cols="14"></textarea></td>
						<td><input type="text" name="carpStartDate" size="14"/></td>
						<td><input type="text" name="carpCompDate" size="14"/></td>
						<td><textarea id="carpRemarks" rows="4" cols="14"></textarea></td>
					</tr>
					<tr>
						<td>Plumbing</td>
						<td><input type="text" name="plumbMan" size="14"/></td>
						<td><textarea id="plumbStat" rows="4" cols="14"></textarea></td>
						<td><input type="text" name="plumbStartDate" size="14"/></td>
						<td><input type="text" name="plumbCompDate" size="14"/></td>
						<td><textarea id="plumbRemarks" rows="4" cols="14"></textarea></td>
					</tr>
					<tr>
						<td>Electrical</td>
						<td><input type="text" name="elecMan" size="14"/></td>
						<td><textarea id="elecStat" rows="4" cols="14"></textarea></td>
						<td><input type="text" name="elecStartDate" size="14"/></td>
						<td><input type="text" name="elecCompDate" size="14"/></td>
						<td><textarea id="elecRemarks" rows="4" cols="14"></textarea></td>
					</tr>
					<tr>
						<td colspan="6"><center>Maintenance Works</center></td>
					</tr>
					<tr>
						<td>Grounds</td>
						<td><input type="text" name="grndsMan" size="14"/></td>
						<td><textarea id="grndsStat" rows="4" cols="14"></textarea></td>
						<td><input type="text" name="grndsStartDate" size="14"/></td>
						<td><input type="text" name="grndsCompDate" size="14"/></td>
						<td><textarea id="grndsRemarks" rows="4" cols="14"></textarea></td>
					</tr>
					<tr>
						<td colspan="6"><center>Maintenance Works</center></td>
					</tr>
					<tr>
						<td>On-going</td>
						<td><input type="text" name="ongoMan" size="14"/></td>
						<td><textarea id="ongoStat" rows="4" cols="14"></textarea></td>
						<td><input type="text" name="ongoStartDate" size="14"/></td>
						<td><input type="text" name="ongoCompDate" size="14"/></td>
						<td><textarea id="ongoRemarks" rows="4" cols="14"></textarea></td>
					</tr>
					<tr>
						<td>Proposed</td>
						<td colspan="6"></td>
					</tr>	
					<tr>
						<td>Proposed Electrical</td>
						<td><input type="text" name="propEMan" size="14"/></td>
						<td><textarea id="propEStat" rows="4" cols="14"></textarea></td>
						<td><input type="text" name="propEStartDate" size="14"/></td>
						<td><input type="text" name="propECompDate" size="14"/></td>
						<td><textarea id="propERemarks" rows="4" cols="14"></textarea></td>
					</tr>
					<tr>
						<td>Proposed Carpentry</td>
						<td><input type="text" name="propCMan" size="14"/></td>
						<td><textarea id="propCStat" rows="4" cols="14"></textarea></td>
						<td><input type="text" name="propCStartDate" size="14"/></td>
						<td><input type="text" name="propCCompDate" size="14"/></td>
						<td><textarea id="propCRemarks" rows="4" cols="14"></textarea></td>
					</tr>		
					<tr>
						<td>Proposed Plumbing</td>
						<td><input type="text" name="propPMan" size="14"/></td>
						<td><textarea id="propPStat" rows="4" cols="14"></textarea></td>
						<td><input type="text" name="propPStartDate" size="14"/></td>
						<td><input type="text" name="propPCompDate" size="14"/></td>
						<td><textarea id="propPRemarks" rows="4" cols="14"></textarea></td>
					</tr>	
				</table>
				<table>
				<tr>
					<td colspan="6"><input type="submit" value="Submit" name="submitWorkload"/></td>
				</tr>
			</table>
			</div>
			<h3 class="other_acts" onclick="dropDown('other_acts')">Other Activities Undertaken</h3>
			<div class="other_acts">
				<table class="other_acts">
					<tr>
					<td rowspan="2"><center>Date/Time</center></td>
					<td rowspan="2"><center>Nature of Activity</center></td>
					<td rowspan="2"><center>Client</center></td>
					<td colspan="2"><center>Resources</center></td>
					<td rowspan="2"><center>Remarks</center></td>
					</tr>
					<tr>
					<td><center>Manpower</center></td>
					<td><center>Facilities and Tools</center></td>
					</tr>
					<tr>
					<td><input type="text" name="date1" size="14"/></td>
					<td><input type="text" name="nature1" size="14"/></td>
					<td><input type="text" name="client1" size="14"/></td>
					<td><input type="text" name="manpower1" size="14"/></td>
					<td><input type="text" name="facilities1" size="14"/></td>
					<td><input type="text" name="remarks1" size="14"/></td>
					</tr>
				</table>
			</div>
			<table>
				<tr>
					<td colspan="6"><input type="submit" value="Submit" name="submitOther_Acts"/></td>
				</tr>
			</table>	
</body>
</html>			
			