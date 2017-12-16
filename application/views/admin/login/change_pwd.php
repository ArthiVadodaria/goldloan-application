<!DOCTYPE html>
<html>
	<head>
		<title>Change Password | GOLD LOANS	</title>	
		<script>
		$(document).ready(function(){
			$('#newppwd,#confirmpwd').on('keyup',function(){
			if ($('#newpwd').val() == $('#confirmpwd').val()) {
					$('.submit').removeAttr('disabled');
					$('#message').html('Matching').css('color', '#02f500');
				}
				else{
					$('.submit').attr('disabled',true);
					$('#message').html('Not Matching').css('color', 'red');
				}
			});
		});
		</script>
	</head>
	<body>
		<?= form_open('API_Controller/change_password');?>
		<div class="container">
			<?php	
				$message = $this->session->flashdata('pwdchange');
			?>
			<div class='<?php echo $message['class'] ?> ' > <?php echo $message['pwdchange']; ?> </div>
			<h1>Change Password</h1>
			<input class="form-control" type="password" name="newpwd" id="newpwd" placeholder="New Password" /><br/>
			<input class="form-control" type="password" name="confrimpwd" id="confirmpwd" placeholder="Confirm Password"/>
			<span id='message'></span>
			<br/><br/>
			<button class="submit btn btn-default" align="center" disabled>Submit</button>
		</div>
		<?= form_close();?>
	</body>
</html>