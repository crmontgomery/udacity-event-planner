<?php

class Index extends Controller 
{
    private $login_model;
    private $user_model;
    private $events_model;
    
    function __construct() 
    {
        parent::__construct();
        Auth::handleLogin(true); //Removed to allow users to view events without being logged in.
        
        // Use methods from the user controller
    	require 'app/models/login_model.php';
        require 'app/models/user_model.php';
        require 'app/models/events_model.php';
		$this->login_model = new Login_Model();
        $this->user_model = new User_Model();
        $this->events_model = new Events_Model();

        $this->className = strtolower(__CLASS__);
    	$this->view->js = array($this->className . '/js/' . $this->className);
	}

	function index()
	{
		$this->view->title = $this->className;
        $this->view->eventsList = $this->events_model->getEventsList();
		$this->view->render($this->className . '/index');
	}
    
    function login()
    {
        $this->login_model->run();
    }
    
    // Create 
    function createEvent()
    {
        echo Session::get('userId');
        $this->events_model->createEvent();
        
    }
    
    function createUser()
    {
        $this->user_model->createUser();
    }
    // Read
    
    function getUser()
    {
        
    }
    
    function userExists()
    {
        $this->user_model->userExists($_POST['email']);
    }
    // Update
    // Delete 
}
