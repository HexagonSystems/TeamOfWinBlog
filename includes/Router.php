<?php

class Router
{

    public function __construct()
    {
    }

    public static function route(PDO $conn)
    {
        $getVars = $_GET;
        
        $cookieMonster = new CookieMonster();
        
        $cookieMonster->setDatabase($conn);
        
        $cookieMonster->lookForCookies();
        
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
            case "navPage":
                include_once 'controller/NavController.php';
                $controller = new NavController($conn);
                $controller->invoke();
                break;
            case "adminPage":
                include_once 'controller/AdminController.php';
                $controller = new AdminController($conn);
                $controller->invoke();
                break;
            case "editPost":
                include_once 'controller/EditPostController.php';
                $controller = new EditPostController($conn);
                $controller->invoke();
                break;
            case "logout":

                include_once 'controller/IndexController.php';
                if (isset($_SESSION['account'])) {
                    session_unset('account');
                }
                if (isset($_SESSION['accountObject'])) {
                    session_unset('accountObject');
                }
                $controller = new IndexController();
                //sessionDestroy();

                $controller->invoke();
                break;
            default:
                include_once 'controller/IndexController.php';
                $controller = new IndexController();
                $controller->invoke();
                break;
        }//end switch
    }
    // end route //end class
}
