<?php

//CONSTANTS
defined("PUBLIC_PATH")
    or define("PUBLIC_PATH", realpath(dirname(__FILE__) . '../../public'));

$projectTitle = 'event-planner'; //must be lower case

// URL's
define('URL', 'http://' . $projectTitle . '.dev/');
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
define('VER', '1.0.1-Alpha');
define('PROJECT_NAME', 'Udacity: Event Planner');
