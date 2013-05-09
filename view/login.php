<?php

/*
 * Sends data to the index
 * Index sends to router
 * Router identifies that it is the login form
 * Router echos to screen
 * 
 * --
 * 
 * Needs to:
 * Send to controller
 * Controller needs to send to model
 * Model verifies the login
 * Then your logged in!
 * 
 * --
 * 
 * Files being used:
 * PersonController.php
 * PersonsTemplate.html
 * PersonsView.php
 * Persons.php
 */

?>
<form action="../index.php?location=loginPage&action=attemptLogin" method="POST">
	<input type="text" placeholder="Username">
	<input type="password" placeholder="Password">
	<input type="submit" value="Login">
</form>