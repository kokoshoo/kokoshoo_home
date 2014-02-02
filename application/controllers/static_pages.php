<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Static_pages extends CI_Controller {


public function view($page = 'home')
{

	if ( ! file_exists('application/views/pages/'.$page.'.php'))
	{
		// Whoops, we don't have a page for that!
		show_404();
	}

	$data['title'] = ucfirst($page); // Capitalize the first letter
	
	$this->load->view('templates/_header', $data);
	$this->load->view('templates/_pagecontentstart',$data);
	$this->load->view('pages/'.$page, $data);
	$this->load->view('templates/_pagecontentfinish',$data);
	$this->load->view('templates/_footer', $data);

}
}

