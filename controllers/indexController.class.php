<?php

require('controller.class.php');

class indexController{

	public function __construct(){
	}

	public function indexAction($request){
        //si le formulaire a bien été rempli
        if(isset($_REQUEST)&& !empty($_POST)){
              //enregistre l'utilisateur
            if($_POST['type']== 'signup') {
                controller::saveUser($_POST);
            }else {
                controller::connectUser($_POST['mail'], md5($_POST['mdp']));
            }
        }
        //sélectionne les qualités et défauts

        $qualities = controller::selectQualities();
        $defaults = controller::selectDefaults();
        $v = new view("homeView");
		$v->assign("qualities", $qualities);
		$v->assign("defaults", $defaults);

	}

	public function gfiPlayAction($request){
		$v = new view("gameView");
	}

	public function logoutAction($request){
		session_destroy();
		return controller::redirect();
	}


}
