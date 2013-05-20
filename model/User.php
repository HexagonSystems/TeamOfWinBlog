<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

class User
{
	private $database;
	private $username;
	public $password;
	private $email;
	private $firstLogin;
	private $lastLogin;
	private $accessLevel;

	/**
	 * Constructor with extra quick create/login
	 * @param type $database sets the database connection
	 * @param type $userArray Optional must contain a key of "new" or "login" needs "username", "password" [, "email", "accessLevel"]
	 * @return type returns this object
	 */
	public function __construct( PDO $database, $userArray = array('') )
	{

		$this->database = $database;

		if( isset($userArray["new"]) ){

			$this->createUser($userArray["username"], $userArray["password"], $userArray["email"], $userArray["accessLevel"]);

			return($this);

		}elseif (isset($userArray["login"]) ) {

			$this->loginUser($userArray["username"], $userArray["password"]);

			return($this);
		}


	}


	/**
	 * Creates a new user
	 *
	 * @param type $username
	 * @param type $password
	 * @param type $email
	 * @param type $firstLogin
	 * @param type $lastLogin
	 * @param type $accessLevel
	 */
	public function createUser($username, $password, $email, $accessLevel)
	{
		if($this->checkUsername($username) == "Username not found"){

			$this->setUsername($username);

			if($this->checkEmail($email) == "Email not found"){

				$this->setEmail($email);

			}else{

				return($this->checkEmail($email));

			}

			$this->setPassword($password);

			$this->setFirstLogin();
			//$this->setLastLogin(time());

			$this->setAccessLevel($accessLevel);

			//If success return this object
			return($this);

		}else{

			return($this->checkUsername($username));
		}

		return($this);

	} //end createUser

	public function checkUsername($username)
	{

		try{
			$user = $this->database->query("select username from users where username = '$username'")->fetch();

		}catch(Exception $e){
			throw new Exception( 'Database error:', 0, $e);
			return;
		};

		if($user !== false){
			return("Username found");
		}else{
			return("Username not found");
		}

	}// end checkUsername

	public function checkExists($data, $type)
	{

		try{
			$user = $this->database->query("select $type from users where $type = '$data'")->fetch();

		}catch(Exception $e){
			throw new Exception( 'Database error:', 0, $e);
			return;
		};

		if($user !== false){
			return("Data found");
		}else{
			return("Data not found");
		}

	}// end checkUsername

	public function checkEmail($email)
	{

		try{
			$user = $this->database->query("select * from users where email = '$email'")->fetch();

		}catch(Exception $e){
			throw new Exception( 'Database error:', 0, $e);
			return;
		};

		if($user !== false){
			return("Email found");
		}else{
			return("Email not found");
		}

	}// end checkEmail
	 

	public function checkPassword($password)
	{
		//$password = sha1($password);

		if($this->getPassword() === $password){
			return true;
		}  else {
			return false;
		}
	}// end checkPassword


	public function loginUser($username, $password)
	{
		if($this->checkUsername($username) == "Username not found"){
			return("Username not found");
		}

		//Collect User from the database
		try{
			$user = $this->database->query("SELECT * FROM users WHERE username = '$username'")->fetch();

		}catch(Exception $e){
			throw new Exception( 'Database error:', 0, $e);
			return;
		};

		//map the single row to be the whole array
		//$user = $user[0];

		//Set the password
		$this->setPassword($user["password"]);
		echo "Database password: ".$user["password"]."<br/>";

		if(!$this->checkPassword($password)){
			//Else errors
			/*
			 * Error handling:
			*
			* echo "Username: ".$username
			."<br/>Entered Password: ".$password
			."<br/>Actual Password: ".$this->getPassword()
			."<br/>";*/
			return("Password Incorrect");
		};
			

		echo "Login succussful!";
		$this->setUsername($user["username"]);

		$this->setEmail($user["email"]);

		//$this->firstLogin = $firstLogin;
		$this->setLastLogin();

		$this->setAccessLevel($user['ACL']);



		//If success return this object
		return($this);

	}//end loginUser

	/**
	 * Save user to database
	 *
	 * @todo Get this working correctly the current INSERT is in correct
	 * @return string - Either error messages or saved
	 */
	public function Save() {

		try{

			$statement = "INSERT INTO `users` (`username`, `email`, `password`, `createDate`, `ACL`, `lastLoginDate`)
					VALUES (:username, :email, :userPassword, :createDate, :ACL, :lastLoginDate)";

			$statement = $this->database->prepare($statement);

			$statement->execute(array( ':username' => $this->getUsername()
					, ':email' => $this->getEmail()
					, ':userPassword' => $this->getPassword()
					, ':createDate' => $this->getFirstLogin()
					, ':ACL' => $this->getAccessLevel()
					, ':lastLoginDate' => $this->getFirstLogin()
			));

		}catch(Exception $e){
			throw new Exception( 'Database error:', 0, $e);
			return;
		};

		return("saved");
	}

	//Username
	public function setUsername($username)
	{
		$this->username = $username;
	}
	public function getUsername()
	{
		return $this->username;
	}

	//Email
	public function setEmail($email)
	{
		$this->email = $email;
	}
	public function getEmail()
	{
		return $this->email;
	}

	//Password
	public function setPassword($password)
	{
		//$password = sha1($password);
		$this->password = $password;
	}
	public function getPassword()
	{
		return $this->password;
	}

	//First Login
	public function setFirstLogin()
	{
		$this->firstLogin =  date('Y-m-d H:i:s');
	}
	public function getFirstLogin()
	{
		return $this->firstLogin;
	}

	//Last Login
	public function setLastLogin()
	{
		$this->lastLogin = time();
	}
	public function getlastLogin()
	{
		return $this->lastLogin;
	}

	//Access Level
	public function setAccessLevel($accessLevel)
	{
		$this->accessLevel = $accessLevel;
	}
	public function getAccessLevel()
	{
		return $this->accessLevel;
	}

	public function sessionCreate(){
		if(!empty($this->username)){
			$_SESSION['account'] = array('username'=>$this->getUsername(), 'access'=>$this->getAccessLevel());
			$_SESSION['accountObject'] = serialize($this);
		}
	}

	public function sessionDestroy(){
		if(isset($_SESSION['account'])){
			session_unset('account');
		}
		if(isset($_SESSION['accountObject'])){
			session_unset('accountObject');
		}
	}
} //end class
?>