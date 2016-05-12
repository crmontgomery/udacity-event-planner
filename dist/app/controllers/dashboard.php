<?php

class Dashboard extends Controller {

	function __construct() {
		parent::__construct();

		Auth::handleLogin();

		$this->view->js = array('dashboard/js/default');
	}

	function index() {
		$this->view->title = 'Dashboard';
		$this->view->render('dashboard/index');
	}

	// TODO: Move to login controller
	function logout() {
		Session::destroy();
		header('location: ../');
		exit;
	}
}