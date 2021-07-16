<?php
error_reporting(E_ERROR | E_PARSE);
function getRealIP()
    {
    
        if (isset($_SERVER["HTTP_CLIENT_IP"]))
        {
            return $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
        {
            return $_SERVER["HTTP_X_FORWARDED"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED"]))
        {
            return $_SERVER["HTTP_FORWARDED"];
        }
        else
        {
            return $_SERVER["REMOTE_ADDR"];
        }
    }
$ip=getRealIP();
$u=null;
if(Session::getUID()!="")
{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	if ($rol=='1' or $rol=='2')
	{
		if(count($_POST)>0)
		{
			//echo $_POST["descconcepto"];
			$vid=$_POST["conIdConcepto"];
			$vdescripcion=$_POST["detDescDetalle"];
			$vnexo=$_POST["detNexo"];
			//Se debe validar si existe un detalle de concepto con esa descripcion
			$controlconcepto = SPDetConceptos::getByDesc($vid,$vdescripcion);
			$vidd = new SPDetConceptos();
			$vidd = SPDetConceptos::getMax($vid);
			if (count($controlconcepto)>0)
			{
				// Ya existe
				Core::alert("El Detalle de Concepto ya existe, por favor revise..");
				print "<script>window.location='index.php?view=detalleconceptosg';</script>";
			}
			else
			{
				// Es nuevo Detalle de Concepto
				// Se debe crear un objeto del tipo SPDetConceptos y personalizar sus atributos
				$rconcepto = new SPDetConceptos();
				$rconcepto->concepto_conIdConcepto = $vid;
				$rconcepto->detIdDetalle = $vidd->secuencia;
				$rconcepto->detDescDetalle=$vdescripcion;
				if (strlen($vnexo)<1)
				{
					$rconcepto->detNexo='NULL';	
				}
				else
				{
					$rconcepto->detNexo=$vnexo;	
				}
				$rconcepto->add();
				$controlconcepto = SPDetConceptos::getByDesc($vid,$vdescripcion);
				// Aqui se registra en Log el nuevo concepto creado
				/*
				$milog=new SPLog();
				$milog->codigo=Session::getUID();
				$milog->operacion="Agrega Concepto:".$user->conIdConcepto;
				$milog->ip=$ip;
				$milog->add();
				*/
				?>
				<h3>Detalle del Concepto creado:</h3>
				<table class="table table-bordered table-hover">
				<thead>
				<th>Codigo</th>
				<th>Detalle</th>
				<th>Descripcion</th>
				<th>Nexo</th>
				</thead>
				<tr>
				<td><?php echo $controlconcepto->concepto_conIdConcepto; ?></td>
				<td><?php echo $controlconcepto->detIdDetalle; ?></td>
				<td><?php echo $controlconcepto->detDescDetalle; ?></td>
				<td><?php echo $controlconcepto->detNexo; ?></td>
				</tr>
				</table>
				<form class="form-horizontal" role="form">
					<a href="#" onclick="window.location='index.php?view=detalleconceptosg'">Volver Atras</a>
				</form>	
				<?php

			}
		}	
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