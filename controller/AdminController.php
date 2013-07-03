<?php
session_start();
require_once 'model/User.php';
class AdminController
{
	private $model;
	private $template;
	private $footer;
	private $nav;
	private $conn;

	private $fileName = 'AdminView';
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
			
			$user = new User($this->conn);
			$data = $user->displayUsers();
			
			$this->template = 'view/'.$this->fileName.'Template.php';
			include_once('view/'.$this->fileName.'.php');
			//create a new view and pass it our template
			$view = new AdminView($this->template,$this->footer);
			//$content ="$data";
			//$view->assign('title' , 'Loggged in');
			$view->assign('content' , $data);
			

		}elseif (isset($_GET['action'])){
		$user = new User($this->conn);
			if($_GET['action'] == 'suspendUser')
			{
				var_dump($_POST);
				//$user = $user->updateAccessLevel($_POST["username"], 1);
				if ($_GET['username'])
				{
					$user->updateAccessLevel($_GET['username'], 1);
					header("Location: index.php?location=adminPage");
				}
			}
			if($_GET['action'] == 'unsuspendUser')
			{
				if ($_GET['username'])
				{
					$user->updateAccessLevel($_GET['username'], 5);
					header("Location: index.php?location=adminPage");
				}
				
			}
			
			
		}
	} // end function
} //end class