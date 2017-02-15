<?php

//if(isset($_POST['submit'])){
	
	if(isset($_POST['uname']) && isset($_POST['psw']))
	{
		session_start();
		$username = htmlentities(trim($_POST['uname']));
		$password = htmlentities(trim($_POST['psw']));
		
		$hash = md5($password."CTF");
		
		include 'connection.php';
		$query = "SELECT * FROM users WHERE USERNAME='$username' AND PASSWORD='$hash'";
		$result = mysqli_query($connection, $query);
		$num = mysqli_num_rows($result);
		if($num == 1)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$user = $row['USERNAME'];
				$auth = $row['TEAM'];
				
				$_SESSION['USERNAME'] = $user;
				$_SESSION['TEAM'] = $auth;
				//header('location:../index.php?team=1');
				setcookie("TEAMCOOK",$auth,time()+(86400*3),"/");
				echo "<h3 style='color:green;'>Login Success</h3>";
			}	
		}else{
			//$_SESSION['error'] = "Incorrect Username and Password";
			//header('location:../index.php?team=1');
			echo "<h3 style='color:orange;'>Login Fail</h3>";
		}		
	}
//}						
?>