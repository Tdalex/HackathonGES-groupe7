<?php


abstract class Controller{


	public function __construct(){
	}

	public function redirect($location = serverUrl){
		if($location == 'home'){
			$location = serverUrl;
		}elseif(substr($location, 0, 4) != 'http'){
			$location = serverUrl . $location;
		}

		return header('Location:'. $location);
	}

	public static function dbConnect(){
		try {
			if(isset($_SERVER['HTTPS'])){
				$dbh = new PDO('mysql:host=localhost;dbname=gfiplay', 'root', '');
			}else{
				$dbh = new PDO('mysql:host=localhost;dbname=gfiplay', 'root');
			}

			return $dbh;
		} catch (PDOException $e) {
			print "Erreur !: " . $e->getMessage() . "<br/>";
			die();
		}
	}

    public static function connectUser($email, $password){
        $dbh = self::dbConnect();
        $sth = $dbh->prepare('SELECT * FROM user WHERE Email = "'. $email .'" AND Password = "' . $password .'"');
        $sth->execute();
		$res = $sth->fetch();
		
        $sth = $dbh->prepare('SELECT IdJobApplication FROM game WHERE IdCandidate = '. $res['IdUser']);
        $sth->execute();
		$game = $sth->fetch();
		if($game)
			$_SESSION['id_game'] = $game;
		
        $_SESSION['id_user']      = $res['IdUser'];
        $_SESSION['name_user']    = $res['Name'];
        $_SESSION['surname_user'] = $res['Surname'];
        $_SESSION['email_user'] = $res['Email'];
        return self::redirect("/gfiPlay");
    }

    public static function saveUser($request){
        //enregistrer l'utilisateur dans la BDD
        $dbh = self::dbConnect();
        $mdp = md5($request["password"]);
        $query1 = 'INSERT INTO user (Name, Surname, Birthdate, Email, CV, Role, Password, Gender) VALUES ("'. $request["name"] .'", "'. $request["surname"] .'", "'. $request["birthday"] .'", "'. $request["email"] .'", "'. $request["cv"] .'", "candidate", "'. $mdp .'", '. $request["gender"] .')';
        $sth1 = $dbh->prepare($query1);
        $sth1->execute();

        $idUser = $dbh->lastInsertId();
        $nameUser = $_POST['name'];
        $surnameUser = $_POST['surname'];

        $_SESSION['id_user'] = $idUser;
        $_SESSION['name_user'] = $nameUser;
        $_SESSION['surname_user'] = $surnameUser;
        //enregistrer les skills de l'utilisateur dans la BDD
        $query2 = 'INSERT INTO user_skills VALUES('.$idUser.', '.$_POST["qualite1"].')';
        $query3 = 'INSERT INTO user_skills VALUES('.$idUser.', '.$_POST["qualite2"].')';
        $query4 = 'INSERT INTO user_skills VALUES('.$idUser.', '.$_POST["defaut1"].')';
        $query5 = 'INSERT INTO user_skills VALUES('.$idUser.', '.$_POST["defaut2"].')';
        $sth2 = $dbh->prepare($query2);
        $sth3 = $dbh->prepare($query3);
        $sth4 = $dbh->prepare($query4);
        $sth5 = $dbh->prepare($query5);
        $sth2->execute();
        $sth3->execute();
        $sth4->execute();
        $sth5->execute();

        return self::redirect("/gfiPlay");
    }

    public static function selectQualities(){
        //sélection de toutes les qualités
        $dbh = self::dbConnect();
        $query = 'SELECT * FROM skills WHERE Type=1';
        $sth = $dbh->prepare($query);
        $sth->execute();
        $res = $sth->fetchAll();

        return $res;
    }

    public static function getAvailbleJobs(){
        //sélection de toutes les postes libres
        $dbh = self::dbConnect();
        $query = 'SELECT * FROM jobapplication where quantity > 0';
        $sth = $dbh->prepare($query);
        $sth->execute();
        $res = $sth->fetchAll();

        return $res;
    }

    public static function selectDefaults(){
        //sélection de tous les défauts
        $dbh = self::dbConnect();
        $query = 'SELECT * FROM skills WHERE Type=0';
        $sth = $dbh->prepare($query);
        $sth->execute();
        $res = $sth->fetchAll();
        return $res;
    }

}
