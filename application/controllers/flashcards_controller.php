<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Static_pages extends CI_Controller {


public function index($page = 'home')
{

	$data['page'] = $page; // Capitalize the first letter
	

	$this->load->view('templates/_page',$data);

}


}

