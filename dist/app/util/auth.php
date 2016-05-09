<?php

class Auth
{
	public static function handleLogin($index = false){
		@session_start();

		if(!$index) {
			$logged = $_SESSION['loggedIn'];

			if($logged == false) {
				Session::destroy();
				header('location: ' . URL);
				exit;
			}
		}
		
	}
}