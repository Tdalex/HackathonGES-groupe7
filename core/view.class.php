<?php
class view{

	public $v;
	public $t;
	public $data;

	public function __construct($view="homeView", $template='defaultTemplate'){

		if(file_exists("views/".$view.".php")){
			$this->v = "views/".$view.".php";
		}else{
			die("La vue n'existe pas");
		}

		if(file_exists("views/".$template.".php")){
			$this->t = "views/".$template.".php";
		}else{
			die("Le template n'existe pas");
		}
	}

	public function assign($key, $value){
		$this->data[$key]= $value;
	}

	public function __destruct(){
		if(!empty($this->data))
			extract($this->data);
		include $this->t;
	}

}