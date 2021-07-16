<?php
class SPContacto {
	public static $tablename = "contacto";

	public function SPContacto(){
		$this->ctoIdContacto=0;
		$this->conIdContacto=6;
		$this->detIdContacto=0;
		$this->conDescripcion1=null;
		$this->conDescripcion2=null;
		$this->conDescripcion3=null;
		$this->conIdEstado=1;
		$this->detIdEstado=1;
		$this->paciente_pacIdPaciente=0;		
	}
	
	public function add(){
		//echo "hola";
		$sql = "insert into ".self::$tablename." (paciente_pacIdPaciente,conIdContacto,detIdContacto,conDescripcion1,conDescripcion2,conDescripcion3,conIdEstado,detIdEstado) ";
		$sql .= "values ($this->paciente_pacIdPaciente,$this->conIdContacto,$this->detIdContacto,UPPER(\"$this->conDescripcion1\"),UPPER(\"$this->conDescripcion2\"),UPPER(\"$this->conDescripcion3\"),$this->conIdEstado,$this->detIdEstado)";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function delById($id,$tip){
		$sql = "delete from ".self::$tablename." where detIdEstado=1 and paciente_pacIdPaciente=$id and detIdContacto=$tip ";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where detIdEstado=1 and paciente_pacIdPaciente=$this->paciente_pacIdPaciente and detIdContacto=$this->detIdContacto ";
		Executor::doit($sql); 
	}

	public function update(){
		$sql = "update ".self::$tablename." set detIdContacto=$this->detIdContacto,conDescripcion1=\"$this->conDescripcion1\",conDescripcion2=\"$this->conDescripcion2\",conDescripcion3=\"$this->conDescripcion3\",detIdEstado=$this->detIdEstado where paciente_pacIdPaciente=$this->paciente_pacIdPaciente and detIdContacto = $this->detIdContacto";
		echo $sql;
		Executor::doit($sql);
	}
	
	public function Inactiva($id,$tip){
		$sql = "update ".self::$tablename." set detIdEstado=2 where detIdEstado=$this->detIdEstado and paciente_pacIdPaciente=$id and detIdContacto=$tip ";
		//echo $sql;
		Executor::doit($sql);
	}
	
	public static function getById($id,$tip){
		$sql = "select paciente_pacIdPaciente,ctoIdContacto,conIdContacto,detIdContacto,conDescripcion1,conDescripcion2,conDescripcion3,conIdEstado,detIdEstado from ".self::$tablename." where paciente_pacIdPaciente=$id and detIdContacto=$tip ";
		//echo $sql;
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPContacto());
	}
	
	public static function getBySec($id){
		$sql = "select paciente_pacIdPaciente,ctoIdContacto,conIdContacto,detIdContacto,conDescripcion1,conDescripcion2,conDescripcion3,conIdEstado,detIdEstado from ".self::$tablename." where paciente_pacIdPaciente=$id";
		//echo $sql;
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPContacto());
	}
	
	public static function getByProv($id)
	{
		$sql = "select * from ".self::$tablename." where detIdEstado=1 and paciente_pacIdPaciente=$id;";
		//echo $sql;
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPContacto());
	}
	
	public function getAll(){
		$sql = "select * from ".self::$tablename." order by paciente_pacIdPaciente,detIdContacto asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPContacto());
	}
	
	public function getBySQL($sql){
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::one($query[0],new SPContacto());
	}

}

?>