<?php
class EditPostController
{
    private $template;
    private $header;
    private $footer;
    private $nav;
    private $conn;
    private $view = 'EditPostView';
    
    public function __construct(PDO $conn)
    {
        $this->header = 'includes/header.php';
        $this->footer = 'includes/footer.php';
        include_once('controller/HeadController.php');
        $this->nav = new HeadController();
        $this->nav->invoke();
        $this->conn = $conn;

    } //end constructor
    public function invoke()
    {
        if (!isset($_GET['action'])) {
            $this->template = 'view/'.$this->view.'Template.php';
            include_once('view/'.$this->view.'.php');
            //create a new view and pass it our template
            $view = new EditPostView($this->template, $this->footer);
            $view->assign('title', 'New');
        } elseif (isset($_GET['action'])) {
            
            $post = new Post();
            
            $post->setDatabase($this->conn);
            
            /**
             * @todo Rig up a full user here instead of crutching on $_SESSION
             */

            $postData = array('title' => $_POST['title'], 'displayStatus' => 'published', 'ACL' => 5, 'content' => $_POST['content'], 'username' => $_SESSION['activeUser']);
            
            if($post->create($postData)){
                
                $this->view = 'BlogView';
                $this->template = 'view/'.$this->view.'Template.php';
                include_once('view/'.$this->view.'.php');
                //create a new view and pass it our template
                $view = new BlogView($this->template,$this->footer,$post);
            }else{
                var_dump($post);
            }
        }

    } // end function
}
