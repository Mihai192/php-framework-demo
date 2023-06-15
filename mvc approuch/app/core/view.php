<?php

namespace App\Core;

class View
{
	private $name;

	function __construct($name) 
	{
    	$this->name = $name;
  	}

  	function render($arr = [])
  	{
  		$array = $arr;

  		
  		require_once(dirname(__DIR__) . "/views/" . $this->name);
  	}
}
