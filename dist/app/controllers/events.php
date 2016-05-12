<?php

class Events extends Controller {

	private $className;

	function __construct()
	{
    	parent::__construct();
		Auth::handleLogin();
		$this->className = strtolower(__CLASS__);
    	$this->view->js = array($this->className . '/js/' . $this->className);
	}

	function index()
	{
    	
	}

	// Create
	// Read
	// Update
	// Delete
}
