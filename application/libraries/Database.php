<?php

class Database {

	public function __construct() {
		$db_host = 'localhost';

		// live 
 	    // $db_name = 'maahiwbs_tech_services';
        // $db_user = 'maahiwbs_wpuser';
        // $db_password = 'X0QK4YHWN203';

		//Localhost
		$db_name = 'database_2412';
		$db_user = 'root';
		$db_password = '';

		ORM::configure("mysql:host=$db_host;dbname=$db_name");
		ORM::configure('username', $db_user);
		ORM::configure('password', $db_password);
		ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		ORM::configure('return_result_sets', true); // returns result sets
	}
}