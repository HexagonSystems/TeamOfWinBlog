<?php
session_start();
require_once 'model/User.php';
class AdminController
{
    private $template;
    private $footer;
    private $nav;
    private $conn;

    private $fileName = 'AdminView';
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
        $get = $_GET;
        if (!isset($get['action'])) {

            $user = new User($this->conn);
            $data = $user->displayUsers();

            $this->template = 'view/'.$this->fileName.'Template.php';
            include_once('view/'.$this->fileName.'.php');
            //create a new view and pass it our template
            $view = new AdminView($this->template, $this->footer);
            //$content ="$data";
            //$view->assign('title' , 'Loggged in');
            $view->assign('content', $data);

        } elseif (isset($get['action'])) {
            
            $user = new User($this->conn);
            if ($get['action'] == 'suspendUser') {
                if ($get['username']) {
                    $user->updateAccessLevel($get['username'], 1);
                }
            }
            if ($get['action'] == 'unsuspendUser') {
                if ($get['username']) {
                    $user->updateAccessLevel($get['username'], 5);
                }

            }
 
            $data = $user->displayUsers();

            $this->template = 'view/'.$this->fileName.'Template.php';
            include_once('view/'.$this->fileName.'.php');
            //create a new view and pass it our template
            $view = new AdminView($this->template, $this->footer);
            //$content ="$data";
            //$view->assign('title' , 'Loggged in');
            $view->assign('content', $data);

        }
    } // end function
}
