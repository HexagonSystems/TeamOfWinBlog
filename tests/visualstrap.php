<?php

spl_autoload_register(function () {
       require_once $_SERVER['DOCUMENT_ROOT']."/model/User.php";
});

spl_autoload_register(function () {
       require_once $_SERVER['DOCUMENT_ROOT']."/model/LoginTracker.php";
});




?>