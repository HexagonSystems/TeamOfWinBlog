<?php
class AccountController
{
    private $template;
    private $footer;
    private $nav;
    private $conn;
    private $fileName = 'AccountView';
    
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
        if (isset($_GET['action'])) {
            
            $user = unserialize($_SESSION['accountObject']);
            $user->setDatabase($this->conn);
            
            var_dump($user);
            
            if ($_GET['action'] == 'changeemail' && isset($_POST['password']) && isset($_POST['email'])) {
                if($user->checkPassword($_POST["password"])){
                    $user->setEmail($_POST["email"]);
                    echo 'email updated';
                }

            } elseif ($_GET['action'] == 'changepassword' && isset($_POST['oldpass']) && isset($_POST['newpass']) === isset($_POST['newpass2'])) {
                if($user->checkPassword($_POST["oldpass"])){
                    $user->setPassword($_POST["newpass"]);
                    $user->save();
                    echo 'password updated';
                }
            }
        }
        
        //Set the view
        $this->template = 'view/'.$this->fileName.'Template.php';
        include_once('view/'.$this->fileName.'.php');
        //create a new view and pass it our template
        $view = new AccountView($this->template,$this->footer);
    } // end function
}
