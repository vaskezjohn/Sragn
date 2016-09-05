
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>SRAGN</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="css/misEstilos.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>  
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <link href="css/bootstrap.min.css" rel="stylesheet">
  	<script type="text/javascript" src="js/funciones.js"></script>
</head>

<header class="navbar navbar-inverse navbar-static-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">SRAGN</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
          <?php if(isset($_SESSION["user_id"])):
          //$user = UserData::getById(Session::get("user_id"));
          ?>
            <li class="active"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Incio</a></li>
            <li><a href="?controller=perConfirmar&action=Lista">Mostrar Personas</a></li>  
            <li><a href='?controller=variables&action=Crud'>Solicitar Turno</a></li>
            <li><a href='?controller=variables&action=ViewTurnos'>Mis Turnos</a></li>
            <li><a href='?controller=variables&action=ViewConfi'>Configuracion</a></li>
          
          <?php else:?>
            <li class="active"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Incio</a></li>
          <?php endif;?> 
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
           <?php if(isset($_SESSION["user_id"])):?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span> 
                        <strong><?php echo ($_SESSION["user_id"]["nrodoc"]);?></strong>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="text-center coloTitulos"><strong><?php echo (strtoupper($_SESSION["user_id"]["apeynom"]));?></strong></p>
                                        <p class="text-center small coloTitulos"><strong><?php echo (strtoupper($_SESSION["user_id"]["mail"]));?></strong></p>
                                        
                                        <p>
                                            <a href="?controller=user&action=ViewReg&id=<?php echo ($_SESSION["user_id"]["id"]); ?>" class="btn btn-primary btn-block btn-default  btn-circle">Editar Perfil</a>
                                        </p>
                                         <p>
                                            <a href="?controller=user&action=ViewReg&id=<?php echo ($_SESSION["user_id"]["id"]); ?>" class="btn btn-primary btn-block btn-default  btn-circle">Cambiar Contraseña</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>
                                            <a href="?controller=user&action=Logout" class="btn btn-danger btn-block btn-circle"><span class="glyphicon glyphicon-log-in"></span> Cerrar Sesion</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
               <?php else:?>
                  <li><a href="?controller=user&action=ViewReg"><span class="glyphicon glyphicon-user"></span> Registrar</a></li>
                  <li><a href="?controller=user&action=ViewLog"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
               <?php endif;?> 
        </ul>

    </nav>
  </div>
</header>






