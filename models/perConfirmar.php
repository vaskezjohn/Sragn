<?php 
//require_once 'db.php';
class PerConfirmar 
{
	private $pdo;
    
    public $id;
    public $codgrado;
    public $apeynom;
    public $codest;
    public $nrodoc;
    public $telefono;
    public $coduni;
    public $turno;
    public $dia;
    public $confirmado;
	


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

	public function TraerTodos()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT perConfirmar.id,
					   codest,
				       apeynom,
				       grados.descgrado as codgrado,
				       coduni,
				       telefono,
				       nrodoc,
				       turno,
				       dia
				FROM perConfirmar, grados
				where perConfirmar.codgrado=grados.codgrado");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);

		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM perConfirmar WHERE id = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM perConfirmar WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try 
		{
			$sql = "UPDATE perConfirmar SET 
						codgrado      = ?, 
						apeynom       = ?,
                        codest        = ?,
						nrodoc        = ?, 
						telefono      = ?,
						coduni        = ?,
						turno         = ?,
						dia           = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->codgrado, 
                        $data->apeynom,
                        $data->codest,
                        $data->nrodoc,
                        $data->telefono,
                        $data->coduni,
                        $data->turno,
                        $data->dia, 
                        $data->id
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	public function ValidarRegistro(perConfirmar $data)
	{
		try 
		{
			$stm = $this->pdo
			       ->prepare("SELECT COUNT(*) FROM perConfirmar WHERE nrodoc=? 
			       	and turno=?
			       	and dia=?");

			$stm->execute(array($data->nrodoc,
								$data->turno,
								$data->dia));
			return $stm->fetch(PDO::FETCH_OBJ);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}

	public function Registrar(perConfirmar $data)
	{
		try 
		{
		$sql = "INSERT INTO perConfirmar (codgrado,apeynom,codest,nrodoc,telefono,coduni,turno,dia,confirmar) 
		        VALUES (?, ?, ?, ?, ?, ?, ?,?,0)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->codgrado,
                    $data->apeynom, 
                    $data->codest,
                    $data->nrodoc,
                    $data->telefono,
                    $data->coduni,
                    $data->turno,
                    $data->dia, 
                    //date('Y-m-d')
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}

 ?>