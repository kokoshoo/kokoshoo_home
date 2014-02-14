<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Static_pages extends CI_Controller {


public function index($page = 'home')
{

	if ( ! file_exists('application/views/pages/'.$page.'.php'))
	{
		// Whoops, we don't have a page for that!
		show_404();
	}

	$data['page'] = $page; // Capitalize the first letter
	$data['name'] = $this->session->userdata('name');
	$data['is_logged_in'] = $this->session->userdata('is_logged_in');

	$this->load->view('templates/_page',$data);

}



public function validate_credentials(){
		//$this->index('members_area');
		$this->load->model('membership_model');
		$query = $this->membership_model->validate();
		
		if($query){
			$data = array(
				'username' => $this->input->post('username'),
				'name' => $this->input->post('first_name'),
				'is_logged_in' => true
			);
			
			$this->session->set_userdata($data);
			redirect('members_area');
		}
		else{
			redirect('login_fail');
		}
}

public function logout(){
	$this->session->sess_destroy();
	redirect('logout_page');
	//$this->index('home');
}

}

