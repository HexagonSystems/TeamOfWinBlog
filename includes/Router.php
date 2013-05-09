<?php
echo "<strong>Information on how the router sees the requests</strong> <br />";
class Router
{
	public function __Construct()
	{
	}
	Static public function route()
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
			if($page[1] == "page1")
			{
				echo "The page your requested is '$page[1]' Get a list off all persons";
				echo '<br/>';
				$vars = print_r($getVars, TRUE);
				echo "The following GET vars were passed to the page:<pre>".$vars."</pre>";
				include_once("controller/PersonController.php");
				$controller = new PersonController();
				$controller->invoke();
			}
			else if($page[1] == "page2")
			{
				echo "The page your requested is '$page[1]' Get details of a person with id of ". $_GET['id'];
				echo '<br/>';
				$vars = print_r($getVars, TRUE);
				echo "The following GET vars were passed to the page:<pre>".$vars."</pre>";
				include_once("controller/PersonController.php");
				$controller = new PersonController();
				$controller->invoke();
			}
			else if($page[1] == "loginPage"){
				//echo "The page your requested is '$page[1]' Get details of a person with id of ". $_GET['username'];
				echo '<br/>';
				$vars = print_r($getVars, TRUE);
				echo "The following GET vars were passed to the page:<pre>".$vars."</pre>";
				include_once("controller/LoginController.php");
				$controller = new LoginController();
				$controller->invoke();
			}
		}

		else
		{
			include_once("controller/PersonController.php");$controller = new PersonController();
			$controller->invoke();
		}
	}// end route
} //end clas
?>