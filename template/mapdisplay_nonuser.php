<?php
	include 'template/connection.php';
	$sql = "SELECT * FROM countries";
	$result = mysqli_query($connection, $sql);
	while($row = mysqli_fetch_assoc($result)){ //Initialise country
		$code = $row['C_ID'];
		$title = $row['TITLE'];
		$d = $row['D'];
		echo "<path id='$code' title='$title' d='$d'/>";
	}
?>