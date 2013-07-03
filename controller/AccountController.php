<?php
session_start();
require_once 'model/User.php';
class AccountController
{
    private $model;
    private $template;
    private $footer;
    private $nav;
    private $conn;

    private $fileName = 'AccountView';
    public function __construct(PDO $conn)
    {
        $this->footer = 'includes/footer.php';
        include_once('controller/HeadController.php');
        $this->nav = new HeadController();
        $this->nav ->invoke();
        $this->conn = $conn;

    } //end constructor
    public function invoke()
    {
        if (!isset($_GET['action'])) {
            $this->template = 'view/'.$this->fileName.'Template.php';
            include_once('view/'.$this->fileName.'.php');
            //create a new view and pass it our template
            $view = new AccountView($this->template,$this->footer);
            $content ="";
            //$view->assign('title' , 'Loggged in');
            //$view->assign('content' , $content);

        } elseif (isset($_GET['action'])) {
            if ($_GET['action'] == 'changeemail') {
                $user = new User($this->conn);
                if (isset($_POST['pass']) && isset($_POST['email'])) {
                    $user = $user->updateEmail($_SESSION['account']['username'],$_POST["email"],$_POST["pass"],$_SESSION['account']['access']);
                    //$user = $user->save();
                    $this->template = 'view/'.$this->fileName.'Template.php';
                    include_once('view/'.$this->fileName.'.php');
                    //create a new view and pass it our template
                    $view = new AccountView($this->template,$this->footer);
                    $content ="";
                    //$view->assign('title' , 'Loggged in');
                    //$view->assign('content' , $content);
                }
            } elseif ($_GET['action'] == 'changepassword') {
                $user = new User($this->conn);
                if (isset($_POST[''])) {

                }
            }
        }
        {

        }

    } // end function
} //end class
