<?php

class Error extends Controller {

	function __construct($type = NULL) {
		parent::__construct();

		if(isset($type)) {
			$this->view->msg = $type;
		}
	}

	function index() {
    $this->view->title = '404 Error';
		$this->view->msg = 'Something went wrong';
		$this->view->render('error/index', true);
	}

	function connection()
	{
		$this->view->title = 'Uh Oh!';
		$this->view->msg = 'It looks like you are unable to connect to the database.  Please check your settings.';
		$this->view->render('error/connection', false, true);
	}
}
