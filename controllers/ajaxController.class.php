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
						}die();
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
					$data = '<table id="game" class="table table-bordered table-striped">
                                <thead>
									<tr>
										<th>Nom</th>
										<th>Email</th>
										<th>Poste</th>
										<th>Score</th>
										<th>Date</th>
										<th>Termine ?</th>
										<th>Detail</th>
									</tr>
								</thead>';

					$query = "SELECT * FROM game INNER JOIN candidate ON candidate.IdCandidate = candidate.IdCandidate";

					$dbh = controller::dbConnect();
					$sth = $dbh->prepare($query);
					$sth->execute();
					$results = $sth->fetchAll();

					$data .= '<tbody>';
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

					$data .= '</tbody></table>';
					break;
					
				case 'Candidats':
					$data = '<table id="candidate" class="table table-bordered table-striped">
								<thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>';

					$query = "SELECT * FROM user where role != 'admin'";
					$query = "SELECT * FROM user";

					$dbh = controller::dbConnect();
					$sth = $dbh->prepare($query);
					$sth->execute();
					$results = $sth->fetchAll();
					$data .= '<tbody>';
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

					$data .= '</tbody></table>';
					break;

				case 'Postes':
					$data = '<table id="poste" class="table table-bordered table-striped">
                                <thead>
									<tr>
										<th>Nom</th>
										<th>Durée avant nouvel essai</th>
										<th>Quantité disponible</th>
										<th>Modifier</th>
										<th>Supprimer</th>
									</tr>
								</thead>';

					$query = "SELECT * FROM JobApplication";

					$dbh = controller::dbConnect();
					$sth = $dbh->prepare($query);
					$sth->execute();
					$results = $sth->fetchAll();
					$data .= '<tbody>';
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

					$data .= '</tbody></table>';
					break;
				
				case 'Caracteres':
					$data = '<table id="skill" class="table table-bordered table-striped">
                                <thead>
									<tr>
										<th>Nom</th>
										<th>Type</th>
										<th>Modifier</th>
										<th>Supprimer</th>
									</tr>
								</thead>';

					$query = "SELECT * FROM Skills";

					$dbh = controller::dbConnect();
					$sth = $dbh->prepare($query);
					$sth->execute();
					$results = $sth->fetchAll();
                    $data .= '<tbody>';
					// if query results contains rows then featch those rows 
					if(!empty($results))
					{
						foreach($results as $result)
						{
							if($result['Type'] == 0 ){
								$type = 'defaut';
							}else{
								$type = 'qualite';
							}
							
							$data .= '<tr>
								<td>'.$result['Name'].'</td>
								<td>'.$type.'</td>
								<td>
									<button data-type="Caracteres" data-id="'.$result['IdSkills'].'" class="update btn btn-warning">Modifier</button>
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
						$data = '<tr><td colspan="6">Aucun caracteres trouvé</td></tr>';
					}

					$data .= '</tbody></table>';
					break;
				case 'Questions':
					$data = '<table id="question" class="table table-bordered table-striped">
                                <thead>
									<tr>
										<th>Enoncé</th>
										<th>Type</th>
										<th>Poste</th>
										<th>Modifier</th>
										<th>Supprimer</th>
									</tr>
								</thead>';

					$query = "SELECT * FROM Question INNER JOIN JobApplication ON Question.IdJobApplication = JobApplication.IdJobApplication";

					$dbh = controller::dbConnect();
					$sth = $dbh->prepare($query);
					$sth->execute();
					$results = $sth->fetchAll();
                    $data .= '<tbody>';
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

					$data .= '</tbody></table>';
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
	
	public function getQuestionAction($request){		
		$needle  = array();
		if($_SESSION['last_question'] < 10){			
			$type = 'QCM';
			$questionTemplate = __DIR__ . '/../views/formulaire/QCM.php';
			$needle = array('{{score}}','{{wording}}','{{answer1}}','{{answer2}}','{{answer3}}','{{answer4}}','{{text_answer1}}','{{text_answer2}}','{{text_answer3}}','{{text_answer4}}');
		}else{
			$type = 'open';
			$questionTemplate = __DIR__ . '/../views/formulaire/openQuestion.php';
			$needle = array('{{score}}','{{wording}}','{{answer}}');
		}

		$dbh = controller::dbConnect();
		$query = "SELECT count(*) FROM Question WHERE type='". $type ."' AND IdJobApplication = " . $_SESSION['id_job'] ." order by rand(". $_SESSION['id_game'] .") limit 1 offset ". $_SESSION['last_question'];
		$sth = $dbh->prepare($query);
		$sth->execute();
		$questionCount = $sth->fetch();
		
		if(!$_SESSION['last_question'] <= $questionCount){
			echo 'Bravo vous avez repondu a toutes les questions, votre score: '. $_SESSION['score'];
			return true;
		}
		
		//question
		$query = "SELECT * FROM Question WHERE type='". $type ."' AND IdJobApplication = " . $_SESSION['id_job'] ." order by rand(". $_SESSION['id_game'] .") limit 1 offset ". $_SESSION['last_question'];
		$sth = $dbh->prepare($query);
		$sth->execute();
		$question = $sth->fetch();
		$_SESSION['idQuestion'] = $question['IdQuestion'];
		
		$replace = array($_SESSION['score'], $question['Wording']);	
		if($type == 'QCM'){
			//answer
			$query = "SELECT * FROM answer WHERE IdQuestion = " . $question['IdQuestion'] ." order by rand()";
			$sth = $dbh->prepare($query);
			$sth->execute();
			$answer = $sth->fetchAll();
			$replace = array($_SESSION['score'], $question['Wording'],$answer[0]['IdAnswer'],$answer[1]['IdAnswer'],$answer[2]['IdAnswer'],$answer[3]['IdAnswer'],$answer[0]['Text'],$answer[1]['Text'],$answer[2]['Text'],$answer[3]['Text']);
		}
		
		$template = file_get_contents($questionTemplate, FILE_USE_INCLUDE_PATH);
		$page 	  = str_replace($needle,$replace,$template);
		echo $page;
	}
	
	public function answerQuestionAction($request){
		if(!isset($_SESSION['id_game']) && !isset($_POST['value']))
			return controller::redirect('/gfiPlay');
		
		$dbh = controller::dbConnect();
		
		$query = 'SELECT * FROM answer WHERE IdQuestion = ' . $_SESSION['idQuestion'] . ' AND IdAnswer = '. $_POST['value'];
		$sth = $dbh->prepare($query);		
		$sth->execute();
		$answer = $sth->fetch();
		
		if($answer['Is_answer']){
			$point = '+1';
			$_SESSION['score']++;
		}else{
			$point = '-1';
			$_SESSION['score']--;
		}
		
		$sth = $dbh->prepare('UPDATE game SET score = score '. $point .', LastQuestion = LastQuestion + 1, Last_play = now() WHERE idGame = '. $_SESSION['id_game'] );		
		$sth->execute();
		
		$_SESSION['last_question']++;
	}
}