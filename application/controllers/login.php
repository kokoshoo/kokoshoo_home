<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends Controller{


	function validate_credentials(){
		
	
		echo 'moo';
		
		/*$this->load->model('membership_model');
		$query = $this->membership_model->validate();
		
		if($query){
			$data = array(
				'username' => $this->input->post('username'),
				'is_logged_in' => true
			);
			
			$this->session->set_userdata($data);
			redirect('pages/membership_area');
		}
		else{
		redirect('pages/home');
		}
	}*/
	}
}