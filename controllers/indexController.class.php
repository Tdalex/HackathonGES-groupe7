<?php

require('controller.class.php');

class indexController{

	public function __construct(){
	}

	public function indexAction($request){
        //si le formulaire a bien été rempli
        //if(isset($_REQUEST)&& !empty($_POST)){
            //enregistre l'utilisateur
        //    controller::saveUser($_POST);
        //}
        //sélectionne les qualités et défauts
        //$qualities = controller::selectQualities();
        //$defaults = controller::selectDefaults();
		//$v = new view("formulaire_inscription");
		//$v->assign("qualities", $qualities);
		//$v->assign("defaults", $defaults);
        // if(isset($_REQUEST) && !empty($_POST))

        $v = new view("formulaire_connexion");

	}

	public function homeAction($request){
		echo "home";
	}

}
