<?php
class BlogController
{
    private $template;
    private $footer;
    private $blog;
    private $nav;
    private $conn;

    private $view = 'BlogView';

    public function __construct()
    {
        $this->footer = 'includes/footer.php';
        $this->nav = 'includes/nav.php';
        include_once('controller/HeadController.php');
        $this->nav = new HeadController();
        $this->nav->invoke();

    } //end constructor
    public function setDatabase(PDO $conn)
    {
        $this->conn = $conn;
    }
    public function invoke()
    {
        if (isset($_GET['blog'])) {

            $post = new Post();
            $post->setDatabase($this->conn);
            $post->load($_GET['blog']);

            $this->blog = $post;

            $this->template = 'view/'.$this->view.'Template.php';
            include_once('view/'.$this->view.'.php');
            //create a new view and pass it our template
            $view = new BlogView($this->template,$this->footer,$this->blog);
        }
    }
} //end class
