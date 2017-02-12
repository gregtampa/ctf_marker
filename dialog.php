<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<style type="text/css">
		#dialogoverlay{
			display: none;
			opacity:.8;
			position: fixed;
			top: 0px;
			left: 0px;
			background: #FFF;
			width:100%;
			z-index: 10;
		}
		
		#dialogbox{
			display:none;
			position:fixed;
			background:#000;
			border-radius: 7px;
			width:550px;
			z-index: 10;
		}
		#dialogbox > div{background:#FFF;margin:8px;}
		#dialogbox > div > #dialogboxhead{background:#666; font-size: 19px; padding: 10px; color:#CCC;}
		#dialogbox > div > #dialogboxbody{background:#333; padding: 20px; color:#FFF;}
		#dialogbox > div > #dialogboxfoot{background:#666; padding: 10px; text-align: right;}
	</style>
	<script>
		
	</script>
</head>
<body>
	<!--Dialog Bx Start-->
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