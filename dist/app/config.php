<?php

//CONSTANTS
defined("PUBLIC_PATH")
    or define("PUBLIC_PATH", realpath(dirname(__FILE__) . '../../public'));

// URL's
// Needs to be changed to whatever the address where the folder is located
// This can be either a domain i.g. www.domain.com or local i.g. localhost/foldername
define('URL', 'http://event-planner.dev/'); 
define('PUBLIC_URL', URL . 'public/');
define('UPLOADS_URL', URL . 'data/uploads/');
define('APP_URL', URL . 'app/');
define('IMG', URL . 'public/img/');

//DATABASE
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost'); // usually localhost, change if different
define('DB_NAME', 'event-planner'); // leave this unless you renamed the database manually
define('DB_USER', 'root'); // your database username
define('DB_PASS', 'mysql'); // your database password

//Version
define('VER', '1.1.0-Alpha');
define('PROJECT_NAME', 'Udacity: Event Planner');
