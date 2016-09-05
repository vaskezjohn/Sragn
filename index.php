<?php 
session_start();
require_once 'models/db.php';

//Cargamos controladores y acciones
if(isset($_GET["controller"])){

    $controlador=$_GET["controller"];
  

    if(file_exists('controllers/'.ucwords($controlador).'Controller.php')){

        require_once ('controllers/'.ucwords($controlador).'Controller.php');  
        $controlador = ucwords($controlador) . 'Ctrl';

        $controladorObj=new $controlador(); 

        if(isset($_GET["action"]) && method_exists($controladorObj, $_GET["action"])){
            $accion=$_GET["action"];
            call_user_method($accion,$controladorObj);
        	//$controladorObj->$accion();

	    }else{
	        $accion="index";
	        $controladorObj->$accion();
	    }
    }else{
    	include ('controllers/homeController.php'); 

    }
}
 else
    {
    	include ('controllers/homeController.php'); 
    }


?>