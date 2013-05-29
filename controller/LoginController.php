<?php
session_start();
require_once 'model/User.php';
class LoginController
{
	private $model;
	private $template;
	private $header;
	private $footer;
	private $nav;
	private $conn;

	private $fileName = 'loginView';
	public function __construct(PDO $conn)
	{
		$this->header = 'includes/header.php';
		$this->footer = 'includes/footer.php';
		$this->nav = 'includes/nav.php';
		$this->conn = $conn;
		
	} //end constructor
	public function invoke()
	{
		if (!isset($_GET['action']))
		{
			$this->template = 'view/'.$this->fileName.'Template.php';
			include_once('view/'.$this->fileName.'.php');
			//create a new view and pass it our template
			$view = new LoginView($this->template,$this->header,$this->footer,$this->nav);
			$content ="";
			$view->assign('title' , 'Loggged in');
			$view->assign('content' , $content);
		}elseif (isset($_GET['action'])){
			if($_GET['action'] == 'login')
			{
				$user = new User($this->conn);
				if(isset($_POST['username']))
				{
					if(isset($_POST['pass']))
					{
						$user = $user->loginUser($_POST["username"], $_POST["pass"]);
						if(!is_a($user, 'User')){
							echo $user;
						}else 
						{
							echo $user->getEmail();
						}
					}else
					{
						//if $_POST['password'] isn't set
					}
				}else
				{
					//if $_POST['username'] isn't set
				}
				
			}
		}
		{
			
		}

	} // end function
} //end class