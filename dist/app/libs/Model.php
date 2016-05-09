<?php

class Model {

	function __construct()
	{
		try {
			$this->db = new Database(DB_TYPE, DB_HOST, DB_HOST, DB_NAME, DB_USER, DB_PASS);

		} catch(Exception $e) {
			// redirects the use to an error page if a database connection cannot be made
			// header('location: error/connection');
			echo $e;
			exit;
		}

		date_default_timezone_set('America/Los_Angeles');
	}

	function sqlDate($date)
	{
		return date('Y-m-d', strtotime(str_replace('-','/', $date)));
	}

	function sqlDateTime($date)
	{
		// Fill this in
	}
	
	function sqlToPhpDateTime($dateTime)
	{
		return date_format(date_create($dateTime), 'd.m.Y g:i A');
	}

	function sqlConverFromTime($time)
	{
		return date('H:i', strtotime($time));
	}

	function removeDupesMulti($array)
	{
		return array_map("unserialize", array_unique(array_map("serialize", $array)));
	}

	function removeDupes($array)
	{
		return array_filter(array_unique($array));
	}

	function fileSourceDate($filename)
	{
		return date('Y-m-d H:i:s', filemtime(DEBUG_UPLOADS_URL . $filename));
	}

}
