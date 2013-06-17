<?php
session_start();
require_once 'model/User.php';
class RegisterController
{
	private $model;
	private $template;
	private $footer;
	private $nav;
	private $conn;

	private $loggedOutView = 'RegisterView';
	private $loggedInView = 'loggedInView';

	public function __construct(PDO $conn)
	{
		$this->footer = 'includes/footer.php';
		include_once("controller/HeadController.php");
		$this->nav = new HeadController();
		$this->nav ->invoke();
		$this->conn = $conn;

	} //end constructor
	public function invoke()
	{
		if (!isset($_GET['action']))
		{
			$this->template = 'view/'.$this->loggedOutView.'Template.php';
			include_once('view/'.$this->loggedOutView.'.php');
			//create a new view and pass it our template
			$view = new RegisterView($this->template,$this->footer);
			$content ="";
			$view->assign('title' , 'Loggged in');
			$view->assign('content' , $content);
		}elseif (isset($_GET['action'])){
			if($_GET['action'] == 'Register')
			{
				$user = new User($this->conn);
				if(isset($_POST['username']) && isset($_POST['pass']))
				{
					$user = $user->RegisterUser($_POST["username"], $_POST["pass"]);
					if(!is_a($user, 'User')){
						//NOt logged In
						echo $user;
						$this->template = 'view/'.$this->$loggedOutView.'Template.php';
						include_once('view/'.$this->$loggedOutView.'.php');
						//create a new view and pass it our template
						$view = new RegisterView($this->template,$this->header,$this->footer,$this->nav);
						$content ="";
						$view->assign('title' , 'Loggged in');
						$view->assign('content' , $content);
					}else
					{
						echo $user->getEmail();
					}
				}else
				{
					//if $_POSTs arn't set
					//NOt logged In
					echo "Post not set";
					$this->template = 'view/'.$this->$loggedOutView.'Template.php';
					include_once('view/'.$this->$loggedOutView.'.php');
					//create a new view and pass it our template
					$view = new RegisterView($this->template,$this->header,$this->footer,$this->nav);
					$content ="";
					$view->assign('title' , 'Loggged in');
					$view->assign('content' , $content);
				}

			}else if($_GET['action'] == 'register')
			{
				echo "attempting to register<br/>";
				$user = new User($this->conn);
				if(isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['email']))
				{
					$user = $user->createUser($_POST["username"], $_POST["pass"], $_POST["email"], "1");
					if(!is_a($user, 'User')){
						//NOt logged In
						echo $user;
						$this->template = 'view/'.$this->$loggedOutView.'Template.php';
						include_once('view/'.$this->$loggedOutView.'.php');
						//create a new view and pass it our template
						$view = new RegisterView($this->template,$this->header,$this->footer,$this->nav);
						$content ="";
						$view->assign('title' , 'Loggged in');
						$view->assign('content' , $content);
					}else
					{
						echo $user->save();
						
					}
				}
			}else{
				echo "failed";
			}
		}
		{

		}

	} // end function
} //end class