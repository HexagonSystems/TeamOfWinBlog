<?php

require_once '../../config/config.php';
require_once '../../model/User.php';

$user = new User($conn);

if (isset($_GET['data'])) {
        $data = $_GET['data'];
        if (!empty($data)) {
            if (checkExists($data, $user) == "true") {
                echo "true";
            } else {
                echo "This username is already in use";
            }
        } else {
            echo "null";
        }
}

function checkExists($data, $user)
{
    if ($user->checkUsername($data) == "Username found") {
        return "This username is taken";
    } else {
        return "true";
    }
}
