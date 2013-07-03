<?php
/**
 * Handles the view functionality of our MVC framework
 */
class MailView
{
	/**
	 * Holds render status of view.
	*/
	private $render = FALSE;
	private $footer = FALSE;
	private $mailData = FALSE;
	private $instructions = FALSE;
	/**
	 * Accept a template to load
	 */
	public function __construct($template,$footer)
	{
		// echo "In Consttructor" ;
		if (file_exists($template))
		{
			/**
			 * trigger render to include file when this model is destroyed
			 * if we render it now, we wouldn't be able to assign variables
			 * to the view!
			 */
			$this->render = $template;
		}
		if (file_exists($footer))
		{
			/**
			 * trigger render to include file when this model is destroyed
			 * if we render it now, we wouldn't be able to assign variables
			 * to the view!
			 */
			$this->footer = $footer;
		}
	}
	
	public function assignMailData($mailData){
		$this->mailData = $mailData;
	}
	
	public function assignInstructions($instructions){
		$this->instructions = $instructions;
	}
	/*** Receives assignments from controller and stores in local data array
	 *
	* @param $variable
	* @param $value
	*/
	public function assign($variable , $value)
	{
		$this->data[$variable] = $value;
	}
	public function __destruct()
	{
		//parse data variables into local variables, so that they render to the view
		$mailData = $this->mailData;
		$instructions = $this->instructions;
		//echo "In Destructor" ;
		//render view
		include_once($this->render);
		include_once($this->footer);
	}
} //end class