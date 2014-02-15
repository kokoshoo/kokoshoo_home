</div><!-- End of left_content -->
	</div><!-- End of left_section -->
	
	<div id = "right_section">
		<div id = "menu_one">
		
			<?php
				if($is_logged_in){
					echo '<p> Welcome ', $this->session->userdata('first_name'),"! </p>";
					echo anchor('logout', 'Logout');
				}
				else{
			 		$this->load->view('menus/login_form.php');
			 	}
			 ?>
		</div>
	</div>


	</div><!-- End of page_content -->
	
		</div> <!-- End of page_content_wrapper -->
			<div id="clear_page_content"></div>