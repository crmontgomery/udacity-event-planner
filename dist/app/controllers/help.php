<?php

class Help extends Controller {
	private $className;

	function __construct()
	{
    	parent::__construct();

		$this->className = strtolower(__CLASS__);
    	$this->view->js = array($this->className . '/js/' . $this->className);
	}

	function index()
	{

		$this->view->title = $this->className;
		$this->view->render($this->className . '/index');
	}
	
	// Create
	// Read
	// Update
	// Delete
}
