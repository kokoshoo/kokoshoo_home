<?php
	if(!$is_logged_in){

		$this->load->view('apps/flashcards/pages/login');
	}

	else{

		echo "<h2> Make a deck </h2>";
		echo "<hr/>";
		echo form_open('flashcards/make_deck');

		?>
		<table>
		<tr>
			<td> Title </td>
			<td>Subject</td>
			<td>Public?</td>
		</tr>

		<tr>
			<td><?php echo $this->session->flashdata('error'); ?></td>
		</tr>

		<tr>
			<td><?php echo form_input('title',''); ?></td>
			<td><?php echo form_input('subject',''); ?></td>
			<td><?php echo form_checkbox('public','public', "true");?></td>
			<td><?php echo form_submit('submit','Create');?></td>
		</tr>

		<?php
		echo form_close();
	}

	echo '</table>';

	echo $this->session->flashdata('success');

	echo "<h2> My Decks </h2>";
	echo "<hr/>";
/*
	if(isset($deck)) : foreach($deck as $row) : 
	echo '<h5>';echo $row->title; echo'</h5>'
	endforeach;
	else :

	echo '<h5>You have no flashcards </h5>';

	endif; 
*/	
?>
	<div id ="container">
		<?php 
		//$this->table->set_heading("title","subject",'public','created','updated',"options");
		//$this->table->add_column("moo");
		echo $deck;
		echo $this->pagination->create_links();?>
	</div>