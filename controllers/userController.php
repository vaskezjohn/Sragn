<?php 
//require_once '../models/uniModel.php';
require_once 'models/userModel.php';

class UserCtrl{
    
    private $model;
    
    public function __construct(){
        $this->model = new Usuarios();
    }

    public function Index(){
        include ('views/header.php');
        include ('views/home.php');
        include ('views/footer.php');
    }
   
    public function ViewReg(){
        $user = new Usuarios();
        
        if(isset($_REQUEST['id'])){
            $user = $this->model->Obtener($_REQUEST['id']);
        }

        include ('views/header.php');
        include ('views/user/register.php');
        include ('views/footer.php');
    }

     public function ViewRegValid($msjError){
        
        $user = new Usuarios();

        if(!empty($_REQUEST['id'])){         
            $user = $this->model->Obtener($_REQUEST['id']);
        }

        include ('views/header.php');
        echo ("<script>$(function() {
                    $(\"#divError\").html(\"<div class='alert alert-danger fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!</strong> ".$msjError."\");
                   });
                   </script>");
        include ('views/user/register.php');
        include ('views/footer.php');
    }

    private function ViewLogValid($msjError){
        include ('views/header.php');
        echo ("<script>$(function() {
                    $(\"#divError\").html(\"<div class='alert alert-danger fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!</strong> ".$msjError."\");
                   });
                   </script>");
        include ('views/login/login.php');
        include ('views/footer.php');
    }
    

    public function Login(){

        $user = new Usuarios();

        $user->nrodoc = $_REQUEST['documento'];
        $user->pass = $_REQUEST['pass'];

        $_SESSION["user_id"]=$this->model->TraerUser($user);
       
        if(empty($_REQUEST['documento']) || empty($_REQUEST['pass'])){
            $this->ViewLogValid("Debe ingresar un Usuario");
        }
        elseif (!isset($_SESSION["user_id"]) && !empty($_REQUEST['documento']) && !empty($_REQUEST['pass'])) {
            $this->ViewLogValid("Usuario y/o contrseña incorrecta");
        }

        else{
             $this->Index();
        }

    }

     public function Logout(){
        unset($_SESSION["user_id"]);  
        $this->Index();
    }


    public function ViewLog(){
        include ('views/header.php');
        include ('views/login/login.php');
        include ('views/footer.php');
    }


    public function Registrar(){

        $user = new Usuarios();

        $user->id = $_REQUEST['id'];
        $user->codgrado = $_REQUEST['grado'];
        $user->apeynom = $_REQUEST['nombre'];
        $user->codest = $_REQUEST['codest'];        
        $user->codarea  = "0".$_REQUEST['codigo'];
        $user->telefono ="15".$_REQUEST['numero'];
        $user->coduni = $_REQUEST['unidad'];
        $user->mail = $_REQUEST['mail'];
        $user->codrol = 2;



        if($user->id > 0)
        {
            $_SESSION["user_id"]["mail"]=$_REQUEST['mail'];
            $_SESSION["user_id"]["nombre"]=$_REQUEST['nombre'];
            $this->model->Actualizar($user);
            $this->Index();
        }
        else{ 
             $user->nrodoc = $_REQUEST['documento'];
             $user->pass = $_REQUEST['pass'];

             $validarNroDoc=$this->model->BuscarNroDoc($_REQUEST['documento']);

              if ($validarNroDoc==true){
                    $this->ViewRegValid("Ya existe un usuario con el documento: ".$_REQUEST['documento']);
              }else{

                     if( $_REQUEST['pass']==$_REQUEST['passconf']) {
                   
                        $this->model->Registrar($user);
                        $this->ViewLog();
                     }
                     else{
                        $this->ViewRegValid("la contraseña no coninside");
                     }
                }        
            }
            
    

     
       
    }



}


?>