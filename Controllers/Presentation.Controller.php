<?php
require_once('Controllers/Controller.Controller.php');

class PresentationController extends Controller
	{
	public $mainContent;
	private $mysqli;
	
	public function __construct($_mysqli)
		{
		$this->mysqli = $_mysqli;
		}

	//Action index
	public function index()
		{
		$req = "SELECT titre, texte, img, extension FROM contenus WHERE id=1";
		$res = $this->mysqli->query($req);
		$table = $res->fetch_assoc();
		
		$title = $table["titre"];
		$content = $table["texte"];
		$image = $table["img"].'.'.$table["extension"];
		
		$newData = array($title, $content, $image);
		$this->viewData = $newData;
		$this->View(__FUNCTION__);
		}
	}
?>