<?php 
if($is_logged_in){?>
	
<h3>Welcome <?php echo $first_name; ?></h3>
<p><strong> You have the option to make/view/edit your flashcards or
	view other public flashcards. </p>

<?php 
} 
else{?>
<h3>Welcome to the flashcards application</h3>
<p>
<strong> You can view all public flashcards,
	but if you want to make flashcards, you will need to make an account.</p>

<?php	
}?>