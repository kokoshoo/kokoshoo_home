<div id="login_form">
	<h1>Login</h1>
	
	<?php
	if($is_logged_in){
		redirect('flashcards/mydecks');
	}

	echo $this->session->flashdata('error');

	echo form_open('flashcards/login');
	echo form_input('username','', 'placeholder = "Username"');
	echo form_password('password',"", 'placeholder = "Password"');
	echo form_submit('submit','Login');
	echo anchor(current_url().'/#', 'Create Account');
	form_close();
	
	?>
</div>