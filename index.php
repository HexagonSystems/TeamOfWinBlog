<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

require 'config/config.php';
include_once("includes/Router.php");
Router::route();

?>