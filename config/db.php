<?php

class Database{
	public static function connect(){
		$db = new mysqli('localhost', 'root', '', 'prm_db');
		$db->query("SET NAMES 'utf8'");

		if ($db->connect_errno) {
			printf("Connect failed: %s\n", $db->connect_error);
			exit();
		}

		return $db;
	}
}
