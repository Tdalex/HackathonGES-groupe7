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
		
		
		$page = 1;
		
		//max contest per page
		$limit = 3;
		
		//start to fetch at
		$offset = ($page - 1) * $limit;
		
		//filter
		$filter = array();
		
		// query get all Candidates by filter
		$query = 'SELECT * FROM candidate order by Id_contest DESC LIMIT '. $offset. ','.$limit;

		// get contests
		
		$dbh = controller::dbConnect();
		$sth = $dbh->prepare($query);
		$sth->execute();
		$candidates = $sth->fetchAll();
		
		//get total number of contest
		$sth = $dbh->prepare('SELECT count(*) FROM candidate');
		$sth->execute();
		
		$countCandidate = $sth->fetch();
		$maxPage = $countCandidate[0] /$limit;
		
		$v = new view("adminCandidateView");
		$v->assign('maxPage', $maxPage);
		$v->assign('page', $page);
		$v->assign("candidate", $candidates);
		$v->assign('filter', $filter);

	}
}