<?php

namespace App\Core;

// use App\Core\Route;
use App\Controllers\PublicController;
use App\Controllers\AdminController;

class Router
{
	static private $routes = [];
	static private $reverseRoutes = [];
	

	public static function get($definedPath, $callback, $name = "")
	{
		// $route = new Route($definedPath, $callback);

		self :: $routes["get"][$definedPath] = $callback;

		if (isset($name))
			self :: $reverseRoutes[$name] = [ "method" => "get", 
				"callback" => $callback,
				"path" => $definedPath 
			];
	}

	public static function post($definedPath, $callback, $name = "")
	{
		self :: $routes["post"][$definedPath] = $callback;

		if (isset($name))
			self :: $reverseRoutes[$name] = [ "method" => "post", 
				"callback" => $callback,
				"path" => $definedPath 
			];
	}

	public static function getPath($name)
	{
		return self :: $reverseRoutes[$name]["path"];
	}

	public static function redirect($name, $path = "")
	{
		if (isset(self :: $reverseRoutes[$name]))
		{
			if ($name != self :: $reverseRoutes[$name]["path"])
			{
				$route = "/^" . str_replace("/", "\/", self :: $reverseRoutes[$name]["path"]) . "$/";

				if ( preg_match($route, $path) )
				{
					header("Location: " . $path);
					exit();
				}
			}
			else
			{
				header("Location: " . self :: $reverseRoutes[$name]["path"]);
				exit();
			}
		}
		
	}

	public static function execute()
	{
		$path = $_SERVER['REQUEST_URI'];
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			foreach(self :: $routes["post"] as $route => $callback)
			{
				$temp = $route;

				
				if ($temp == $path)
				{
					call_user_func(self :: $routes["post"][$temp], $_POST);
					return;
				}
			}
		}
		else
		{
			foreach(self :: $routes["get"] as $route => $callback)
			{
				$temp = $route;
				$route = "/^" . str_replace("/", "\/", $route) . "$/";
					
				if (preg_match($route, $path, $output))
				{
					call_user_func(self :: $routes["get"][$temp], $output);
					return;
				}
			}
		}	
	}	
}