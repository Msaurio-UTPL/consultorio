<?php
class SPUser {
	public static $tablename = "usuario";

	public function SPUser(){
		$this->usuIdUsuario=0;
		$this->usuCodUsuario="";
		$this->usuNombreUsuario="";
		$this->usuClaveUsuario="";
		$this->usuCorreo="";
		$this->conIdEstado=1;
		$this->detIdEstado=0;
		$this->conIdRol=2;
		$this->detIdRol=0;
		$this->centro_cenIdCentro=0;
	}
	
	public function add(){
		$sql = "insert into ".self::$tablename." (usuCodUsuario,usuNombreUsuario,usuClaveUsuario,usuCorreo,conIdEstado,detIdEstado,conIdRol,detIdRol,centro_cenIdCentro) ";
		$sql .= "values (LCASE(\"$this->usuCodUsuario\"),UPPER(\"$this->usuNombreUsuario\"),SHA(\"$this->usuClaveUsuario\"),LCASE(\"$this->usuCorreo\"),$this->conIdEstado,$this->detIdEstado,$this->conIdRol,$this->detIdRol,$this->centro_cenIdCentro)";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql); 
	}

	public function update(){
		$sql = "update ".self::$tablename." set 
		usuCodUsuario=\"$this->usuCodUsuario\",
		usuNombreUsuario=\"$this->usuNombreUsuario\",
		detIdRol=$this->detIdRol,
		usuCorreo=\"$this->usuCorreo\",
		detIdEstado=$this->detIdEstado 
		where usuIdUsuario=$this->usuIdUsuario";
		//echo $sql;
		Executor::doit($sql);
	}
	
	public function updatecompleto(){
		$sql = "update ".self::$tablename." set usuCodUsuario=\"$this->usuCodUsuario\",usuNombreUsuario=\"$this->usuNombreUsuario\",detIdRol=$this->detIdRol,usuClaveUsuario=SHA(\"$this->usuClaveUsuario\"),usuCorreo=$this->usuCorreo,detIdEstado=$this->detIdEstado where usuIdUsuario=$this->usuIdUsuario";
		//echo $sql;
		Executor::doit($sql);
	}
	
	public function Inactiva($id){
		$sql = "update ".self::$tablename." set detIdEstado=0 where usuCodUsuario='$id'";
		//echo $sql;
		Executor::doit($sql);
	}
	
	public static function getById($id){
		$sql = "select usuIdUsuario,usuCodUsuario,usuNombreUsuario,usuClaveUsuario,usuCorreo,detIdEstado,detIdRol,centro_cenIdCentro from ".self::$tablename." where usuCodUsuario='$id'";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPUser());
	}

	public static function getCentro($id){
		$sql = "select usuIdUsuario,usuCodUsuario,usuNombreUsuario,usuClaveUsuario,usuCorreo,detIdEstado,detIdRol,centro_cenIdCentro from ".self::$tablename." where usuCodUsuario='$id'";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPUser());
	}
	
	public static function getBySec($id){
		$sql = "select usuIdUsuario,usuCodUsuario,usuNombreUsuario,usuClaveUsuario,usuCorreo,detIdEstado,detIdRol,centro_cenIdCentro from ".self::$tablename." where usuIdUsuario='$id'";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPUser());
	}
	
	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by usuIdUsuario asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPUser());
	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where usuCodUsuario like '%$q%' or usuNombreUsuario like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPUser());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::one($query[0],new SPUser());
	}

}

?>