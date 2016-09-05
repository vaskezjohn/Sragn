<?php 
class LineasTren 
{	
	private $pdo;
    
    public $id;
    public $codlinea;
    public $desclinea;
	

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

	public function ObtenerLineas()
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM lineastren");		          

			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

}


 ?>