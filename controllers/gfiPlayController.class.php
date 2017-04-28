<?php

require('controller.class.php');

class gfiPlayController{

	public function __construct(){
	}

	public function indexAction($request){
		if(!isset($_SESSION['id_user']))
			controller::redirect();
		
		
		$dbh = controller::dbConnect();
		$sth = $dbh->prepare('SELECT * FROM game WHERE IdUser = '. $_SESSION['id_user'] .' AND Is_finished = 0');
        $sth->execute();
		$game = $sth->fetch();
		
		$sth = $dbh->prepare('SELECT count(*) FROM game WHERE IdUser = '. $_SESSION['id_user'] .' AND Is_finished = 1');
        $sth->execute();
		$countGame = $sth->fetch();

		
		$_SESSION['game_finished'] = 0;
		if($countGame){
			$_SESSION['game_finished']	= $countGame[0];
		
			$sth = $dbh->prepare('SELECT * FROM game INNER JOIN jobapplication ON jobapplication.IdJobApplication = game.IdJobApplication WHERE IdUser = '. $_SESSION['id_user'] .' AND Is_finished = 1');
			$sth->execute();
			$finished_game = $sth->fetchAll();
			$_SESSION['finished_game']  = $finished_game;
		}
		
		if($game){
			$sth = $dbh->prepare('SELECT * FROM jobapplication WHERE IdJobApplication = '.$game['IdJobApplication']);
			$sth->execute();
			$gameJob = $sth->fetch();
			
			$_SESSION['id_game']		= $game['IdGame'];
			$_SESSION['id_job'] 		= $game['IdJobApplication'];
			$_SESSION['game_info']		= $gameJob;
			$_SESSION['last_question']  = $game['LastQuestion'];
			$_SESSION['score']  		= $game['Score'];
		}
		
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
		
		$sth = $dbh->prepare('SELECT * FROM jobapplication WHERE IdJobApplication = '.$game['IdJobApplication']);
		$sth->execute();
		$gameJob = $sth->fetch();

		$_SESSION['id_game'] = $dbh->lastInsertId();
		$_SESSION['id_job']  = $_POST['job'];
		$_SESSION['last_question'] = 0;
		$_SESSION['game_info']		= $gameJob;
		$_SESSION['score'] = 0;
		return controller::redirect('/gfiPlay/play');
	}

	public function playAction($request){
		if(!isset($_SESSION['id_user']) || !isset($_SESSION['id_game']))
			controller::redirect('/gfiPlay');

		$v = new view("playView");
	}


}
