<?php
class SPCentro
{
	public static $tablename = "centro";

	public function SPCentro(){
		$this->cenIdCentro=0;
		$this->cenDescripcion="";
		$this->cenIdentificacion="";
		$this->conIdTipo=0;
		$this->detIdTipo=0;
		$this->cenSuscripcionInicio=null;
		$this->cenSuscripcionFin=null;
		$this->cenLogo=null;
		$this->cenDireccion="";
		$this->cenTelefonos=0;	
	}
	
	public function add(){
		$sql = "insert into ".self::$tablename." (cenDescripcion,cenIdentificacion,conIdTipo,detIdTipo,cenSuscripcionInicio,cenSuscripcionFin,cenDireccion,cenTelefonos) ";
		$sql .= "value (UPPER(\"$this->cenDescripcion\"),UPPER(\"$this->cenIdentificacion\"),$this->conIdTipo,$this->detIdTipo,\"$this->cenSuscripcionInicio\",\"$this->cenSuscripcionFin\",UPPER(\"$this->cenDireccion\"),\"$this->cenTelefonos\")";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where cenIdCentro=$id";
		Executor::doit($sql);
	}

	public function update(){
		//echo $this->cenIdCentro;
		$sql = "update ".self::$tablename." set cenDescripcion=UPPER(\"$this->cenDescripcion\"),cenIdentificacion=\"$this->cenIdentificacion\",conIdTipo=$this->conIdTipo,detIdTipo=$this->detIdTipo,cenSuscripcionInicio=\"$this->cenSuscripcionInicio\",cenSuscripcionFin=\"$this->cenSuscripcionFin\",cenLogo=\"$this->cenLogo\",cenDireccion=\"$this->cenDireccion\",cenTelefonos=\"$this->cenTelefonos\" where cenIdCentro=$this->cenIdCentro ";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select cenIdCentro,cenDescripcion,cenIdentificacion,conIdTipo,detIdTipo,cenSuscripcionInicio,cenSuscripcionFin,cenLogo,cenDireccion,cenTelefonos from ".self::$tablename." where cenIdCentro=$id ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPCentro());
	}

	public static function getDesc($id){
		$sql = "select cenDescripcion from ".self::$tablename." where cenIdCentro=$id ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPCentro());
	}
	
	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by cenIdCentro asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPCentro());
	}

	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where cenDescripcion like UPPER('%$q%')";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPCentro());
	}
	
}
?>