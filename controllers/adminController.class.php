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
		$v->assign("filter", array());
		$v->assign("content", array());
		$v->assign("maxPage", 1);
		$v->assign("page", 1);

	}

	public function homeAction($request){
		echo "home";
	}

}