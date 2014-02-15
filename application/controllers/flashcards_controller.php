<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flashcards_controller extends CI_Controller {


public function index($page = null)
{

	$data['first_name'] = $this->session->userdata('first_name');
	$data['id'] = $this->session->userdata('id');
	$data['is_logged_in'] = $this->session->userdata('is_logged_in');
	
	if($page == null){
		if($data['is_logged_in']){
			$data['page'] = 'member_home';
		}
		else{
			$data['page'] = 'guest_home';
		}
	}
	else{
		$data['page'] = $page;	
	}
	

	$this->load->view('apps/flashcards/templates/_page',$data);
	


}


}

