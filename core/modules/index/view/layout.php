<!DOCTYPE html>
<html lang="es"> 
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SISTEMA DE GESTIÓN DE CITAS MEDICAS">
    <meta name="author" content="Mario Suarez Cedeno">
    <title>SISTEMA DE GESTIÓN DE CITAS MEDICAS (GesMed-ECU).</title>
    <!-- Bootstrap core CSS -->
    <link href="res/bootstrap3/css/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <!--
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	-->
	<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="js/jquery-1.10.2.js"></script>
  </head>
  <body>
  <div id="wrapper">
      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./">GesMed-ECU <sup><small><span class="label label-info">v1.0</span></small></sup></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
		<?php 
			$u=null;
			if(Session::getUID()!=""):
			$u = SPUser::getById(Session::getUID());
			$empresa = SPCentro::getById(1);
		?>
			<ul class="nav navbar-nav side-nav">
				<li><a href=""> Cliente: <?php echo $empresa->cenDescripcion; ?> </a></li>
				<div align='center'>
					<?php
					echo '<img src="data:image/jpeg;base64,'.base64_encode($empresa->cenLogo).' " height="97" width="130">';
					?>
				</div>
				<li><a href="index.php?view=funcionalidad"><i class="fa fa-filter"></i> Funcionalidad </a></li>						
				<li><a href="index.php?view=pacientes"><i class="glyphicon glyphicon-folder-close"></i> Gestión de Pacientes</a></li>
				<?php if($u->detIdRol=='1' or $u->detIdRol=='2'):?>			
				<li><a href="index.php?view=reportes"><i class="fa fa-newspaper-o"></i> Gestión de Reportes</a></li>	
				<li><a href="index.php?view=atencion"><i class="fa fa-address-card"></i> Gestión Atención Médica</a></li>
				<li><a href="index.php?view=medicos"><i class="glyphicon glyphicon-user"></i> Gestión de Médicos</a></li>
				<?php endif;?>
				<?php if($u->detIdRol=='1'):?>	
				<li><a href="index.php?view=parametrosg"><i class="glyphicon glyphicon-cog"></i> Parámetros Generales</a></li>				
				<li><a href="index.php?view=usuarios"><i class="fa fa-users"></i> Usuarios del Sistema </a></li>
				<li><a href="index.php?view=centro"><i class="glyphicon glyphicon-briefcase"></i> Centros Médicos</a></li>
				<?php endif;?>
			</ul>
			<?php endif;?>
			<ul class="nav navbar-nav navbar-right navbar-user">
				<?php if(Session::getUID()!=""):?>
				<?php 
				$u=null;
				if(Session::getUID()!=""){
				  $u = SPUser::getById(Session::getUID());
				  $user = $u->usuCodUsuario." <b>Nombre:</b> ".$u->usuNombreUsuario;
				  $notas= array();
				  //$notas = CPNotaData::getAllPorAtender($u->usuario);
				}?>
				<li class="dropdown user-dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown"><b>Usuario: </b><?php echo $user; ?><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="logout.php?id=<?php echo $u->usuCodUsuario; ?>">Salir</a></li>
					</ul>
				</li>
				<?php
					if(count($notas)>0)
					{
					  ?>
					  <a href="./index.php?view=notasatender">Avisos: <?php echo count($notas);?>.</a>
					  <?php
					}
				?>
				<?php else:?>

				<?php endif; ?>
			</ul>
        </div><!-- /.navbar-collapse -->
      </nav>
      <div id="page-wrapper">
		<?php 
		  // Opcional Carga de Funciones
		  View::load("login");
		?>
      </div><!-- /#page-wrapper -->
    </div><!-- /#wrapper -->
    <!-- JavaScript -->
<script src="res/bootstrap3/js/bootstrap.min.js"></script>
  </body>
</html>