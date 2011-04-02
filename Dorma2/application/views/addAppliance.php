<table class = "appliance" id = "app">
	<tr>
		<td>
			<select name="ApplianceName0" id="ApplianceName0" > 
				<option value = "RADIO0">
					Radio
				</option>
				<option value = "EF0">
					Electric Fan
				</option>
				<option value = "CW/P0">
					Computer With Printer
				</option>
				<option value = "CW/OP0">
					Computer With Out Printer
				</option>

			</select>
		</td>
		<td>
			<input type="text" name="controlNum0" id="controlNum0"/>
		</td>
	</tr>
</table>
<input type="button" value="Add Appliances" onclick="addApp()"/>
<input type="button" value="Remove Appliance" onclick="removeApp()"/>