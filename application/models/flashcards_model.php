<?php

class Flashcards_model extends CI_Model{

	function add_deck($data){
		$this->db->insert('deck',$data);
		return;
	}

	function add_flashcard(){

	}

	function get_deck_by_id($id,$limit,$offset){
		//$query = $this->db->query('SELECT * FROM deck WHERE user_id = '.$id);
		//$this->db->select("title,subject,public,created,updated");
		$query = $this->db->get_where('deck',array('user_id'=> $id),$limit,$offset);
		return $query;
	}

	function get_deck_by_public(){
		$query = $this->db->query('SELECT * FROM deck WHERE public = 1');
		return $query->result();
	}

	function get_flashcard(){

	}

	function get_rows($id){
		$query = $this->db->get_where('deck',array('user_id'=> $id));
		return $query->num_rows();
	}

	function validate_deck_deletion($user_id,$deck_id){
		
		$this->db->where('user_id',$user_id);
		$this->db->where('deck_id',$deck_id);
		$query = $this->db->get('deck');
		if($query->num_rows() == 1){
			return true;
		}
		else{
			return false;
		}
	}

	function delete_deck($deck_id){
		//First delete all of the deck's flashcards
		$this->db->delete('flashcards',array('deck_id'=>$deck_id));
		//Then delete deck
		$this->db->delete('deck',array('deck_id'=>$deck_id));

	}
}