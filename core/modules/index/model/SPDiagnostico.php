<?php
class SPDiagnostico
{
	public static $tablename = "diagnostico";

	public function SPDiagnostico(){
		$this->diaIdDiagnostico=0;
		$this->diaDiagnostico="";
		$this->conIdCie10=27;
		$this->detIdCie10=0;
		$this->conIdTipo=28;
		$this->detIdTipo=0;
		$this->historia_hisIdHistoria=0;
		$this->historia_medIdMedico=0;	
		$this->historia_hisFecha=null;	
	}
	
	public function add(){
		$sql = "insert into ".self::$tablename." (
		diaDiagnostico,
		conIdCie10,
		detIdCie10,
		conIdTipo,
		detIdTipo,
		historia_hisIdHistoria,
		historia_medIdMedico,	
		historia_hisFecha) ";
		$sql .= "values (
		UPPER(\"$this->diaDiagnostico\"),
		$this->conIdCie10,
		$this->detIdCie10,
		$this->conIdTipo,
		$this->detIdTipo,
		$this->historia_hisIdHistoria,
		$this->historia_medIdMedico,	
		\"$this->historia_hisFecha\")";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where diaIdDiagnostico=$id";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "update ".self::$tablename." set 
		diaDiagnostico=UPPER(\"$this->diaDiagnostico\"),
		detIdCie10=$this->detIdCie10,
		detIdTipo=$this->detIdTipo";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function getByHisMedFec($id,$id2,$id3){
		$sql = "select * from ".self::$tablename." where historia_hisHistoria = $id and historia_medIdMedico = $id2 and historia_hisFecha = '$id3' ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPDiagnostico());
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where historia_hisIdHistoria = $id ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPDiagnostico());
	}	
		
	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by historia_hisHistoria,historia_medIdMedico,historia_hisFecha";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPDiagnostico());
	}

	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where diaDiagnostico like UPPER('%$q%')";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPDiagnostico());
	}
}
?>