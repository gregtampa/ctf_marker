<?php
  
  if(isset($_POST['flag'])){
  	 $flag = $_POST['flag'];
	 $cid = $_POST['cid'];
		
	 include 'connection.php';	
	 $sql = "SELECT FLAG_KEY FROM flag WHERE C_ID='$cid'";
	 $result = mysqli_query($connection, $sql);
	 while($row = mysqli_fetch_assoc($result)){
	 	$ans = $row['FLAG_KEY'];
		if($flag == $ans){
			echo "<h3 style='color:#d4ff00;'>Your key is Correct</h3>"; 
		}else{
			echo "<h3 style='color:orange;'>Your key is Incorrent</h3>"; 
		} 		
	 } 
	  
  }
  
  
?>