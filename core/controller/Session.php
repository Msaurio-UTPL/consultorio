<?php

/**
* 1 de agosto del 2013
* Esta funcion contiene el nombre de los identificadores que se usaran como variables de session
* y tambien los setters y getters correspondientes.
**/

class Session{
	public static function setUID($uid){
		$_SESSION['vs_codigo'] = $uid;
	}

	public static function unsetUID(){
		if(isset($_SESSION['vs_codigo']))
			unset($_SESSION['vs_codigo']);
	}

	public static function issetUID(){
		if(isset($_SESSION['vs_codigo']))
			return true;
		else return false;
	}

	public static function getUID(){
		if(isset($_SESSION['vs_codigo']))
			return $_SESSION['vs_codigo'];
		else return false;
	}

}

?>