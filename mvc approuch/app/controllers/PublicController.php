<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Controller;
use App\Models\Comment;

class PublicController extends Controller
{
	public static function index()
	{
		$arr = [];

		try {
			
			$commentObj = new Comment();
			$comments = $commentObj -> all();


			$arr = [
				"comments" => $comments
			];


		} catch (\Exception $e) {
			
			$arr = [
				"error" => "Database connection error"
			];
		}

		(new View("public/index.php")) -> render($arr);
	}

	public static function post($post_request)
	{
		$name = $post_request['name'];
		$email = $post_request['email'];
		$text  = $post_request['comment'];

		$arr = [];

		try {
			$commentObj = new Comment();

			$commentObj -> add($name, $email, $text);

			$comments = $commentObj -> all();

			$arr = [
				"comments" => $comments
			];
		}
		catch (\Exception $e) {
			$arr = [
				"error" => "Database connection error"
			];
		}

		

		(new View("public/index.php")) -> render($arr);
	}
}