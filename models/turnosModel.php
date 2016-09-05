<?php 

class Turno
{	
	private $pdo;
    
    public $id;
    public $nrodoc;
    public $codestacion;
    public $codlinea;
    public $turno;
    public $dia;
    public $estado;
    public $ingreso;
	

	public function __construct()
	{
		try
		{
			$this->pdo = Database::Conectar();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}


	public function CargarTurno(Turno $data)
	{
		try 
		{
		$sql = "INSERT INTO turnos (nrodoc,codestacion,codlinea,turno,dia,estado,ingreso) 
		        VALUES (?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->nrodoc,
                    $data->codestacion,
                    $data->codlinea,
                    $data->turno, 
                    $data->dia,
                    $data->estado,
                    date('Y-m-d H:i:s')
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

    public function BuscarTurnos($nrodoc)
    {
	  try 
        {
            $stm = $this->pdo
                      ->prepare("SELECT * FROM turnos, estacion, lineastren 
                      	WHERE turnos.codestacion=estacion.idcodestacion 
                      	      and turnos.codlinea=lineastren.idcodlinea 
                      	      and nrodoc = ?");
                      
            $stm->execute(array($nrodoc));

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }	
    }

    public function ObtenerTurno($id)
    {
      try 
        {
            $stm = $this->pdo
                      ->prepare("SELECT estado FROM turnos WHERE id = ?");
                      
            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }   
    }

}

 ?>