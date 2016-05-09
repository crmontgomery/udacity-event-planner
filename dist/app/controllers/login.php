<?php

class Login extends Controller {

	function __construct()
	{
    	parent::__construct();
    	$this->view->js = array('login/js/login');
	}

	function index()
	{
		$this->view->title = 'Login';
    	$this->view->render('login/index', false, true);
	}

	function run()
	{
    	$this->model->run();
	}
}
