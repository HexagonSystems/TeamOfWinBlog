<?php

require_once '../../config/config.php';
require_once '../../model/User.php';

$user = new User($conn);

if(isset($_GET['data']))
{
	if(isset($_GET['type'])){
		$data = $_GET['data'];
		$type = $_GET['type'];
		if(!empty($data)){
			if(checkEmailValid($data)){
				if (checkExists($data, $type, $user) == "true")
				{
					echo "true";
				}else
				{
					echo "This $type is already in use";
				}
			}else{
				echo "Please enter in a valid email";
			}
		}else
		{
			echo "null";
		}
	}
}

function checkExists($data, $type, $user){
	if($user->checkExists($data, $type) == "Data found")
	{
		return "This $type is taken";
	}else
	{
		return "true";
	}
}

/**
 * Check Email Valid
 * If the email meets the criteria of FILTER_VALIDATE_EMAIL return true.
 * Otherwise, return false;
 * @param $email
 * @return boolean
 */
function checkEmailValid($email){
	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		return true;
	}else{
		return false;
	}
}



?>