<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui" />
		<link rel="stylesheet" href="css/map.css"/>
	</head>
<body>
	 <?php
	include 'template/map.php';
	
	
	?>
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
<!--Dialog Bx End-->
<button onclick="Alert.render('You dont have permission')">Custom Alert</button>
</body>
</html>	