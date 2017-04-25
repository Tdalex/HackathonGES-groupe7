<?php

require('controller.class.php');

class adminController{

	public function __construct(){
	}

	public function indexAction($request){
		$_SESSION['role'] = 'admin';
		$_SESSION['surname'] = 'root';
		if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
			controller::redirect();
		}
		$v = new view("adminHomeView");

	}

	public function homeAction($request){
		echo "home";
	}

}