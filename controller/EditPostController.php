<?php
session_start();
require_once 'model/User.php';
class EditPostController
{
    private $model;
    private $template;
    private $footer;
    private $nav;
    private $conn;

    private $fileName = 'EditPostView';
    public function __construct(PDO $conn)
    {
        $this->footer = 'includes/footer.php';
        include_once 'controller/HeadController.php';
        $this->nav = new HeadController();
        $this->nav ->invoke();
        $this->conn = $conn;

    } //end constructor
    public function invoke()
    {
        if (!isset($_GET['action'])) {
            $this->template = 'view/'.$this->fileName.'Template.php';
            include_once 'view/'.$this->fileName.'.php');
            //create a new view and pass it our template
            $view = new EditPostView($this->template, $this->footer);
        } elseif (isset($_GET['action'])) {

        }

    } // end function
}
