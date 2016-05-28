<?php

class Error extends Controller {

	function __construct($type = NULL) {
		parent::__construct();

		if(isset($type)) {
			$this->view->msg = $type;
		}
	}

	function index($msg = null) {
		$this->view->title = '404 Error';
		$this->view->msg = ($msg != null ? $msg : 'Something went wrong' );
		$this->view->render('error/index', false, true);
	}
}
