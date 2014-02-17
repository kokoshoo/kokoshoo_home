<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flashcards_controller extends CI_Controller {


public function index($page = 'welcome')
{

	if ( ! file_exists('application/views/apps/flashcards/pages/'.$page.'.php'))
	{
		// Page doesn't exist
		echo'moo';
		show_404();
	}
	$data['first_name'] = $this->session->userdata('first_name');
	$data['id'] = $this->session->userdata('id');
	$data['is_logged_in'] = $this->session->userdata('is_logged_in');
	$data['page'] = $page;	
	

	$this->load->view('apps/flashcards/templates/_page',$data);
	
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
			redirect('flashcards/index/member_home');
		}
		else{
			redirect('flashcards/index/login_fail');
		}
}



public function logout(){
	$this->session->sess_destroy();
	redirect('flashcards/index/welcome');
	//$this->index('home');
}
}

