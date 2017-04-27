<?php

require('controller.class.php');

class gfiPlayController{

	public function __construct(){
	}

	public function indexAction($request){
		$_SESSION['id_user']      = 1;
		$_SESSION['name_user']    = 'toto';
		$_SESSION['surname_user'] = 'tata';
		$_SESSION['email_user']   = 'test@test.com';
		if(!isset($_SESSION['id_user']))
			controller::redirect();
		
		$availableJobs = controller::getAvailbleJobs();
		$v = new view("gameView");
		$v->assign("availableJobs", $availableJobs);
	}
	
	public function newGameAction($request){
		if(!isset($_SESSION['id_user']))
			controller::redirect();
		
		$availableJobs = controller::getAvailbleJobs();
		$v = new view("gameView");
		$v->assign("availableJobs", $availableJobs);
	}
}
