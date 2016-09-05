<?php 
require_once 'db.php';

class Grados extends Database
{
	private $pdo;
    
    public $id;
    public $codgrado;
    public $descgrado;
	

	public function __construct()
	{
		try
		{
		    $this->pdo = $this->Conectar();   
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}


	public function TodoGrados()
	{
		try 
		{
		    $stm = $this->pdo->prepare("SELECT * FROM grados ORDER BY codgrado DESC");	
			$stm->execute();	

		    return $stm->fetchall(PDO::FETCH_OBJ);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}


 ?>