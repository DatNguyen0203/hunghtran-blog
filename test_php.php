<?php
	require('includes/config.php');
		$q = "SELECT COUNT(*) FROM blog_post_info;";
		$result = $db->query($q);
		echo $result->fetch_row()[0];

?>