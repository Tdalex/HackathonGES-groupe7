<?php

require('controller.class.php');

class adminController{

	public function __construct(){
	}

	public function indexAction($request){
		$_SESSION['role'] = 'admin';
		$_SESSION['surname'] = 'root';
		//check admin
		if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin')
			controller::redirect();

		$type  = 'Candidats';
		$links = array('Candidats', 'Postes', 'Questions', 'Caracteres','Jeux');

		if(isset($_POST['type']))
			$type = $_POST['type'];

		$links = array_diff($links, array($type));
		$availableJobs = controller::getAvailbleJobs();

		$v = new view("adminView");
		$v->assign("type", $type);
		$v->assign("links", $links);
		$v->assign("availableJobs", $availableJobs);
	}
}
