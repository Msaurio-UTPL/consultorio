<?php
class SPDetHistoria
{
	public static $tablename = "historia_detalle";

	public function SPDetHistoria(){
		$this->detIdDetalleHistoria=0;
		$this->conIdAntecedentes=0;
		$this->detIdAntecedentes=0;
		$this->detAntecedente="";
		$this->historia_hisIdHistoria=0;
		$this->historia_medIdMedico=0;
		$this->historia_hisFecha="";
	}
	
	public function add(){
		$sql = "insert into ".self::$tablename." (conIdAntecedentes,detIdAntecedentes,detAntecedente,historia_hisIdHistoria,historia_medIdMedico,historia_hisFecha) ";
		$sql .= "value ($this->conIdAntecedentes,\"$this->detIdAntecedentes\",UPPER(\"$this->detAntecedente\"),$this->historia_hisIdHistoria,$this->historia_medIdMedico,\"$this->historia_hisFecha\")";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where detIdDetalleHistoria=$id";
		Executor::doit($sql);
	}

	public function update(){
		//echo $this->cenIdCentro;
		$sql = "update ".self::$tablename." set 
		detIdAntecedentes=$this->detIdAntecedentes,
		detAntecedente=UPPER(\"$this->detAntecedente\"),
		historia_hisIdHistoria=$this->historia_hisIdHistoria,
		historia_medIdMedico=$this->historia_medIdMedico,
		historia_hisFecha=\"$this->historia_hisFecha\")";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function getByMedFec($id,$id2){
		$sql = "select * from ".self::$tablename." where historia_medIdMedico = $id and historia_hisFecha = '$id2' ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPDetHistoria());
	}

	public static function getByMed($id){
		$sql = "select * from ".self::$tablename." where historia_medIdMedico = $id ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPDetHistoria());
	}
		
	public static function getById($id){
		$sql = "select * from ".self::$tablename." where detIdDetalleHistoria = $id ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPDetHistoria());
	}

	public static function getByIdHist($id,$id2,$id3){
		$sql = "select * from ".self::$tablename." where historia_hisIdHistoria = $id and conIdAntecedentes = $id2 and detIdAntecedentes = $id3 order by detIdDetalleHistoria";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPDetHistoria());
	}

	public static function getByHist($id,$id2){
		$sql = "select * from ".self::$tablename." where historia_hisIdHistoria = $id and conIdAntecedentes = $id2";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPDetHistoria());
	}

	public static function getByHist2($id){
		$sql = "select * from ".self::$tablename." where historia_hisIdHistoria = $id ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPDetHistoria());
	}

	public static function getByHist3($id){
		$sql = "select * from ".self::$tablename." where historia_hisIdHistoria = $id and (detAntecedente != '') order by conIdAntecedentes,detIdAntecedentes ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPDetHistoria());
	}
	
	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by conIdAntecedentes,detIdAntecedentes asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPDetHistoria());
	}

	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where detAntecedente like UPPER('%$q%')";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPDetHistoria());
	}
}
?>