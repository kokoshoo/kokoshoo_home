<div id="login_form">
	<h1>Login</h1>
	
	<?php
	
	echo form_open('login');
	echo form_input('username','Username');
	echo form_password('password',"Password");
	echo form_submit('submit','Login');
	echo anchor('#', 'Create Account');
	
	?>
</div>