<?php

include "../core/controller/Database.php";
include "../core/controller/Executor.php";
include "../core/controller/Model.php";
include "../core/controller/Session.php";
include "../core/controller/View.php";
include "../core/modules/index/model/SPUser.php";

$u=null;
//if(Session::getUID()!="")
//{
	$u = SPUser::getById(Session::getUID());
	$user = $u->usuCodUsuario;
	$rol=$u->detIdRol;
	//if ($rol=='1')
	//{

		// Conexion a la base de datos
		$enlace = mysqli_connect('localhost', 'root', 'mxsc', 'dbcalificacion');

		if (!$enlace) {
			echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
			echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
			echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}

		if ($_GET['id'] > 0)
		{
			// Consulta de búsqueda de la imagen.
			$consulta = "SELECT docDocumento as imagen FROM dbcalificacion.documentos WHERE docIdDocumento={$_GET['id']}";
			$resultado = $enlace->query($consulta) or die(mysql_error());
			$datos = $resultado->fetch_assoc();

			$imagen = $datos['imagen']; // Datos binarios de la imagen.
			$tipo='application/pdf';
			//$tipo = $datos['tipo_imagen'];  // Mime Type de la imagen.
			// Mandamos las cabeceras al navegador indicando el tipo de datos que vamos a enviar.
			header("Content-type: application/pdf");
			// A continuación enviamos el contenido binario de la imagen.
			echo $imagen;
			//echo '<embed src="'.$imagen.'" type="application/pdf" width="10%" height="100px" />';
			//echo '<img src="data:application/pdf;base64,'.base64_encode($imagen).' " height="100" width="100">';
			//echo '<iframe src="$imagen" frameborder="0" width="655" height="550" marginheight="0" marginwidth="0" id="pdf" ></iframe>';
		}
/*
	}	
	else
	{
		View::Error("<b>Error!!!<br></b>El usuario <b>".$user."</b> no esta autorizado para emplear esta opción.<br><a href='index.php?view=home'>Inicio</a>");
	}
}
else
{
	View::Error("<b>Error!!!<br></b>No puede emplear el sistema sin iniciar sesión.<br><a href='index.php'>Inicio</a>");
	?>
	<?php
}
*/
?>