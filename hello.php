<html>
	<head>
		<title>PHP Web Server Test</title>
	</head>
	<body>
		<?php echo '<p>Hello World from Aneesh!<p>';?>
		<?php echo 'Current Script owner: '.get_current_user(); ?>
		<form action="action.php" method="post">
			<p>Enter your name: <input type="text" name="name" /></p>
			<p>Enter your university: <input type="text" name="university" /></p>
			<p><input type="submit" /></p>
		</form> 
		
		
		<form action="upload.php" method="post" enctype="multipart/form-data">
			Select CSV File:
			<input type="file" name="uploadedFile" id="uploadedFile">
			<input type="submit" value="Upload File" name="submit">
		</form>
		<?php /*print_r(array_values($_SERVER)) ;*/ ?>
		<?php foreach ($_SERVER as $key => $value) { ?>
		<p><?php print ("$key => $value \n"); ?></p>
		
		<?php } ?>
		<?php /*phpinfo();*/ ?>
	</body>
</html>
