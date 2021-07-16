<?php
class SPHorario
{
	public static $tablename = "horario";

	public function SPHorario(){
		$this->horIdHorario=0;
		$this->conIdDia=0;
		$this->detIdDia=0;
		$this->horDescripcion="";
		$this->horHoraInicio=0;
		$this->horHoraFin=0;
		$this->conIdEstado=1;
		$this->detIdEstado=1;
		$this->medico_medIdMedico=0;	
	}
	
	public function add(){
		$sql = "insert into ".self::$tablename." (conIdDia,detIdDia,horDescripcion,horHoraInicio,horHoraFin,conIdEstado,detIdEstado,medico_medIdMedico) ";
		$sql .= "value ($this->conIdDia,$this->detIdDia,UPPER(\"$this->horDescripcion\"),\"$this->horHoraInicio\",\"$this->horHoraFin\",$this->conIdEstado,$this->detIdEstado,$this->medico_medIdMedico)";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where horIdHorario=$id";
		Executor::doit($sql);
	}

	public function update(){
		//echo $this->cenIdCentro;
		$sql = "update ".self::$tablename." set 
		horHoraInicio=\"$this->horHoraInicio\",
		horHoraFin=\"$this->horHoraFin\",
		detIdEstado=$this->detIdEstado
		where medico_medIdMedico=$this->medico_medIdMedico
		and detIdDia = $this->detIdDia";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function getById($id,$id2){
		$sql = "select horIdHorario,conIdDia,detIdDia,horDescripcion,horHoraInicio,horHoraFin,conIdEstado,detIdEstado,medico_medIdMedico from ".self::$tablename." where conIdDia = $id and detIdDia = $id2 ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPHorario());
	}
	
	public static function getByMed($id,$id2,$id3){
		$sql = "select horIdHorario,conIdDia,detIdDia,horDescripcion,horHoraInicio,horHoraFin,conIdEstado,detIdEstado,medico_medIdMedico from ".self::$tablename." where medico_medIdMedico = $id and detIdEstado = 1 and detIdDia = $id2 and (horHoraInicio <= '$id3' and horHoraFin >= '$id3') ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPHorario());
	}	

	public static function getByMedico($id){
		$sql = "select horIdHorario,conIdDia,detIdDia,horDescripcion,horHoraInicio,horHoraFin,conIdEstado,detIdEstado,medico_medIdMedico from ".self::$tablename." where medico_medIdMedico = $id order by detIdDia";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPHorario());
	}
	
	public static function getDia($id){
		$sql = "SELECT *,DAYOFWEEK('$id')-1 dia from horario where detIddia = DAYOFWEEK('$id')-1";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPHorario());
	}
	
	public static function getDesc($id){
		$sql = "select horDescripcion from ".self::$tablename." where horDescripcion=$id ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPHorario());
	}
	
	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by horIdHorario asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPHorario());
	}

	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where horDescripcion like UPPER('%$q%')";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPHorario());
	}
}
?>