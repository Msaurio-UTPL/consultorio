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
if(Session::getUID()=="")
{
	$user = $_POST['codigo'];
	//$pass = sha1(md5($_POST['password']));
	$pass = $_POST['password'];
	$base = new Database();
	$con = $base->connect();
	$sql = "select usuIdUsuario,usuCodUsuario,usuNombreUsuario,usuClaveUsuario,detIdEstado,detIdRol,centro_cenIdCentro from usuario where usuCodUsuario='".$user."' and usuClaveUsuario=SHA('".$pass."') and detIdEstado='1'";
	$query = $con->query($sql);
	$found = false;
	$total=0;
	while($r = $query->fetch_array())
	{
		$found = true ;
		$s_usuarioid = $r['usuCodUsuario'];
		$s_rol = $r['detIdRol'];
		$s_usuario = $r['usuNombreUsuario'];
		$s_centro = $r['centro_cenIdCentro'];
	}
	if($found==true)
	{
		$empresa = SPCentro::getById($s_centro);
		$extras= SPUser::getBySQL("select now() as ahora from dual;");
		$factual=$extras->ahora;
		if ($factual>=$empresa->cenSuscripcionInicio and $factual<=$empresa->cenSuscripcionFin)
		{
			session_start();
			//print $userid;
			$_SESSION['vs_codigo']=$s_usuarioid;
			$_SESSION['vs_rol']=$s_rol;
			$_SESSION['vs_usuario']=$s_usuario;
			$empresas = SPCentro::getById(1);
			$_SESSION['vs_nempresa']=$empresas->cenDescripcion;
			setcookie('vs_codigo',$s_usuarioid);
			$vlog = new SPLog();
			$vlog->logaCodigo=$s_usuarioid;
			$vlog->logaOperacion='Ingreso exitoso';
			$vlog->logaIp=$ip;
			$vlog->add();
			Core::alert("Acceso concedido..");
			print "<script>window.location='index.php?view=home';</script>";
		}
		else
		{
			if ($s_rol==1 or $s_rol==2)
			{
				session_start();
				//print $userid;
				$_SESSION['vs_codigo']=$s_usuarioid;
				$_SESSION['vs_rol']=$s_rol;
				$_SESSION['vs_usuario']=$s_usuario;
				$empresas = SPCentro::getById(1);
				$_SESSION['vs_nempresa']=$empresas->cenDescripcion;
				setcookie('vs_codigo',$s_usuarioid);
				$vlog = new SPLog();
				$vlog->logaCodigo=$s_usuarioid;
				$vlog->logaOperacion='Ingreso exitoso';
				$vlog->logaIp=$ip;
				$vlog->add();
				Core::alert("Acceso concedido ...revise vigencia de suscripcion.");
				print "<script>window.location='index.php?view=home';</script>";
			}
			else
			{
					Core::alert("Acceso negado: Empresa fuera de tiempo de Suscripción.");
					print "<script>window.location='index.php?view=login';</script>";
			}
		}		
	}
	else
	{
		$vlog = new SPLog();
		$vlog->logaCodigo=$user;
		$vlog->logaOperacion='Ingreso fallido';
		$vlog->logaIp=$ip;
		$vlog->add();
		$total=$vlog->getFallidos($user);
		//echo $total->total;
		if ($total->total>=3)
		{
			$xuser = new SPUser();
			$xuser=SPUser::Inactiva($user);
			$vlog->logaOperacion='Usuario Inactivado';
			$vlog->add();
		}
		Core::alert("Acceso negado: Usuario inactivo o credenciales erróneas.");
		print "<script>window.location='index.php?view=login';</script>";
	}
}
else
{
	Core::alert("Acceso negado: No se ha iniciado sesión.");
	print "<script>window.location='index.php?view=home';</script>";	
}
?>