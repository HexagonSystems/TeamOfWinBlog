<?php
class HeadController
{
	public $header;
	public $nav;

	private $fileName = 'HeadView';
	public function __construct()
	{
		$this->header = 'includes/header.php';
		if(isset($_SESSION['activeUser'])&&($_SESSION['account']['access']=="10")){
		$this->nav = 'includes/nav10.php';
		}
		elseif(isset($_SESSION['activeUser'])){
			$this->nav = 'includes/nav5.php';
		}else{
			$this->nav = 'includes/nav0.php';				
		}
		
	} //end constructor
	public function invoke()
	{
		if (!isset($_GET['action']))
		{
			$this->template = 'view/'.$this->fileName.'Template.php';
			include_once('view/'.$this->fileName.'.php');
			//create a new view and pass it our template
			$view = new HeadView($this->template,$this->header,$this->nav);
			$content ="";
			$view->assign('title' , 'Loggged in');
			$view->assign('content' , $content);
		}

	} // end function
} //end class