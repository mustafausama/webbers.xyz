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
		echo "<h2>Comments</h2>";
		if($page->numChildren > 0) {
			
			echo "<ul class='nav' role='navigation'>";
			foreach($page->children as $child) {

				if($child->template == "comment") {

					echo "<li style='display:block;'>";
					echo "<a href='#'>#</a>";
					echo "<div class='summary' style='margin-left: 15px; display:inline-block;'>".htmlspecialchars_decode($child->postOrDesignComment)."</div>";
					echo "</li>";

				}

			}

			echo "<hr>";

			foreach($page->children as $child) {
				if($child->template == "post-accepted") {

					echo "<p style='color:".( ($child->accepted) ? "green" : "red" ).";'>".( ($child->accepted) ? "Accepted" : "Rejected" )."</p>";

				}
			}

		}
	?></div><!-- end content -->

<?php include('./_foot.php'); // include footer markup ?>
