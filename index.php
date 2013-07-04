<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

/**
 * CHANGE THIS TO A CONFIG THAT IS YOU!
 */
require_once('config/config_steve.php');
require_once('controller/CookieMonster.php');
include_once("includes/Router.php");
Router::route($conn);

?>