<html>
<head>
<title>Houseman|Upload Sucess</title>
</head>
<body>

<br/>
<h3>Your file was successfully uploaded!</h3>

<ul>
<?php foreach($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>

<p><?php echo anchor('house/upload', 'Upload Another File!'); ?></p>

</body>
</html>