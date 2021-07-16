<?php
class SPMedicinas
{
	public static $tablename = "medicinas";

	public function SPMedicinas(){
		$this->medIdMedicinas=0;
		$this->conIdMedicamento=33;
		$this->detIdMedicamento=0;
		$this->conIdTipoPresentacion=0;
		$this->detIdTipoPresentacion=0;
		$this->medCantidad=0;
		$this->historia_hisIdHistoria=0;
		$this->historia_medIdMedico=0;
		$this->historia_hisFecha=null;	
	}
	
	public function add(){
		$sql = "insert into ".self::$tablename." (conIdMedicamento,detIdMedicamento,conIdTipoPresentacion,detIdTipoPresentacion,medCantidad,historia_hisIdHistoria,historia_medIdMedico,historia_hisFecha) ";
		$sql .= "value ($this->conIdMedicamento,$this->detIdMedicamento,$this->conIdTipoPresentacion,$this->detIdTipoPresentacion,$this->medCantidad,$this->historia_hisIdHistoria,$this->historia_medIdMedico,\"$this->historia_hisFecha\")";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where medIdMedicinas=$id";
		Executor::doit($sql);
	}

	public function update($id){
		//echo $this->cenIdCentro;
		$sql = "update ".self::$tablename." set 
		detIdMedicamento=$this->detIdMedicamento,
		detIdTipoPresentacion=$this->detIdTipoPresentacion,
		medCantidad=$this->medCantidad,
		historia_hisIdHistoria=$this->historia_hisIdHistoria
		where medIdMedicinas=$id";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where medIdMedicinas = $id ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPMedicinas());
	}	

	public static function getByHis($id){
		$sql = "select * from ".self::$tablename." where historia_hisIdHistoria = $id ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPMedicinas());
	}	
	
	public static function getByIdDet($id,$id2){
		$sql = "select * from ".self::$tablename." where historia_hisIdHistoria = $id and detIdMedicamento = $id2";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPMedicinas());
	}
	
	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by conIdMedicamento,detIdMedicamento asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPMedicinas());
	}
}
?>