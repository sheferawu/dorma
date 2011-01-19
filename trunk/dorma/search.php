<?php 


?>

<html>
 <head><title>Search</title>
 	<script type="text/javascript" src="searchJS.js"></script>
 </head>

	<body>
	
	<input type="text" name="search" id="search" onkeyup="suggest(this.value)" onkeydown="suggest(this.value,this.id)" />
	<div id="suggest" style="position: relative; top: -4px; width='100px;'" >

	</div>
	
	<div id="link">
  	</div>  
 	<br/>
 	<table>
 	</table>
	</body>
</html>