<link rel="stylesheet" type="text/css"
	href="includes/css/index.css" />
	
	<link rel="stylesheet" type="text/css"
	href="includes/css/index_blog_display.css" />

<header>Welcome to the Team Of Win Blog website!</header>

<?php 
if(isset($_SESSION['activeUser'])){
	echo 'You are currently logged in as ' . $_SESSION['activeUser'];
}else{
	echo 'You are not currently logged in';
}

?>
