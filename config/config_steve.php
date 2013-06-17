<?php 
/**
 * Define document paths
 */
define('SERVER_ROOT' , $_SERVER["DOCUMENT_ROOT"]);
define('SITE_ROOT' , 'tow.dev:8888');
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