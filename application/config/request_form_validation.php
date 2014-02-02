<?php 

$config = array(
		array(
			'field'   => 'name', 
            'label'   => 'name', 
            'rules'   => 'trim|required|min_length[2]|xxs_clean'
		),
		array(
			'field'   => 'email', 
            'label'   => 'email', 
            'rules'   => 'trim|required|valid_email|xss_clean'
		),
		array(
			'field'   => 'cellPhone', 
            'label'   => 'cellPhone', 
            'rules'   => 'trim|required|numeric|min_length[10]|max_length[11]|xss_clean'
		),
		array(
			'field'   => 'additional', 
            'label'   => 'additional', 
            'rules'   => 'trim|xss_clean'
		),

	);



?>