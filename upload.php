<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
//$target_directory = "/var/www/html/";
$target_directory = "/var/www/html/uploaded/";
$target_file_name = $target_directory.basename($_FILES["uploadedFile"]["name"]);
//$target_file_name = $target_directory;
$uploadOK=1;
$fileType = pathinfo($target_file_name, PATHINFO_EXTENSION);

if (isset($_POST["submit"])) {
	//$size = filesize ($_FILES["uploadedFile"]["size"]);
	//if ($_FILES['uploadedFile']['name'] != "") {}
	?>
	<p> <?php echo "File type - ".$_FILES['uploadedFile']['type']."\xA"; ?> </p>
	<p> <?php //echo "File size - ".$_FILES['uploadedFile']['size']; ?> </p>
	<p> <?php //echo "File name - ".$_FILES['uploadedFile']['name']; ?> </p>
	<p> <?php //echo "File temp - ".$_FILES['uploadedFile']['tmp_name']; ?> </p>
	<p> <?php //echo "File err - ".$_FILES['uploadedFile']['error']; ?> </p>
	<?php
	$fileType = $_FILES['uploadedFile']['type'];
	if ($fileType !== "application/x-csv") {
		exit ("Please upload CSV File");
	}
	$temporary_file = $_FILES['uploadedFile']['tmp_name'];
	print ("Target file name: $target_file_name");
	?>
	<p><?php print ("VAR DUMP"); ?></p>
	<p>
	<?php
	//var_dump($_FILES['uploadedFile']['error']);
	?> </p>
	
	<?php
	//if (move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $target_file_name)) {}
	$rowCount = 0;
	$colCount = 0;
	if (move_uploaded_file($temporary_file, $target_file_name)) {
		//echo "File uploaded successfully - ".$_FILES["uploadedFile"]["tmp_name"]."\xA";
		?>
		
		<?php
		//$file_cont =  file_get_contents($target_file_name);
		//print ("$file_cont");
		$handle = fopen($target_file_name,'r');
		$row = 1;
		if ($handle) {
			print("Inside file handle"); ?>
			<html>
			<head>
			<style>
				table, th, td {
					border: 1px solid black;
					border-collapse: collapse;
				}
				th, td {
					padding: 5px;
					text-align: left;
				}
			</style>
			</head>

			<body><table style="width:100%">
			<?php $first = fgetcsv($handle);?>
			<tr>
			<?php foreach ($first as $heading) {?>
				<?php $colCount++; ?>
				<th> <?php echo htmlspecialchars($heading);?> </th>
			<?php } ?>
			<?php while (($line = fgetcsv($handle)) !== false) { ?>
				<?php $rowCount++;?>
				<tr>
					<?php foreach ($line as $element) { ?>
						<td><?php echo htmlspecialchars($element); ?> </td>
					<?php } ?>
				</tr>
			<?php } ?>	
			
			<td colspan="<?php echo $colCount; ?>"><b>This table contains  <?php echo $rowCount ?> entries</b></td> 	
			
		<?php 
		}
		fclose($handle);
		?>
		</table></body></html>	
		<?php 

		?>
		<p>Click <a href="hello.php">here</a> to go back </p>
		<?php

	} else {
		echo "ERROR ";
		print ("File not uploaded");
		?>
		<p>Click <a href="hello.php">here</a> to go back </p>
		<?php
	}
}
		?>
