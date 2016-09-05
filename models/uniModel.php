<?php 
require_once 'db.php';

class Unidades extends Database
{
	private $pdo;
    
    public $id;
    public $desccorta;
    public $descuni;
	

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


	public function UniCorta($uni)
	{
		try 
		{
		    $stm = $this->pdo->prepare("SELECT * FROM unidades WHERE desccorta LIKE '".$uni."%' ORDER BY desccorta ASC LIMIT 0,10");	
			$stm->execute();	

			foreach ( $stm->fetchall(PDO::FETCH_OBJ) as $row) {
				$data[]=$row->desccorta;
			}

		    return $data;

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}
	
?>