<?php

abstract class controller{

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
        $dbh = controller::dbConnect();
        $sth = $dbh->prepare('SELECT * FROM user WHERE email = '. $email .' && password = ' . $password);
        $sth ->execute();
        return $sth->fetch();
    }

    public function saveUser(){
        $dbh = controller::dbConnect();
        $sth = $dbh->prepare('INSERT INTO user ("Name", "Surname", "Birthdate", "Email", "CV", "Role", "Password") 
                              VALUES ('. $_POST["name"] .', '. $_POST["surname"] .', '. $_POST["birthday"] .', '. $_POST["email"] .', '. $_POST["cv"] .', '. $_POST["role"] .', '. $_POST["password"] .')');
        $sth->execute();

        $idUser = $dbh->lastInsertId();
        $nameUser = $_POST['name'];
        $surnameUser = $_POST['surname'];

        $_SESSION['id_user'] = $idUser;
        $_SESSION['name_user'] = $nameUser;
        $_SESSION['surname_user'] = $surnameUser;

        return controller::redirect();
    }

}