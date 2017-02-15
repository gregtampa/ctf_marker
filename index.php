<?php
session_start();
if(!isset($_GET['team']) || empty($_GET['team'])){
	
		if(!isset($_SESSION['USERNAME'])){
			header('location:index.php?team=1');
		}else{
			$no = $_SESSION['TEAM'];
			header('location:index.php?team='.$no);
		}	
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Iceland|Orbitron" rel="stylesheet"> 
		<link rel="stylesheet" href="css/map.css" type="text/css"/>
		<link rel="stylesheet" href="css/login.css" type="text/css"/>
		<link rel="stylesheet" href="css/score.css" type="text/css"/>
		<script src="js/dialog.js"></script>
		<!-- Bootstrap  -->
	</head>
	<script src="js/jquery_form.js"></script>
	<script>
		setInterval(function () {
			$("#div1_inner_body_1").load("./template/userscoreboard.php"),
		    $("#div3_inner_chat_history").load("./template/viewchat.php").click(chatscroll()),
		    $("#div2_inner_border").load("./template/viewlog.php").click(actiscroll());
		}, 1000);
		
		setInterval(function(){
			$("#div1_inner_body_2").load("./template/teamscoreboard.php");
		},10000);
		
		function chatscroll() {
		  var a_chat    = $('#div3_inner_chat_history');		  
		  var cheight = a_chat[0].scrollHeight;
		  a_chat.scrollTop(cheight);
		}
		
		function actiscroll(){
		  var a_log    = $('#div2_inner_border');
		  var aheight = a_log[0].scrollHeight;
		  a_log.scrollTop(aheight);
		}
		
	</script>
	<style>
		.modal-content{
			width:30%;
			height:auto;
		}
				
		::-webkit-scrollbar {
		  width: 6px;
		  height: 6px;
		}
		::-webkit-scrollbar-button {
		  width: 0px;
		  height: 0px;
		}
		::-webkit-scrollbar-thumb {
		  background: #ceb342;
		  border: 0px none #ffffff;
		  border-radius: 50px;
		}
		::-webkit-scrollbar-thumb:hover {
		  background: #faf434;
		}
		::-webkit-scrollbar-thumb:active {
		  background: #000000;
		}
		::-webkit-scrollbar-track {
		  background: #abd17d;
		  border: 0px none #ffffff;
		  border-radius: 90px;
		}
		::-webkit-scrollbar-track:hover {
		  background: #41a428;
		}
		::-webkit-scrollbar-track:active {
		  background: #ffff00;
		}
		::-webkit-scrollbar-corner {
		  background: transparent;
		}

	</style>
<body>
	<!--Dialog Code -->
	<div id="map_wrapper">	
	<div class="map__image" id="main"><!--ViewBox -15 100 1100 665 -->
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:amcharts="http://amcharts.com/ammap" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.2" viewBox="-15 0 1100 665">
				<g>	
					 <?php 
					 	if(isset($_SESSION['USERNAME']) && isset($_SESSION['TEAM']) && !empty($_SESSION['USERNAME'])){
					 		include 'template/mapdisplay.php';
					 	}else{
					 		include 'template/mapdisplay_nonuser.php'; 	
					 	}
					 ?>
				</g>
			</svg>
	</div>
	</div>
<!--Dialog Code -->
<!-- Left Menu -->
<div id="info_menu" onclick="openNav()">
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
</div>
<div id="mySidenav" class="sidenav">
  	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  	<?php
  	if(isset($_SESSION['USERNAME']) && isset($_SESSION['TEAM']))
  	{
  	?>
    <a href="template/logout.php" id="main_logout">Logout</a>
	<div id="div1">
		<div id="div1_inner">
			<div id="div1_inner_heading">
				<h1>Score Board</h1>
			</div>
			<div class="div1_inner_body">				
				<span id="div1_inner_body_1"><?php include 'template/userscoreboard.php'; ?></span>
				<span id="div1_inner_body_2"><?php include 'template/teamscoreboard.php'; ?></span>				
			</div>
		</div>	  
	</div>
	<div id="div2">
	  <div id="div2_inner">
			<div id="div2_inner_border">
				<?php include 'template/viewlog.php'; ?>
			</div>
	  </div>	
	</div>
	<div id="div3">
	  <div id="div3_inner">
			<div id="div3_inner_chat_history">
				<?php include 'template/viewchat.php'; ?>
			</div>
			<div id="div3_inner_chat_input">
				<input id="div3_chat_input" type="text" placeholder="Enter Message and Press Enter" />
			</div>
	  </div>
	</div>
	<?php
	}else{
	?>
	<div id="div4">
	  <div id="div4_inner">
	  		<div id="div4_heading">
	  			<h3>Catch the Flag</h3>
	  		</div>
	  		<div id="div4_login_logo">
				<img src="images/anon1.png"/>
	  		</div>
	  		<div id="div4_login_form">
	  			<input type="text" placeholder="Username" id="login_usr"/>
	  			<input type="text" placeholder="Password" id="login_psw"/>
	  			<button id="login_submit">Log In</button>
	  			<h5 id="login_status"></h5>
	  		</div>
	  		<script src="js/loginpopup.js"></script>
	  </div>	
	</div>
	<?php
	}
	?>	
</div>
<!-- Right Menu---->
<div id="center_panel">
	<div id="center_panel_div">
		<?php
		$center_panel_sql = "SELECT DISTINCT TEAM FROM flag";
		$center_panel_result = mysqli_query($connection, $center_panel_sql);
		while($center_row = mysqli_fetch_assoc($center_panel_result)){
			$team = $center_row['TEAM'];
			if(isset($_SESSION['TEAM'])){
				$sess_team = $_SESSION['TEAM'];
			}else{
				$sess_team = "";
			}		
			if($team == $sess_team){
				echo "<a href='index.php?team=$team' class='center_panel_count' style='background-color:#ABD17D;color:black;'>$team</a>";
			}else{
				echo "<a href='index.php?team=$team' class='center_panel_count'>$team</a>";
			}
			
		}
		
		?>
	</div>
</div>

<!-- Right Menu---->
<div id="right_panel">
	<div id="right_panel_div_heading">
		<h1>Timer</h1>
	</div>
	<div id="right_panel_div_timer">
		<h1 id="timer"></h1>
	</div>
	<div id="right_panel_div_announce">
		<marquee><p>Announcement</p></marquee>
	</div>
</div>
<div id="right_panel_background">
</div>
<script src="js/timer.js" type="text/javascript"></script>
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3 id="dialog-id" class="modal_info"></h3> -
      <h3 id="dialog-title" class="modal_info"></h3>
    </div>
    <div class="modal-body">
       <p id="dialog-flag"></p>	
	   <input type="text" placeholder="Enter Flag Here..." id="modal-country-flag"/>
	   <div id="dialog_flag_button">
	   		<button type="fsubmit" id="fsubmit">Submit</button>
	  	 	<button type="fsubmit" id="fhint">Hint</button>
	   </div>
    </div>
    <div class="modal-footer">
      <h3 id="flag_hint">Status</h3>
    </div>
  </div>

</div>
<script src="js/dialog.js"></script>
<input type="hidden" id="session_team" value="<?php if(isset($_SESSION['TEAM'])){echo $_SESSION['TEAM'];}?>"  />
<input type="hidden" id="session_user" value="<?php if(isset($_SESSION['USERNAME'])){echo $_SESSION['USERNAME'];}?>"  />
</body>
</html>	