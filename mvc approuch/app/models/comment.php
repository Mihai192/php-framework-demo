<?php


namespace App\Models;
use App\Core\Model;


class Comment extends Model
{
	protected $table = "comment"; 

	public function __construct() {
		parent::__construct();
	}

	public function add($name, $email, $comment) {
        $stmt = $this -> conn ->prepare("INSERT INTO comment (name, email, date_posted, text) VALUES (?, ?, CURDATE(), ?)");
        $stmt->bind_param("sss", $name, $email, $comment);
        $stmt->execute();
	}
}