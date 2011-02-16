<?php 
/*
 * 
 * 			 
 */
?>
<html>
	<head>
	
		<title> Dorma - New Dormitory Residence Hall </title>
		<link rel="stylesheet" type="text/css" href= '<?php  echo base_url()."CSS/style.css" ?>' />
		<script type="text/javascript" src='<?php echo base_url()."JS/addJS.js"?>'></script>
		<script type="text/javascript" src='<?php echo base_url()."JS/searchJS.js"?>'></script>
		
		<script type="text/javascript" src="JS/option.js"></script>
		<script type="text/javascript" src="JS/jquery_2.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function () {
				 $(".sort_option").hide();
				 $(".report_option").hide();
			});
		</script>
	</head>

	<body onLoad="restart()">
		
		<div class="maindiv">
			<br/>
			<div class="top_links">
				<a href="">help</a> | <a href="" >settings</a> | <a href="" >logout</a> 
			</div>
			<br/><br/><br/>
			<div class="sidebar">
				<br/><br/><br>
				<?php echo anchor("home",img(array('src'=> "IMG/dorma.png", 'alt' => "dorma", 'style' => "border: 0px" )));?>
				
				<div style="color: rgb(149, 149, 149); letter-spacing:0px; font-size:14">
					dorm manager system
				
				
					<br/><br/><br>
					<br/><br/><br/>
					- - - - - - - - - - - - - - - - - - - - - - - -
				</div>
				<br/>
				<br/>
				
				<div class="menuOpt">
					<ul id="menu"> 
						<li> <input type="button" onclick="loadXMLDoc('index.php?c=resident&m=add')" value="Add Resident"> </li>
						<li> <input type="button" onclick="loadXMLDoc('index.php?c=resident&m=tally')" value="Tally"> </li>
						<li> <input type="button"  class="report_title" value="Report" onclick="dropDown('report_option')" />
							<div class="report_option">
								<ul id="report_option">
									<li> <input type="button" value="Accomp. Monthly Rep." onclick="loadXMLDoc('index.php?c=dorm&m=currentAccomplishReport')"/> </li>
								    <li> <input type="button" value="Resident Monthly Rep." onclick="loadXMLDoc('index.php?c=dorm&m=residentswithaccount')"/> </li>
									<li> <input type="button" value="App. Monthly Rep." onclick="loadXMLDoc('index.php?c=dorm&m=applianceReport')" /> </li>
									<li> <input type="button" value="Accounts Receivable"  onclick="loadXMLDoc('index.php?c=dorm&m=accountsReceivable')"/> </li>
									
								</ul>
							</div>
						</li>
						<li>
							<input type="button" value="Sort" class="sort_title" onclick="dropDown('sort_option')"/>
							
							<div class="sort_option">
								<ul id="sort_option">
									<li> <input type="button" value="By Sex" onclick ="loadXMLDoc('index.php?c=resident&m=sort&category=gender')"/> </li>
									<li> <input type="button" value="By College" onclick ="loadXMLDoc('index.php?c=resident&m=sort&category=college')" /> </li>
									<li> <input type="button" value="By Classification" onclick ="loadXMLDoc('index.php?c=resident&m=sort&category=classification')"/> </li>
									<li> <input type="button" value="By Region" onclick ="loadXMLDoc('index.php?c=resident&m=sort&category=region')" /> </li>
									<li> <input type="button" value="By Economic Status"/> </li>
								</ul>
							</div>
						</li>
						<li> <input type="button"  class="project_title" value="Repairs and Projects" onclick="loadXMLDoc('index.php?c=dorm&m=addProject')"/>
					</ul>	 
				</div>
			</div>
			
			<div class="container">
				<?php echo img(array('src'=> "IMG/banner.png", 'alt' => "banner", 'style' => "border: 5px;border-color: rgb(243, 243, 243)" ));?>
				<br/><br/>
				<div class="date">
										
					<?php
						/* 	Philippines is not in the list of available time zones
							Supposedly, Singapore and Philippines has the same time zones
							Let's see... */
						
						$timezone = new DateTimeZone( "Asia/Singapore" ); 
					
						$date = new DateTime(); 
						$date->setTimezone( $timezone ); 
						echo  $date->format( 'l, F j, Y' ); 
					?>
					
				</div>
				<br/>
				<div style="color: rgb(149, 149, 149); letter-spacing:0px; font-size:14">
					- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
				</div>
				
				<div align="right">
					<input type="text"  name="search" class="searchbox" value="Search..." id="search" onkeyup="suggest(this.value)" onkeydown="suggest(this.value,this.id)" onFocus="clearfield()" onBlur="restart()"/>
					<div id="suggest" class="suggestionbox" style="z-index: 2" >
					</div>
				</div>
				
				<br><br>
				
				<div class="content" id="content" style="position: absolute; z-index: 1">
					<?php if(isset($_SESSION["newResidentInfo"])){
							echo $_SESSION["newResidentInfo"];
							unset($_SESSION["newResidentInfo"]);
						}
						else if (isset($_SESSION["appCheckedOut"])){
							echo $_SESSION["appCheckedOut"];
							unset($_SESSION["appCheckedOut"]);
						}
						else{ ?>
						<h2 style="text-align: center; color: gray">Welcome!</h2>
				
					<?php }?>
				</div>
				
			</div>
		</div>
	</body>
</html>