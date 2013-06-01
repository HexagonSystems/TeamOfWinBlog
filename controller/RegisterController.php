<?php
session_start();
require_once 'model/User.php';
class RegisterController
{
	private $model;
	private $template;
	private $header;
	private $footer;
	private $nav;
	private $conn;

	private $fileName = 'RegisterView';
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
			$view = new RegisterView($this->template,$this->header,$this->footer,$this->nav);
			$content ="";
			$view->assign('title' , 'Register');
			$view->assign('content' , $content);
			
		}elseif (isset($_GET['action'])){
			if($_GET['action'] == 'register')
			{
				$user = new User($this->conn);
				if(isset($_POST['username']))
				{
					if(isset($_POST['email']))
					{
						if(isset($_POST['pass']))
						{
							if(isset($_POST['pass2']))
							{
								//Check that password 1 and 2 match
								if($_POST['pass'] === $_POST['pass2'])
								{
									//create the user
									$user = $user->createUser($_POST["username"], $_POST["pass"], $_POST["email"], 2);	
									//save the user
									$user = $user->save();
								}else
								{
									//if $_POST['pass'] isn't === $_POST['pass2'] 
									echo "Passwords do not match";
								}
							}else
							{
								//if $_POST['pass2'] isn't set
								echo "Password Again is not set";
							}
						}else
						{
							//if $_POST['pass'] isn't set
							echo "Password is not set";
						}
					}else
					{
						//if $_POST['email'] isn't set
						echo "Email is not set";
					}
				}else
				{
					//if $_POST['username'] isn't set	
					echo "Username is not set";
				}
				
			}
		}
		{
			
		}

	} // end function
} //end class