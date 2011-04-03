<html>
<head>
<title>Houseman|Upload</title>
</head>
<body>
	<h4>Upload Dorm Picture</h4>
	<hr/><br/>
	Only png files are accepted!
	<?php echo $error;?>
	
	<?php echo form_open_multipart('house/do_upload');?>
	<form>
		<input type="file" name="userfile" size="20" /><br/>
		
		Select Alias Of Dorm:<?php if(isset($_SESSION["select"])){echo $_SESSION["select"];}else{
								echo "<input type=\"text\" name=\"filename\"/>";	
						}
					?>
		<br /><br />
		
		<input type="submit" value="Upload" />
	
	</form>

</body>
</html>