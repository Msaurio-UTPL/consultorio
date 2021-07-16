<?php
class SPTratamiento
{
	public static $tablename = "tratamiento";

	public function SPTratamiento(){
		$this->medicinas_medIdMedicinas=0;
		$this->conIdFrecuencia=33;
		$this->detIdFrecuencia=0;
		$this->conIdTiempo=0;
		$this->detIdTiempo=0;
		$this->traCantidad=0;
		$this->medicinas_historia_hisIdHistoria=0;
		$this->medicinas_historia_medIdMedico=0;
		$this->medicinas_historia_hisFecha=null;	
	}
	
	public function add(){
		$sql = "insert into ".self::$tablename." (conIdFrecuencia,detIdFrecuencia,conIdTiempo,detIdTiempo,traCantidad,medicinas_historia_hisIdHistoria,medicinas_historia_medIdMedico,medicinas_historia_hisFecha,medicinas_medIdMedicinas) ";
		$sql .= "value ($this->conIdFrecuencia,$this->detIdFrecuencia,$this->conIdTiempo,$this->detIdTiempo,$this->traCantidad,$this->medicinas_historia_hisIdHistoria,$this->medicinas_historia_medIdMedico,\"$this->medicinas_historia_hisFecha\",$this->medicinas_medIdMedicinas)";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where medicinas_medIdMedicinas=$id";
		Executor::doit($sql);
	}

	public function update($id){
		//echo $this->cenIdCentro;
		$sql = "update ".self::$tablename." set 
		detIdFrecuencia=$this->detIdFrecuencia,
		detIdTiempo=$this->detIdTiempo,
		traCantidad=$this->traCantidad,
		medicinas_historia_hisIdHistoria=$this->medicinas_historia_hisIdHistoria
		medicinas_medIdMedicinas=$this->medicinas_medIdMedicinas
		where medicinas_medIdMedicinas = $id";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where traIdTratamiento = $id ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPTratamiento());
	}	

	public static function getByHis($id){
		$sql = "select * from ".self::$tablename." where medicinas_historia_hisIdHistoria = $id ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPTratamiento());
	}	
	
	public static function getByIdDet($id,$id2){
		$sql = "select * from ".self::$tablename." where medicinas_historia_hisIdHistoria = $id and medicinas_medIdMedicinas = $id2";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPTratamiento());
	}
	
	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by medicinas_historia_hisIdHistoria,medicinas_medIdMedicinas asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPTratamiento());
	}
}
?>