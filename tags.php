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

    <!-- Retrievev the respective tag name from $_GET -->

    <?php 
        $tag = $_GET['tag'];
        
        if ($tag!='NULL') {
            $tag = '#'.$tag;
        }
     ?>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/homepage-img/home-bg-1.jpg')">
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

    <!-- Main Content -->

    <div class="container-fluid">   
        <div class="row side-padding">
            <h3 class="page-header"><?php if($tag!='NULL') {echo"$tag";} else {echo"Untagged posts";} ?></h3>
        </div> <!-- end of row -->
            <!-- Blog Post Grid  -->

        <div class='row margin-top side-padding'>
            <?php   

                if ($tag!='NULL') {
                    $q = "SELECT * FROM blog_post_info WHERE tag='$tag' ORDER BY date DESC;";
                } else {
                    $q = "SELECT * FROM blog_post_info WHERE tag is NULL ORDER BY date DESC;";
                }

                $result = $db->query($q);

                //Display all posts in the tagged category 

                while($row = $result -> fetch_row()){
                    $id = $row[0];
                    $img_link = "img/blog-post-img/$id.jpg";
                    $title = $row[1];
                    $summary = $row[2];
                    $date = date('F j, o',strtotime($row[4]));
                    $Dprotected = $row[5];

                    if ($Dprotected == 1) {

                        echo "
                            <div class='col-xs-12'>
                                <div class='col-lg-3 col-md-3 col-sm-4 col-xs-12'>
                                    <div class='img-frame'>
                                        <img class='img-responsive' src='$img_link'></img>
                                    </div>
                                </div>

                                <div class='col-lg-9 col-md-9 col-sm-8 col-xs-12'>
                                    <div class='post-preview'>
                                        <a href='post.php?id=$id'>
                                            <h2 class='post-title'>
                                                $title
                                            </h2>
                                            <h3 class='post-subtitle'>
                                               There is no excerpt because this is a protected post. 
                                            </h3>
                                        </a>
                                        <p class='post-meta'>Posted by <a href='#'>Hung H. Tran</a> on $date</p>
                                    </div> <!--end of post-preview-->
                                </div> <!--end of inner col-->
                            </div><!--end of outer col-->
                            ";
                    } else {
                        echo "
                        <div class='col-xs-12''>
                            <div class='col-lg-3 col-md-3 col-sm-4 col-xs-12'>
                                <div class='img-frame'>
                                    <img class='img-responsive' src='$img_link'></img>
                                </div>
                            </div>

                            <div class='col-lg-9 col-md-9 col-sm-8 col-xs-12'>
                                <div class='post-preview'>
                                    <a href='post.php?id=$id'>
                                        <h2 class='post-title'>
                                            $title
                                        </h2>
                                        <h3 class='post-subtitle'>
                                           $summary
                                        </h3>
                                    </a>
                                    <p class='post-meta'>Posted by <a href='#'>Hung H. Tran</a> on $date</p>
                                </div> <!--end of post-preview-->
                            </div> <!--end of inner col-->
                        </div><!--end of outer col-->
                        ";
                    }
                }

            ?>

           <!-- Pager -->
            <ul class="pager">
                <li class="next">
                    <a href="archives.php">Archives &rarr;</a>
                </li>
            </ul>
        </div><!--end of outer row-->

    </div> <!-- end of container-fluid -->

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