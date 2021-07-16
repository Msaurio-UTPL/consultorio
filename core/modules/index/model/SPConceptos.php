<?php
class SPConceptos {
	public static $tablename = "concepto";

	public function SPConceptos(){
		$this->conIdConcepto=0;
		$this->conDescConcepto='';
	}
	
	public function add(){
		$sql = "insert into ".self::$tablename." (conDescConcepto) ";
		$sql .= "values (UPPER(\"$this->conDescConcepto\") )";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where conIdConcepto=$id";
		//echo $sql;
		Executor::doit($sql);
	}

	public function update($id,$des){
		$sql = "update ".self::$tablename." set conDescConcepto=UPPER(\"$des\") where conIdConcepto=$id";
		//echo $sql;
		Executor::doit($sql);
	}
	
	public function updatecompleto(){
		$sql = "update ".self::$tablename." set conDescConcepto=\"$this->conDescConcepto\" where conIdCentro=$this->conIdCentro and conIdConcepto=$this->conIdConcepto";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select conIdConcepto,conDescConcepto from ".self::$tablename." where conIdConcepto=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPConceptos());
	}
	
	public static function getByDesc($q){
		$sql = "select * from ".self::$tablename." where conDescConcepto='$q'";
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::one($query[0],new SPConceptos());
	}
	
	
	public static function getByIdSec($id){
		$sql = "select conIdConcepto,conDescConcepto from ".self::$tablename." where conIdConcepto='$id'";
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::one($query[0],new SPConceptos());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by conIdConcepto asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPConceptos());
	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where conDescConcepto like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPConceptos());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::one($query[0],new SPConceptos());
	}

}

?>