<?php 
/*
 * 
 * 			 
 */

	if (!(isset($_SESSION['username'])))
		redirect('');
		
	

?>
<html>
	<head>
	
		<title> Dorma - New Dormitory Residence Hall </title>
		<link rel="stylesheet" type="text/css" href= '<?php  echo base_url()."CSS/style.css" ?>' />
		<script type="text/javascript" src='<?php echo base_url()."JS/addJS.js"?>'></script>
		<script type="text/javascript" src='<?php echo base_url()."JS/searchJS.js"?>'></script>
		
		<script type="text/javascript" src="JS/option.js"></script>
		<script type="text/javascript" src="JS/jquery_2.js"></script>
		
		<!--script type="text/javascript">
			$(document).ready(function () {
				 $(".sort_option").hide();
				 $(".report_option").hide();
			});
		</script-->
		
		<script>
			var timeout    = 500;
			var closetimer = 0;
			var ddmenuitem = 0;

			function jsddm_open()
			{  jsddm_canceltimer();
			   jsddm_close();
			   ddmenuitem = $(this).find('ul').css('visibility', 'visible');}

			function jsddm_close()
			{  if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

			function jsddm_timer()
			{  closetimer = window.setTimeout(jsddm_close, timeout);}

			function jsddm_canceltimer()
			{  if(closetimer)
			   {  window.clearTimeout(closetimer);
				  closetimer = null;}}

			$(document).ready(function()
			{  $('#jsddm > li').bind('mouseover', jsddm_open);
			   $('#jsddm > li').bind('mouseout',  jsddm_timer);});

			document.onclick = jsddm_close;

			function keepColor(x){
				document.getElementById(x).style.background="#363636";
			}
			
			function returnColor(x){
				document.getElementById(x).style.background="rgb(43, 182, 211)";
			}
		</script>
	</head>

	<body onLoad="restart()" class="homeBody">
		
		<div class="maindiv">
				<?php echo anchor("home",img(array('src'=> "IMG/dorma2.png", 'alt' => "dorma", 'style' => "border: 0px" )));?>
			<br/>
		
			<div class="top_links">
				<a href="">help</a> | <input type ="button" value="settings" onclick="loadXMLDoc('index.php?c=dorm&m=setting')" /> | <a href="index.php?c=dorm&m=logout" >logout</a> 
			</div>
			
			<br/>
			
			
			<br/>
			<div style="color: rgb(149, 149, 149); letter-spacing:0px; font-size:14; text-align: center">
					- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			</div>
			
			<br/><br/>
			
			<?php echo img(array('src'=> "IMG/img2.jpg", 'alt' => "banner", 'style' => "border: 5px; border-color: rgb(243, 243, 243)" ));?>
			<br/><br/>
			<div style="color: rgb(149, 149, 149); letter-spacing:0px; font-size:14; text-align: center">
					- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			</div>
			<div class="date">
										
					<?php
						/* 	Philippines is not in the list of available time zones
							Supposedly, Singapore and Philippines has the same time zones
							Let's see... */
						
						$timezone = new DateTimeZone( "Asia/Manila" ); 
					
						$date = new DateTime(); 
						$date->setTimezone( $timezone ); 
						echo  $date->format( 'l, F j, Y' ); 
					?>
					
			</div><br/>
			<table class="horizontalBar">
				<tr>
					<td>
						<div class="horiContent">
							<div class="menuOpt">
								<ul id="jsddm"> 
									<li> <input type="button" class="add_title" value="Add Resident" id="add_title" onMouseOver="keepColor('add_title')" onmouseout="returnColor('add_title')">
										<div class="add_option"  onMouseOver="keepColor('add_title')" onmouseout="returnColor('add_title')">
											<ul id="add_option">
												<li> <input class="addOpt" type="button" value="Student" onclick="loadXMLDoc('index.php?c=resident&m=addStudent')"/> </li>
												<li> <input class="addOpt" type="button" value="Transient" onclick="loadXMLDoc('index.php?c=resident&m=addTransient')"/> </li>
											</ul>
										</div>
									</li>
									
									<li> <input type="button" onclick="loadXMLDoc('index.php?c=resident&m=tally')" class="tally_title" value="Tally"> </li>
									<li> <input type="button"  class="report_title" value="Report" id="report_title" onMouseOver="keepColor('report_title')" onmouseout="returnColor('report_title')"/>
										<div class="report_option"  onMouseOver="keepColor('report_title')" onmouseout="returnColor('report_title')">
											<ul id="report_option">
												<li> <input class="repOpt" type="button" value="Accomplisment Monthly Report" onclick="loadXMLDoc('index.php?c=dorm&m=currentAccomplishReport')"/> </li>
												<li> <input class="repOpt"  type="button" value="Resident Monthly Report" onclick="loadXMLDoc('index.php?c=dorm&m=residentswithaccount')"/> </li>
												<li> <input class="repOpt"  type="button" value="Transient Monthly Report"  onclick="loadXMLDoc('index.php?c=dorm&m=transientswithaccount')"/> </li>
												<li> <input class="repOpt" type="button" value="Appliance Monthly Report" onclick="loadXMLDoc('index.php?c=dorm&m=applianceReport')" /> </li>
												<li> <input class="repOpt"  type="button" value="Accounts Receivable"  onclick="loadXMLDoc('index.php?c=dorm&m=accountsReceivable')"/> </li>
												
											</ul>
										</div>
									</li>
									<li>
										<input type="button" value="Sort" class="sort_title" id="sort_title" onMouseOver="keepColor('sort_title')" onmouseout="returnColor('sort_title')"/>
										
										<div class="sort_option"  onMouseOver="keepColor('sort_title')" onmouseout="returnColor('sort_title')">
											<ul id="sort_option">
												<li> <input type="button" value="By Sex" onclick ="loadXMLDoc('index.php?c=resident&m=sort&category=gender')"/> </li>
												<li> <input type="button" value="By College" onclick ="loadXMLDoc('index.php?c=resident&m=sort&category=college')" /> </li>
												<li> <input type="button" value="By Classification" onclick ="loadXMLDoc('index.php?c=resident&m=sort&category=classification')"/> </li>
												<li> <input type="button" value="By Region" onclick ="loadXMLDoc('index.php?c=resident&m=sort&category=region')" /> </li>
												<li> <input type="button" value="By Economic Status"/> </li>
											</ul>
										</div>
									</li>
									<li>
										<input type="button" class="project_title" id="project_title" value="Repairs and Projects"/>
										<div class="project_option"  onMouseOver="keepColor('project_title')" onmouseout="returnColor('project_title')">
											<ul id="project_option">
												<li> <input type="button" class="projOpt" value="Add"  onclick="loadXMLDoc('index.php?c=dorm&m=addProject')"/> </li>
												<li> <input type="button" class="projOpt" value="View & Edit"  onclick="loadXMLDoc('index.php?c=dorm&m=editWorkload')"/> </li>
			
											</ul>
										</div>
									</li>
								</ul>	 
							</div>
							</div>
					</td>
					<td style="width: 280px">
							<div class="searchBar">
								<input type="text"  name="search" class="searchbox" value="Search..." id="search" onkeyup="suggest(this.value)" onkeydown="suggest(this.value)" onFocus="clearfield()" onBlur="restart()"/>
								<div id="suggest" class="suggestionbox" style="z-index: 2">
								
								</div>
							</div>
						
					</td>
				</tr>
			</table>
				
			<br><br>
			
			<table>
				<tr>
					<td>
						
											<div class="content" id="content">
										
								<?php 
								
								if(isset($_SESSION["newResidentInfo"])){
									echo "<div class=\"message\">";
									echo $_SESSION["newResidentInfo"];
									echo "</div>";
								
								
									unset($_SESSION["newResidentInfo"]);
								}
								else if (isset($_SESSION["appCheckedOut"])){
									echo $_SESSION["appCheckedOut"];
									unset($_SESSION["appCheckedOut"]);
								}
								else
									if(isset($_SESSION["Settings"])){echo $_SESSION["Settings"];  unset($_SESSION["Settings"]);}
	
								else
								if(isset($_SESSION["trans"])){echo $_SESSION["trans"];  unset($_SESSION["trans"]);}
	
								else
								{ ?>
								<h2 style="text-align: center; color: gray">Welcome!</h2><br/>
								<?php 
								if(isset($_SESSION["setSettings"])){
								echo $_SESSION["setSettings"];
						}
								
								?>
						
							<?php }?>
						</div>
						
						<div class="content" id="residentSearch">
						</div>
						
						<div class="content" id="transientSearch">
						</div>
	
					</td>
				</tr>
			</table>
			
			
		<br/><br/>	
		</div>
		<br/>
		<div class="footer">
				Dorma © 2011
		</div>
	</body>
</html>
