<?php 
//require_once 'db.php';
class Usuarios 
{
	private $pdo;
    
    public $id;
    public $codgrado;
    public $apeynom;
    public $codest;
    public $nrodoc;
    public $codarea;
    public $telefono;
    public $coduni;
    public $mail;
    public $pass;
    public $codrol;
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

	public function TraerTodos()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT usuarios.id,
					   codest,
				       apeynom,
				       grados.descgrado as codgrado,
				       coduni,
				       codarea,
				       tel,
				       nrodoc,
				       $mail,
				       $pass,
				       $codrol
				FROM usuarios, grados
				where usuarios.codgrado=grados.codgrado");
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
			          ->prepare("SELECT * FROM usuarios WHERE id = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function BuscarNroDoc($dni)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM usuarios WHERE nrodoc = ?");
			$stm->execute(array($dni));

			if ($stm->rowCount()> 0) {
				return true;
			}
			else{
				return false;
			}

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
			            ->prepare("DELETE FROM usuarios WHERE id = ?");			          

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
			$sql = "UPDATE usuarios SET 
						codgrado      = ?, 
						apeynom       = ?,
                        codest        = ?,
						codarea       = ?, 
						tel           = ?,
						coduni        = ?,
						mail          = ?

				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->codgrado, 
                        $data->apeynom,
                        $data->codest,
                        $data->codarea,
                        $data->telefono,
                        $data->coduni,
                        $data->mail,
                        $data->id
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
	public function ValidarRegistro(usuarios $data)
	{
		try 
		{
			$stm = $this->pdo
			       ->prepare("SELECT COUNT(*) FROM usuarios WHERE nrodoc=? 
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

	public function Registrar(Usuarios $data)
	{
		try 
		{
		$sql = "INSERT INTO usuarios (codgrado,apeynom,codest,nrodoc, codarea,tel,coduni,mail,pass,codrol,ingreso) 
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->codgrado,
                    $data->apeynom, 
                    $data->codest,
                    $data->nrodoc,
                    $data->codarea,
                    $data->telefono,
                    $data->coduni,
                    $data->mail,
                    $data->pass,  
                    $data->codrol,
                    date('Y-m-d H:i:s')
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}


	public function TraerUser(Usuarios $data)
	{
		try 
		{
		    $stm = $this->pdo->prepare("SELECT * FROM usuarios WHERE nrodoc=? 
			       	and pass=?");

			$stm->execute(array($data->nrodoc,
								$data->pass));

			foreach ( $stm->fetchall(PDO::FETCH_OBJ) as $row => $value) {
				$user = (array)$value;
			}

			if (isset($user)): return $user; endif;
		    

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}

 ?>