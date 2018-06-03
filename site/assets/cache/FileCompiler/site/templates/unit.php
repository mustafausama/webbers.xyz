<?php

if(!$config->ajax) include(\ProcessWire\wire('files')->compile(\ProcessWire\wire("config")->paths->root . 'site/templates/_head.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true))); // include header markup ?>

    <div class="page-body">
        <div class="container">

            <section class="page-content"><?php 

                // output 'headline' if available, otherwise 'title'
                echo "<h1>" . $page->get('headline|title') . "</h1>";

                $unitUsers = $users->find("unitID={$page->unitID}");
                if($unitUsers->count):
            ?>
                <h3>Users' Details</h3>
                <ul>
            <?php
                    foreach($unitUsers as $user) {

                        ?>
                        
                        <li><?=$user->FullName ?> | <input class="userPoint" id="<?=$user->id ?>" size="20" value="<?=$user->userPoints?>"> Points</li>
                        
                        <?php

                    }
            ?>
                </ul>
            <?php
                endif;

            ?>
            
                <section class='comments' style='direction: ltr'>
                    <h2>Tasks</h2>

                    <div class="commentsForm">
                    
                        <textarea class="commentArea" required></textarea>
                        <span class="commentPlace">Task</span>
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
                                    case: 'task',
                                    unitID: <?=$page->id ?>,
                                    taskData: $('.commentArea').val()
                                    
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
            
<?php if(!$config->ajax) include(\ProcessWire\wire('files')->compile(\ProcessWire\wire("config")->paths->root . 'site/templates/_foot.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true))); // include footer markup ?>
