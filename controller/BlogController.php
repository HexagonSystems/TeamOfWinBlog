<?php
session_start();
require_once 'model/Post.php';
class BlogController
{
	private $model;
	private $template;
	private $header;
	private $footer;
	private $comments;
	private $blog;
	private $nav;
	private $conn;

	private $loggedOutView = 'BlogView';
	private $loggedInView = 'loggedInView';

	public function __construct()
	{
		$this->header = 'includes/header.php';
		$this->footer = 'includes/footer.php';
		$this->nav = 'includes/nav.php';

	} //end constructor
	public function setDatabase(PDO $conn)
	{
		$this->conn = $conn;
	}
	public function invoke()
	{
		if (isset($_GET['blog']))
		{
			
			$post = new Post();
			$post->setDatabase($this->conn);
			$post->loadPost($_GET['blog']);
			
			$this->blog = $post;

			
			$this->template = 'view/'.$this->loggedOutView.'Template.php';
			include_once('view/'.$this->loggedOutView.'.php');
			//create a new view and pass it our template
			$view = new BlogView($this->template,$this->header,$this->footer,$this->nav,$this->blog);
		}
	}
} //end class