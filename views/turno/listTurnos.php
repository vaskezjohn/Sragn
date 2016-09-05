<div class="container">
	<?php foreach ($this->objTurnos->BuscarTurnos($_SESSION["user_id"]["nrodoc"]) as $r): ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title pull-left">Turno Solicitado Fecha: <?php echo date("d-m-Y", strtotime($r->ingreso));?> Solicitud Nro: <?php echo $r->id; ?></h3>
			<a class="btn-info btn pull-right" href="?controller=variables&action=Crud&id=<?php echo $r->id; ?>">Ver Detalle</a>
		<div class="clearfix"></div>
		</div>
		<div class="panel-body"><table class="table">
			<thead class="thead-inverse">
				<tr>
					<th>Estacion</th>
					<th>Linea</th>
					<th>Turno</th>
					<th>Dia</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td><?php echo $r->estacion; ?></td>
					<td><?php echo $r->desclinea; ?></td>
					<td><?php echo $r->turno; ?></td>
					<td><?php echo $r->dia; ?></td>
				</tr>		 
			</tbody>			  
			</table>
		</div>
	</div>
	<?php endforeach?>
</div>


