<?php
$u=null;
if(Session::getUID()!="")
{
	$u = UserData::getById(Session::getUID());
	$user = $u->usuario;
	$perfil=$u->perfil;
	if ($perfil=="1")
	{
	?>	
		<div class="row">
			<div class="col-md-12">
				<h3>Lista de Disciplinas</h3>
				<?php

				$users = SPDisciplina::getAll();
				if(count($users)>0){
					// si hay usuarios
					?>
					<table class="table table-bordered table-hover">
					<thead>
					<th>Id</th>
					<th>Disciplina</th>
					</thead>
					<?php
					foreach($users as $user){
						?>
						<tr>
						<td><?php echo $user->idDisciplina; ?></td>
						<td><?php echo $user->DesDisciplina; ?></td>
						</tr>
						<?php
					}

				}else{
					// no hay usuarios
				}
				?>
			</div>
		</div>
<?php
	}	
	else
	{
		View::Error("<b>Error!!!<br></b>El usuario <b>".$user."</b> no esta autorizado para emplear esta opción.<br><a href='index.php?view=home'>Inicio</a>");
	}
}
else
{
	View::Error("<b>Error!!!<br></b>No puede emplear el sistema sin iniciar sesión.<br><a href='index.php'>Inicio</a>");
}
?>