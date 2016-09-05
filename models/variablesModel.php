<?php 
//require_once 'db.php';

class Variables 
{
	private $pdo;
    
    public $id;
    public $semana;
    public $fecDesde;
    public $fecHasta;
	

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

	public function Guardar(Variables $data)
	{
		try 
		{
		$sql = "INSERT INTO variables (semana) 
		        VALUES (?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->semana
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function BuscarFecha($codestacion)
    {
	  try 
        {
            $stm = $this->pdo
                      ->prepare("SELECT grados.descgrado, usuarios.apeynom, variables.semana 
                      	FROM variables, estacion, usuarios, grados
                      	WHERE variables.codestacion=estacion.idcodestacion 
                      		  and estacion.acargo=usuarios.nrodoc
                      		  and usuarios.codgrado=grados.codgrado
                      	      and variables.codestacion = ?");
                      
            $stm->execute(array($codestacion));

            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }	
    }


}


 ?>