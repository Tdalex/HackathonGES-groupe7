<?php

require('controller.class.php');

class gfiPlayController{

	public function __construct(){
	}

	public function indexAction($request){
		if(!isset($_SESSION['id_user']))
			controller::redirect();
		
		$availableJobs = controller::getAvailbleJobs();
		$v = new view("gameHomeView");
		$v->assign("availableJobs", $availableJobs);
	}
	
	public function newGameAction($request){
		if(!isset($_SESSION['id_user']))
			controller::redirect();
		
		
		$dbh = controller::dbConnect();
		$sth = $dbh->prepare('INSERT INTO Game (Last_play, IdJobApplication, IdUser) VALUES(now(), "'.$_POST['job'].'","'.$_SESSION['id_user'].'")');		
		$sth->execute();
		
		$_SESSION['id_game'] = $dbh->lastInsertId();
		
		return controller::redirect('/gfiPlay/play');
	}
	
	public function playAction($request){
		if(!isset($_SESSION['id_user']) && !isset($_SESSION['id_game']))
			controller::redirect('/gfiPlay');
		
		$v = new view("playView");
	}
}
