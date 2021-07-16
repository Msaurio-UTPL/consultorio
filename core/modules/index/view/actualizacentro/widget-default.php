<?php
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
	if ($rol=='1' )
	{
		if(count($_POST)>0)
		{
			//echo "ingresa a bloque 1";
			$emp = SPCentro::getById($_POST["id"]);
			$emp->cenDescripcion = $_POST["nombre"];
			$emp->cenSuscripcionInicio = $_POST["susini"];
			$emp->cenSuscripcionFin = $_POST["susfin"];
			$enlace = mysqli_connect('localhost', 'root', '', 'consultorio');
			//echo isset($_FILES["logo"]);		
			if (!isset($_FILES["logo"]) || $_FILES["logo"]["error"] > 0)
			{
				Core::alert("Ha ocurrido un error.");
			}
			//echo "ingresa a bloque 2";
			$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
			$limite_kb = 1000;
			if (in_array($_FILES['logo']['type'], $permitidos) && $_FILES['logo']['size'] <= $limite_kb * 1024)
			{
				//echo "ingresa a bloque 3";
				// Archivo temporal
				$imagen_temporal = $_FILES['logo']['tmp_name'];
				// Tipo de archivo
				$tipo = $_FILES['logo']['type'];
				// Tamano de archivo
				$tamano = round($_FILES['logo']['size']/1024,0);
				// Leemos el contenido del archivo temporal en binario.
				$fp = fopen($imagen_temporal, 'r+b');
				$data = fread($fp, filesize($imagen_temporal));
				fclose($fp);
				//echo "ingresa a bloque 4";				
				//Podríamos utilizar también la siguiente instrucción en lugar de las 3 anteriores.
				// $data=file_get_contents($imagen_temporal);
				// Escapamos los caracteres para que se puedan almacenar en la base de datos correctamente.
				$data = mysqli_real_escape_string($enlace,$data);
				// Insertamos en la base de datos.
				//echo "INSERT INTO imagenes (imagen, tipo_imagen) VALUES ('$data', '$tipo');";
				//$resultado = $enlace->query("INSERT INTO imagenes (imagen, tipo_imagen,tamano_imagen) VALUES ('$data', '$tipo',$tamano);");
				$emp->cenLogo=$data;
				//echo "ingresa a bloque 5";
				$emp->update();
				//echo "ingresa a bloque 6";
				if ($emp)
				{
					Core::alert("El archivo ha sido copiado exitosamente.");
				}
				else
				{
					Core::alert("Ocurrió algun error al copiar el archivo: Tipo: ".$tipo.'Tamaño: '.$tamano);
				}
			}
			else
			{
				echo "Formato de archivo no permitido o excede el tamaño límite de $limite_kb Kbytes.";
			}
			// Log
			/*
			$milog=new SPLog();
			$milog->codigo=Session::getUID();
			$milog->ip=$ip;
			*/
			/*			
			if (isset($bactivo))
			{
				$milog->operacion=$bactivo.$_POST["usuario"];
				$milog->add();
			}
			*/
			Core::alert("El centro ha sido actualizado exitosamente.");
			print "<script>window.location='index.php?view=centro';</script>";
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