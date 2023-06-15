<?php

namespace App\Core;


class DatabaseConnection
{
	private $connection;
	private static $instance;
 	
	private function __construct()
	{
		$this->connection = new \mysqli(DB_HOST, 
			DB_USER, DB_PASS, DB_NAME);

		
		if ($this->connection->connect_error)
			throw new \Exception("Database connection error");
	}

	public static function getInstance()
	{
		

		if (!isset(self :: $instance))
			self :: $instance = new self;
	
				
		return self :: $instance;
	}

	public function getConnection()
	{
		return $this -> connection;
	}
}