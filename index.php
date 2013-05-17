<?php 
require_once 'config/config.php';
include_once("includes/Router.php");
Router::route($conn);

?>