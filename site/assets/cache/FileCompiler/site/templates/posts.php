<?php

if(!$config->ajax) if(!$config->ajax) 
 include(\ProcessWire\wire('files')->compile(\ProcessWire\wire("config")->paths->root . 'site/templates/_head.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true))); 
?>

    <div class="page-body">
        <div class="container">
            <section class="page-content"><?php 

                // output 'headline' if available, otherwise 'title'
                echo "<h1 style='display: inline-block'>" . $page->get('headline|title') . "</h1>"; 
                if($user->hasRole('social-media-head') || $user->hasRole('social-media-member') || $user->isSuperuser())
                    echo "<p class='add'><a href='{$config->urls->admin}page/add/?parent_id={$page->id}'>Add Post</a></p>";
                
                // output bodycopy
                echo $page->body; 

                // render navigation to child pages
                renderNav($page->children); 

                // TIP: Notice that this <div id='content'> section is
                // identical between home.php and basic-page.php. You may
                // want to move this to a separate file, like _content.php
                // and then include(\ProcessWire\wire('files')->compile(\ProcessWire\wire("config")->paths->root . 'site/templates/_content.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true))); here instead, on both
                // the home.php and basic-page.php template files. Then when
                // you make yet more templates that need the same thing, you
                // can simply include() it from them.

            ?></section><!-- end content -->

            <aside class='page-sidebar'><?php

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

<?php if(!$config->ajax) if(!$config->ajax) include(\ProcessWire\wire('files')->compile(\ProcessWire\wire("config")->paths->root . 'site/templates/_foot.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true))); // include footer markup ?>
