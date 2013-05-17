<?php 
/**
 * Define document paths
 */
define('SERVER_ROOT' , 'I:\xampp\htdocs\workspace\TOW_BLOG_02');
define('SITE_ROOT' , 'http://localhost/workspace/TOW_BLOG_02');
/**
 * Define database connection if using a database
*/

$host = "localhost";
$db = "tow";
$user = "root";
$pass = "";
$conn = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
/**
 * Define any other config option you may want to use
*/
?>