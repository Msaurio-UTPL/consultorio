<?php
class SPDetConceptos {
	public static $tablename = "concepto_detalle";

	public function SPDetConceptos(){
		$this->concepto_conIdConcepto=0;
		$this->detIdDetalle=0;
		$this->detDescDetalle='';
		$this->detNexo=null;
	}
	
	public function add(){
		$sql = "insert into ".self::$tablename." (concepto_conIdConcepto,detIdDetalle,detDescDetalle,detNexo) ";
		$sql .= "values ($this->concepto_conIdConcepto,$this->detIdDetalle,UPPER(\"$this->detDescDetalle\"),$this->detNexo)";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function delById($id, $idd){
		$sql = "delete from ".self::$tablename." where concepto_conIdConcepto=$id and detIdDetalle=$idd";
		//echo $sql;
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where concepto_conIdConcepto=$this->concepto_conIdConcepto";
		Executor::doit($sql); 
	}

	public function update($id, $idd,$q){
		$sql = "update ".self::$tablename." set detDescDetalle=UPPER(\"$q\") where concepto_conIdConcepto=$id and detIdDetalle=$idd";
		//echo $sql;
		Executor::doit($sql);
	}
	
	public function updatecompleto(){
		$sql = "update ".self::$tablename." set detDescDetalle=\"$this->detDescDetalle\",detNexo=$this->detNexo where 
		concepto_conIdConcepto=$this->concepto_conIdConcepto";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function getById($id, $idd){
		$sql = "select concepto_conIdConcepto,detIdDetalle,detDescDetalle,detNexo from ".self::$tablename." where concepto_conIdConcepto=$id and detIdDetalle=$idd";
		//echo $sql;
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPDetConceptos());
	}
	
	public static function getByDesc($id, $q){
		$sql = "select * from ".self::$tablename." where concepto_conIdConcepto=$id and detDescDetalle='$q'";
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::one($query[0],new SPDetConceptos());
	}
	
	public static function getByIdSec($id, $idd){
		$sql = "select concepto_conIdConcepto,detIdDetalle,detDescDetalle,detNexo from ".self::$tablename." where concepto_conIdConcepto='$id' and detIdDetalle=$idd";
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::one($query[0],new SPDetConceptos());
	}
	
	public static function getByCod($id, $nexo){
		$sql = "select detIdDetalle,detDescDetalle from ".self::$tablename." where concepto_conIdConcepto='$id' and (detNexo is null or detNexo = $nexo) order by detIdDetalle";
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::many($query[0],new SPDetConceptos());
	}

	public static function getByConReg($id,$prov){
		//$sql = "select a.detIdDetalle,CONCAT(COUNT(b.detIdContacto),' ',a.detDescDetalle) as detDescDetalle from ".self::$tablename." as a, contacto as b where a.concepto_conIdConcepto='$id' and a.concepto_conIdConcepto=b.conIdContacto and a.detIdDetalle = b.detIdContacto and b.proIdProveedor='$prov' group by a.detIdDetalle,a.detDescDetalle";
		$sql = "select a.detIdDetalle,
		CONCAT(a.detDescDetalle,' (',(select COUNT(b.detIdContacto) from contacto as b where a.concepto_conIdConcepto=b.conIdContacto and a.detIdDetalle = b.detIdContacto and b.paciente_pacIdPaciente='$prov'),' Registros)') as detDescDetalle
		from ".self::$tablename." as a where a.concepto_conIdConcepto='$id' group by a.detIdDetalle,a.detDescDetalle ";
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::many($query[0],new SPDetConceptos());
	}

	public static function getByDirReg($id,$prov){
		//$sql = "select a.detIdDetalle,CONCAT(COUNT(b.detIdContacto),' ',a.detDescDetalle) as detDescDetalle from ".self::$tablename." as a, contacto as b where a.concepto_conIdConcepto='$id' and a.concepto_conIdConcepto=b.conIdContacto and a.detIdDetalle = b.detIdContacto and b.proIdProveedor='$prov' group by a.detIdDetalle,a.detDescDetalle";
		$sql = "select a.detIdDetalle,
		CONCAT(a.detDescDetalle,' (',(select COUNT(b.detIdDireccion) from direccion as b where a.concepto_conIdConcepto=b.conIdDireccion and a.detIdDetalle = b.detIdDireccion and b.paciente_pacIdPaciente='$prov'),' Registros)') as detDescDetalle
		from ".self::$tablename." as a where a.concepto_conIdConcepto='$id' group by a.detIdDetalle,a.detDescDetalle ";
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::many($query[0],new SPDetConceptos());
	}
	
	public static function getByLista($id, $lista){
		$sql = "select concepto_conIdConcepto,detIdDetalle,detDescDetalle,detNexo from ".self::$tablename." where concepto_conIdConcepto=$id and detIdDetalle in (".$lista.")";
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::many($query[0],new SPDetConceptos());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by concepto_conIdConcepto,detNexo,detIdDetalle asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPDetConceptos());
	}
	
	public static function getAllId($id){
		$sql = "select * from ".self::$tablename." where concepto_conIdConcepto='$id' order by detIdDetalle asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPDetConceptos());
	}
	
	public static function getLike($id, $q){
		$sql = "select * from ".self::$tablename." where concepto_conIdConcepto='$id' and detDescDetalle like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPDetConceptos());
	}
	
	public static function getMax($id){
		$sql = "select concepto_conIdConcepto,max(detIdDetalle)+1 secuencia from ".self::$tablename." where concepto_conIdConcepto=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPDetConceptos());
	}	

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::one($query[0],new SPDetConceptos());
	}

}

?>