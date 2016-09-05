<?php 
//require_once '../models/uniModel.php';
require_once 'models/perConfirmar.php';
require_once 'models/gradosModel.php';

class PerConfirmarCtrl{
    
    private $model;
    private $objGrados;
    
    public function __construct(){
        $this->model = new PerConfirmar();
        $this->objGrados = new Grados();
    }

    public function Index(){
        include ('views/header.php');
        include ('views/home.php');
        include ('views/footer.php');
    }
    
    public function Lista(){
        include ('views/header.php');
        include ('views/perConfirmar/listView.php');
        include ('views/footer.php');
    }
    
    public function Crud(){
        $per = new PerConfirmar();
        
        if(isset($_REQUEST['id'])){
            $per = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'views/header.php';
        require_once 'views/PerConfirmar/cargarView.php';
        require_once 'views/footer.php';
    }
    
    public function Guardar(){
        $per = new PerConfirmar();

        $per->id = $_REQUEST['id'];
        $per->codgrado = $_REQUEST['grado'];
        $per->apeynom = $_REQUEST['nombre'];
        $per->codest = $_REQUEST['codest'];
        $per->nrodoc = $_REQUEST['documento'];
        $per->telefono = "0".$_REQUEST['codigo']."15".$_REQUEST['numero'];
        $per->coduni = $_REQUEST['unidad'];
        $per->turno = $_POST['turno'];
        $per->dia = $_POST['dia'];

        if($per->id > 0)
        {
            $this->model->Actualizar($per);
            $this->Index();
        }
        elseif($this->model->ValidarRegistro($per) == null){
             $this->model->Registrar($per);
             $this->Index();
        }
        else{
            require_once 'views/header.php';
            echo ("<script>
                    $(function() {
                     $('#miModal').modal('show');
                    });
                   </script>");
            require_once 'views/PerConfirmar/cargarView.php';
            include ('views/footer.php');
        }
                    
        //header('Location: index.php');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php?controller=perConfirmar&action=Lista');
    }
}



 ?>