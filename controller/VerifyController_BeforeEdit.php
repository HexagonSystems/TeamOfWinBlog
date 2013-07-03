<?php

require_once 'model/Verify.php';

class VerifyController{
	
	private $model;
	private $template;
	private $footer;
	private $nav;
	private $database;
	
	private $mailView = 'mail';
	private $loggedInView = 'loggedInView';
	private $forgottenPassword = 'ResetPassword';
	
	private $mailData = array(
		'header'	=> 'Hi!',
		'content'	=> FALSE,
		'link'		=> FALSE,
		'footer'	=> 'TOW Blog'	
	);
	
	private $forgotPasswordContent = "Click this link to reset your password";
	private $registerAccountContent = "Click this link to register your account";
	
	public function __construct()
	{
		$this->footer = 'includes/footer.php';
		include_once("controller/HeadController.php");
		$this->nav = new HeadController();
		$this->nav ->invoke();
	
	} //end constructor
	
	public function setDatabase($database){
		$this->database = $database;
	}
	
	public function invoke()
	{
		if (isset($_GET['action'])){
			if($_GET['action'] == 'forgotPassword'){
				if(!isset($_POST['email'])){
					echo "EMAIL NOT SET";
					$this->template = 'view/ResetPasswordTemplate.php';
					include_once('view/'.$this->mailView.'View.php');
					//create a new view and pass it our template
					$view = new MailView($this->template,$this->footer);
					$content ="";
					$view->assign('title' , 'Loggged in');
					$view->assign('content' , $content);
				}else {
					/*$mail = new Mail();
					 $mail->addReceiver("alex-robinson@live.com");
					$mail->setSender("alex-robinson@live.com");
					$mail->setMessage("Click here to verify your account");
					$mail->setSubject("testingsubject");
					$mail->print();*/
					$email = $_POST['email'];
					require_once 'model/Verify.php';
					$verify = new Verify();
					$verify->setDatabase($this->database);
					$user = new User($this->database);
					$emailCheck = $user->checkEmail($email);
					echo $emailCheck."</br>";
					if($emailCheck === "Email found"){
						$this->mailData['link'] = $verify->buildHashLink($email, $_GET['action']);
					}else{
						echo "Email not found";
					}
					$this->template = 'view/MailSentTemplate.php';
					include_once('view/MaiLView.php');
					//create a new view and pass it our template
					$view = new MailView($this->template,$this->footer);
					$view->assignMailData($this->mailData);
				}
				require_once 'model/Mail.php';
			
			
			
			}
			else if($_GET['action'] == 'reset'){
				echo "about to reset mail";
				if(isset($_POST['mail'])){
					echo "reset mail";
				}
	
			}else if($_GET['action'] == 'validate')
			{
				echo "validate register";
				
			/**********************
			 * View mail
			 **********************/
			}else if($_GET['action'] == 'viewMail'){
				if(isset($_GET['mail'])){
					$verifyCode = $_GET['mail'];
					echo $verifyCode;
				}else{
					exit("No mail code provided");
				}
				
				$verify = new Verify();
				$verify->setDatabase($this->database);
				$instructions = $verify->retriveInstructions($verifyCode);
				if($instructions){
					$this->mailData['link'] = $instructions['hash'];
					if($instructions['action'] == 'forgotPassword'){
						$this->mailData['content'] = $this->forgotPasswordContent;
					}else if($instructions['action'] == 'registerAccount'){
						$this->mailData['content'] = $this->registerAccountContent;
					}else{
						//Error
						exit("No action found");
					}
				}else{
					exit("Retrieiving data failed");
				}
				
				print_r($this->mailData);
				$this->template = 'view/'.$this->mailView.'Template.php';
				include_once('view/'.$this->mailView.'View.php');
				//create a new view and pass it our template
				$view = new MailView($this->template,$this->footer);
				$view->assignMailData($this->mailData);
			}
			
			else{
				echo "fail";
			}
		}else{
			echo "no action provided";
			//header("Location: index.php?location=indexPage");
		}
	
	} // end function
	
}

?>