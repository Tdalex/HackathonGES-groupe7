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
				$dbh = new PDO('mysql:host=localhost;dbname=gfi_play', 'root', '');
			}else{
				$dbh = new PDO('mysql:host=localhost;dbname=gfi_play', 'root');
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

}