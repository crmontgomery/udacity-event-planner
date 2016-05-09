<?php

class User extends Controller {

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
    	$this->view->title = Session::get('userId');
		$this->view->user = $this->model->getUser();
    	$this->view->render($this->className . '/index');
	}

	// If the argument is missing, the users profile will be shown
	function s($id = NULL)
	{
		$this->view->user = $this->model->getUser($id);
		$this->view->render($this->className . '/index');
	}

	// Create
	function addUser()
	{
		$this->view->user = $this->model->addUser();
	}

	// Read
	function getUser()
	{
		$this->view->user = $this->model->getUser();
	}

	function getAllUsers()
	{
		$this->model->getAllUsers();
	}

	// Update
	function updateUser()
	{
		$this->model->updateUser();
	}

	// Delete
	function deleteUser()
	{
		$this->model->deleteUser();
	}
}
