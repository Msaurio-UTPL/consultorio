<?php
class SPHistoria
{
	public static $tablename = "historia";

	public function SPHistoria(){
		$this->hisIdHistoria=0;
		$this->medIdMedico=0;
		$this->hisFecha=null;
		$this->hisMotivoConsulta="";
		$this->hisEnfermedad="";
		$this->codIdEstado=1;
		$this->detIdEstado=1;
		$this->paciente_pacPaciente=0;	
	}
	
	public function add(){
		$sql = "insert into ".self::$tablename." (medIdMedico,hisFecha,hisMotivoConsulta,hisEnfermedad,conIdEstado,detIdEstado,paciente_pacIdPaciente) ";
		$sql .= "value ($this->medIdMedico,\"$this->hisFecha\",UPPER(\"$this->hisMotivoConsulta\"),UPPER(\"$this->hisEnfermedad\"),$this->conIdEstado,$this->detIdEstado,$this->paciente_pacIdPaciente)";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where hisIdHistoria=$id";
		Executor::doit($sql);
	}

	public function update($id){
		//echo $this->cenIdCentro;
		$sql = "update ".self::$tablename." set 
		medIdMedico=$this->medIdMedico,
		hisFecha=\"$this->hisFecha\",
		hisMotivoConsulta=UPPER(\"$this->hisMotivoConsulta\"),
		hisEnfermedad=UPPER(\"$this->hisEnfermedad\"),
		detIdEstado=$this->detIdEstado,
		paciente_pacIdPaciente=$this->paciente_pacIdPaciente
		where hisIdHistoria = $id";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function getByMedPacFec($id,$id2,$id3){
		$sql = "select * from ".self::$tablename." where medIdMedico = $id and paciente_pacIdPaciente = $id2 and hisFecha = '$id3' ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPHistoria());
	}
	
	public static function getByPac($id){
		$sql = "select * from ".self::$tablename." where paciente_pacIdPaciente = $id order by hisFecha desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPHistoria());
	}

	public static function getByPacFeciFecf($id,$id2,$id3){
		$sql = "select * from ".self::$tablename." where paciente_pacIdPaciente = $id and hisFecha between '$id2' and '$id3' ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPHistoria());
	}
	
	public static function getById($id){
		$sql = "select * from ".self::$tablename." where hisIdHistoria = $id ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPHistoria());
	}	
	
	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by medIdMedico,hisFecha asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPHistoria());
	}

	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where hisMotivoConsulta like UPPER('%$q%')";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPHistoria());
	}
}
?>