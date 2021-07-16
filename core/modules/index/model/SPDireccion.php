<?php
class SPDireccion {
	public static $tablename = "direccion";

	public function SPDireccion(){
		$this->paciente_pacIdPaciente=0;
		$this->dirIdDireccion=0;
		$this->conIdDireccion=5;
		$this->detIdDireccion=0;
		$this->dirDescripcion1='';
		$this->dirDescripcion2='';
		$this->dirDescripcion3='';
		$this->conIdEstado=1;
		$this->detIdEstado=1;
	}
	
	public function add(){
		$sql = "insert into ".self::$tablename." (paciente_pacIdPaciente,conIdDireccion,detIdDireccion,dirDescripcion1,dirDescripcion2,dirDescripcion3,conIdEstado,detIdEstado) ";
		// control correo en minusculas
		if ($this->detIdDireccion==2) {
			$sql .= "values ($this->paciente_pacIdPaciente,$this->conIdDireccion,$this->detIdDireccion,LCASE(\"$this->dirDescripcion1\"),LCASE(\"$this->dirDescripcion2\"),UPPER(\"$this->dirDescripcion3\"),$this->conIdEstado,$this->detIdEstado)";
		} else {
			$sql .= "values ($this->paciente_pacIdPaciente,$this->conIdDireccion,$this->detIdDireccion,UPPER(\"$this->dirDescripcion1\"),UPPER(\"$this->dirDescripcion2\"),UPPER(\"$this->dirDescripcion3\"),$this->conIdEstado,$this->detIdEstado)";
		}
		//echo $sql;
		Executor::doit($sql);
	}

	public static function delById($id,$tip){
		$sql = "delete from ".self::$tablename." where detIdEstado=1 and paciente_pacIdPaciente=$id and detIdDireccion=$tip ";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where detIdEstado=1 and paciente_pacIdPaciente=$this->paciente_pacIdPaciente and detIdDireccion=$this->detIdDireccion ";
		Executor::doit($sql); 
	}

	public function update(){
		if ($this->detIdDireccion==2) {
			$sql = "update ".self::$tablename." set conIdDireccion=$this->conIdDireccion,detIdDireccion=$this->detIdDireccion,dirDescripcion1=LCASE(\"$this->dirDescripcion1\"),dirDescripcion2=LCASE(\"$this->dirDescripcion2\"),dirDescripcion3=\"$this->dirDescripcion3\",detIdEstado=$this->detIdEstado where paciente_pacIdPaciente=$this->paciente_pacIdPaciente and detIdDireccion = $this->detIdDireccion ";
		} else {
			$sql = "update ".self::$tablename." set conIdDireccion=$this->conIdDireccion,detIdDireccion=$this->detIdDireccion,dirDescripcion1=\"$this->dirDescripcion1\",dirDescripcion2=\"$this->dirDescripcion2\",dirDescripcion3=\"$this->dirDescripcion3\",detIdEstado=$this->detIdEstado where paciente_pacIdPaciente=$this->paciente_pacIdPaciente and detIdDireccion = $this->detIdDireccion ";
		}		
		//echo $sql;
		Executor::doit($sql);
	}
	
	public function Inactiva($id,$tip){
		$sql = "update ".self::$tablename." set detIdEstado=2 where detIdEstado=$this->detIdEstado and paciente_pacIdPaciente=$id and detIdDireccion=$tip ";
		//echo $sql;
		Executor::doit($sql);
	}
	
	public static function getById($id,$tip){
		$sql = "select paciente_pacIdPaciente,dirIdDireccion,conIdDireccion,detIdDireccion,dirDescripcion1,dirDescripcion2,dirDescripcion3,conIdEstado,detIdEstado from ".self::$tablename." where paciente_pacIdPaciente=$id and detIdDireccion=$tip ";
		//echo $sql;
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPDireccion());
	}
	
	public static function getBySec($id){
		$sql = "select paciente_pacIdPaciente,conIdDireccion,detIdDireccion,dirDescripcion1,dirDescripcion2,dirDescripcion3,conIdEstado,detIdEstado from ".self::$tablename." where paciente_pacIdPaciente=$id ";
		//echo $sql;
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPDireccion());
	}
	
	public static function getByProv($id){
		$sql = "select * from ".self::$tablename." where detIdEstado=1 and paciente_pacIdPaciente=$id;";
		//echo $sql;
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPDireccion());
	}
	
	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by paciente_pacIdPaciente,detIdDireccion asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPDireccion());
	}
	
	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::one($query[0],new SPDireccion());
	}

}

?>