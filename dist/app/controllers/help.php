<?php

class Help extends Controller {
	function __construct() {
		parent::__construct();

	}

	function index() {
		$this->view->title = 'Help';
		$this->view->render('help/index');
	}

	function blah()
	{
		require 'user.php';
		$new = new User();
		echo $new->testing();
	}
}
