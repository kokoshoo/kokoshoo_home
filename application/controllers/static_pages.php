<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Static_pages extends CI_Controller {


public function index($page = 'home')
{

	if ( ! file_exists('application/views/pages/'.$page.'.php'))
	{
		// Page doesn't exist
		echo 'static';
		show_404();
	}

	$data['page'] = $page; // Capitalize the first letter
	$data['first_name'] = $this->session->userdata('first_name');
	$data['id'] = $this->session->userdata('id');
	$data['is_logged_in'] = $this->session->userdata('is_logged_in');

	$this->load->view('templates/_page',$data);

}



public function validate_credentials(){
		//$this->index('members_area');
		$this->load->model('membership_model');
		$query = $this->membership_model->validate();
		
		if($query != null){
			$data = array(
				'username' => $query->username,
				'first_name' => $query->first_name,
				'id' => $query->id,
				'is_logged_in' => true
			);
			
			
			$this->session->set_userdata($data);
			redirect('index/members_area');
		}
		else{
			redirect('index/login_fail');
		}
}



public function logout(){
	$this->session->sess_destroy();
	redirect('index/logout_page');
	//$this->index('home');
}

}

