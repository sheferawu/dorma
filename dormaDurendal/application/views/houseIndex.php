<html>
<head>
	<title>Houseman|Home</title>
	<script type="text/javascript" src='<?php echo base_url()."JS/house.js"?>'></script>
	<script type="text/javascript" src="JS/jquery_2.js"></script>
	<link rel="stylesheet" type="text/css" href= '<?php  echo base_url()."CSS/style2.css" ?>' />	
</head>
<body>
	<div class="header"><?php echo  anchor("home",img(array('src'=> "IMG/H2.png", 'alt' => "logo")));?></div>
	
	<hr/>
	<div class="maindiv">
		<table>
			<tr>
				<td>
					<div class="sidebar">
						<h4>Menu</h4>
						<hr/>
						<a href="index.php?c=house">Home</a>
						<hr/>
						<input type ="button" value="Options" onclick="loadXMLDoc('index.php?c=house&m=options')" /><br/>
						<hr/>
						<input type ="button" value="Upload Picture" onclick="loadXMLDoc('index.php?c=house&m=upload')" /><br/>
						<hr/>
						<input type ="button" value="Search" onclick="loadXMLDoc('index.php?c=house&m=search')" /><br/>
						<hr/>
						<a href="index.php?c=house&m=logout">Logout</a>
					</div>
				</td>
				<td>
					<div class="content" id="contentHouse">
						<h4>Welcome to Houseman</h4>
						<hr/>
						<p>Houseman is an extension of <i>Dorma: Dorm Manager System</i> which supports the generic feature of the system.<br/>
						This enables housing staffs to determine and modify dorm managers, informations and images.
						</p>
					</div>
					
					


				</td>
				<td>
				
				</td>
			</tr>
		</table>
	</div>
	
	<hr/>
	<div class="footer"><br/><br/>Dorma © 2011</div>
</body>
</html>