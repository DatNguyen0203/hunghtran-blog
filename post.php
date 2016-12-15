<!DOCTYPE html>
<html lang="en">

<?php 
    require('includes/config.php');
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

    <title>Clean Blog - Sample Post</title>

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
    <header class="intro-header" style="background-image: url('img/post-bg.jpg')">
	    <div class="container">
	        <div class="row">
	            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
	                <div class="post-heading">
		    <?php 
		    	 $id = $_GET['id'];
		    	 $q = "SELECT * FROM blog_post_info WHERE id=$id";
		         $result = $db->query($q);

		         $row = $result->fetch_assoc();
		         $title = $row['title'];
		         $summary = $row['summary'];
		         $date = date('F j, o',strtotime($row['date']));

		         echo"
                     <h1>$title</h1>
                   
                     <h2 class='subheading'>$summary</h2>
                        
                     <span class='meta'>Posted by <a href='#'>Hung H. Tran</a> on $date</span>
		         ";
		     ?>
 
                    </div> <!--end of post-heading-->
                </div> <!--end of col-->
            </div> <!--end of row-->
        </div> <!--end of container-->
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">

                <?php 
                	$q = "SELECT content FROM blog_post_content WHERE id=$id";
                	$result = $db->query($q);
                	$content = $result->fetch_row()[0];
                	echo $content;
                 ?>

                    <blockquote>The dreams of yesterday are the hopes of today and the reality of tomorrow. Science has not yet mastered prophecy. We predict too much for the next year and yet far too little for the next ten.</blockquote>


                    <a href="#">
                        <img class="img-responsive" src="img/post-sample-image.jpg" alt="">
                    </a>
                    <span class="caption text-muted">To go places and do things that have never been done before – that’s what living is all about.</span>

                    <p>Placeholder text by <a href="http://spaceipsum.com/">Space Ipsum</a>. Photographs by <a href="https://www.flickr.com/photos/nasacommons/">NASA on The Commons</a>.</p>
                </div>
            </div>
        </div>
    </article>

    <hr>

    <?php 
        include 'includes/footer.php';
     ?>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/clean-blog.min.js"></script>

</body>

</html>
