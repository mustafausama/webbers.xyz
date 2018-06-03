<?php

if(!$config->ajax) include(\ProcessWire\wire('files')->compile(\ProcessWire\wire("config")->paths->root . 'site/templates/_head.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true))); // include header markup ?>


    <div class="page-body">
        <div class="container">
            <section class="page-content">
                
                <article class="post">
                    <header>
                        <?="<h1 class='display: inline-block;'>" . $page->get('headline|title') . " " . (($page->editable()) ? ("<p class='add edit'><a href='{$page->editUrl()}'>Edit</a></p>") : NULL) . "</h1>"?>
                    </header>                    
                    <?=$page->body ?>

                <?php
                if(isset($page->images)) {

                    echo "<div>";
                    foreach($page->images as $image) {
                        $image = $image->width(400);
                        echo "<img style='align: center;' src='$image->url' alt'$image->description' />";
                    }
                    echo "</div>";
                }
                // TIP: Notice that this <div id='content'> section is
                // identical between home.php and basic-page.php. You may
                // want to move this to a separate file, like _content.php
                // and then include(\ProcessWire\wire('files')->compile(\ProcessWire\wire("config")->paths->root . 'site/templates/_content.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true))); here instead, on both
                // the home.php and basic-page.php template files. Then when
                // you make yet more templates that need the same thing, you
                // can simply include() it from them.

            ?>
                </article>
                <section class='comments'>
                    <h2>Comments</h2>
                <?php

                echo "<ul class='nav' role='navigation'>";
                
                if($page->numChildren > 0) {

                    foreach($page->children as $child) {

                        if($child->template == "comment") {

                            echo "<li>";
                            echo "<div class='summary'>".htmlspecialchars_decode($child->postOrDesignComment)."</div>";
                            echo "</li>";

                        }

                    }

                }

                echo "</ul>";
                
                if($page->numChildren > 0) {

                    foreach($page->children as $child) {
                        if($child->template == "post-accepted") {

                            echo "<p style='color:".( ($child->accepted) ? "green" : "red" ).";'>".( ($child->accepted) ? "Accepted" : "Rejected" )."</p>";

                        }
                    }

                }
                ?>
                    <div class="commentsForm">
                    
                        <textarea class="commentArea" required></textarea>
                        <span class="commentPlace">Comment</span>
                        <button class="commentSubmit">Submit</button>
                    
                    </div>
                    
                    <script type="text/javascript">
                    
                        
                        $('.commentPlace').click(function () {

                            $(this).prev().focus();

                        });
                        
                        $('.commentSubmit').click(function (e) {
                            
                            'use strict';
                            $.ajax({
                                
                                type: 'POST',
                                url: '<?=$pages->get(1052)->httpUrl?>',
                                data: {
                                    
                                    ajax: true,
                                    case: 'comment',
                                    post: <?=$page->id ?>,
                                    comment: $('.commentArea').val()
                                    
                                }
                                
                            }).done(function (data) {
                                
                                if(data.status == 'succeeded') {
                                    
                                    var commentHTML = "<li><div class='summary'>" + $('.commentArea').val().replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;") + "</div></li>";
                                    $('.comments .nav').append(commentHTML);
                                    $('.commentArea').val('');
                                    
                                    
                                } else if (data.status == 'failed') {
                                    
                                    alert( (data.message) ? data.message : "Error in posting comment" );
                                
                                }
                                
                            });
                                                        
                        });
                        
                    </script>
                </section>
            </section><!-- end content -->
            <aside class="page-sidebar">
                <?php
                    
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
            </aside>
        </div>
    </div>

<?php if(!$config->ajax) include(\ProcessWire\wire('files')->compile(\ProcessWire\wire("config")->paths->root . 'site/templates/_foot.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true))); // include footer markup ?>
