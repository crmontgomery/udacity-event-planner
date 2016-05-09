<?php

class View {

	function __construct() {

	}

	public function render($name, $hideHeader = false, $hideMenu = false){

		$subMenu = substr($name, 0, strpos($name, '/'));
		$subMenu .= '/sub-menu.php';

		if ($hideHeader != true && $hideMenu != true) {
			require 'app/views/_templates/header.php';
			require 'app/views/_templates/menu.php';
			if(file_exists('app/views/' . $subMenu)){require 'app/views/' . $subMenu;}
			require 'app/views/' . $name . '.php';
			require 'app/views/_templates/footer.php';
		} elseif($hideHeader == false && $hideMenu == true) {
			require 'app/views/_templates/header.php';
			require 'app/views/' . $name . '.php';
			require 'app/views/_templates/footer.php';
		} else {
			require 'app/views/' . $name . '.php';
		}
	}
}
