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
	if ($rol=='1' or $rol=='2' or $rol=='3')
	{
		if(count($_POST)>0)
		{
			//echo count($_POST);
			$vproveedor=$_POST['proveedor'];
			
			$videntificacion=$_POST['identificacion'];
			$vndocumentos=$_POST['totaldocumentos'];
			$arreglocodigos=$_POST['listacodigos'];
			$arregloperiodos=$_POST['listaperiodos'];
			//echo count($arreglocodigos);
			//echo count($arregloperiodos);
			$permitidos = array("application/pdf");
			$limite_kb = 1000;
			$valetipo=0;
			$valetamano=0;
			// Características de documentos
				$imagentmp1 = $_FILES['documento1']['tmp_name'];
				$imagentmp2 = $_FILES['documento2']['tmp_name'];
				$imagentmp3 = $_FILES['documento3']['tmp_name'];
				$imagentmp4 = $_FILES['documento4']['tmp_name'];
				//echo '<br>'.$imagentmp1;
				//echo '<br>'.$imagentmp2;
				//echo '<br>'.$imagentmp3;
				//echo '<br>'.$imagentmp4;
				if (
						in_array($_FILES['documento1']['type'], $permitidos) &&
						in_array($_FILES['documento2']['type'], $permitidos) &&
						in_array($_FILES['documento3']['type'], $permitidos) &&
						in_array($_FILES['documento4']['type'], $permitidos) 
					) $valetipo=1;
				$tamano1 = round($_FILES['documento1']['size']/1000,0);
				$tamano2 = round($_FILES['documento2']['size']/1000,0);
				$tamano3 = round($_FILES['documento3']['size']/1000,0);
				$tamano4 = round($_FILES['documento4']['size']/1000,0);
				if (
						$tamano1 <= $limite_kb &&
						$tamano2 <= $limite_kb &&
						$tamano3 <= $limite_kb &&
						$tamano4 <= $limite_kb
					) $valetamano=1;	
				
			if ($vndocumentos==8)
			{
				// Características de documentos
				$imagentmp5 = $_FILES['documento5']['tmp_name'];
				$imagentmp6 = $_FILES['documento6']['tmp_name'];
				$imagentmp7 = $_FILES['documento7']['tmp_name'];
				$imagentmp8 = $_FILES['documento8']['tmp_name'];
				if (
						in_array($_FILES['documento5']['type'], $permitidos) &&
						in_array($_FILES['documento6']['type'], $permitidos) &&
						in_array($_FILES['documento7']['type'], $permitidos) &&
						in_array($_FILES['documento8']['type'], $permitidos) 
					) $valetipo=$valetipo*1;
				else  $valetipo=$valetipo*0;
				$tamano5 = round($_FILES['documento5']['size']/1000,0);
				$tamano6 = round($_FILES['documento6']['size']/1000,0);
				$tamano7 = round($_FILES['documento7']['size']/1000,0);
				$tamano8 = round($_FILES['documento8']['size']/1000,0);
				if (
						$tamano5 <= $limite_kb &&
						$tamano6 <= $limite_kb &&
						$tamano7 <= $limite_kb &&
						$tamano8 <= $limite_kb
					) $valetamano=$valetamano*1;
				else  $valetamano=$valetamano*0;
			}
			//echo '<br>('.$valetipo.')('.$valetamano.')';
			if ($valetipo==1 && $valetamano==1)
			{
				/*
				for ($vindice=0;$vindice<$vndocumentos;$vindice++)
				{
					echo '<br>'.$arreglocodigos[$vindice];
					echo '<br>'.$arregloperiodos[$vindice];
					$i=$vindice+1;
				}
				*/
				// Para todos los documentos
				$enlace = mysqli_connect('localhost', 'root', 'mxsc', 'dbcalificacion');

				// Documento 1
				//echo '<br>'.$arreglocodigos[0];
				//echo '<br>'.$arregloperiodos[0];
				$rdocumento = new SPDocumento();
				
				// Borrado de documentos
				$rdocumento->delByProv($vproveedor);
				
				$rdocumento->proIdProveedor=$vproveedor;
				$rdocumento->conIdConcepto=16;
				$rdocumento->detIdDetalle=$arreglocodigos[0];
				$rdocumento->docTamanio=$tamano1;
				$rdocumento->docFecha=$arregloperiodos[0];
				// Leemos el contenido del archivo temporal en binario.
				$fp = fopen($imagentmp1, 'r+b');
				$data = fread($fp, filesize($imagentmp1));
				fclose($fp);		
				// Escapamos los caracteres para que se puedan almacenar en la base de datos correctamente.
				$data = mysqli_real_escape_string($enlace,$data);
				// Insertamos en la base de datos.
				$rdocumento->docDocumento=$data;
				$rdocumento->add();
				if ($rdocumento)
				{
					Core::alert("El archivo 1 ha sido copiado exitosamente.");
				}
				else
				{
					Core::alert("Ocurrió algun error al copiar el archivo1");
				}
				unset($rdocumento); 
				
				// Documento 2
				//echo '<br>'.$arreglocodigos[1];
				//echo '<br>'.$arregloperiodos[1];
				$rdocumento = new SPDocumento();
				$rdocumento->proIdProveedor=$vproveedor;
				$rdocumento->conIdConcepto=16;
				$rdocumento->detIdDetalle=$arreglocodigos[1];
				$rdocumento->docTamanio=$tamano2;
				$rdocumento->docFecha=$arregloperiodos[1];
				// Leemos el contenido del archivo temporal en binario.
				$fp = fopen($imagentmp2, 'r+b');
				$data = fread($fp, filesize($imagentmp2));
				fclose($fp);		
				// Escapamos los caracteres para que se puedan almacenar en la base de datos correctamente.
				$data = mysqli_real_escape_string($enlace,$data);
				// Insertamos en la base de datos.
				$rdocumento->docDocumento=$data;
				$rdocumento->add();
				if ($rdocumento)
				{
					Core::alert("El archivo 2 ha sido copiado exitosamente.");
				}
				else
				{
					Core::alert("Ocurrió algun error al copiar el archivo2");
				}
				unset($rdocumento);
				
				// Documento 3
				//echo '<br>'.$arreglocodigos[2];
				//echo '<br>'.$arregloperiodos[2];
				$rdocumento = new SPDocumento();
				$rdocumento->proIdProveedor=$vproveedor;
				$rdocumento->conIdConcepto=16;
				$rdocumento->detIdDetalle=$arreglocodigos[2];
				$rdocumento->docTamanio=$tamano3;
				$rdocumento->docFecha=$arregloperiodos[2];
				// Leemos el contenido del archivo temporal en binario.
				$fp = fopen($imagentmp3, 'r+b');
				$data = fread($fp, filesize($imagentmp3));
				fclose($fp);		
				// Escapamos los caracteres para que se puedan almacenar en la base de datos correctamente.
				$data = mysqli_real_escape_string($enlace,$data);
				// Insertamos en la base de datos.
				$rdocumento->docDocumento=$data;
				$rdocumento->add();
				if ($rdocumento)
				{
					Core::alert("El archivo 3 ha sido copiado exitosamente.");
				}
				else
				{
					Core::alert("Ocurrió algun error al copiar el archivo3");
				}
				unset($rdocumento);
				
				// Documento 4
				//echo '<br>'.$arreglocodigos[3];
				//echo '<br>'.$arregloperiodos[3];
				$rdocumento = new SPDocumento();
				$rdocumento->proIdProveedor=$vproveedor;
				$rdocumento->conIdConcepto=16;
				$rdocumento->detIdDetalle=$arreglocodigos[3];
				$rdocumento->docTamanio=$tamano4;
				$rdocumento->docFecha=$arregloperiodos[3];
				// Leemos el contenido del archivo temporal en binario.
				$fp = fopen($imagentmp4, 'r+b');
				$data = fread($fp, filesize($imagentmp4));
				fclose($fp);		
				// Escapamos los caracteres para que se puedan almacenar en la base de datos correctamente.
				$data = mysqli_real_escape_string($enlace,$data);
				// Insertamos en la base de datos.
				$rdocumento->docDocumento=$data;
				$rdocumento->add();
				if ($rdocumento)
				{
					Core::alert("El archivo 4 ha sido copiado exitosamente.");
				}
				else
				{
					Core::alert("Ocurrió algun error al copiar el archivo4");
				}
				unset($rdocumento);
				
				// Para cuando son 8 documentos
				if ($vndocumentos==8)
				{
					// Documento 5
					//echo '<br>'.$arreglocodigos[4];
					echo '<br>'.$arregloperiodos[4];
					$rdocumento = new SPDocumento();
					$rdocumento->proIdProveedor=$vproveedor;
					$rdocumento->conIdConcepto=16;
					$rdocumento->detIdDetalle=$arreglocodigos[4];
					$rdocumento->docTamanio=$tamano5;
					$rdocumento->docFecha=$arregloperiodos[4];
					// Leemos el contenido del archivo temporal en binario.
					$fp = fopen($imagentmp5, 'r+b');
					$data = fread($fp, filesize($imagentmp5));
					fclose($fp);		
					// Escapamos los caracteres para que se puedan almacenar en la base de datos correctamente.
					$data = mysqli_real_escape_string($enlace,$data);
					// Insertamos en la base de datos.
					$rdocumento->docDocumento=$data;
					$rdocumento->add();
					if ($rdocumento)
					{
						Core::alert("El archivo 5 ha sido copiado exitosamente.");
					}
					else
					{
						Core::alert("Ocurrió algun error al copiar el archivo5");
					}
					unset($rdocumento); 
					
					// Documento 6
					//echo '<br>'.$arreglocodigos[5];
					//echo '<br>'.$arregloperiodos[5];
					$rdocumento = new SPDocumento();
					$rdocumento->proIdProveedor=$vproveedor;
					$rdocumento->conIdConcepto=16;
					$rdocumento->detIdDetalle=$arreglocodigos[5];
					$rdocumento->docTamanio=$tamano6;
					$rdocumento->docFecha=$arregloperiodos[5];
					// Leemos el contenido del archivo temporal en binario.
					$fp = fopen($imagentmp6, 'r+b');
					$data = fread($fp, filesize($imagentmp6));
					fclose($fp);		
					// Escapamos los caracteres para que se puedan almacenar en la base de datos correctamente.
					$data = mysqli_real_escape_string($enlace,$data);
					// Insertamos en la base de datos.
					$rdocumento->docDocumento=$data;
					$rdocumento->add();
					if ($rdocumento)
					{
						Core::alert("El archivo 6 ha sido copiado exitosamente.");
					}
					else
					{
						Core::alert("Ocurrió algun error al copiar el archivo6");
					}
					unset($rdocumento);
					
					// Documento 7
					//echo '<br>'.$arreglocodigos[6];
					//echo '<br>'.$arregloperiodos[6];
					$rdocumento = new SPDocumento();
					$rdocumento->proIdProveedor=$vproveedor;
					$rdocumento->conIdConcepto=16;
					$rdocumento->detIdDetalle=$arreglocodigos[6];
					$rdocumento->docTamanio=$tamano7;
					$rdocumento->docFecha=$arregloperiodos[6];
					// Leemos el contenido del archivo temporal en binario.
					$fp = fopen($imagentmp7, 'r+b');
					$data = fread($fp, filesize($imagentmp7));
					fclose($fp);		
					// Escapamos los caracteres para que se puedan almacenar en la base de datos correctamente.
					$data = mysqli_real_escape_string($enlace,$data);
					// Insertamos en la base de datos.
					$rdocumento->docDocumento=$data;
					$rdocumento->add();
					if ($rdocumento)
					{
						Core::alert("El archivo 7 ha sido copiado exitosamente.");
					}
					else
					{
						Core::alert("Ocurrió algun error al copiar el archivo7");
					}
					unset($rdocumento);
					
					// Documento 8
					//echo '<br>'.$arreglocodigos[7];
					//echo '<br>'.$arregloperiodos[7];
					$rdocumento = new SPDocumento();
					$rdocumento->proIdProveedor=$vproveedor;
					$rdocumento->conIdConcepto=16;
					$rdocumento->detIdDetalle=$arreglocodigos[7];
					$rdocumento->docTamanio=$tamano8;
					$rdocumento->docFecha=$arregloperiodos[7];
					// Leemos el contenido del archivo temporal en binario.
					$fp = fopen($imagentmp8, 'r+b');
					$data = fread($fp, filesize($imagentmp8));
					fclose($fp);		
					// Escapamos los caracteres para que se puedan almacenar en la base de datos correctamente.
					$data = mysqli_real_escape_string($enlace,$data);
					// Insertamos en la base de datos.
					$rdocumento->docDocumento=$data;
					$rdocumento->add();
					if ($rdocumento)
					{
						Core::alert("El archivo 8 ha sido copiado exitosamente.");
					}
					else
					{
						Core::alert("Ocurrió algun error al copiar el archivo8");
					}
					unset($rdocumento);
				}
				
				Core::alert("Los documentos han sido cargados exitosamente.");
				
			}
			else
				
			{
				Core::alert("Ocurrió algun error por tipo de archivo o por tamaño máximo ".$limite_kb." KB.");
			}
			print "<script>window.location='index.php?view=operaciones&q=".$videntificacion."';</script>";
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