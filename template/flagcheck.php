<?php
  
  if(isset($_POST['flag'])){
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
			echo "<h3 style='color:orange;'>Your key is Incorrent</h3>"; 
			$log_sql = "INSERT INTO logger (DATE, TEAM, LOG) VALUES ('$fdate','$team','Incorrect Flag Entered - $cid')";
			mysqli_query($connection, $log_sql);
		 } 		
	 } 	  
  }
 
?>