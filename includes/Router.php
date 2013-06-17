<?php
class Router
{
    public function __construct()
	{
	}
    public static function route(PDO $conn)
	{
        $getVars = $_GET;

        $page = isset($getVars['location']) ? $getVars['location'] : 'empty';

        switch ($page) {
            case "indexPage":
                include_once 'controller/IndexController.php';
				$controller = new IndexController();
				$controller->invoke();
                break;
            case "loginPage":
                include_once 'controller/LoginController.php';
						$controller = new LoginController($conn);
						$controller->invoke();
                break;
            case "registerPage":
                include_once 'controller/RegisterController.php';
							$controller = new RegisterController($conn);
							$controller->invoke();
                break;
            case "accountPage":
                include_once 'controller/AccountController.php';
                $controller = new AccountController($conn);
							$controller->invoke();
                break;
            case "adminPage":
                include_once 'controller/AdminController.php';
                $controller = new AdminController($conn);
					$controller->invoke();
                break;
            default:
                include_once 'controller/IndexController.php';
                $controller = new IndexController();
			$controller->invoke();
                break;
        }//end switch
    }// end route
    //end class
		}
