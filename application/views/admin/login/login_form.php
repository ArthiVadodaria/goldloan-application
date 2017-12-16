<html>	
<head>
	<title>Login Form | Gold Loan</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/loginstyle.css">
</head>
<body class="bg">
	<?php
		if (isset($logout_message)) {
			echo "<div class='message'>";
			echo $logout_message;
			echo "</div>";
		}
		if (isset($message_display)) {
			echo "<div class='message'>";
			echo $message_display;
			echo "</div>";
		}
	?>
	<div class="bg" id="main">

	<h2>Login Form</h2>
	<hr/>
	<?php echo form_open('authentication_controller/user_login_process'); 
	echo "<div class='error_msg'>";
		if (isset($error_message)) {
			echo $error_message;
		}
		echo validation_errors();
		echo "</div>";
	?>
		
		<input class="form_input" type="text" name="username" id="username" placeholder="Username" /><br /><br />	
		<input class="form_input" type="password" name="password" id="password" placeholder="Password"/><br/><br />
		<button class="button submit" align="center">
        Login
        <svg width="18" height="12" viewBox="0 0 18 12" xmlns="http://www.w3.org/2000/svg">
			<g fill="#ffffff" fill-rule="evenodd">
			<path d="M12 12c-.3 0-.5 0-.7-.3-.4-.4-.4-1 0-1.4l5-5c.4-.4 1-.4 1.4 0 .4.4.4 1 0 1.4l-5 5c-.2.2-.4.3-.7.3z"/>
			<path d="M17 7c-.3 0-.5 0-.7-.3l-5-5c-.4-.4-.4-1 0-1.4.4-.4 1-.4 1.4 0l5 5c.4.4.4 1 0 1.4-.2.2-.4.3-.7.3z"/>
			<path d="M17 7H1c-.6 0-1-.4-1-1s.4-1 1-1h16c.6 0 1 .4 1 1s-.4 1-1 1z"/>
			</g>
		</svg>        
		</button>
	<?php echo form_close(); ?>

	</div>
</body>
</html>