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
	private $newPassView = 'newPass';
	
	private $mailData = array(
		'header'	=> 'Hi!',
		'content'	=> FALSE,
		'link'		=> FALSE,
		'footer'	=> 'TOW Blog'	
	);
	
	private $instructions = array(
			'hash'	=> FALSE,
			'email'	=> FALSE,
			'action'=> FALSE,
			'data'	=> FALSE
	);
	
	private $forgotPasswordContent = "Click this link to reset your password";
	private $registerAccountContent = "Click this link to register your account";
	private $post;
	private $get;
	
	public function __construct($get = FALSE, $post = FALSE)
	{
		if($get != false){
			$this->get = $get;
		}else{
			$this->get = $_GET;
		}
		if($post != false){
			$this->post = $post;
		}else{
			$this->post = $_POST;
		}
		
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
		if (isset($this->get['action']))
		{			
			/*
			 * Mail sent screen
			 * 
			 * This is where the hash is generated
			 */
			if($this->get['action'] == 'mailSent')
			{
					if(isset($this->post['action']))
					{
						/*
						 * How this works:
						 * Step 1: get instruction data through post data
						 * 	- instructions email (this is the identifier)
						 *  - action (to determine if the user is trying to register their account, or reset their password
						 *  Step 2: Set up the models
						 * 	- Models in use:
						 * 		- Verify
						 * 		- User
						 * Step 3: Check if the email provided is valid
						 * 	- Assume the email is valid for this step to step guide
						 * Step 4: Check when the last hash was created for this action
						 * Step 5:
						 * 	- If there is no previous hash, generate a new one, skip Step 6
						 * 	- If there is a previous hash move on to Step 6
						 * Step 6:
						 * 	- If it is time to create a new hash, create a new hash
						 * 	- If the last hash has not expired yet, use this as the current hash
						 */
						
						$user = new User($this->database);
						
						/*
						 * Step 1: Gather data
						 * As both a username and an email can be passed through to this function
						 * The code first checks to see which one was passed through by trying to get the data if it is set
						 * 
						 * After this a simple check is done to see: (I will use 'username' for this example'
						 * 	- If the username isn't set
						 * 	- Check to see if the email was passing in instead (assume true)
						 * 	- Query the User model function getUsernameFromEmail($username)
						 * 	- Use this as the username
						 * 
						 * Obviously the exceptions would include if both pieces of data arn't set, or if a username/email can't be found.
						 * If this is the case the system will exit(), although, this should be updated to produce a visually nice error message
						 */
						
						
						//Gather data from $this->post
						if(isset($this->post['email'])){
							$this->instructions['email'] = $this->post['email'];
						}
						if(isset($this->post['username'])){
							$this->instructions['username'] = $this->post['username'];
						}
						
						//Gather data that wasn't passed through
						if(!isset($this->post['email'])){
							if(isset($this->instructions['username'])){
								$this->instructions['email'] = $user->getEmailFromUsername($this->instructions['username']);
								if($this->instructions['email'] == ""){
									exit ("Email failed");
								}
							}else{
								//Username not provided
								exit("Username not provided");
							}
						}else{
							echo "Email set".$this->instructions['email'];
						}
						
						if(!isset($this->post['username'])){
							if(isset($this->instructions['email'])){
								$this->instructions['username'] = $user->getUsernameFromEmail($this->instructions['email']);
							}else{
								//Email not provided
								exit("Email not provided");
							}
						}
						
						//Check if the data gathered is valid data
						$emailCheck = $user->checkEmail($this->instructions['email']);
						if($emailCheck !== "Email found")
						{
							//Email not valid
							exit($emailCheck);
						}
						$usernameCheck = $user->checkUsername($this->instructions['username']);
						if($usernameCheck !== "Username found")
						{
							//Username not valid
							exit($usernameCheck);
						}
						
						if(isset($this->post['action']))
						{
							$this->instructions['action'] = $this->post['action'];
							if($this->instructions['action'] !== 'registerAccount' && $this->post['action'] !== 'resetPassword')
							{
								//Action not valid
								exit("Action not valid");
							}
						}else{
							//Action not provided
							exit("Action was not provided");
						}
						
						//Start the Verify class
						require_once 'model/Verify.php';
						$verify = new Verify();
						$verify->setDatabase($this->database);
						
						//Check the email exists in the database
						
						echo "Before hash checker<br/>";
							
						$timeOfLastHash = $verify->getTimeOfLastHash($this->instructions['email'], $this->instructions['action']);
						//$verify->timeToCreateNewHash($timeOfLastHash, $this->instructions['action']);
						if($timeOfLastHash === "null")
						{
							//Build the hash
							$this->instructions['hash'] = $verify->buildHash($this->instructions['email'], $this->instructions['action'] = $this->post['action']);
						}else if($timeOfLastHash !== false)
						{
							if($verify->timeToCreateNewHash($timeOfLastHash, $this->instructions['action'] = $this->post['action']))
							{
								//Build a new hash
								$this->instructions['hash'] = $verify->buildHash($this->instructions['email'], $this->instructions['action'] = $this->post['action']);
							}else{
								$lastHash = $verify->getLashHash($this->instructions['email'], $this->instructions['action'] = $this->post['action']);
								if($lastHash != false && $lastHash != null){
									$this->instructions = $lastHash;
								}else{
									exit("Something went wrong".$lastHash);
								}
							}
						}else
						{
							exit("Something went wrong");
						}
											
						$this->template = 'view/MailSentTemplate.php';
						include_once('view/MaiLView.php');
						//create a new view and pass it our template
						$view = new MailView($this->template,$this->footer);
						$view->assignInstructions($this->instructions);
						$this->nav ->invoke();

					}else
					{
						//Action not provided
						exit("Action not provided");
					}
			}
			
			/*
			 * View Mail Screen
			 */
			else if($this->get['action'] == 'mailView')
			{
				if(!isset($this->get['email']) || !isset($this->get['code']))
				{
					exit("Data missing");
				}
				
				//Get data
				$verifyCode 	= $this->get['code'];
				$email			= $this->get['email'];
				
				//Retrieve the hash instructions
				$verify = new Verify();
				$verify->setDatabase($this->database);
				$this->instructions = $verify->retreiveInstructions($verifyCode, $email);
				//Build the mail data
				if($this->instructions){
					$this->mailData['link'] = $this->instructions['hash'];
					if($this->instructions['action'] == 'resetPassword'){
						$this->mailData['content'] = $this->forgotPasswordContent;
					}else if($this->instructions['action'] == 'registerAccount'){
						$this->mailData['content'] = $this->registerAccountContent;
					}else{
						//Error
						exit("No action found");
					}
				}else{
					exit("Retrieiving data failed");
				}
				
				$this->template = 'view/'.$this->mailView.'Template.php';
				include_once('view/'.$this->mailView.'View.php');
				//create a new view and pass it our template
				$view = new MailView($this->template,$this->footer);
				$view->assignMailData($this->mailData);
				$view->assignInstructions($this->instructions);
			}
			
			/*
			 * Validate and run hash code
			 */
			else if($this->get['action'] == 'validate')
			{
				if(!isset($this->get['email']) || !isset($this->get['code']))
				{
					exit("Data missing");
				}
				
				//Get data
				$verifyCode 	= $this->get['code'];
				$email			= $this->get['email'];
				
				//Retrieve the hash instructions
				$verify = new Verify();
				$verify->setDatabase($this->database);
				$this->instructions = $verify->retreiveInstructions($verifyCode, $email);
				
				if($this->instructions['action'] == 'resetPassword')
				{
					if(isset($this->post['newPass'])){
						//reset password
						$user = new User($this->database);
						$username = $user->getUsernameFromEmail($email);
						if($username !== false)
						{
							$user->automaticLogin($username, false);
							$user->setPassword($this->post['newPass']);
							$result = $user->updateUser();
							if($result == "Updated"){
								echo $username." updated";
							}else{
								exit("Error: ".$result);
							}
							
						}else{
							exit("Something went wrong");
						}
					}else{
						//Display enter new password screen
						$this->template = 'view/'.$this->newPassView.'Template.php';
						include_once('view/'.$this->mailView.'View.php');
						//create a new view and pass it our template
						$view = new MailView($this->template,$this->footer);
					}
					
				}else if($this->instructions['action'] == 'registerAccount')
				{
					//register account
					$user = new User($this->database);
					$username = $user->getUsernameFromEmail($email);
					if($username !== false)
					{
						$user->automaticLogin($username, false);
						$user->setAccessLevel(5);
						$result = $user->updateUser();
						if($result == "Updated"){
							echo $user->getUsername()." validated";
						}else{
							echo "Error: ".$result;
						}
					}else{
						exit("Something went wrong");
					}
				}else
				{
					//Error
					exit("No action found");
				}
				
			}
			
			/*
			 * Action provided invalid
			 */
			else{
				exit("Action not valid HERE".$this->get['action']);
			}
		}else{
			exit("No action provided (end else)");
			//header("Location: index.php?location=indexPage");
		}
	
	} // end function
}

?>