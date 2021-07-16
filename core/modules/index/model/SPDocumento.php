<?php
class SPDocumento
{
	public static $tablename = "documentos";

	public function SPDocumento(){
		$this->docIdDocumento=0;
		$this->proIdProveedor=0;
		$this->conIdConcepto=0;
		$this->detIdDetalle=0;
		$this->docDocumento=null;
		$this->docTamanio=0;
		$this->docFecha="";
		$this->fecha="";
	}
	
	public function add(){
		$sql = "insert into ".self::$tablename." (proIdProveedor,conIdConcepto,detIdDetalle,docDocumento,docTamanio,docFecha,fecha) ";
		$sql .= "value ($this->proIdProveedor,$this->conIdConcepto,$this->detIdDetalle,\"$this->docDocumento\",$this->docTamanio,\"$this->docFecha\",now())";
		//echo $this->docTamanio;
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where empIdEmpresa=$id";
		Executor::doit($sql);
	}
	
	public static function delByProv($id){
		$sql = "delete from ".self::$tablename." where proIdProveedor=$id";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "update ".self::$tablename." set empDescripcion=UPPER(\"$this->empDescripcion\"),empIdentificacion=\"$this->empIdentificacion\",conIdTipo=$this->conIdTipo,detIdTipo=$this->detIdTipo,empSuscripcionInicio=\"$this->empSuscripcionInicio\",empSuscripcionFin=\"$this->empSuscripcionFin\",empLogo=\"$this->empLogo\" where empIdEmpresa=$this->empIdEmpresa";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select empIdEmpresa,empDescripcion,empIdentificacion,conIdTipo,detIdTipo,empSuscripcionInicio,empSuscripcionFin,empLogo from ".self::$tablename." where empIdEmpresa=$id ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPDocumento());
	}
	
	public static function getByProv($id){
		$sql = "select count(*) as total from ".self::$tablename." where proIdProveedor=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPDocumento());
	}
	
	public static function getDetProv($id){
		$sql = "select docIdDocumento,conIdConcepto,detIdDetalle,docTamanio,docFecha,fecha from ".self::$tablename." where proIdProveedor=$id";
		//echo $sql;
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPDocumento());
	}
	
	public static function getDesc($id){
		$sql = "select empDescripcion from ".self::$tablename." where empIdEmpresa=$id ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPDocumento());
	}
	
	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by empIdEmpresa asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPDocumento());
	}

	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where empDescripcion like UPPER('%$q%')";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPDocumento());
	}
	
}
?>