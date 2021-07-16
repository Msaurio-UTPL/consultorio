<?php
class SPCita
{
	public static $tablename = "cita";

	public function SPCita(){
		$this->citIdCita=0;
		$this->medIdMedico=0;
		$this->citFecha=null;
		$this->citHoraInicio=null;
		$this->conIdEstado=1;
		$this->desIdEstado=0;
		$this->paciente_pacIdPaciente=0;
		$this->horario_horIdHorario=0;
	}
	
	public function add(){
		$sql = "insert into ".self::$tablename." (medIdMedico,citFecha,citHoraInicio,conIdEstado,detIdEstado,paciente_pacIdPaciente,horario_horIdHorario) ";
		$sql .= "values ($this->medIdMedico,\"$this->citFecha\",'$this->citHoraInicio',$this->conIdEstado,$this->detIdEstado,$this->paciente_pacIdPaciente,$this->horario_horIdHorario)";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where citIdCita=$id";
		Executor::doit($sql);
	}

	public function update(){
		//echo $this->cenIdCentro;
		$sql = "update ".self::$tablename." set medIdMedico=$this->medIdMedico,citFecha=\"$this->citFecha\",citHoraInicio='$this->citHoraInicio',conIdEstado=$this->conIdEstado,detIdEstado=$this->detIdEstado,paciente_pacIdPaciente=$this->paciente_pacIdPaciente,horario_horIdHorario=$this->horario_horIdHorario where citIdCita=$this->citIdCita ";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select citIdCita,medIdMedico,citFecha,citHoraInicio,conIdEstado,detIdEstado,paciente_pacIdPaciente,horario_horIdHorario,now() hoy from ".self::$tablename." where citIdCita=$id ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPCita());
	}

	public static function getByMed($id){
		$sql = "select citIdCita,medIdMedico,citFecha,citHoraInicio,conIdEstado,detIdEstado,paciente_pacIdPaciente,horario_horIdHorario,now() hoy from ".self::$tablename." where medIdMedico=$id order by citFecha";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPCita());
	}
	
	public static function getByIdPacFec($id,$id2,$id3){
		$sql = "select citIdCita,medIdMedico,citFecha,citHoraInicio,conIdEstado,detIdEstado,paciente_pacIdPaciente,horario_horIdHorario,now() hoy ";
		$sql .= "from ".self::$tablename." where medIdMedico=$id and paciente_pacIdPaciente=$id2 and detIdEstado=1 and citFecha = '$id3' ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPCita());
	}

	public static function getByHoy($id){
		$sql = "select date_format(now(), '%Y-%m-%d') hoy from dual where '$id' < date_format(now(), '%Y-%m-%d') ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPCita());
	}
	
	public static function getByPacHorFec($id,$id2,$id3){
		$sql = "select citIdCita,medIdMedico,citFecha,citHoraInicio,conIdEstado,detIdEstado,paciente_pacIdPaciente,horario_horIdHorario,date_format(now(), '%Y-%m-%d') hoy from ".self::$tablename." where paciente_pacIdPaciente=$id and detIdEstado=1 and citHoraInicio='$id2' and citFecha='$id3' ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPCita());
	}
	
	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by citIdCita asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPCita());
	}

}
?>