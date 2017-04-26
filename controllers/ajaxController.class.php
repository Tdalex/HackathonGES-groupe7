<?php

require('controller.class.php');

class ajaxController{

	public function __construct(){
	}

	public function indexAction($request){
		controller::redirect();
	}
	
	public function candidateAction($request){
		if(isset($_POST['action']) && !empty($_POST['action'])) {
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
	}
}