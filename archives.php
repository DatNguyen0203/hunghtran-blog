<!DOCTYPE html>
<html lang="en">

<?php 
    require('includes/config.php');
 ?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hung H. Tran</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/clean-blog.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/clean-blog.css">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Import Navigation -->
    <?php 
        require('includes/nav.php');
    ?>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/archives-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Hung H. Tran</h1>
                        <hr class="small">
                        <span class="subheading">You Probably Never Know Who I Am</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row side-padding">
            <h3 class="page-header">Archives</h3>

            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

            <?php 
                $q = "SELECT * FROM blog_post_info ORDER BY date DESC;";
                $result = $db->query($q);
                $latest_post = $result->fetch_assoc();
                
                $latest_post_id = $latest_post['id'];
                $latest_post_title = $latest_post['title'];
                $latest_post_summary = $latest_post['summary'];
                $latest_post_date = date('F j, o',strtotime($latest_post['date']));

                $previous_date_month = date('F',strtotime($latest_post['date']));
                $previous_date_year = date('o',strtotime($latest_post['date']));

                echo "
                    <div class='panel panel-default'>
                        <div class='panel-heading' role='tab' id='heading1'>
                            <h4 class='panel-title'>
                                <a data-toggle='collapse' data-parent='#accordion' href='#collapse1' aria-expanded='true' aria-controls='collapse1'>$previous_date_month $previous_date_year</a>
                            </h4>
                        </div>  

                        <div id='collapse1' class='panel-collapse collapse' role='tabpanel1' aria-labelledby='heading1'>
                            <div class='panel-body'> 
                                <div class='media'>
                                    <a href='post.php?id=$latest_post_id' class='media-left'>
                                        <img class='img-64by64'src='img/blog-post-img/$latest_post_id.jpg'/>
                                     </a>

                                    <div class='media-body'>
                                        <a href='post.php?id=$latest_post_id'><h4 class='media-heading'>$latest_post_title</h4></a>
                                        <h6 class='media-heading no-bold'>$latest_post_date</h6>  
                                        <p class='no-margin-top'>$latest_post_summary</p>
                                    </div> <!--end of media-body-->
                            

                                </div> <!-- end of media-->             
                ";

                $collapse_id = 1; //used to format bootstrap collapse functionality of panel//  

                while($row = $result->fetch_assoc()) {
                    $post_id = $row['id'];
                    $post_title = $row['title'];
                    $post_summary = $row['summary'];
                    $post_date = date('F j, o',strtotime($row['date']));
                   
                    $post_protection_status = $row['Dprotected'];
                    if ($post_protection_status == 1) {
                        $post_summary = 'There is no excerpt because this is a protected post.';
                    }

                    $current_date_month = date('F',strtotime($row['date']));
                    $current_date_year = date('o',strtotime($row['date']));

                    if (($current_date_month!=$previous_date_month)||($current_date_year!=$previous_date_year)) {

                        $collapse_id+=1;

                        //if the current post's date is different from the previous post at month level, end the current panel and make a new one//  
                        echo "
                                    </div> <!--end of panel-body-->
                                </div> <!--end of panel-collapse-->
                            </div><!--end of panel panel-default-->

                            <!-- New Panel: -->

                            <div class='panel panel-default'>
                                <div class='panel-heading' role='tab' id='heading$collapse_id'>
                                    <h4 class='panel-title'>
                                        <a data-toggle='collapse' data-parent='#accordion' href='#collapse$collapse_id' aria-expanded='true' aria-controls='collapse$collapse_id'>$current_date_month $current_date_year</a>
                                    </h4>
                                </div>  

                                <div id='collapse$collapse_id' class='panel-collapse collapse' role='tabpanel$collapse_id' aria-labelledby='heading$collapse_id'>
                                    <div class='panel-body'> 
                                        <div class='media'>
                                            <a href='post.php?id=$post_id' class='media-left'>
                                                <img class='img-64by64'src='img/blog-post-img/$post_id.jpg'/>
                                            </a>

                                            <div class='media-body'>
                                                <a href='post.php?id=$post_id'><h4 class='media-heading'>$post_title</h4></a>
                                                <h6 class='media-heading no-bold'>$post_date</h6>  
                                                <p class='no-margin-top'>$post_summary</p>
                                            </div> <!--end of media-body-->
                                        </div> <!-- end of media-->   
                        ";
                    } else {
                        //Else, if the current post's date is the same as the previous post at month level, add this post info in terms of <div class="media"> into the current <div class="panel">//
                        echo "
                            <div class='media'>
                                <a href='post.php?id=$post_id' class='media-left'>
                                    <img class='img-64by64'src='img/blog-post-img/$post_id.jpg'/>
                                </a>

                                <div class='media-body'>
                                    <a href='post.php?id=$post_id'><h4 class='media-heading'>$post_title</h4></a>
                                    <h6 class='media-heading no-bold'>$post_date</h6>  
                                    <p class='no-margin-top'>$post_summary</p>
                                </div> <!--end of media-body-->
                            </div> <!-- end of media-->   
                        ";
                    }
                }

                //Close the last panel//

                echo "
                            </div> <!--end of panel-body-->
                        </div> <!--end of panel-collapse-->
                    </div><!--end of panel panel-default-->
                    ";
            ?>

            </div> <!--end of panel-group-->
        </div><!--end of row-->
    </div><!--end of container-fluid-->

    <?php 
        include 'includes/footer.php';
     ?>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/clean-blog.min.js"></script>

</body>

</html>