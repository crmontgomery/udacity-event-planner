<?php

class Help_Model extends Model {

	function __construct() {
		parent::__construct();
	}

	function blah() {
		require 'app/controllers/user.php';
		
		$userObject = new User();

		echo $userObject->testing();
	}
}
