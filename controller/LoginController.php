<?php
include_once("model/Users.php");
session_start();
class LoginController
{
	private $model;
	private $template;
	private $header;
	private $footer;
	private $nav;
	public function __construct()
	{
		$this->model = new Users();
		$this->header = 'includes/header.php';
		$this->footer = 'includes/footer.php';
		$this->nav = 'includes/nav.php';
	} //end constructor
	public function invoke()
	{
		if (!isset($_GET['action']))
		{
			$this->template = 'view/LoginViewTemplate.html';
			include_once('view/LoginView.php');
			//create a new view and pass it our template
			$view = new LoginView($this->template,$this->header,$this->footer,$this->nav);
			$content ="";
			$view->assign('title' , 'Loggged in');
			$view->assign('content' , $content);
		}
		else if ($_GET['action']==='logout')
		{
			$this->template = 'view/LoginViewTemplate.html';
			include_once('view/LoginView.php');
			//create a new view and pass it our template
			$view = new LoginView($this->template,$this->header,$this->footer,$this->nav);
			$content ="";
			if (isset($_SESSION['userLogin']) && isset($_SESSION['isLogged']))
			{
				unset($_SESSION['userLogin']);
				unset($_SESSION['isLogged']);
				unset($_SESSION['firstName']);
				session_destroy();
			}
			// for testing purposes only
			// check to see if logged in session set
			if (!isset($_SESSION['userLogin']) && !isset($_SESSION['isLogged']))
			{
				echo "yes session destroyed";
			}
			$view->assign('title' , 'Loggged out');
			$view->assign('content' , $content);
			// header('location: index.php');
		}
		else if($_GET['action']==='login')
		{
			if($this->model->checkUsername($_POST['username']))
			{
				if($this->model->checkPassword($_POST['username'],($_POST['pass'])))
				{
					$user = $this->model->getUser($_POST['username']);

					$_SESSION['userLogin'] = $user->getUsername();
					$_SESSION['firstName'] = $user->getFirstName();
					$_SESSION['isLogged'] = 1;
					$_SESSION['accessLevel'] = $user->getAccessLevel();
					$_SESSION['userl'] = $user;
					$user2= $_SESSION['userl'];
					echo "user2 " . $user2->getUsername().'</br>';
					echo "SESSIONS HAVE BEEN SET";

					header('location: index.php?location=loginPage&action=success');
					/*$view->assign('title' , 'Logged In');
					 $view->assign('content' , $content);*/
					//header('location: index.php?location=homePage&action=main');
				}else
				{
					echo "Problems with login, try again!";
					header('location: index.php?location=loginPage&action=fail');
				}
			}
			else
			{
				echo "Problems with login, try again!";
				header('location: index.php?location=loginPage&action=fail');
			}
		}
	else if($_GET['action']==='success'){
		echo "LOGGED IN!!!!!!";
	}
	else if($_GET['action']==='fail'){
		echo "Didn't log in";
	}
	else
	{
		$this->template = 'view/loginViewTemplate.html';

		include_once('view/LoginView.php');
		//create a new view and pass it our template
		$view = new LoginView($this->template,$this->header,$this->footer,$this->nav);
		$content ="";

		/*
		 * Checks if the userLogin session exists
		*/
		/*if(isset($_SESSION['userLogin'])){
		 echo $_SESSION['userLogin'].' THIS IS THE USERNAME</br>';
		} else {
		echo "FAIL userLogin";
		}

		Checks if the isLogged session exists

		if(isset($_SESSION['isLogged'])){
		echo $_SESSION['isLogged'].' THIS IS THE isLogged VARIABLE</br>';
		}*/



		/*
		 * unsets the session variables
		*
		session_unset('userLogin');
		session_unset('firstName');
		session_unset('isLogged');
		session_unset('accessLevel');
		session_unset('userl');*/

		// for testing purposes only
		if (isset($_SESSION['userLogin']) && isset($_SESSION['isLogged']))
		{
			//echo "<br />Yes session created";
			if($_SESSION['accessLevel'] == 1)
			{
				echo "<br />Yes User is Admin";
				//show menu for member
			}
			else if($_SESSION['accessLevel'] == 2)
			{
				echo "<br />Yes User is Member";
				//show menu for member
			}

		} // isset($_SESSION['userLogin'] and isset($_SESSION['isLogged']
		else
		{
			echo "<br />No user is guest";
			//show menu for guest
		}
	}// end else process login
} // end function
} //end class