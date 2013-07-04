<?php

class IndexController
{
    private $template;
    private $footer;
    private $nav;
    private $currentPagePosts;
    private $database;
    private $fileName = 'indexView';

    public function __construct()
    {
        $this->footer = 'includes/footer.php';
        include_once('controller/HeadController.php');
        $this->nav = new HeadController();
        $this->nav ->invoke();
    } //end constructor

    public function setDatabase(PDO $database)
    {
        $this->database = $database;
    }

    public function invoke()
    {
        if (!isset($_GET['action'])) {
            $this->template = 'view/'.$this->fileName.'Template.php';
            include_once('view/'.$this->fileName.'.php');

            $post = new Post();
            $post->setDatabase($this->database);
            $this->currentPagePosts = $post->getPosts(0, 10);

            //create a new view and pass it our template
            $view = new IndexView($this->template,$this->footer, $this->currentPagePosts);
            $content ="";
            $view->assign('title' , 'Loggged in');
            $view->assign('content' , $content);
        }

    } // end function
}
