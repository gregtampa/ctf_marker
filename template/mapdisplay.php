<?php
	include 'template/connection.php';
	$sql = "SELECT * FROM countries";
	$result = mysqli_query($connection, $sql);
	while($row = mysqli_fetch_assoc($result)){ //Initialise country
		$code = $row['C_ID'];
		$title = $row['TITLE'];
		$d = $row['D'];
		echo "<path id='$code' title='$title' d='$d'/>";

		if(isset($_GET['team'])){
			$no = $_GET['team'];
			$c_select = "SELECT * FROM flag WHERE TEAM='$no'";
		}else{
			$c_select = "SELECT * FROM flag";
		}
		
		$c_result = mysqli_query($connection, $c_select);		 
		while($row = mysqli_fetch_assoc($c_result)){ //flag 
			$c_code = $row['C_ID'];
			$flag = $row['FLAG'];
			$team = $row['TEAM'];
			$status = $row['STATUS'];
			if($c_code == $code){
				$t_select = "SELECT * FROM team WHERE TEAM='$no'";
				$t_result = mysqli_query($connection, $t_select);
				while($row = mysqli_fetch_assoc($t_result)){
					$t_yes = $row['T_YES'];
					$t_no = $row['T_NO'];
					$t_team = $row['TEAM'];
					$session_team = $_SESSION['TEAM'];
					if($t_team == $session_team){
						if($status == 0){
							echo "<path id='$code' fill='$t_no' title='$title' d='$d' onclick='Alert.menu(\"$c_code\",\"$title\",\"$flag\");'/>";
						}else{
							echo "<path id='$code' fill='$t_yes' title='$title' d='$d' onclick='Alert.menu(\"$c_code\",\"$title\",\"$flag\");'/>";
						}	
					}else{
						if($status == 0){
							echo "<path id='$code' fill='$t_no' title='$title' d='$d'/>";
						}else{
							echo "<path id='$code' fill='$t_yes' title='$title' d='$d'/>";
						}
					}
				}								
			}
		}	
	}	
							
?>