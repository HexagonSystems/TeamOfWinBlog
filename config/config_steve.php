<?php 
/**
 * Define document paths
 */
define('SERVER_ROOT' , $_SERVER["DOCUMENT_ROOT"]);
define('SITE_ROOT' , 'tow.dev');

spl_autoload_register(function () {
       require_once $_SERVER['DOCUMENT_ROOT']."/model/User.php";
});

spl_autoload_register(function () {
       require_once $_SERVER['DOCUMENT_ROOT']."/model/LoginTracker.php";
});

spl_autoload_register(function () {
       require_once $_SERVER['DOCUMENT_ROOT']."/model/Post.php";
});

spl_autoload_register(function () {
       require_once $_SERVER['DOCUMENT_ROOT']."/model/Article.php";
});

spl_autoload_register(function () {
       require_once $_SERVER['DOCUMENT_ROOT']."/model/Comment.php";
});

/**
 * Define database connection if using a database
*/

$host = "localhost";
$db = "tow";
$user = "towuser";
$pass = "towpassword";
$conn = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
/**
 * Define any other config option you may want to use
*/
?>