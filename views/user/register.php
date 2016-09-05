<?php require_once './models/gradosModel.php'; ?>
<div class="container">
  <div id="divError"></div>
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <?php echo $user->id != null ? "Editar Perfil" : "Registro";  ?>
        </div>
        <div class="panel-body">
          <form role="form" method="post" action="?controller=user&action=Registrar">
          <input type="hidden" name="id" value="<?php echo $user->id; ?>" />

          <div class="form-group">
              <label for="codgrado">Grado</label>
              <select class="form-control" id='codgrado' name='grado' >            
                <?php $objGrados = new Grados();
                 foreach($objGrados->TodoGrados() as $r):?>
                  <option <?php echo $r->codgrado == $user->codgrado ? 'selected' : '';?> value="<?php echo $r->codgrado;?>"><?php echo $r->descgrado;?></option>
                <?php endforeach;?>
              </select>
          </div>
          <div class="form-group">
            <label for="apeynom">Apellidos y Nombre</label>
            <input onkeypress="return validaLetra(event)" required id='apeynom' name='nombre' class='form-control mayuscula' autocomplete="off" type='text'  value="<?php if(!empty($user->apeynom)): echo $user->apeynom; elseif(!empty($_REQUEST['nombre'])): echo $_REQUEST['nombre']; else: echo null; endif; ?>" placeholder="Nombre Completo">
          </div>
          <div class="form-group">
            <label for="ce">Codigo Estadistico</label>
            <input onkeypress="return valida(event)" required id='ce' name="codest" class='form-control' autocomplete="off" maxlength="6" type='tel' value="<?php if(!empty($user->codest)): echo $user->codest; elseif(!empty($_REQUEST['codest'])): echo $_REQUEST['codest']; else: echo null; endif; ?>" placeholder="Ej:100100 (Sin Guion)">
          </div>
          <?php if($user->id == null): ?>
          <div class="form-group">
            <label for="nrodoc">Numero Documento</label>
            <input  onkeypress="return valida(event)" required id='nrodoc' name="documento" class='form-control' autocomplete="off" maxlength="8" type='tel' value="<?php if(!empty($user->nrodoc)): echo $user->nrodoc; elseif(!empty($_REQUEST['documento'])): echo $_REQUEST['documento']; else: echo null; endif; ?>" placeholder="Ej:30000000 (Sin Punto)">
          </div>
        <?php endif;?>
          <div class="form-group">
            <label for="telefono">Telefono</label>
            <div class="row">
              <div class="col-xs-5 col-md-5 col-lg-6 ">
                <div id="login-codigo-container" class="input-group">
                  <span class="input-group-addon">0</span>
                  <input required type="tel" name="codigo" value="<?php if(!empty($user->codarea)): echo substr($user->codarea,1,4) ; elseif(!empty($_REQUEST['codigo'])): echo $_REQUEST['codigo']; else: echo null; endif;  ?>" maxlength="4" class="form-control" onkeypress="return valida(event)" placeholder="Ej:11 (Codigo de area)">
                </div>   
              </div>

              <div class="col-xs-7 col-md-7 col-lg-6">
                <div id="login-numero-container" class="input-group">
                  <span class="input-group-addon">15</span>
                  <input required type="tel" name="numero" value="<?php if(!empty($user->tel)): echo substr($user->tel,2,8) ; elseif(!empty($_REQUEST['numero'])): echo $_REQUEST['numero']; else: echo null; endif; ?>" autocomplete="off" maxlength="8" class="form-control" onkeypress="return valida(event)" placeholder="Ej:17897980">
                </div>
              </div>    
            </div>
          </div>
          <div class="form-group">
            <label for="uni">Unidad de Revista</label>
            <input onkeypress="return validaLetra(event)" required id='uni' class='form-control mayuscula'  maxlength="15" name="unidad" type='text' value="<?php if(!empty($user->coduni)): echo $user->coduni; elseif(!empty($_REQUEST['unidad'])): echo $_REQUEST['unidad']; else: echo null; endif; ?>" placeholder="EJ:DIRSAF">
          </div>
          <div class="form-group">
            <label for="email">Correo electronico</label>
            <input type="email" class="form-control" value="<?php  if(!empty($user->mail)): echo $user->mail; elseif(!empty($_REQUEST['mail'])): echo $_REQUEST['mail']; else: echo null; endif;  ?>" id="email" name="mail" placeholder="Correo electronico" required>
          </div>

          <?php if($user->id == null): ?>
          <div class="form-group">
            <label for="pass1">Password</label>
            <input type="password" class="form-control" id="pass1" name="pass" placeholder="Password" required>
          </div>
          <div class="form-group">
            <label for="pass2">Confirmar Password</label>
            <input type="password" name="passconf" value="" class="form-control" id="pass2" placeholder="Confirmar Password" required>
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox" required> Acepto terminos y condiciones
            </label>
          </div>
          <?php endif;?>

          <button type="submit" class="btn btn-block btn-default"> <?php echo $user->id != null ? "Guardar Cambios" : "Registrar";  ?></button>
        </form>
      </div>
    </div>
  </div>
</div>
