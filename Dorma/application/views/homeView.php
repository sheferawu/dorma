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
		
		<script type="text/javascript">
		
			function loadXMLDoc(url){
				if (window.XMLHttpRequest){		// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp=new XMLHttpRequest();
				}else{		// code for IE6, IE5
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.open("GET",url,false);
				xmlhttp.send(null);
				document.getElementById('content').innerHTML=xmlhttp.responseText;
				document.getElementById('search').value="Search...";
				document.getElementById('suggest').innerHTML="";				
			}

			function loadAppliances(url){
				
				if(document.getElementById('loadApp').value=="Load Appliances"){
					if (window.XMLHttpRequest){		// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					}else{		// code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
				xmlhttp.open("GET",url,false);
				xmlhttp.send(null);
				document.getElementById('app').innerHTML=xmlhttp.responseText;
				document.getElementById('search').value="Search...";
				document.getElementById('suggest').innerHTML="";
				document.getElementById('loadApp').value= "Unload Appliances";
				}else{
					document.getElementById('loadApp').value= "Load Appliances";
					document.getElementById('app').innerHTML="";
					
				}				
			}
		</script>
	
	</head>

	<body onLoad="restart()">
		
		<div class="maindiv">
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
				<div style="color: rgb(43, 182, 211); letter-spacing:0px; font-size:16; line-height: 30px">
					<input type="button" onclick="loadXMLDoc('index.php?c=resident&m=add')" value="Add Resident &lt"><br/>
					<input type="button" onclick="loadXMLDoc('tally.php')" value="Tally &lt"><br/>
					<input type="button" onclick="loadXMLDoc('monthly.php')" value="Monthly Report &lt"><br/>
					
				</div>
			</div>
			
			<div class="container">
				<?php echo img(array('src'=> "IMG/banner.png", 'alt' => "banner", 'style' => "border: 5px;border-color: rgb(243, 243, 243)" ));?>
				<br>
				<br>
				<br>
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
					<?php if(isset($_SESSION["newResidentInfo"])){echo $_SESSION["newResidentInfo"]; unset($_SESSION["newResidentInfo"]); }else{ ?>
					<a href="">Query Result</a> <br>
						Sample description text text text text text text text text text text text text text text text text text text text text text text text text.
				
					<?php }?>
				</div>
				
			</div>
		</div>
	</body>
</html>