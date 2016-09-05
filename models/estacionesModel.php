<?php 

class Estacion 
{	
	private $pdo;
    
    public $idcodest;
    public $estacion;
    public $codlinea;
	

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

	public function ObtenerEstaciones($linea)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Estacion WHERE codlinea = ?");		          

			$stm->execute(array($linea));
			return $stm->fetchall(PDO::FETCH_OBJ);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	


}

?>