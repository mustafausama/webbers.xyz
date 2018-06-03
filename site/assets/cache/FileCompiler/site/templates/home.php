<?php

if(!$config->ajax) include(\ProcessWire\wire('files')->compile(\ProcessWire\wire("config")->paths->root . 'site/templates/_head.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true))); // include header markup ?>
    <div class="page-body">
        <div class="container">
            <section class="page-content">


            <?php

                // output 'headline' if available, otherwise 'title'
                echo "<h1>" . $page->get('headline|title') . "</h1>";

                // output bodycopy
                echo $page->body;

                // render navigation to child pages
                //renderNav($page->children);

            ?><!-- end content -->

            </section>

            <aside class='page-sidebar'>
            <?php

                if(count($page->images)) {

                    // if the page has images on it, grab one of them randomly... 
                    $image = $page->images->getRandom();

                    // resize it to 400 pixels wide
                    $image = $image->width(136);

                    // output the image at the top of the sidebar...
                    echo "<img class='align_center' src='$image->url' alt='$image->description' />";
                }

                // output sidebar text if the page has it
                echo $page->sidebar;

            ?>
            </aside><!-- end sidebar -->
        </div>
    </div>
<?php if(!$config->ajax) include(\ProcessWire\wire('files')->compile(\ProcessWire\wire("config")->paths->root . 'site/templates/_foot.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true))); // include footer markup ?>
