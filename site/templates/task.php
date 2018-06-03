<?php

if(!$config->ajax) include('./_head.php'); // include header markup ?>

    <div class="page-body">
        <div class="container">

            <section class="page-content"><?php 

                echo "<h1>" . $page->get('headline|title') . "</h1>";

                echo $page->body;

            ?></section><!-- end content -->

            <aside class="page-sidebar"><?php

                // rootParent is the parent page closest to the homepage
                // you can think of this as the "section" that the user is in
                // so we'll assign it to a $section variable for clarity
                $section = $page->rootParent; 

                // if there's more than 1 page in this section...
                if($section->hasChildren > 1) {
                    // output sidebar navigation
                    // see _init.php for the renderNavTree function
                    renderNavTree($section);
                }

                // output sidebar text if the page has it
                echo $page->sidebar; 

            ?>
            </aside><!-- end sidebar -->
        </div>
    </div>
            
<?php if(!$config->ajax) include('./_foot.php'); // include footer markup ?>
