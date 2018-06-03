<?php

include('./_head.php'); // include header markup ?>

	<div id='content'><?php 
	
		// output 'headline' if available, otherwise 'title'
		echo "<h1>" . $page->get('headline|title') . "</h1>";
	
		// output bodycopy
		echo $page->body; 
	
		
		// TIP: Notice that this <div id='content'> section is
		// identical between home.php and basic-page.php. You may
		// want to move this to a separate file, like _content.php
		// and then include('./_content.php'); here instead, on both
		// the home.php and basic-page.php template files. Then when
		// you make yet more templates that need the same thing, you
		// can simply include() it from them.
	
	?></div><!-- end content -->

<?php include('./_foot.php'); // include footer markup ?>
