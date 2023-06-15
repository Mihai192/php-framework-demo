<?php

namespace App\Core;
use App\Core\DatabaseConnection;

class Model
{
	protected $table;
	protected $conn;
	
	public function __construct()
	{
		$this->conn = DatabaseConnection :: getInstance() -> getConnection();
	}	

	private function executeQuery($sql)
	{
		return $this -> conn -> query($sql);
	}

	// Select operations
	public function all()
	{
		$table = $this -> table;

		$sql = "SELECT * FROM $table";

		$result = $this -> executeQuery($sql);

		return $result -> fetch_all(MYSQLI_ASSOC);
	}


	public function findByID($id)
	{
		$table = $this -> table;

		$sql = "SELECT * FROM $table where id = $id";

		$result = $this -> executeQuery($sql);

		return $result -> fetch_all(MYSQLI_ASSOC);
	}


	public function find($arr)
	{
		$table = $this -> table;

		$sql = "SELECT * FROM $table where ";

		$i = 0;
		$len = count($arr);

		foreach($arr as $key => $value)
		{
			$sql .= $key . " = " . $value;

			if ($i != $len - 1)
				$sql .= " and "; 
			
			
			$i += 1;	
		}

		$result = $this -> executeQuery($sql);

		return $result -> fetch_all(MYSQLI_ASSOC);
	}

	// Delete
	public function deleteById($id)
	{
		$table = $this -> table;

		$sql = "DELETE FROM $table where id = $id";

		$this -> executeQuery($sql);
	}


	public function delete($arr)
	{
		$table = $this -> table;

		$sql = "DELETE FROM $table where ";

		
		$i = 0;
		$len = count($arr);

		foreach($arr as $key => $value)
		{
			$sql .= $key . " = " . $value;

			if ($i != $len - 1)
				$sql .= " and "; 
			
			
			$i += 1;	
		}
		
		$this -> executeQuery($sql);
	}


	// Update
	public function update($arrValues, $arrCondition)
	{
		$table = $this -> table;

		$sql = "UPDATE $table SET ";
		
		$i = 0;
		$len = count($arrValues);

		foreach($arrValues as $key => $value)
		{
			$sql .= $key . " = " . $value;

			if ($i != $len - 1)
				$sql .= " and "; 
			
			
			$i += 1;	
		}

		$sql .= " WHERE ";

		$i = 0;
		$len = count($arrCondition);

		foreach($arrCondition as $key => $value)
		{
			$sql .= $key . " = " . $value;

			if ($i != $len - 1)
				$sql .= " and "; 
			
			
			$i += 1;	
		}


		


		$this -> executeQuery($sql);
	}

	// Insert
	public function insert($columns, $values)
	{
		$table = $this -> table;

		$sql = "INSERT INTO $table ";

		
		$i = 0;
		$len = count($columns);

		$sql .= "(";

		foreach($columns as $key => $value)
		{
			$sql .= $key;

			if ($i != $len - 1)
				$sql .= ", "; 
			
			$i += 1;	
		}

		$sql .= ") VALUES ";


		$i = 0;
		$len = count($values);

		$sql .= "(";


		foreach($values as $key => $value)
		{
			$sql .= "'" . $value . "'";

			if ($i != $len - 1)
				$sql .= ", "; 
			
			$i += 1;	
		}

		$sql .= ")";

		$this -> executeQuery($sql);
	}

	// select
	public function select($columns, $values, $start, $offset, $orderBy, $sort = "ASC")
	{
		$table = $this -> table;

		$sql = "SELECT ";

		
		$i = 0;
		$len = count($columns);

		$sql .= "(";

		foreach($columns as $key => $value)
		{
			$sql .= $value;

			if ($i != $len - 1)
				$sql .= ", "; 
			
			$i += 1;	
		}

		$sql .= " FROM " . $table;


		$i = 0;
		$len = count($values);
		
		$sql .= "(";


		foreach($values as $key => $value)
		{
			$sql .= "'" . $value . "'";

			if ($i != $len - 1)
				$sql .= ", "; 
			
			$i += 1;	
		}

		$sql .= ")";


		

		$sql .= " LIMIT " . $start . ", " . $offset;


		$sql .= " ORDER BY ";

		$len = count($orderBy);
		$i = 0;

		foreach($orderBy as $key => $value)
		{
			$sql .=  $value ;

			if ($i != $len - 1)
				$sql .= ", "; 
			
			$i += 1;	
		}
		
		$sql .= " " . $sort;


		
		
		return $this -> executeQuery($sql);
	}

	public function __destruct()
	{
		$this -> conn -> close();
	}
}