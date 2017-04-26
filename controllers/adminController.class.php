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
		
		$v = new view("adminCandidateView");
	}
	
	public function getCandidate(){
		$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email Address</th>
							<th>Update</th>
							<th>Delete</th>
						</tr>';

		$query = "SELECT * FROM candidates";

		$dbh = controller::dbConnect();
		$sth = $dbh->prepare($query);
		$sth->execute();
		$candidates = $sth->fetchAll();

		// if query results contains rows then featch those rows 
		if($candidates !== null)
		{
			foreach($candidates as $candidate)
			{
				$data .= '<tr>
					<td>'.$candidate['first_name'].'</td>
					<td>'.$candidate['last_name'].'</td>
					<td>'.$candidate['email'].'</td>
					<td>
						<button onclick="GetCandidateDetails('.$candidate['id'].')" class="btn btn-warning">Update</button>
					</td>
					<td>
						<button onclick="CandidateUser('.$candidate['id'].')" class="btn btn-danger">Delete</button>
					</td>
				</tr>';
			}
		}
		else
		{
			// records now found 
			$data .= '<tr><td colspan="6">Aucun candidat trouvé</td></tr>';
		}

		$data .= '</table>';

		echo $data;
	}
	
	public function SkillsAction($request){		
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
		$query = 'SELECT * FROM skills order by IdSkills DESC LIMIT '. $offset. ','.$limit;

		// get contests
		
		$dbh = controller::dbConnect();
		$sth = $dbh->prepare($query);
		$sth->execute();
		$skills = $sth->fetchAll();
		
		//get total number of contest
		$sth = $dbh->prepare('SELECT count(*) FROM skills');
		$sth->execute();
		
		$countSkills = $sth->fetch();
		$maxPage = $countSkills[0] /$limit;
		
		$v = new view("adminSkillsView");
		$v->assign('maxPage', $maxPage);
		$v->assign('page', $page);
		$v->assign("skills", $skills);
		$v->assign('filter', $filter);

	}
}