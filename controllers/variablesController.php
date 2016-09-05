<?php 
require_once 'models/estacionesModel.php';
require_once 'models/turnosModel.php';
require_once 'models/lineasModel.php';
require_once 'models/variablesModel.php';

class VariablesCtrl 
{
	  private $modelVariables;
    private $objLineas;
    private $objEstaciones;
    private $objTurnos;
    private $linea;

    private $estadop1="active";
    private $estadop2="disabled";
    private $estadop3="disabled";
    private $estadofin="disabled";

	
	function __construct()
	{
		    $this->modelVariables = new Variables();
        $this->objLineas = new LineasTren();
        $this->objEstaciones = new Estacion();
        $this->objTurnos = new Turno();
	}

    public function Index(){
        include ('views/header.php');
        include ('views/home.php');
        include ('views/footer.php');
    }

	public function Crud(){
        $estado;        
        if(!empty($_REQUEST['id'])){
            
        $estado = $this->objTurnos->ObtenerTurno($_REQUEST['id']);

            if ($estado["estado"]=='0')
            {              
                $this->estadop1="disabled";
                $this->estadop3="active";
            }
            else
            {
              $this->estadop1="disabled";
              $this->estadofin="active";
            }
        }
        
        include ('views/header.php');
        include ('views/turno/solturnoView.php');
        include ('views/footer.php');
    }

    public function ViewTurnos(){
        include ('views/header.php');
        include ('views/turno/listTurnos.php');
        include ('views/footer.php');
    }

    public function ViewConfi(){
        include ('views/header.php');
        include ('views/configurar/confi.php');
        include ('views/footer.php');
    }



	 public function Guardar(){
        $objFecha = new Variables();

        $fecDesde=date('Y-m-d', strtotime($_REQUEST['semana']));
        $fecHasta=date('Y-m-d',strtotime('+7 day', strtotime($fecDesde)));
        
        $objFecha->semana = $_REQUEST['semana'];
        $objFecha->fecDesde = $fecDesde;
        $objFecha->fecHasta = $fecHasta;

        echo date('Y-m-d',strtotime('+7 day', strtotime($_REQUEST['semana'])));

        $this->modelVariables->Guardar($objFecha);
                
       // header('Location: index.php');
    }
    public function TraerEstaciones()
    {
       $this->linea = $_REQUEST["radio"];

       $this->estadop1="";
       $this->estadop2="active";

       $this->Crud();
    }

    public function EnviarSolicitud()
    {       
       $turno = new Turno();

       $turno->nrodoc=$_SESSION["user_id"]["nrodoc"];
       $turno->codestacion=$_REQUEST["estacion"];
       $turno->codlinea=$_REQUEST["linea"];
       $turno->turno=$_REQUEST["turno"];
       $turno->dia=$_REQUEST["dia"];
       $turno->estado=0;  

       $this->objTurnos->CargarTurno($turno);

       $this->estadop1="disabled";
       $this->estadop3="active";


       $this->Crud();
    }

    public function ListTurnos()
    {
      $this->objTurnos=$this->objTurnos->BuscarTurnos($_SESSION["user_id"]["nrodoc"]);
    }


    public function TraerSemana()
    {
        header('Content-Type: application/json');
        
        $cursos = $this->modelVariables->BuscarFecha($_REQUEST['codestacion']);
        print_r( json_encode($cursos));
    }

}
 
 ?>