<?php
include_once("model/User.php");
class Users {

	public function getUserList()
	{
		//global $conn;
		//$sql = "SELECT * FROM user";
		//$resultSet = $conn->query($sql) or die("failed!");
		//$arrayofUsers = array();
		/*while($row= $resultSet ->fetch(PDO::FETCH_ASSOC))
		 {
		$username = $row['username'];
		$firstName = $row['firstName'];
		$lastName = $row['lastName'];
		$pass = $row['pass'];
		$email = $row['email'];
		$firstLogin = $row['firstLogin'];
		$lastLogin = $row['lastLogin'];

		$arrayOfUsers[$username] = (new User($username, $firstName, $lastName, $pass, $email, $firstLogin, $lastLogin));
		}*/

		//return $arrayofUsers;

		//TEMP CODE
		$tempUsers = array();
		$tempUsers['firstPerson'] = new User('firstPerson', 'Bob', 'Fred', 'password', 'MrBob@gmail.com', '0', '0', '1');
		$tempUsers['secondPerson'] = new User('secondPerson', 'Spam', 'fgdfg', 'passdfgssdfgsword', 'MrBob@gmsdfgsdfgail.com', '01', '01', '2');
		return $tempUsers;

	} // end function
	public function getUser($username)
	{
		// we use the previous function to get all the users and then we return the requested one.
		// in a real life scenario this will be done through a db select command
		$allUsers = $this->getUserList();
		return $allUsers[$username];

	} // end function

	public function checkUsername($username){
		$allUsers = $this->getUserList();

		if(array_key_exists($username, $allUsers)){
			return true;
		} else {
			return false;
		}
	}

	public function checkPassword($username, $password){
		$user = $this->getUser($username);

		if($password == $user->getPass()){
			return true;
		} else {
			return false;
		}
	}

	/*
	 * STUFF TO USE LATER
	*
	public function createUser($name, $age, $gender){
	global $conn;
	$sql = "INSERT INTO user(name, age, gender) VALUES(:name,:age,:gender)";
	$resultSet = $conn->prepare($sql);
	$resultSet->execute(array(':name'=>$name,':age'=>$age,':gender'=>$gender));
	}

	public function changeUser($username, $attribute, $value){
	global $conn;
	$sql = "UPDATE user SET ".$attribute." = '".$value."' WHERE id = '".$username."'";
	//$resultSet = $conn->prepare($sql);
	$resultSet = $conn->query($sql);
	}
	public function deleteUser($username){
	global $conn;
	$sql = "DELETE FROM user WHERE id=?";
	$resultSet = $conn->prepare($sql);
	$resultSet->execute(array($username));
	}
	*/
} //end class
?>