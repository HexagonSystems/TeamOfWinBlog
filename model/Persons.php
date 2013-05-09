<?php
include_once("model/Person.php");
class Persons {
	
	public function getPersonList()
	{
		global $conn;
		$sql = "SELECT * FROM person";
		$resultSet = $conn->query($sql) or die("failed!");
		$arrayOfPeople = array();
		while($row= $resultSet ->fetch(PDO::FETCH_ASSOC))
		{
			$id = $row['id'];
			$name = $row['name'];
			$age = $row['age'];
			$gender = $row['gender'];

			$arrayOfPeople[$id] = (new Person($id, $name, $age, $gender));
		}

		return $arrayOfPeople;

	} // end function
	public function getPerson($id)
	{
		// we use the previous function to get all the persons and then we return the requested one.
		// in a real life scenario this will be done through a db select command
		$allPersons = $this->getPersonList();
		return $allPersons[$id];
	} // end function

	public function createPerson($name, $age, $gender){
		global $conn;
		$sql = "INSERT INTO person(name, age, gender) VALUES(:name,:age,:gender)";
		$resultSet = $conn->prepare($sql);
		$resultSet->execute(array(':name'=>$name,':age'=>$age,':gender'=>$gender));
	}

	public function changePerson($id, $attribute, $value){
		global $conn;
		$sql = "UPDATE person SET ".$attribute." = '".$value."' WHERE id = '".$id."'";
		//$resultSet = $conn->prepare($sql);
		$resultSet = $conn->query($sql);
	}
	public function deletePerson($id){
		global $conn;
		$sql = "DELETE FROM person WHERE id=?";
		$resultSet = $conn->prepare($sql);
		$resultSet->execute(array($id));
	}
} //end class
?>