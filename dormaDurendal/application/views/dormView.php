<?php 
//problem: naming convention of variables specially the 'name' attribute of the html tags

?>
<html>
	<head>
		<title>Dorm View</title>
		<link rel="stylesheet" type="text/css" href="CSS/style.css" />
		<script type="text/javascript" src=JS/addJS.js></script>
		<script type="text/javascript" src="JS/jquery_2.js"></script>
		<script type="text/javascript"> 
		function addApp2()
		{	var tbl = document.getElementById('apl');
		
		var lastRow = tbl.rows.length;
		var iteration = lastRow;
	
		var row = tbl.insertRow(lastRow);
		var cellRight;
		var el;
		var cnt = 0;
		var arr = new Array('NONE','RADIO','EF', 'CW/P', 'CW/OP');
		var arr1 = new Array('None','Radio','Electric Fan', 'Computer With Printer', 'Computer With Out Printer');


		
		
		cellRight = row.insertCell(0);
		el = document.createElement('select');
		el.name = "ApplianceName" + (iteration);
		el.id = "ApplianceName" + (iteration);
		var cnt1 = 0;
		var p;
		for(cnt1=0;cnt1<arr.length;cnt1++){
			
		 el.options[cnt1] = new Option(arr1[cnt1], arr[cnt1]);
		 }
		 cellRight.appendChild(el);

		 cellRight = row.insertCell(1);
			el = document.createElement('input');
			el.type = 'text';
			el.name = "mFee" + (iteration);
			
			el.id = "mFee" + (iteration);
		    cellRight.appendChild(el);
			
		    cellRight = row.insertCell(2);
			el = document.createElement('input');
			el.type = 'text';
			el.name = "dFee" + (iteration);
			
			el.id = "dFee" + (iteration);
		    cellRight.appendChild(el);
		}
		
		    function addApp3()
			{	
			var tbl = document.getElementById('clstr');
			
			var lastRow = tbl.rows.length;
			var iteration = lastRow;
		
			var row = tbl.insertRow(lastRow);
			var cellRight;
			var el;
			var cnt = 0;
			var arr = new Array('NONE','RADIO','EF', 'CW/P', 'CW/OP');
			var arr1 = new Array('None','Radio','Electric Fan', 'Computer With Printer', 'Computer With Out Printer');


			
			
			cellRight = row.insertCell(0);
			el = document.createElement('select');
			el.name = "cstartMonth" + (iteration);
			el.id = "csMonth" + (iteration);
			var cnt1 = 0;
			var p;
			for(cnt1=0;cnt1<arr.length;cnt1++){
				
			 el.options[cnt1] = new Option(arr1[cnt1], arr[cnt1]);
			 }
			 cellRight.appendChild(el);

			 cellRight = row.insertCell(1);
				el = document.createElement('select');
				el.name = "cstartDate" + (iteration);
				
				el.id = "cstDate" + (iteration);
				var cnt1 = 0;
				var p;
				for(cnt1=0;cnt1<arr.length;cnt1++){
					
				 el.options[cnt1] = new Option(arr1[cnt1], arr[cnt1]);
				 }
				 cellRight.appendChild(el);
			    
			    cellRight = row.insertCell(2);
				el = document.createElement('select');
				el.name = "cstartYear" + (iteration);
				
				el.id = "cstYear" + (iteration);
				var cnt1 = 0;
				var p;
				for(cnt1=0;cnt1<arr.length;cnt1++){
					
				 el.options[cnt1] = new Option(arr1[cnt1], arr[cnt1]);
				 }
				 cellRight.appendChild(el);
			}
	function removeApp()
	{
	  var tbl = document.getElementById('app');
	  var lastRow = tbl.rows.length;
	  if (lastRow > 1) tbl.deleteRow(lastRow - 1);
	}

</script>
		
		
	</head>
	
	<body>
		<form action="index.php?c=resident&m=getData" method="POST" name="dormview"  onsubmit="return(validateForm(this))">
			<h3 class="dorm_view" onclick="dropDown('dorm_view')">Dorm Information</h3>
			<div class="dorm_view">
				<table class="addDorm">
					<tr class="d1">
						<td>Dorm Name:</td>					
						<td><input type="text" name="dormname" id="dormname" size="35"></td>					
						<td id="dn" class="error"></td>
					</tr>
					
					<tr class="d1">
						<td> Alias: </td>
						<td><input type="text" name="alias" size="35"></td>
						<td id="an" class="error"></td>
					</tr>
					
					<tr class="d1">
						<td>Dorm Manager: </td>
						<td><input type="text" name="dormngr" size="35"></td>
						<td id="dormmngr" class="error"></td>
					</tr>
					
					<tr class="d1">
						<td>Number of Rooms: </td>
						<td><input type="text" name="noRooms" size="5"></td>
						<td id="noRooms" class="error"></td>
					</tr>
					
					<tr class="d1">
						<td>Max number of residents per room: </td>
						<td><input type="text" name="maxRoom" size="5"></td>
						<td id="maxRoom" class="error"></td>
					</tr>
					
					<tr class="d1">
						<td>Max number of dorm residents: </td>
						<td><input type="text" name="maxDorm" size="5"></td>
						<td id="maxDorm" class="error"></td>
					</tr>
					
					<tr class="d1">
						<td>Daily Rent: </td>
						<td><input type="text" name="dailyRent" size="10"></td>
						<td id="dRent" class="error"></td>
					</tr>
					
					<tr class="d1">
						<td>Monthly Rent: </td>
						<td><input type="text" name="monthlyRent" size="10"></td>
						<td id="mRent" class="error"></td>
					</tr>
					
					<tr>
						<td>Start Date of Operation:</td>
						<td>
						<select name="startMonth"  onchange="getMonth(this.options[this.selectedIndex].value)">
						<option value="0" >Month</option>
						<option value="01" >January</option>
						<option value="02" >February</option>
						<option value="03" >March</option>
						<option value="04" >April</option>
						<option value="05" >May</option>
						<option value="06" >June</option>
						<option value="07" >July</option>
						<option value="08" >August</option>
						<option value="09" >September</option>
						<option value="10" >October</option>
						<option value="11" >November</option>
						<option value="12" >December</option>
						</select>
						<div style="display:inline;" id = "sDay">
						<select name="startDay" >
						<option value="">Day</option>
						</select>
						</div>
						<div style="display:inline;" id = "sYear">
						<select name="startYear">
						<option value="">Year</option>
						<option value=""></option>
						</select>
						</div>
						</td>
						<td class="error"></td>
					</tr>
					
					<tr>
						<td>End Date of Operation:</td>
						<td>
						<select name="endMonth"  onchange="getMonth(this.options[this.selectedIndex].value)">
						<option value="0" >Month</option>
						<option value="01" >January</option>
						<option value="02" >February</option>
						<option value="03" >March</option>
						<option value="04" >April</option>
						<option value="05" >May</option>
						<option value="06" >June</option>
						<option value="07" >July</option>
						<option value="08" >August</option>
						<option value="09" >September</option>
						<option value="10" >October</option>
						<option value="11" >November</option>
						<option value="12" >December</option>
						</select>
						<div style="display:inline;" id = "eDay">
						<select name="endDay" >
						<option value="">Day</option>
						</select>
						</div>
						<div style="display:inline;" id = "eYear">
						<select name="endYear">
						<option value="">Year</option>
						<option value=""></option>
						</select>
						</div>
						</td>
						<td class="error"></td>
					</tr>
					<tr>
					<td>
					<table class="appl" id="apl">
					<tr class="d1"> 
						<td>Appliance: </td>
						<td>Monthly Fee </td>
						<td>Daily Fee </td>
						<td id="app" class="error"></td>
							</tr>
							<tr>
								<td>
								<select name="ApplianceName0" id="ApplianceName0" > 
								<option value = "RADIO0">Radio</option>
								<option value = "EF0">Electric Fan</option>
								<option value = "CW/P0">Computer With Printer</option>
								<option value = "CW/OP0">Computer With Out Printer</option>
								</select>
								</td>
								<td>
							
								<input type="text" name="monthlyFee" id="mFee"/>
								</td>
								<td>
							
								<input type="text" name="dailyFee" id="dFee"/>
								</td>
							</tr>
							
					</table>			
								<input type="button" value="Add Appliances" onclick="addApp2()"/>
								<input type="button" value="Remove Appliance" onclick="removeApp()"/>
						
					<table class="cluster" id="clstr">
					<tr class="d1"> 
						<td>Cluster </td>
						<td id="clstr" class="error"></td>
					</tr>
					<tr>
					<td>
						<select name="cstartMonth0" id="cstMonth0" onchange="getMonth(this.options[this.selectedIndex].value)">
						<option value="0" >Month</option>
						<option value="01" >January</option>
						<option value="02" >February</option>
						<option value="03" >March</option>
						<option value="04" >April</option>
						<option value="05" >May</option>
						<option value="06" >June</option>
						<option value="07" >July</option>
						<option value="08" >August</option>
						<option value="09" >September</option>
						<option value="10" >October</option>
						<option value="11" >November</option>
						<option value="12" >December</option>
						</select>
						<div style="display:inline;" id = "csDay">
						<select name="cstartDay" id="cstDay" >
						<option value="">Day</option>
						</select>
						</div>
						<div style="display:inline;" id = "csYear">
						<select name="cstartYear" id="cstYear">
						<option value="">Year</option>
						<option value=""></option>
						</select>
						</div>
						</td>		
						<td> To </td>		
					<td>
						<select name="cendMonth" id="cedMonth" onchange="getMonth(this.options[this.selectedIndex].value)">
						<option value="0" >Month</option>
						<option value="01" >January</option>
						<option value="02" >February</option>
						<option value="03" >March</option>
						<option value="04" >April</option>
						<option value="05" >May</option>
						<option value="06" >June</option>
						<option value="07" >July</option>
						<option value="08" >August</option>
						<option value="09" >September</option>
						<option value="10" >October</option>
						<option value="11" >November</option>
						<option value="12" >December</option>
						</select>
						<div style="display:inline;" id = "ceDay">
						<select name="cendDay" id="cenDay">
						<option value="">Day</option>
						</select>
						</div>
						<div style="display:inline;" id = "ceYear">
						<select name="cendYear" id="cenYear">
						<option value="">Year</option>
						<option value=""></option>
						</select>
						</div>
						</td>
						</tr>
						
						
					</table>			
								<input type="button" value="Add Cluster" onclick="addApp3()"/>
								<input type="button" value="Remove Cluster" onclick="removeApp()"/>
						
					
			</table>
			
		</div>
					
			<table>
				<tr>
					<td colspan="3"><input type="submit" value="Submit" name="submitResident"/></td>
				</tr>
			</table>
			
		</form>
	</body>
</html>