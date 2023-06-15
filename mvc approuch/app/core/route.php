<?php


namespace App\Core;

class Route
{
	private $method;
	private $path;
	private $name;
	private $callback;
	private $middlewaresList = [];

	function __construct($method = "", $path = "", $name = "", $controllerCallback, $middlewareCallbacksList = []) 
	{
		$this -> method = $method;
		$this -> path = $path;
		$this -> name = $name;
		$this -> callback = $controllerCallback;
		$this -> middlewaresList = $middlewaresList;
	}


	// GETTERS

	public function getMethod()
	{
		return $this -> method;
	}

	public function getPath()
	{
		return $this -> path;
	}


	public function getName()
	{
		return $this -> name;
	}


	public function getCallback()
	{
		return $this -> callback;
	}

	public function getMiddlewares()
	{
		return $this -> middlewaresList;
	}



	// SETTERS 

	public function setMethod($method)
	{
		$this -> method = $method;
	}


	public function setPath($path)
	{
		$this -> path = $path;
	}


	public function setName($name)
	{
		$this -> name = $name;
	}

	public function setCallback($callback)
	{
		$this -> callback = $callback;
	}

	public function addMiddleware($middleware)
	{
		$this -> middlewaresList[] = $middleware;
	}

	// methods


	public function name($name)
	{
		$this -> name = $name;
		return $this;
	}


	public function middleware($middleware)
	{
		$this -> middlewaresList[] = $middleware;
		return $this;
	}
}