<?php
class User
{
	private $firstName;
	private $lastName;
	private $username;
	private $pass;
	private $email;
	private $firstLogin;
	private $lastLogin;
	private $accessLevel;
	

	public function __construct($username, $firstName, $lastName, $pass, $email, $firstLogin, $lastLogin, $accessLevel)
	{
		$this->username = $username;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->pass = $pass;
		$this->email = $email;
		$this->firstLogin = $firstLogin;
		$this->lastLogin = $lastLogin;
		$this->accessLevel = $accessLevel;
		
	} //end constructor
	
	//Username
	public function setUsername($username)
	{
		$this->username = $username;
	}
	public function getUsername()
	{
		return $this->username;
	}
	
	//First name
	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;
	}
	public function getFirstName()
	{
		return $this->firstName;
	}
	
	//Last name
	public function setLastName($lastName)
	{
		$this->lastName = $lastName;
	}
	public function getlastName()
	{
		return $this->lastName;
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
	public function setPass($pass)
	{
		$this->pass = $pass;
	}
	public function getPass()
	{
		return $this->pass;
	}
	
	//First Login
	public function setFirstLogin($firstLogin)
	{
		$this->firstLogin = $firstLogin;
	}
	public function getFirstLogin()
	{
		return $this->firstLogin;
	}
	
	//Last Login
	public function setLastLogin($lastLogin)
	{
		$this->lastLogin = $lastLogin;
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
} //end class
?>