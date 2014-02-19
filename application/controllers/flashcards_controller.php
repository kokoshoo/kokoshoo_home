<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flashcards_controller extends CI_Controller {

private $per_page;

public function __construct() {
    parent::__construct();
    $this->per_page = 10;
    $this->load->model('membership_model');
    $this->load->model('flashcards_model');
}


public function index($page = 'welcome')
{

	if ( ! file_exists('application/views/apps/flashcards/pages/'.$page.'.php'))
	{
		// Page doesn't exist
		echo'moo';
		show_404();
	}

	$data['first_name'] = $this->session->userdata('first_name');
	$data['user_id'] = $this->session->userdata('user_id');
	$data['is_logged_in'] = $this->session->userdata('is_logged_in');
	$data['page'] = $page;

	if($page == "myflashcards"){
		redirect('flashcards/mydecks');
	}

	if($page == "publicflashcards"){
		$data['deck'] = $this->publicdecks();
	}


	$this->load->view('apps/flashcards/templates/_page',$data);
	
}


public function login(){
		
		$this->load->library("form_validation");

		$this->form_validation->set_rules("username","User name", "required");

		if($this->form_validation->run() == FALSE){
			index('login');
		}
			$query = $this->membership_model->validate();
			
			if($query != null){
				$data = array(
					'username' => $query->username,
					'first_name' => $query->first_name,
					'user_id' => $query->user_id,
					'is_logged_in' => true
				);
				
				
				$this->session->set_userdata($data);
				redirect('flashcards/index/welcome');
			}
			else{
				$this->session->set_flashdata('error','Invalid Username and/or Password');
				redirect('flashcards/index/login');
			}
}

public function make_deck(){
	$this->load->library("form_validation");
	$this->form_validation->set_rules("title","Title", "required");
	$this->form_validation->set_rules("subject","Subject","required");

	if($this->form_validation->run() == FALSE){
		$this->session->set_flashdata('error',"Please fill out all of the fields");
		
	}
	else{

		if($this->input->post('public')){
			$public = 1;
		}
		else{
			$public = 0;
		}

		$data = array(
			'title' => $this->input->post('title'),
			'subject' => $this->input->post('subject'),
			'public' => $public,
			'user_id' => $this->session->userdata('user_id')
		);

		$this->flashcards_model->add_deck($data);

		$this->session->set_flashdata('success',"You have added the deck ".$this->input->post('title'));
		
	}
	redirect("flashcards/mydecks");
}

public function publicdecks(){
	
	if($query = $this->flashcards_model->get_deck_by_public()){
		return $query;
	}

}

public function mydecks(){

	$data['first_name'] = $this->session->userdata('first_name');
	$data['user_id'] = $this->session->userdata('user_id');
	$data['is_logged_in'] = $this->session->userdata('is_logged_in');
	$data['page'] = "myflashcards";

	if(!$data['is_logged_in']){
		redirect('flashcards/index/login');
	}
	
	//Get decks for individual user

	$this->paginatedata('mydecks',$this->flashcards_model->get_rows($data['user_id']));

	if($query = $this->flashcards_model->get_deck_by_id($data['user_id'],
				$this->per_page, $this->uri->segment(3))){

	    $tmpl = array (
	      'table_open' => '<table border="0" cellpadding="3" cellspacing="0">',
	      'heading_row_start' => '<tr bgcolor="#66cc44">',
	      'row_start' => '<tr bgcolor="#dddddd">' 
	      );
	    //$this->table->set_template($tmpl); 

		$this->table->set_empty("&nbsp;");
		
		$this->table->set_heading('Title','Subject','Public','Created','Updated','Options');

		$table_row = array();

		foreach($query->result() as $row){
			$table_row = NULL;
			$table_row[] = anchor('flashcards/study/' . $row->deck_id, $row->title);
			$table_row[] = $row->subject;
			if($row->public == '0'){
				$table_row[] = "No";
			}
			else{
				$table_row[] = "Yes";
			}
			$table_row[] = $row->created;
			$table_row[] = $row->updated;
			$table_row[] = 
				anchor('flashcards/study/' . $row->deck_id, 'Study') . ' | ' .
				anchor('flashcards/edit/'. $row->deck_id, 'Edit') . ' | '.
				anchor('flashcards/delete_deck/'. $row->deck_id, 'Delete',
         	 "onClick=\" return confirm('Are you sure you want to '
            + 'delete the deck $row->title?')\"") .
        	'</nobr>';
			$this->table->add_row($table_row);
		}



		$deck_table = $this->table->generate();

		$data['deck'] = $deck_table;


	}

	$this->load->view('apps/flashcards/templates/_page',$data);

}

function delete_deck(){
	$valid = $this->flashcards_model->validate_deck_deletion(
		$this->session->userdata('user_id'),
		$this->uri->segment(3));
	
	if($valid){
		$this->flashcards_model->delete_deck(
			$this->uri->segment(3));
		redirect('flashcards/mydecks','refresh');

	}
	else{
		redirect('flashcards/index/login');
	}


		
}

public function edit(){

}


private function paginatedata($page,$rows){
	$this->load->library('pagination');

	$config['base_url'] = base_url()."index.php/flashcards/".$page;
	$config['total_rows'] = $rows;
	$config['per_page'] = $this->per_page;
	$config['num_links'] = 20;
	$this->pagination->initialize($config);
}


public function logout(){
	$this->session->sess_destroy();
	redirect('flashcards/index/welcome');
	//$this->index('home');
}

private function prepare_table($query){

}



}

