<?php

require('controller.class.php');

class ajaxController{

	public function __construct(){
	}

	public function indexAction($request){
		controller::redirect();
	}
	
	public function addRecordAction($request){
		if(isset($_POST['action']) && !empty($_POST['action'])) {
			$dbh = controller::dbConnect();
			switch($_POST['action']){
				case 'Questions':
					$sth = $dbh->prepare('INSERT INTO Question (Wording,Type,IdJobApplication) VALUES("'.$_POST['wording'].'","'.$_POST['type'].'","'.$_POST['job'].'")');		
					$sth->execute();
					$idQuestion = $dbh->lastInsertId();
					if($_POST['type'] == 'QCM'){
						$i = 1;
						foreach($_POST['text_answer'] as $answer){
							if(in_array($i, $_POST['is_answer'])){
								$is_answer = 1;
							}else{
								$is_answer = 0;
							}
							$sth = $dbh->prepare('INSERT INTO Answer (Text,Is_Answer,IdQuestion) VALUES("'.$answer.'","'. $is_answer.'","'.$idQuestion.'")');		
							$sth->execute();
							$i++;
						}
					}else{
						$sth = $dbh->prepare('INSERT INTO Answer (Text,Is_Answer,IdQuestion) VALUES("'.$_POST['answer'].'","1","'.$idQuestion.'")');		
						$sth->execute();
					}
				break;
	
				case 'Postes':				
					$sth = $dbh->prepare('INSERT INTO jobapplication (Name,Quantity,Timeout,Description) VALUES("'.$_POST['name'].'","'.$_POST['quantity'].'","'.$_POST['timeout'].'","'.$_POST['description'].'")');		
					$sth->execute();
					break;

				case 'Caracteres':
					$sth = $dbh->prepare('INSERT INTO skills (Name,Type) VALUES("'.$_POST['name'].'","'.$_POST['type'].'")');		
					$sth->execute();
					break;
			}
		}
	}
	
	public function deleteRecordAction($request){
		if(isset($_POST['type']) && !empty($_POST['type'])) {
			$dbh = controller::dbConnect();
			switch($_POST['type']){
				case 'Questions':
					$sth = $dbh->prepare('DELETE FROM question WHERE IdQuestion = '. $_POST['id']);		
					$sth->execute();
					
					$sth = $dbh->prepare('DELETE FROM answer WHERE IdQuestion = '. $_POST['id']);		
					$sth->execute();
				break;
	
				case 'Postes':				
					$sth = $dbh->prepare('DELETE FROM jobapplication WHERE IdJobApplication = '. $_POST['id']);
					$sth->execute();
					break;

				case 'Caracteres':
					$sth = $dbh->prepare('DELETE FROM skills WHERE IdSkills = '. $_POST['id']);		
					$sth->execute();
					break;
			}
		}
	}

	public function getRecordAction($request){
		if(isset($_POST['action']) && !empty($_POST['action'])) {
			switch($_POST['action']){
				case 'Jeux':
					$data = '<table class="table table-bordered table-striped">
									<tr>
										<th>Nom</th>
										<th>Email</th>
										<th>Poste</th>
										<th>Score</th>
										<th>Date</th>
										<th>Termine ?</th>
										<th>Detail</th>
									</tr>';

					$query = "SELECT * FROM game INNER JOIN candidate ON candidate.IdCandidate = candidate.IdCandidate";

					$dbh = controller::dbConnect();
					$sth = $dbh->prepare($query);
					$sth->execute();
					$results = $sth->fetchAll();
					// if query results contains rows then featch those rows 
					if(!empty($results))
					{
						foreach($results as $result)
						{
							$data .= '<tr>
								<td>'.$result['Surname'] . ' ' . $result['Name'].'</td>
								<td>'.$result['Email'].'</td>
								<td>'.$result['Score'].'</td>
								<td>'.$result['Last_play'].'</td>
								<td>'.$result['is_finished'].'</td>
								<td>
									<button data-type="Jeux" data-id="'.$result['IdGame'].'" class="getdetail btn btn-warning">Detail</button>
								</td>
							</tr>';
						}
					}
					else
					{
						// records now found 
						$data = '<tr><td colspan="6">Aucun jeu trouvé</td></tr>';
					}

					$data .= '</table>';
					break;
					
				case 'Candidats':
					$data = '<table class="table table-bordered table-striped">
									<tr>
										<th>Nom</th>
										<th>Email</th>
										<th>Detail</th>
									</tr>';

					$query = "SELECT * FROM user where role != 'admin'";
					$query = "SELECT * FROM user";

					$dbh = controller::dbConnect();
					$sth = $dbh->prepare($query);
					$sth->execute();
					$results = $sth->fetchAll();
					// if query results contains rows then featch those rows 
					if(!empty($results))
					{
						foreach($results as $result)
						{
							$data .= '<tr>
								<td>'.$result['Surname'] . ' ' . $result['Name'].'</td>
								<td>'.$result['Email'].'</td>
								<td>
									<button data-type="Candidats" data-id="'.$result['IdUser'].'" class="getdetail btn btn-warning">Detail</button>
								</td>
							</tr>';
						}
					}
					else
					{
						// records now found 
						$data = '<tr><td colspan="6">Aucun candidat trouvé</td></tr>';
					}

					$data .= '</table>';
					break;

				case 'Postes':
					$data = '<table class="table table-bordered table-striped">
									<tr>
										<th>Nom</th>
										<th>Durée avant nouvel essai</th>
										<th>Quantité disponible</th>
										<th>Modifier</th>
										<th>Supprimer</th>
									</tr>';

					$query = "SELECT * FROM JobApplication";

					$dbh = controller::dbConnect();
					$sth = $dbh->prepare($query);
					$sth->execute();
					$results = $sth->fetchAll();
					// if query results contains rows then featch those rows 
					if(!empty($results))
					{
						foreach($results as $result)
						{
							$data .= '<tr>
								<td>'.$result['Name'].'</td>
								<td>'.$result['Timeout'].' jours</td>
								<td>'.$result['Quantity'].'</td>
								<td>
									<button data-type="Postes" data-id="'.$result['IdJobApplication'].'" class="getdetail btn btn-warning">Modifier</button>
								</td>
								<td>
									<button data-type="Postes" data-id="'.$result['IdJobApplication'].'" class="deleteRecord btn btn-danger">Supprimer</button>
								</td>
							</tr>';
						}
					}
					else
					{
						// records now found 
						$data = '<tr><td colspan="6">Aucun poste trouvé</td></tr>';
					}

					$data .= '</table>';
					break;
				
				case 'Caracteres':
					$data = '<table class="table table-bordered table-striped">
									<tr>
										<th>Nom</th>
										<th>Type</th>
										<th>Modifier</th>
										<th>Supprimer</th>
									</tr>';

					$query = "SELECT * FROM Skills";

					$dbh = controller::dbConnect();
					$sth = $dbh->prepare($query);
					$sth->execute();
					$results = $sth->fetchAll();

					// if query results contains rows then featch those rows 
					if(!empty($results))
					{
						foreach($results as $result)
						{
							$data .= '<tr>
								<td>'.$result['Name'].'</td>
								<td>'.$result['Type'].'</td>
								<td>
									<button data-type="Caracteres" data-id="'.$result['IdSkills'].'" class="update btn btn-warning">Detail</button>
								</td>
								<td>
									<button data-type="Caracteres" data-id="'.$result['IdSkills'].'" class="deleteRecord btn btn-danger">Supprimer</button>
								</td>
							</tr>';
						}
					}
					else
					{
						// records now found 
						$data = '<tr><td colspan="6">Aucune question trouvée</td></tr>';
					}

					$data .= '</table>';
					break;
				case 'Questions':
					$data = '<table class="table table-bordered table-striped">
									<tr>
										<th>Enoncé</th>
										<th>Type</th>
										<th>Poste</th>
										<th>Modifier</th>
										<th>Supprimer</th>
									</tr>';

					$query = "SELECT * FROM Question INNER JOIN JobApplication ON Question.IdJobApplication = JobApplication.IdJobApplication";

					$dbh = controller::dbConnect();
					$sth = $dbh->prepare($query);
					$sth->execute();
					$results = $sth->fetchAll();

					// if query results contains rows then featch those rows 
					if(!empty($results))
					{
						foreach($results as $result)
						{
							$data .= '<tr>
								<td>'.$result['Wording'].'</td>
								<td>'.$result['Type'].'</td>
								<td>'.$result['Name'].'</td>
								<td>
									<button data-type="Questions" data-id="'.$result['IdQuestion'].'" class="update btn btn-warning">Modifier</button>
								</td>
								<td>
									<button data-type="Questions" data-id="'.$result['IdQuestion'].'" class="deleteRecord btn btn-danger">Supprimer</button>
								</td>
							</tr>';
						}
					}
					else
					{
						// records now found 
						$data = '<tr><td colspan="6">Aucune question trouvée</td></tr>';
					}

					$data .= '</table>';
					break;

				default:
					$data = 'wrong type';
					break;
					
			}
		}else{
			$data = 'error';
		}
		echo $data;
	}
	
	public function getDetailsAction($request){
		if(isset($_POST['type']) && isset($_POST['type']) != ""){
			// get ID and type
			$id   = $_POST['id'];
			$from = $_POST['type'];
			switch($_POST['type']){
				case 'Candidats':

					// get Details
					$query = "SELECT * FROM user WHERE IdUser = ".$id;
					$dbh = controller::dbConnect();
					$sth = $dbh->prepare($query);
					$sth->execute();
					$results = $sth->fetch();
					
					$response = array();
					
					if($results){
						$response = $results;
					}else{
						$response['status'] = 200;
						$response['message'] = "Data not found!";
					}
					break;
					
				case 'Jeux':

					// get Details
					$query = "SELECT * FROM game INNER JOIN candidate ON candidate.IdCandidate = candidate.IdCandidate WHERE IdGame = ".$id;
					$dbh = controller::dbConnect();
					$sth = $dbh->prepare($query);
					$sth->execute();
					$results = $sth->fetch();
					
					$response = array();
					
					if($results){
						$response = $results;
					}else{
						$response['status'] = 200;
						$response['message'] = "Data not found!";
					}
					break;
			}
		}else{
			$response['status'] = 200;
			$response['message'] = "Invalid Request!";
		}
		
		// display JSON data
		echo json_encode($response);
	}
}