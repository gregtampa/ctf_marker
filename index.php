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
		<link rel="stylesheet" href="css/map.css"/>
		<link rel="stylesheet" href="css/login.css" type="text/css"/>
		<script src="js/dialog.js"></script>
		<!-- Bootstrap  -->
	</head>
	<script>
		$(document).ready(function(){
			$(".map__image").draggable();
		});
		//Chat
		$(document).ready(function(){
   			$("#chat").click(function(){
        		$("#info_chat").slideToggle("slow");
    		});
		});
		
		$(document).ready(function(){
			$('#modal-country-flag').keypress(function(event){
				var key = (event.keyCode ? event.keyCode : event.which);
				if(key == 13){
					callback();
				}
			});
			$('#fsubmit').click(function(){
				callback();
			});
		});
		var callback = function(){
			var info = $('#modal-country-flag').val();
			var coun_id = $('#dialog-id').text();
			$.ajax({
				method: "POST",
				url: "template/flagcheck.php",
				data: {flag: info, cid: coun_id},
				success: function(status){
					$('#flag_hint').html(status);
					$('#modal-country-flag').val('');
				}
			});
		};		
	</script>
	<style>
		.modal-content{
			width:30%;
			height:auto;
		}
	</style>
<body>
	<!--Dialog Code -->
	<div id="map_wrapper">	
	<div class="map__image" id="main"><!--ViewBox -15 100 1100 665 -->
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:amcharts="http://amcharts.com/ammap" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.2" viewBox="-15 0 1100 665">
				<g>	
					 <?php include 'template/mapdisplay.php'; ?>
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
  	<a href="template/logout.php">Logout</a>
  	<?php
  	if(isset($_SESSION['USERNAME']) && isset($_SESSION['TEAM']))
  	{
  	?>
	<div id="div1">
		<div id="div1_inner">
			<div id="div1_inner_heading">
				<h1>Score Board</h1>
			</div>
			<div class="div1_inner_body">
				<div class="div1_inner_team">
					<div class="div1_inner_team_logo">
						
					</div>
				</div>
				<div class="div1_inner_other_team">

				</div>
			</div>
		</div>	  
	</div>
	<div id="div2">
	  <div id="div2_inner">
			<div id="div2_inner_border">
				<p>=> Flag Captured</p>
			</div>
	  </div>	
	</div>
	<div id="div3">
	  <div id="div3_inner">
			<div id="div3_inner_chat_history">
				<p>=> Flag Captured</p>
				<p>=> Flag Captured</p>
				<p>=> Flag Captured</p>
				<p>=> Flag Captured</p>
				<p>=> Flag Captured</p>
				<p>=> Flag Captured</p>
				<p>=> Flag Captured</p>
				<p>=> Flag Captured</p>
				<p>=> Flag Captured</p>
				<p>=> Flag Captured</p>
				<p>=> Flag Captured</p>
				<p>=> Flag Captured</p>
				<p>=> Flag Captured</p>
				<p>=> Flag Captured</p>
				<p>=> Flag Captured</p>
				<p>=> Flag Captured</p>
				<p>=> Flag Captured</p>
				<p>=> Flag Captured</p>
				<p>=> Flag Captured</p>
			</div>
			<div id="div3_inner_chat_input">
				<input type="text" placeholder="Enter Message and Press Enter" />
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
			echo "<a href='index.php?team=$team' class='center_panel_count'>$team</a>";
		}
		
		?>
		
		<!-- <a href="index.php?team=4" class="center_panel_count">D</a> -->
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
	   <button type="fsubmit" id="fsubmit">Submit</button>
    </div>
    <div class="modal-footer">
      <h3 id="flag_hint">Status</h3>
    </div>
  </div>

</div>
<script src="js/dialog.js"></script>
</body>
</html>	