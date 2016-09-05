
<div class="container">
  <div id="divError"></div>
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Configuracion</h4> 
        </div>
        <div class="panel-body">
          <form role="form" method="post" action="?controller=variables&action=Guardar">
          <div class="form-group">
          	<label for="sem">Semana del año habilitada</label>
            <input class='form-control' type="week" name="semana" id="sem" value="" id="fecha" min="<?php echo "2016-W".date("W"); ?>">
          </div>

          <?php 
          	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
//Salida: Viernes 24 de Febrero del 2012
		
           ?>
          <!-- 
          <div class="form-group">
            <label for="ce">Codigo Estadistico</label>
            <input onkeypress="return valida(event)" required id='ce' name="codest" class='form-control' autocomplete="off" maxlength="6" type='tel' value="<?php if(!empty($user->codest)): echo $user->codest; elseif(!empty($_REQUEST['codest'])): echo $_REQUEST['codest']; else: echo null; endif; ?>" placeholder="Ej:100100 (Sin Guion)">
          </div>
          <div class="form-group">
            <label for="nrodoc">Numero Documento</label>
            <input  onkeypress="return valida(event)" required id='nrodoc' name="documento" class='form-control' autocomplete="off" maxlength="8" type='tel' value="<?php if(!empty($user->nrodoc)): echo $user->nrodoc; elseif(!empty($_REQUEST['documento'])): echo $_REQUEST['documento']; else: echo null; endif; ?>" placeholder="Ej:30000000 (Sin Punto)">
          </div> -->
          <button type="submit" class="btn btn-block btn-primary">Guardar Cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>
