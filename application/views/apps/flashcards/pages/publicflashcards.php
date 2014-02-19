<?php
echo "<h2> Public Decks </h2>";
	echo "<hr/>";

	if(isset($deck)) : foreach($deck as $row) : ?>
	<h5><?php echo $row->title; ?> </h5>
	<?php endforeach; ?>
	<?php else : ?>

	<h5>There are no decks </h5>

	<?php endif; 
?>