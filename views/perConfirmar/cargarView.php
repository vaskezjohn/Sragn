<?php if (isset($_SESSION["user_id"])):?>
	<div class='container'>
		<br><br>
		<h1><?php echo $per->id != null ? $per->apeynom : 'Nueva Carga';  ?></h1>
		<hr>
		<div class='row'>
			<!-- edit form column -->
			<div class='col-md-12 personal-info'>
				<h3>Informacion del Gendarme</h3>
				<br>
				<form class='form-horizontal'  action="?controller=perConfirmar&action=Guardar" method="post" enctype="multipart/form-data" role='form'>
				<input type="hidden" name="id" value="<?php echo $per->id; ?>" />
				<div class='form-group'>
					<label class='col-lg-3 control-label'>Grado:</label>
					<div class='col-lg-8'>
						<select class="form-control" id='codgrado' name='grado' >					   
							<?php foreach($this->objGrados->TodoGrados() as $r):?>
							<option <?php echo $r->codgrado == $per->codgrado ? 'selected' : '';  ?> value="<?php echo $r->codgrado;?>"><?php echo $r->descgrado;?></option>
						<?php endforeach;?>
						</select>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-lg-3 control-label'>Apellido y Nombre:</label>
					<div class='col-lg-8'>
						<input onkeypress="return validaLetra(event)" required id='apeynom' name='nombre' class='form-control mayuscula' autocomplete="off" type='text'  value="<?php echo $per->apeynom; ?>" placeholder="NOMBRE COMPLETO">
					</div>
				</div>
				<div class='form-group'>
					<label class='col-md-3 control-label'>CodEst:</label>
					<div id='valClave1'class='col-md-8'>		
						<input onkeypress="return valida(event)" required id='ce' name="codest" class='form-control' autocomplete="off" maxlength="6" type='text' value="<?php echo $per->codest; ?>" placeholder="Ej:100100 (SIN GUION)">
					</div>
				</div>
				<div class='form-group'>
					<label class='col-md-3 control-label'>Nro Documento:</label>
					<div id='valClave2' class='col-md-8'>
						<input  onkeypress="return valida(event)" required id='nrodoc' name="documento" class='form-control' autocomplete="off" maxlength="8" type='text' value="<?php echo $per->nrodoc; ?>" placeholder="Ej:30000000 (SIN PUNTOS)">
					</div>
				</div>
				<div class='form-group'>

					<label class='col-lg-3 control-label'>Telefono:</label>

					<div class="col-lg-4">
						<div id="login-codigo-container" class="input-group input-group-sm">
							<span class="input-group-addon">0</span>
							<input onkeypress="return valida(event)" required type="text" name="codigo" value="" maxlength="4" class="form-control" onkeypress="return validarNum(event)" placeholder="Ej:11">
						</div>
					</div>
					<div class="col-lg-4">
						<div id="login-numero-container" class="input-group input-group-sm">
							<span class="input-group-addon">15</span>
							<input onkeypress="return valida(event)" required type="text" name="numero" value="" autocomplete="off" maxlength="8" class="form-control" onkeypress="return validarNum(event)" placeholder="Ej:17897980">
						</div>
					</div>
				</div>
				<div class='form-group'>

					<label class='col-lg-3 control-label'>Unidad:</label>
					<div class='col-lg-8'>
						<input onkeypress="return validaLetra(event)" required id='uni' class='form-control mayuscula'  maxlength="15" name="unidad" type='text' value="<?php echo $per->coduni; ?>" placeholder="EN LO POSIBLE SELECCIONE UNO DEL LISTADO SINO EJ:DIRSAF">
					</div>
				</div>

				<label class='col-lg-3 control-label'>Turno:</label>
				<div class='col-lg-4'>
					<div class="form-group">
						<select class="form-control" name="turno" id="selTurno">
							<option <?php echo $per->turno == 'Mañana' ? 'selected' : ''; ?>>Mañana</option>
							<option <?php echo $per->turno == 'Noche' ? 'selected' : ''; ?>>Noche</option>
						</select>
					</div>
				</div>
				<label class='col-lg-1 control-label'>Día:</label>    
				<div class='col-lg-3'>
					<div class="form-group">
						<select class="form-control" name="dia" id="selDia">
							<option <?php echo $per->turno == 'Lunes' ? 'selected' : ''; ?>>Lunes</option>
							<option <?php echo $per->turno == 'Martes' ? 'selected' : ''; ?>>Martes</option>
							<option <?php echo $per->turno == 'Miercoles' ? 'selected' : ''; ?>>Mircoles</option>
							<option <?php echo $per->turno == 'Jueves' ? 'selected' : ''; ?>>Jueves</option>
							<option <?php echo $per->turno == 'Viernes' ? 'selected' : ''; ?>>Viernes</option>
							<option <?php echo $per->turno == 'Sabado' ? 'selected' : ''; ?>>Sabado</option>
							<option <?php echo $per->turno == 'Domingo' ? 'selected' : ''; ?>>Domingo</option>
						</select>
					</div>
				</div>
				<div class='form-group'>
					<label class='col-md-3 control-label'></label>
					<div class='col-md-8'>
						<input type='submit' class='btn btn-primary' value='Guardar Cambios'>
						<span></span>
						<input onclick='MostrarPerfil()' type='reset' class='btn btn-default' value='Cancel'>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php endif;?>