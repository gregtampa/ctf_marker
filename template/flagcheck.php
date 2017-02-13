<?php
  
  if(isset($_POST['flag'])){
  	 $flag = $_POST['flag'];
	 $cid = $_POST['cid'];
	 $team = $_POST['team'];	
	 include 'connection.php';	
	 $sql = "SELECT FLAG_KEY FROM flag WHERE C_ID='$cid'";
	 $result = mysqli_query($connection, $sql);
	 while($row = mysqli_fetch_assoc($result)){
	 	 $ans = $row['FLAG_KEY'];
		 $date = new DateTime('now', new DateTimeZone('Europe/London'));
		 $fdate = $date->format('Y-m-d H:i:s');
		 
		 if($flag == $ans){
			echo "<h3 style='color:#d4ff00;'>Your key is Correct</h3>"; 
			$log_sql = "INSERT INTO logger (DATE, TEAM, LOG) VALUES ('$fdate','$team','Captured the Flag - $cid')";
			mysqli_query($connection, $log_sql);
		 }else{
			echo "<h3 style='color:orange;'>Your key is Incorrent</h3>"; 
			$log_sql = "INSERT INTO logger (DATE, TEAM, LOG) VALUES ('$fdate','$team','Incorrect Flag Entered - $cid')";
			mysqli_query($connection, $log_sql);
		 } 		
	 } 	  
  }
 
?>