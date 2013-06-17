<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');

/**
 * CHANGE THIS TO A CONFIG THAT IS YOU!
 */
require_once('config/config_steve.php');
include_once("includes/Router.php");
Router::route($conn);

?>