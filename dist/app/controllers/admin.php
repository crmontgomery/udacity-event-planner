<?php

class Admin extends Controller 
{
	private $className;
	private $user_model;

	function __construct()
	{
    	parent::__construct();
		Auth::handleLogin();
    	// Use methods from the user controller
    	require 'app/models/user_model.php';
		$this->user_model = new User_Model();

		$this->className = strtolower(__CLASS__);
    	$this->view->js = array($this->className . '/js/' . $this->className);
	}

	function index()
	{
		if(Session::get('role') == 4){
			$this->view->title = $this->className;
			$this->view->render($this->className . '/index');
		} else {
			header('location: ' . URL);
			exit;
		}
	}

	function users($id = null)
	{
		if(isset($id)){
			$this->view->title = 'Admin: Manage A User';
			$this->view->user = $this->user_model->getUser($id);
			$this->view->roleList = $this->user_model->getUserRoles();
			$this->view->render($this->className . '/user-single');
		} else {
			$this->view->title = 'Admin: Manage Users';
			$this->view->usersList = $this->user_model->getAllUsers();
			$this->view->roleList = $this->user_model->getUserRoles();
			$this->view->render($this->className . '/users');
		}
	}

	function people()
	{
		$this->view->title = 'Admin: Manage People';
    	$this->view->render($this->className . '/people');
	}

	// Create
	function _addUser()
	{
		$this->user_model->addUser();
	}

	// Read
	// function getUser()
	// {
	//
	// }

	function _getAllUsers()
	{
		$this->model->getAllUsers();
	}

	// Update
	function _updateUser()
	{
		echo 'Update User';
	}

	function _updatePassword()
	{
		$this->user_model->updatePassword();
	}

	// Delete
	function _deleteUser()
	{

	}
}
