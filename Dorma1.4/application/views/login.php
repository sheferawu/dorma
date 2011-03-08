<html>
	<head>
		<link rel="stylesheet" type="text/css" href= '<?php  echo base_url()."CSS/style.css" ?>' />
		<script type="text/javascript" src='<?php echo base_url()."JS/validateLogin.js"?>'></script>
		<script type="text/javascript" src='<?php echo base_url()."JS/scrollMenu.js"?>'></script>
		<script type="text/javascript" src='<?php echo base_url()."JS/jquery_2.js"?>'></script>
		<script type="text/javascript" src='<?php echo base_url()."JS/jquery_3.js"?>'></script>
		<script type="text/javascript" src='<?php echo base_url()."JS/tooltip.js"?>'></script>
		
		<script>
			$(function(){
			//Get our elements for faster access and set overlay width
			var div = $('div.sc_menu'),
						 ul = $('ul.sc_menu'),
						 // unordered list's left margin
						 ulPadding = 15;
	
			//Get menu width
			var divWidth = div.width();
	
			//Remove scrollbars
			div.css({overflow: 'hidden'});
	
			//Find last image container
			var lastLi = ul.find('li:last-child');
	
			//When user move mouse over menu
			div.mousemove(function(e){
	
			  //As images are loaded ul width increases,
			  //so we recalculate it each time
			  var ulWidth = lastLi[0].offsetLeft + lastLi.outerWidth() + ulPadding;
	
			  var left = (e.pageX - div.offset().left) * (ulWidth-divWidth) / divWidth;
			  div.scrollLeft(left);
			});
		});
	</script>
	
	</head>

	
	<body class="loginBody">
		
		
		<!-- div class="background1">
		
		</div-->
		
		<br/><br/>
		<center>
		<table class="logTable">
			<tr> 
				<td colspan="2">
					<div class="loginHeader">
						<?php echo anchor("home",img(array('src'=> "IMG/dorma3.png", 'alt' => "dorma", 'style' => "border: 0px" )));?>
					</div>
				</td>
			</tr>
			<tr>
				<td>
				<div class="mainLogDiv">
					<!-- div class="background"></div-->
					<div class="dormInfo">
						<div id="dormTitle">
							Welcome
						</div>
						<br/>
						<hr style="border: none; background-color:#fff; height:1px;"/>
						<br/>
						<div id="dInfo">
							Insert dorma info here<br/>
							must be long enough to look good
							blah blah blah blah
						</div>
					</div>
					
					<div class="login">
						<form class="loginForm" name="loginForm" method="post" action="index.php?c=dorm&m=checkUser" onSubmit="return(validateForm(this))">
							<br/>
							<table class="logTable">
								<tr>
									<th colspan="3">Login</th>
								</tr>
								<tr>
								
								<td colspan="3">
									Select dorm <br/>
									<!-- select name="dormname"> 
									<?php 
									//foreach ($dn as $d){
									//echo "<option value=\"$d\">$d </option>";
									//}
									?>
									
									
										
									</select--> 
									<div class="sc_menu">
									  <ul class="sc_menu">
										<li><a href="#">
										  <img src="IMG/WOMENSbit.png" id="WomensDorm" alt="Womens Dorm" onclick="selectDorm('WomensDorm')" onMouseover="displayDormInfo('Women\'s Dormitory', this, event, '126px')" onMouseout="displayWelcomeNote()"/><span>Women's Dormitory</span>
										</a></li>
										<li><a href="#">
										  <img src="IMG/VETbit.png" id="VetMedDorm" alt="VetMedDorm" onclick="selectDorm('VetMedDorm')" onMouseover="displayDormInfo('Veterinary Medicine Dormitory', this, event, '126px')" onMouseout="displayWelcomeNote()"/><span>Vet Med Dorm</span>
										</a></li>
										<li><a href="#">
										  <img src="IMG/NDbit.png" id="NewDorm" alt="NewDorm"  onclick="selectDorm('NewDorm')"  onMouseover="displayDormInfo('New Dorm Residence Hall', this, event, '126px')" onMouseout="displayWelcomeNote()" /><span>New Dorm</span>
										</a></li>
										<li><a href="#">
										  <img src="IMG/MENSbit.png" id="MensDorm" alt="Mens Dorm"  onclick="selectDorm('MensDorm')"  onMouseover="displayDormInfo('Men\'s Dormitory', this, event, '126px')" onMouseout="displayWelcomeNote()" /><span>Men's Dorm</span>
										</a></li>
										<li><a href="#">
										  <img src="IMG/ACCIbit.png" id="ACCIDorm" alt="ACCI Dorm"  onclick="selectDorm('ACCIDorm')" onMouseover="displayDormInfo('ACCI Dormitory', this, event, '126px')" onMouseout="displayWelcomeNote()" /><span>ACCI Dorm</span>
										</a></li>
									  </ul>
									</div>
									
									<input type="hidden" name="dormname" id="dorm" value="none">
								</td>
								
								</tr>
								<tr>
									<td style="width: 50px">Dorm manager:</td>
									<td style="width: 50px"><input type="text" name="username" size="20"/></td>
									<td class="error" id="unameError"></td>
								</tr>
								
								<tr>
									<td style="width: 50px">Password:</td>
									<td style="width: 50px"><input type="password" name="password" size="20"/></td>
									<td class="error" id="passError"></td>
								</tr>
								
								<tr>
									<td colspan="3" class="errorMessage">
										<?php if(isset($_SESSION["message"])){
											echo $_SESSION["message"];
											unset($_SESSION["message"]);
										}?>
									</td>
								</tr>
								
								<tr>
									<td  style="width: 50px"><input type="submit" name="loginSubmit" value="Login"/></td>
									<td style="width: 50px"><input type="reset" value="Reset"/></td>
									<td>&nbsp;</td>
								</tr>
							</table>				
						</form>
					</div>
					<!-- div class="background"></div-->
					</div>
				</td>
			</tr>
			
		</table>
		</center>
		<br/><br/><br/>
		<div class="footer" id="logFooter">
			Dorma © 2011
		</div>
	</body>

</html>