<?php

if (isset($_POST['uname']) && isset($_POST['psw'])) {
	session_start();
	$username = stripslashes(htmlspecialchars(htmlentities(trim(filter_var($_POST['uname']), FILTER_SANITIZE_STRING))));
	$password = stripslashes(htmlspecialchars(htmlentities(trim(filter_var(($_POST['psw']), FILTER_SANITIZE_STRING)))));

	include 'connection.php';
	if(strlen($username) >= 5 && strlen($username) <=10){
		if(strlen($password) >= 5 && strlen($password) <= 10){
			$hash = md5($password . "CTF");
			$result = mysqli_query($connection, "SELECT * FROM users WHERE USERNAME='$username' AND PASSWORD='$hash'");
			$num = mysqli_num_rows($result);
			$LoginCheck = mysqli_query($connection, "SELECT value FROM options WHERE name='LOGIN'");
			foreach (mysqli_fetch_assoc($LoginCheck) as $val) {
				$permission = $val;
			}
			if ($num === 1) {
				while ($row = mysqli_fetch_assoc($result)) {
					$user = $row['USERNAME'];
					$auth = $row['TEAM'];
					$level = $row['TYPE'];
		
					if ($level == "A") {
						$_SESSION['USERNAME'] = $user;
						$_SESSION['TEAM'] = $auth;
						$_SESSION['TYPE'] = $level;
						echo "<h3 style='color:green;'>Admin Login</h3>";
					} else {
						if ($permission == "ALLOW") {
							$_SESSION['USERNAME'] = $user;
							$_SESSION['TEAM'] = $auth;
							$_SESSION['TYPE'] = $level;
							echo "<h3 style='color:green;'>Login Success</h3>";
						} else {
							echo "<h3 style='color:orange;'>Please wait for the game to start</h3>";
						}
					}
				}
		
			} else {
				echo "<h3 style='color:orange;'>Login Fail</h3>";
			}
		}else{
			echo "<h3 style='color:orange;'>Login Fail</h3>";
		}
	}else{
		echo "<h3 style='color:orange;'>Login Fail</h3>";
	}
}
?>