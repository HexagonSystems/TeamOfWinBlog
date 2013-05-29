<?php
class Router
{
	public function __construct($conn)
	{
	}
	Static public function route($conn)
	{
		//fetch the passed request
		$request = $_SERVER['QUERY_STRING'];
		//parse the page request and other GET variables
		$parsed = explode('&' , $request);
		//the location is the first element
		$location = array_shift($parsed) ;
		$page = explode('=' , $location);
		//the rest of the array are get statements, parse them out.
		$getVars = array();
		foreach ($parsed as $argument)
		{
			//explode GET vars along '=' symbol to separate variable, values
			list($variable , $value) = explode('=' , $argument);
			$getVars[$variable] = $value;
		}
		if(isset($page[1]))
		{
			if($page[1] == "indexPage"){
				include_once("controller/IndexController.php");
				$controller = new IndexController();
				$controller->invoke();
			}
			else if($page[1] == "loginPage"){
				if(isset($page[2])){
					if(isset($page[2])){
						include_once("controller/LoginController.php");
						$controller = new LoginController($conn);
						$controller->invoke();
					}
				}else
				{
					include_once("controller/LoginController.php");
					$controller = new LoginController($conn);
					$controller->invoke();
				}
			}
		}

		else
		{
			include_once("controller/IndexController.php");$controller = new IndexController();
			$controller->invoke();
		}
	}// end route
} //end clas
?>