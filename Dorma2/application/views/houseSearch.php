
<html>
<head><title>Search Resident In a Dorm</title>
<script type="text/javascript" src='<?php echo base_url()."JS/house.js"?>'></script>
<script type="text/javascript" src="JS/jquery_2.js"></script>
				
</head>
<body>
<h4>Search</h4>
<hr/><br/>

<table>
	<tr>
		<td>
			<table>
			<tr>
			<td>
			<div class="searchBar" style="float:left">
				<?php echo $select; ?><br/>
				<input type="text"  name="search" class="searchbox" value="Search..." id="searchHouse" onkeyup="suggest(this.value)" onkeydown="suggest(this.value)" onFocus="clearfield()" onBlur="restart()"/>
				
			</div>
			</td>
			</tr>
			<tr>
			<td>
			<div id="suggestHouse" class="suggestionbox" style="z-index: 2">
			</div>
			</td>
			</tr>
			</table>
		</td>
		<td>	
			<div class="content" id="residentSearchHouse" >
			</div>
		</td>
	</tr>
</table>
<br/>
<br/>




</body>

</html>