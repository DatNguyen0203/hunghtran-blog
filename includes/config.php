<?php 
ob_start();
// session_start();

// database credentials

$dbConnect = array('server'=>'localhost','user'=>'root','pass'=>'4k4hb4T@','database'=>'myblog');

// connect to the database

$db = new mysqli($dbConnect['sever'],$dbConnect['user'],$dbConnect['pass'],$dbConnect['database']);

// React to database connection error
$error_code = $db -> connect_errno;

if ($error_code > 0) {
	$error_name = $db -> connect_error;
	echo "
		<h1>Error Connecting to the Database</h1>
		<h3>$error_name</h3>
		<p>Please contact maintenance at <a href='#'>hunghtran-blog@hotmail.com</a></p>
		";
	exit;
}

// set timezone
date_default_timezone_set('Asia/Singapore'); 

//set containing folder
$containing_folder = '/myblog'; 

?>

