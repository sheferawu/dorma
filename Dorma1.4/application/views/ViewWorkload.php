<?php

?>

<html>
	<head>
	
	</head>


	<body>
	
		<?php 
			if (isset($project)){
				echo "<h2>Repairs, Maintenance Works and Projects</h2>";
				echo $project;
			}
			else{
				echo "Nothing to display";
			}
		?>
		
		
	
	
	</body>
</html>