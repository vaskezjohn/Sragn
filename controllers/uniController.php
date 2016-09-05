<?php 
require_once '../models/uniModel.php';

class UnidadesCtrl{
    
    private $model;
    public $unidad;
    public $data;
    
    public function __construct($unidad){
        $this->model = new Unidades();
        $this->unidad=$unidad;
        //$this->ListUnidades();
    }

    public function Index(){
        include ('views/header.php');
        include ('views/home.php');
        include ('views/footer.php');
    }
    
    
    public function ListUnidades(){
        return $this->model->UniCorta($this->unidad);
    }
}


$unidades = new UnidadesCtrl($_GET['term']);
echo json_encode($unidades->ListUnidades());




 ?>


