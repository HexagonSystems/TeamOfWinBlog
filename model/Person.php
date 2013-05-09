<?php
class Person
{
	private $name;
	private $age;
	private $gender;
	private $id;

	public function __construct($id, $name, $age, $gender)
	{
		$this->id = $id;
		$this->name = $name;
		$this->age = $age;
		$this->gender = $gender;
	} //end constructor
	public function setId($id)
	{
		$this->id = $id;
	}
	public function getId()
	{
		return $this->id;
	}
	public function setName($name)
	{
		$this->name = $name;
	}
	public function getName()
	{
		return $this->name;
	}
	public function setAge($age)
	{
		$this->age = $age;
	}
	public function getAge()
	{
		return $this->age;
	}
	public function setGender($gender)
	{
		$this->gender = $gender;
	}
	public function getGender()
	{
		return $this->gender;
	}
} //end class
?>