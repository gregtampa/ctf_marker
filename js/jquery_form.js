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
			
			$('#fhint').click(function(){
				var coun_id1 = $('#dialog-id').text();
				var team1 = $('#session_team').val();
				$.ajax({
				method: "POST",
				url: "template/flagcheck.php",
				data: {type: "hint", cid: coun_id1, team: team1},
				success: function(status){
					$('#flag_hint').html(status);
					$('#modal-country-flag').val('');
				}
			});
			});
		});
		var callback = function(){
			var info = $('#modal-country-flag').val();
			var coun_id = $('#dialog-id').text();
			var team = $('#session_team').val();
			$.ajax({
				method: "POST",
				url: "template/flagcheck.php",
				data: {flag: info, cid: coun_id, team: team},
				success: function(status){
					$('#flag_hint').html(status);
					$('#modal-country-flag').val('');
				}
			});
		};	
		//chat
		$(document).ready(function(){
			$('#div3_chat_input').keypress(function(event){
				var key = (event.keyCode ? event.keyCode : event.which);
				if(key == 13){
					var team = $('#session_team').val();
					var user = $('#session_user').val();
					var chat = $('#div3_chat_input').val();
					$.ajax({
						method: "POST",
						url: "template/chat.php",
						data: {team: team, chat: chat, user: user},
						success: function(status){
							$('#div3_chat_input').val('');
						}
					});
				}
			});
		});	