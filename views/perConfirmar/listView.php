<?php if (isset($_SESSION["user_id"])):
require_once './models/gradosModel.php';
?>
<div class='container'>
<br>
<h1 class="page-header">Alumnos</h1>

<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?controller=perConfirmar&action=TraerTodo">Nuevo alumno</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:180px;">CodEst</th>
            <th>Apellido</th>
            <th>Grado</th>
            <th style="width:120px;">Unidad</th>
            <th style="width:120px;">Telefono</th>
            <th style="width:120px;">Docuemnto</th>
            <th style="width:60px;">Turno</th>
            <th style="width:60px;">Dia</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->TraerTodos() as $r): ?>
        <tr>
            <td><?php echo $r->codest; ?></td>
            <td><?php echo $r->apeynom; ?></td>
            <td><?php echo $r->codgrado; ?></td>
            <td><?php echo $r->coduni; ?></td>
            <td><?php echo $r->telefono; ?></td>
            <td><?php echo $r->nrodoc; ?></td>
            <td><?php echo $r->turno; ?></td>
            <td><?php echo $r->dia; ?></td>
            <td>
                <a href="?controller=perConfirmar&action=Crud&id=<?php echo $r->id; ?>">Editar</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?controller=perConfirmar&action=Eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 
</div>

<?php endif;?>