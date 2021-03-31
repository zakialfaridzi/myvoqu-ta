<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>Chat all MyVoQu</title>
	<link rel="shortcut icon" type="image/png" href="http://localhost/tubes-ci/assets_login/images/mvq.png" />
	<link rel="stylesheet" href="style.css" type="text/css" />

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script type="text/javascript" src="chat.js"></script>
	<script type="text/javascript">
		var name = prompt('Enter Your Name', "");

		name = name.replace(/(<([^>]+)>)/ig, "");


		$("#name-area").html("You are: <span>" + name + "</span>");



		var chat = new Chat();
		$(function() {

			chat.getState();


			$("#sendie").keydown(function(event) {

				var key = event.which;


				if (key >= 33) {

					var maxLength = $(this).attr("maxlength");
					var length = this.value.length;


					if (length >= maxLength) {
						event.preventDefault();
					}
				}
			});

			$('#sendie').keyup(function(e) {

				if (e.keyCode == 13) {

					var text = $(this).val();
					var maxLength = $(this).attr("maxlength");
					var length = text.length;


					if (length <= maxLength + 1) {

						chat.send(text, name);
						$(this).val("");

					} else {

						$(this).val(text.substring(0, maxLength));

					}


				}
			});

		});
	</script>

</head>

<body onload="setInterval('chat.update()', 1000)">

	<h1 style="color: white">Chat All Aplikasi MyVoQu (testing)</h1>

	<div id="page-wrap">



		<p id="name-area"></p>

		<div id="chat-wrap">
			<div id="chat-area"></div>
		</div>

		<form id="send-message-area">
			<p>Your message: </p>
			<textarea id="sendie" maxlength='100'></textarea>
		</form>

	</div>

</body>

</html>
