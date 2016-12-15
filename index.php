<!DOCTYPE html>
<html lang="en">

<?php 
    require('includes/config.php');
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
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

    <div class='container-fluid'>

        <!-- Carousel -->
        <div class="row">
          <div class="col-md-8 col-md-offset-2 col-xs-12">
            <div id="carousel-example-generic" class="width-constraint carousel slide" data-ride="carousel">
              <!--indicator-->
              <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="3"></li>
              </ol>

              <!-- wrapper for the slides -->
              <div class="carousel-inner" role="listbox">
                <div class="item active">
                  <img src=img/homepage-img/home-img-1.jpg>
                </div> <!--end of item active-->

                <div class="item">
                  <img src="img/homepage-img/home-img-2.jpg">
                </div><!--end of item-->

                <div class="item">
                  <img src="img/homepage-img/home-img-3.jpg">
                </div><!--end of item-->

              </div><!--end of carousel-inner-->

              <!-- controls -->
              <a href="#carousel-example-generic" role="button" data-slide="prev" class="left carousel-control">
                <span class="glyphicon glyphicon-chevron-left" aria-hiden="true"></span>
                <span class="sr-only">Previous</span>
              </a>

              <a href="#carousel-example-generic" role="button" data-slide="next" class="right carousel-control">
                <span class="glyphicon glyphicon-chevron-right" aria-hiden="true"></span>
                <span class="sr-only">Next</span>
              </a>

            </div> <!--end of carousel slide-->
          </div> <!--end of col-->
        </div> <!--end of row-->

        <p id="welcome" class="text-center font-family-inherit no-margin-top">Warmest Welcome to my Blog. Do check out my recent posts below</p>

        <hr>

        <!-- Blog Post Grid  -->
        <div class='row margin-top side-padding'>
            <?php   

                $q = "SELECT * FROM blog_post_info ORDER BY date DESC;";

                $result = $db->query($q);

                // Only display the latest 3 posts

                $count = 1;

                while(($row = $result -> fetch_row())&&($count<4)){
                    $id = $row[0];
                    $img_link = "img/blog-post-img/$id.jpg";
                    $title = $row[1];
                    $summary = $row[2];
                    $date = date('F j, o',strtotime($row[4]));
                    $Dprotected = $row[5];

                    $count+=1;

                    if ($Dprotected == 1) {

                        echo "
                            <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12'>
                                <div class='col-lg-12 col-md-12 col-sm-4 col-xs-12'>
                                    <div class='img-frame'>
                                        <img class='img-responsive' src='$img_link'></img>
                                    </div>
                                </div>

                                <div class='col-lg-12 col-md-12 col-sm-8 col-xs-12'>
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
                        <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12'>
                            <div class='col-lg-12 col-md-12 col-sm-4 col-xs-12'>
                                <div class='img-frame'>
                                    <img class='img-responsive' src='$img_link'></img>
                                </div>
                            </div>

                            <div class='col-lg-12 col-md-12 col-sm-8 col-xs-12'>
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

        <hr>

        <!-- Video embed -->
        <div class="row margin-top side-padding">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12  video-embed-col-min-height">
              <div class="embed-reponsive embed-responsive-4by3 no-padding-bottom">
                <iframe src="https://www.youtube.com/embed/YEoVilawSyo" class="embed-reponsive-item iframe-size" frameborder="0" allowfullscreen></iframe>
              </div>
            </div> <!--end of col-->
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">          
                <p class="text-center">A short video about our time in Hanoi. Check it out.</p>
            </div> <!--end of col-->
        </div> <!--end of row-->


    <hr>

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
