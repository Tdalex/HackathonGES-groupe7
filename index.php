<?php
    session_start();
	require __DIR__.'/vendor/autoload.php';

    function my_autoloader($class) {
        if(file_exists('core/' . $class . '.class.php')){
            require 'core/' . $class . '.class.php';
        }
    }
    
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

	if(isset($_SERVER['HTTPS'])){
		$protocol = 'https://';
	}else{
		$protocol = 'http://';
	}
	define('serverUrl', $protocol . $_SERVER['HTTP_HOST']);

    spl_autoload_register('my_autoloader');

    $uri = trim($_SERVER["REQUEST_URI"], "/");
    $array_uri = explode("/", $uri);

    $c = (!empty($array_uri[0]))?$array_uri[0].'Controller':"indexController";

    $path_c = "controllers/".$c.".class.php";

    $a = (isset($array_uri[1]))?$array_uri[1]."Action":"indexAction";


    if( file_exists($path_c) ){
        require $path_c;
        $controller = new $c;
        if(method_exists ( $controller , $a )){
            $controller->$a($_REQUEST);
        }else{
			die("L'action n'existe pas");
        }

    }else{
        die("Le controller n'existe pas");
    }
