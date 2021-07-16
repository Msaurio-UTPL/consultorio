<?php
class SPCriterios {
	public static $tablename = "criterios";

	public function SPCriterios(){
		$this->criIdCriterios=0;
		$this->criDescCriterio='';
		$this->gruIdGrupo=0;
		$this->conIdAmbito=0;
		$this->detIdAmbito=0;
		$this->criPeso=0;
		$this->criProcedimiento=0;
		$this->conTipoParametro=0;
		$this->detTipoParametro=0;
		$this->fecha='';
	}
	
	public function add(){
		$sql = "insert into ".self::$tablename." (criDescCriterio,gruIdGrupo,conIdAmbito,detIdAmbito,criPeso,criProcedimiento,conTipoParametro,detTipoParametro,fecha) ";
		$sql .= "values (UPPER(\"$this->criDescCriterio\"),$this->gruIdGrupo,$this->conIdAmbito,$this->detIdAmbito,$this->criPeso,$this->criProcedimiento,$this->conTipoParametro,$this->detTipoParametro,UPPER(\"$this->fecha\"))";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where criIdCriterios=$id";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function update($id,$peso,$pro,$par){
		$sql = "update ".self::$tablename." set criPeso=$peso,criProcedimiento='$pro',detTipoParametro=$par where criIdCriterios=$id";
		//echo $sql;
		Executor::doit($sql);
	}
	
	public function updatecompleto(){
		$sql = "update ".self::$tablename." set criPeso=$this->criPeso,criProcedimiento=$this->criProcedimiento,detTipoParametro==$this->detTipoParametro where criIdCriterios=$this->criIdCriterios";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select criIdCriterios,criDescCriterio,gruIdGrupo,conIdAmbito,detIdAmbito,criPeso,criProcedimiento,conTipoParametro,detTipoParametro,fecha from ".self::$tablename." where criIdCriterios=$id";
		//echo $sql;
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPCriterios());
	}
	
	public static function getByDesc($q){
		$sql = "select * from ".self::$tablename." where criDescCriterio='$q'";
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::one($query[0],new SPCriterios());
	}
	
	public static function getByIdSec($id){
		$sql = "select criIdCriterios,criDescCriterio,gruIdGrupo,conIdAmbito,detIdAmbito,criPeso,criProcedimiento,conTipoParametro,detTipoParametro,fecha from ".self::$tablename." where criIdCriterios='$id'";
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::one($query[0],new SPCriterios());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by criIdCriterios asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPCriterios());
	}
	
	public static function getGroup($id){
		$sql = "select * from ".self::$tablename." where gruIdGrupo=$id order by criIdCriterios asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPCriterios());
	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where criDescCriterio like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPCriterios());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::one($query[0],new SPCriterios());
	}

}

?>