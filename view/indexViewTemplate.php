<header>Welcome to the Team Of Win Blog website! THIS IS THE FILE</header>

<?php 
if(isset($_SESSION['activeUser'])){
	echo 'You are currently logged in as ' . $_SESSION['activeUser'];
}else{
	echo 'You are not currently logged in';
}

?>

<form action="index.php?action=logout" method = "GET">
	<input type="submit" name="action" value="Logout">
</form>