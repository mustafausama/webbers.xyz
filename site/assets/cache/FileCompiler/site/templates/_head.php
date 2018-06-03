    <!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<title><?php echo $page->title; ?></title>
        <meta name="description" content="<?php echo $page->summary; ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates?>styles/style.css">
		    <link href='https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Lusitana:400,700|Quattrocento:400,700' rel='stylesheet' type='text/css' />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <script src="<?=$config->urls->templates?>scripts/jquery.min.js"></script>

    </head>
    <body class='has-sidebar'>

	   <div class="white"></div>
        
        <a class="load" href="http://webbers.xyz">
            <img src="<?php echo $config->urls->templates?>img/logo.png">
        </a>
        
		<header class="header"> <!-- Start Header -->

			<div class="container">
                
                <div class="clearfix"></div>
				
				<button class="bars" <?=($user->isLoggedin()) ? NULL : "style='opacity:0;'" ?> ><i class="fa fa-bars"></i></button>
                
            <?php
                if($user->isLoggedin()):
              ?>
                <nav class="main-nav">
                
                    <ul>
                    <?php

                        // top navigation consists of homepage and its visible children
                        $homepage = $pages->get('/'); 
                        $children = $homepage->children();

                        // make 'home' the first item in the navigation
                        $children->prepend($homepage); 

                        // render an <li> for each top navigation item
                        foreach($children as $child) {
                            if($child->id == $page->rootParent->id) {
                                // this $child page is currently being viewed (or one of it's children/descendents)
                                // so we highlight it as the current page in the navigation
                                echo "<li class='current'><a class='ajax-link' href='$child->url'>$child->title</a></li>";
                            } else {
                                echo "<li><a class='ajax-link' href='$child->url'>$child->title</a></li>";
                            }
                        }

                        // output an "Edit" link if this page happens to be editable by the current user
                        if($page->editable()) {
                            echo "<li class='edit'><a href='$page->editUrl'>Edit</a></li>";
                        }

                    ?>
                    </ul>
                    
                </nav>
            <?php
                endif;
            ?>
                
            </div>
            
        </header> <!-- End Header -->

        <!-- search form
        <form class='search' action='<?php echo $pages->get('template=search')->url; ?>' method='get'>
            <label for='search' class='visually-hidden'>Search:</label>
            <input type='text' name='q' id='search' placeholder='Search' value='' />
            <button type='submit' name='submit' class='visually-hidden'>Search</button>
        </form>
        -->
        <!-- breadcrumbs -->
        <div class="intro"> <!-- Start Intro -->
        
            <div class="container">
            
                <nav class="intro-nav">
                
                    <ul>
                    <?php

                        foreach($page->parents() as $item) {
                            echo "<li><a class='ajax-link' href='$item->url'>$item->title</a></li> "; 
                        }
                        echo "<li class='current'><a class='ajax-link' href='{$page->url}'>$page->title</a></li> "; 

                    ?>
                    </ul>
                </nav>
                <?php
                    if($user->isLoggedin())
                        echo "<p class='welcome'>Welcome <a href='{$config->urls->admin}/profile'>{$user->FullName}</a> | <a href='{$config->urls->admin}'>Dashboard</a></p>";
                    else
                        echo "<p class='welcome'>Welcome Visitor | <a href='{$config->urls->admin}'>Login</a></p>";
                ?>
            </div>
        </div> <!-- End Intro -->
