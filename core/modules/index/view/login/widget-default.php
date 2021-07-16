<?php

if(Session::getUID()!="")
{
	print "<script>window.location='index.php?view=home';</script>";
}

?>
<div class="row vertical-offset-100">
    	<div class="col-md-4 col-md-offset-2">
    	<?php if(isset($_COOKIE['password_updated'])):?>
				<div class="alert alert-success">
				<p><i class='glyphicon glyphicon-off'></i> Se ha cambiado la contraseña exitosamente !!</p>
    		<p>Pruebe iniciar sesion con su nueva contraseña.</p>
    		</div>
    	<?php setcookie("password_updated","",time()-18600);
    	 endif; ?>
    		<div class="panel panel-primary">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Ingreso al sistema GesMed-ECU v1.0</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form accept-charset="UTF-8" role="form" method="post" action="index.php?view=processlogin">
					
                    <fieldset>
						<div align='center'><img src="report/logo-gesmed.jpg" alt="GESMED-ECU" height="97" width="130"></div>
						<br>
						<div class="form-group">
							<input class="form-control" placeholder="Ingrese su usuario"  name="codigo" type="text">
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Ingrese su Contraseña" name="password" type="password" value="">
						</div>
			    		<input class="btn btn-lg btn-primary btn-block" type="submit" value="Iniciar Sesión">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
		</div>
	</div>
