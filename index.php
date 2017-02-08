<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui" />
		<link rel="stylesheet" href="css/map.css"/>
	</head>
<body>
	<!--Dialog Code -->
<script src="js/dialog.js"></script>
	<div class="map" id="map">
	<div class="map__image">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:amcharts="http://amcharts.com/ammap" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.2" viewBox="-15 100 1100 665">
				<g>	
					 <?php
					//include 'template/map.php';
					include 'template/connection.php';
					$sql = "SELECT * FROM countries";
					$result = mysqli_query($connection, $sql);
					while($row = mysqli_fetch_assoc($result)){
						$code = $row['C_ID'];
						$title = $row['TITLE'];
						$d = $row['D'];
						echo "<path id='$code' title='$title' d='$d' "."onclick=\"Alert.render('$title')\"/>";
					}
					
					?>
				</g>
			</svg>
	</div>
	</div>	
<!--Dialog Code -->
<script src="js/dialog.js"></script>
<div id="dialogoverlay"></div>
<div id="dialogbox">
	<div>
		<div id="dialogboxhead"></div>
		<div id="dialogboxbody"></div>
		<div id="dialogboxfoot"></div>
	</div>
</div>
<!--Dialog Bx End
<button onclick="Alert.render('You dont have permission')">Custom Alert</button>
-->
</body>
</html>	