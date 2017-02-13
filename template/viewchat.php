<?php
	include 'template/connection.php';
	if(isset($_SESSION['TEAM'])){
		$chatlog_team = $_SESSION['TEAM'];
	}
	
	$chatlog_sql = "SELECT * FROM `chat` WHERE TEAM=$chatlog_team ORDER BY DATE ASC";
	$chatlog_result = mysqli_query($connection, $chatlog_sql);
	while($chatlog_row = mysqli_fetch_assoc($chatlog_result)){
		$chatlog_user = $chatlog_row['USERNAME'];
		$chatlog_log = $chatlog_row['CHAT'];
		echo "<p>$chatlog_user => $chatlog_log</p>";
	}
?>