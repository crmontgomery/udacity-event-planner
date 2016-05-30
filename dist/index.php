<?php

require 'app/config.php';
require 'app/util/auth.php';

// Calls password compatability file for secure passwords
//require 'app/libs/Password.php';

// Loads the rest of the library files
function __autoload($class) {
	require "app/libs/" . $class. ".php";
}

$app = new bootstrap();