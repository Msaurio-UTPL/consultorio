<?php
class SPExamenes
{
	public static $tablename = "examenes";

	public function SPExamenes(){
		$this->exaIdExamenes=0;
		$this->conIdTipoExamen=29;
		$this->detIdTipoExamen=0;
		$this->exaIndicaciones="";
		$this->exaFechaExamen=null;
		$this->historia_hisIdHistoria=0;
		$this->historia_medIdMedico=0;
		$this->historia_hisFecha=null;	
	}
	
	public function add(){
		$sql = "insert into ".self::$tablename." (conIdTipoExamen,detIdTipoExamen,exaIndicaciones,exaFechaExamen,historia_hisIdHistoria,historia_medIdMedico,historia_hisFecha) ";
		$sql .= "value ($this->conIdTipoExamen,$this->detIdTipoExamen,UPPER(\"$this->exaIndicaciones\"),\"$this->exaFechaExamen\",$this->historia_hisIdHistoria,$this->historia_medIdMedico,\"$this->historia_hisFecha\")";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where exaIdExamenes=$id";
		Executor::doit($sql);
	}

	public function update($id){
		//echo $this->cenIdCentro;
		$sql = "update ".self::$tablename." set 
		detIdTipoExamen=$this->detIdTipoExamen,
		exaIndicaciones=UPPER(\"$this->exaIndicaciones\"),
		exaFechaExamen=\"$this->exaFechaExamen\",
		historia_hisIdHistoria=$this->historia_hisIdHistoria
		where exaIdExamenes=$id";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where exaIdExamenes = $id ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPExamenes());
	}	

	public static function getByHis($id){
		$sql = "select * from ".self::$tablename." where historia_hisIdHistoria = $id ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPExamenes());
	}	
	
	public static function getByIdDet($id,$id2){
		$sql = "select * from ".self::$tablename." where exaIdExamenes = $id and detIdTipoExamen = $id2";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPExamenes());
	}
	
	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by conIdTipoExamen,detIdTipoExamen asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPExamenes());
	}

	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where exaIndicaciones like UPPER('%$q%')";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPExamenes());
	}
}
?>