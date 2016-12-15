<!-- Below php code is for activate the nav button of the current page  -->

<?php 
    require('includes/config.php');
    $curr_page = ($_SERVER['PHP_SELF']);
    $index = $containing_folder.'/index.php';
    $post = $containing_folder.'/post.php';
    $archives = $containing_folder.'/archives.php';
    $about = $containing_folder.'/about.php';
    $tags = $containing_folder.'/tags.php';
    $contact = $containing_folder.'/contact.php';

    $page_dir_to_nav_button = array($index=>'Home',$about=>'About',$tags=>'Tags',$archives=>'Archives',$contact=>'Contact');

    $nav_button_to_activate = $page_dir_to_nav_button[$curr_page];
 ?>


<!-- Navigation -->
<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="../myblog/">Hung H. Tran</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <?php 
                        if($nav_button_to_activate == 'Home') {
                            echo "
                                <a href='..$containing_folder' class='activate'>Home</a>
                                ";
                        } else {
                            echo "
                                <a href='..$containing_folder'>Home</a>
                                ";
                        }

                     ?>
                </li>

                <li>
                    <?php 
                        if($nav_button_to_activate == 'About') {
                            echo "
                                <a href='about.php' class='activate'>About</a>
                                ";
                        } else {
                            echo "
                                <a href='about.php'>About</a>
                                ";
                        }

                     ?>
                </li>
                <li class="dropdown">
                    <?php 
                        if($nav_button_to_activate == 'Tags') {
                            echo "
                                <a href='tags.php' class='activate dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>
                                    Tags 
                                    <span class='caret'></span>
                                </a>
                                ";
                        } else {
                            echo "
                                <a href='tags.php' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>
                                    Tags 
                                    <span class='caret'></span>
                                </a>
                                ";
                        }

                     ?>

                    <ul class="dropdown-menu" role="menu">
                        <?php
                            $q = "SELECT DISTINCT(tag) AS tag FROM blog_post_info ORDER BY tag DESC;";
                            $result = $db->query($q);
                            $first_row = $result->fetch_row();
                            $tags = array($first_row[0]);

                            while ($row = $result->fetch_row()) {
                                $tags[] = $row[0];
                            } 

                            $total_no_of_tagged_posts = 0;

                            foreach ($tags as $tag) {
                                # Process tags that are no NULL first 
                                if ($tag) { 
                                    # Find the number of posts for each tag  
                                    $q = "SELECT COUNT(*) FROM blog_post_info WHERE tag='$tag';";
                                    $result = $db->query($q);
                                    $no_of_posts = $result->fetch_row()[0];
                                    $tag_variable = substr($tag, 1, strlen($tag)-1);
                                    echo"
                                        <li><a href='tags.php?tag=$tag_variable' class='custom-color'>$tag ($no_of_posts)</a></li>                
                                        ";
                                }
                            }

                            //Find the number of untagged post 
                            $q = "SELECT COUNT(*) FROM blog_post_info WHERE tag is NULL;";
                            $result = $db->query($q);
                            $total_no_of_untagged_posts = $result->fetch_row()[0];
                         ?>

                         <!-- Process NULL tag -->
                        <li>
                            <a href="tags.php?tag=NULL" class="custom-color">
                            Untagged
                            <?php echo" ($total_no_of_untagged_posts)" ?>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <?php 
                        if($nav_button_to_activate == 'Archives') {
                            echo "
                                <a href='archives.php' class='activate'>Archives</a>
                                ";
                        } else {
                            echo "
                                <a href='archives.php'>Archives</a>
                                ";
                        }

                     ?>
                </li>

                <li>
                    <?php 
                        if($nav_button_to_activate == 'Contact') {
                            echo "
                                <a href='contact.php' class='activate'>Contact</a>
                                ";
                        } else {
                            echo "
                                <a href='contact.php'>Contact</a>
                                ";
                        }

                     ?>
                </li>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

