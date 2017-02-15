<?php
  
  if(isset($_POST['flag']) && isset($_POST['cid']) && isset($_POST['team'])){
  	 $flag = $_POST['flag'];
	 $cid = $_POST['cid'];
	 $team = $_POST['team'];	
	 include 'connection.php';	
	 $sql = "SELECT FLAG_KEY,POINTS FROM flag WHERE C_ID='$cid'";
	 $result = mysqli_query($connection, $sql);
	 while($row = mysqli_fetch_assoc($result)){
	 	 $ans = $row['FLAG_KEY'];
		 $point = $row['POINTS'];
		 $date = new DateTime('now', new DateTimeZone('Europe/London'));
		 $fdate = $date->format('Y-m-d H:i:s');
		 
		 if($flag == $ans){
		 	//update flag status
		 	$suc = 1;
		 	$update_status_sql = "UPDATE flag SET STATUS='$suc' WHERE C_ID='$cid'";
			$update_status_result = mysqli_query($connection, $update_status_sql);
			if($update_status_result){
				$flag_marker_scb_sql = "SELECT SCORE FROM scoreboard WHERE TEAM='$team'";
				$flag_marker_scb_result = mysqli_query($connection, $flag_marker_scb_sql);
				while($flag_marker_scb_row = mysqli_fetch_assoc($flag_marker_scb_result)){
					$flag_scoreboard_points = $flag_marker_scb_row['SCORE'];
					$final_grade = $flag_scoreboard_points + $point;
					$update_points_sql = "UPDATE scoreboard SET SCORE='$final_grade' WHERE TEAM=$team";
					$update_status = mysqli_query($connection, $update_points_sql);
					if($update_status){
						echo "<h3 style='color:#d4ff00;'>Your key is Correct</h3>"; 
						$log_sql = "INSERT INTO logger (DATE, TEAM, LOG) VALUES ('$fdate','$team','Captured the Flag - $cid')";
						$flag_log_query = mysqli_query($connection, $log_sql);
						if(!$flag_log_query){
							$log_sql_failed = "INSERT INTO report (DATE,LOG) VALUES ('$fdate','Flag check logger failed to log')";
							$flag_log_query_failed = mysqli_query($connection, $log_sql_failed);
						}
					}
				} 
			}else{
				$log_sql_error = "INSERT INTO report (DATE,  LOG) VALUES ('$fdate','Flag Status Update Failed - $cid')";
				mysqli_query($connection, $log_sql_error);
			}
		 	//end
		 }else{
			echo "<h3 style='color:orange;'>Your key is Incorrent</h3>"; 
			$log_sql = "INSERT INTO logger (DATE, TEAM, LOG) VALUES ('$fdate','$team','Incorrect Flag Entered - $cid')";
			mysqli_query($connection, $log_sql);
		 } 		
	 } 	  
  }else if(isset($_POST['type']) && isset($_POST['cid']) && isset($_POST['team'])){
  		 include 'connection.php';	
  	  	 $type = $_POST['type'];
		 $hcid = $_POST['cid'];
		 $hteam = $_POST['team'];	
		 $hsql = "SELECT HINT_1,PENALITY_1 FROM flag WHERE C_ID='$hcid' AND TEAM=$hteam";
		 $hresult = mysqli_query($connection, $hsql);
		 while($hrow = mysqli_fetch_assoc($hresult)){
		 	$h = $hrow['HINT_1'];
		 	$p = $hrow['PENALITY_1'];
	 		$flag_marker_scb_sql = "SELECT SCORE,PENALTY FROM scoreboard WHERE TEAM='$hteam'";
			$flag_marker_scb_result = mysqli_query($connection, $flag_marker_scb_sql);
			while($flag_marker_scb_row = mysqli_fetch_assoc($flag_marker_scb_result)){
				$flag_scoreboard_points = $flag_marker_scb_row['SCORE'];
				$flag_scoreboard_penalty = $flag_marker_scb_row['PENALTY'];
				$final_grade = $flag_scoreboard_points - $p;
				$final_penalty = $flag_scoreboard_penalty + $p;
				$update_points_sql = "UPDATE scoreboard SET SCORE='$final_grade', PENALTY='$final_penalty' WHERE TEAM=$hteam";
				$update_status = mysqli_query($connection, $update_points_sql);
				if($update_status){
					echo "<h3 style='color:#d4ff00;'>Your Hint: $h</h3>";
				}else{
					echo "<h3 style='color:orange;'>Issue while trying to connect to the gameboard [Error 201]</h3>";	
				}
		 	}
  		 }
  }
 
?>