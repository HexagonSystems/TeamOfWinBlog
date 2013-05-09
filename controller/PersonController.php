<?php
include_once("model/Persons.php");
class PersonController
{
	private $model;
	private $template;
	private $header;
	private $footer;
	private $nav;
	public function __construct()
	{
		$this->model = new Persons();
		$this->header = 'includes/header.php';
		$this->footer = 'includes/footer.php';
		$this->nav = 'includes/nav.php';
	} //end constructor
	public function invoke()
	{
		if (!isset($_GET['id']))
		{
			// no special person is requested, we'll show a list of all available persons
			$this->template = 'view/PersonsTemplate.html';
			$persons = $this->model->getPersonList();
			//WORKING $this->model->createPerson('Bob','24','Male');
			//WORKING $this->model->changePerson('2', 'age', '99');
			//WORKING $this->model->deletePerson('6');
			include_once('view/PersonsView.php');
			//create a new view and pass it our template
			$view = new PersonsView($this->template,$this->header,$this->footer,$this->nav);
			// show the persons list
			$content ="";
			foreach ($persons as $name => $person)
			{
				$content = $content . '<tr><td><a href="' . SITE_ROOT
				.'/index.php?location=page2&action=view&id='.$person->getId().'">'.$person->getName().'</a></td><td>'.$person->getAge().'</td><td>'.$person->getGender().'</td></tr>';
			}
			$view->assign('title' , 'Persons Details');
			$view->assign('content' , $content);
		}
		else
		{
			$this->template = 'view/PersonTemplate.html';$person = $this->model->getPerson($_GET['id']);
			include_once('view/PersonView.php');
			//create a new view and pass it our template
			$view = new PersonView($this->template,$this->header,$this->footer,$this->nav);
			// show the requested person
			$content ="";
			$content = 'Name:' . $person->getName() . '<br/>';
			$content = $content . 'Age:' . $person->getAge() . '<br/>';
			$content = $content . 'Gender:' . $person->getGender() . '<br/>';
			$view->assign('title' , 'Person Details');
			$view->assign('content' , $content);
		} // end else
	} // end function
} //end class
?>