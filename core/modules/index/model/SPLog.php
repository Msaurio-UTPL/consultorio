<?php
class SPLog
{
	public static $tablename = "logacceso";

	public function SPLog(){
		$this->logaFecha='';
		$this->logaCodigo='';
		$this->logaOperacion='';
		$this->logaIp='';
	}
	
	public function add(){
		$sql = "insert into ".self::$tablename." (logaFecha,logaCodigo,logaOperacion,logaIp) ";
		$sql .= "value (now(),\"$this->logaCodigo\",\"$this->logaOperacion\",\"$this->logaIp\")";
		Executor::doit($sql);
	}
	
	public static function getByCodigo($id){
		$sql = "select * from ".self::$tablename." where logaCodigo='$id' order by logaFecha asc";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPLog());
	}
	
	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by logaFecha asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPLog());
	}
	
	public static function getResumen(){
		$sql = "select logaCodigo,logaOperacion,count(logaFecha) from ".self::$tablename." group by logaCodigo, logaOperacion order by logaCodigo, logaOperacion asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPLog());
	}
	
	public static function getFallidos($cod){
		$sql = "select count(*) as total from ".self::$tablename." where logaCodigo='$cod'
				and substr(logaFecha,1,10)=substr(now(),1,10) and logaOperacion='Ingreso fallido'";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPLog());
	}
	
	public static function getAccesos(){
		$sql = "SELECT logaOperacion as concepto,count(*) as pistas from ".self::$tablename.
			   " where logaOperacion in ('Ingreso exitoso','Ingreso fallido')
			   group by concepto
			   order by concepto;";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPLog());
	}
	
	public static function getUsrOperaciones(){
		$sql = "SELECT substr(logaOperacion,1,locate(':',logaOperacion)-1) as concepto,count(*) as pistas from ".self::$tablename.
			   " where substr(logaOperacion,1,locate(':',logaOperacion)-1)
			   in ('Crea Usuario','Activa Usuario','Inactiva Usuario','Cambia Clave Usuario')
			   group by concepto
			   order by concepto;";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPLog());
	}
	
	public static function getJugOperaciones(){
		$sql = "SELECT substr(operacion,1,locate(':',operacion)-1) as concepto,count(*) as pistas from ".self::$tablename.
			   " where substr(operacion,1,locate(':',operacion)-1)
			   in ('Agrega Jugador','Activa Jugador','Inactiva Jugador','Actualiza Jugador','Califica Jugador','Reubica Jugador','Transfiere Jugador')
			   group by concepto
			   order by concepto;";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPLog());
	}
	
	public static function getDetTransferencias($vdesde,$vhasta){
		$sql = "SELECT	fecha,codigo,
		substr(operacion,locate(':',operacion)+1,locate('-',operacion)-locate(':',operacion)-1) as vjugador,
        concat(nombres,' ',apellidos) as vnombre,
        substr(operacion,locate('-',operacion)+1,length(operacion)-locate('-',operacion)) as vtipo
		FROM	log a,
				jugador b
		where	substr(operacion,locate(':',operacion)+1,locate('-',operacion)-locate(':',operacion)-1)=b.codigoJugador and
				substr(operacion,1,locate(':',operacion)-1) in ('Transfiere Jugador') and
		substr(logaFecha,1,10)>='$vdesde' and
        substr(logaFecha,1,10)<='$vhasta'
		order by fecha;";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPLog());
	}
	
	public static function getDetUsuarios($vdesde,$vhasta){
		$sql = "SELECT	logaFecha,a.codigo as administrador,
				substr(logaOperacion,1,locate(':',logaOperacion)-1) as operacion,
				substr(logaOperacion,locate(':',logaOperacion)+1,length(logaOperacion)) as usuario,
				nombre
				FROM	log a,
						usuario b
				where	substr(logaOperacion,locate(':',logaOperacion)+1,length(logaOperacion))=b.codigo and
						substr(logaOperacion,1,locate(':',logaOperacion)-1)
						in ('Crea Usuario','Activa Usuario','Inactiva Usuario','Cambia Clave Usuario') and
				substr(logaFecha,1,10)>='$vdesde' and
				substr(logaFecha,1,10)<='$vhasta'
				order by logaFecha;";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPLog());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::one($query[0],new SPLog());
	}	
}
?>