<?php 
/**
 * Define document paths
 */
define('SERVER_ROOT' , 'I:\xampp\htdocs\workspace\TeamOfWinBlog');
define('SITE_ROOT' , 'http://localhost/workspace/TeamOfWinBlog');
/**
 * Define database connection if using a database
*/

$host = "localhost";
$db = "pdoexercise";
$user = "root";
$pass = "";
$conn = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
/**
 * Define any other config option you may want to use
*/
?>