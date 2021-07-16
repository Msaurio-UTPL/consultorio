<?php
class SPMedico {
	public static $tablename = "medico";

	public function SPMedico(){
		$this->medIdMedico=0;
		$this->medApellidos='';
		$this->medNombres='';
		$this->conIdTipoIdentificacion=4;
		$this->detIdTipoIdentificacion=0;
		$this->medIdentificacion='';
		$this->conIdEspecialidad=11;
		$this->detIdEspecialidad=0;
		$this->conIdEstado=1;
		$this->detIdEstado=0;
		$this->conIdDuracion=13;
		$this->detIdDuracion=0;		
		$this->centro_cenIdCentro=0;
	}
	
	public function add(){
		$sql = "insert into ".self::$tablename." (
		medApellidos,
		medNombres,
		conIdTipoIdentificacion,
		detIdTipoIdentificacion,
		medIdentificacion,
		conIdEspecialidad,
		detIdEspecialidad,
		conIdEstado,
		detIdEstado,
		conIdDuracion,
		detIdDuracion,		
		centro_cenIdCentro
		) ";
		$sql .= "values (
		UPPER(\"$this->medApellidos\"),
		UPPER(\"$this->medNombres\"),
		$this->conIdTipoIdentificacion,
		$this->detIdTipoIdentificacion,
		UPPER(\"$this->medIdentificacion\"),
		$this->conIdEspecialidad,
		$this->detIdEspecialidad,
		$this->conIdEstado,
		$this->detIdEstado,
		$this->conIdDuracion,
		$this->detIdDuracion,			
		$this->centro_cenIdCentro
		) ";
		//echo now();
		//echo $sql;
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where medIdMedico=$id";
		//echo $sql;
		Executor::doit($sql);
	}

	/*public static function update($id,$parc,$amb){
		$sql = "update ".self::$tablename." set 
		gruPorcParticipacion=$parc,
		detIdAmbito=$amb 
		where proIdProveedor=$id";
		//echo $sql;
		Executor::doit($sql);
	}*/

	public static function getByIdSec($id){
		$sql = "select 
		medIdMedico,
		medApellidos,
		medNombres,
		conIdTipoIdentificacion,
		detIdTipoIdentificacion,
		medIdentificacion,
		conIdEspecialidad,
		detIdEspecialidad,
		conIdEstado,
		detIdEstado,
		conIdDuracion,
		detIdDuracion,		
		centro_cenIdCentro
		from ".self::$tablename." where medIdMedico=$id";
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::one($query[0],new SPMedico());
	}
	
	public static function getInfoByIdSec($id){
		$sql = "select 
		medIdMedico,
		medApellidos,
		medNombres,
		conIdTipoIdentificacion,
		detIdTipoIdentificacion,
		medIdentificacion,
		conIdEspecialidad,
		detIdEspecialidad,
		conIdEstado,
		detIdEstado,
		conIdDuracion,
		detIdDuracion,		
		centro_cenIdCentro
		from ".self::$tablename." where medIdMedico=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPMedico());
	}
	
	public static function getById($id){
		$sql = "select 
		medIdMedico,
		medApellidos,
		medNombres,
		conIdTipoIdentificacion,
		detIdTipoIdentificacion,
		medIdentificacion,
		conIdEspecialidad,
		detIdEspecialidad,
		conIdEstado,
		detIdEstado,
		conIdDuracion,
		detIdDuracion,		
		centro_cenIdCentro
		from ".self::$tablename." where medIdentificacion='$id'";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPMedico());
	}

	public static function getByCentro($id){
		$sql = "select * from ".self::$tablename." m where m.centro_cenIdCentro = $id
		and m.centro_cenIdCentro = (select c.cenIdCentro from centro c where c.cenIdCentro = m.centro_cenIdCentro )";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPMedico());
	}
		
	public static function getByDesc($q){
		$sql = "select * from ".self::$tablename." where medApellidos='$q'";
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::one($query[0],new SPMedico());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by medIdMedico asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPMedico());
	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where medApellidos like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPMedico());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::one($query[0],new SPMedico());
	}
	
	public function update($id)
	{
		//echo "upd"; echo $id;
		$sql = "update ".self::$tablename." set ";
		$sql .= " medApellidos=UPPER('$this->medApellidos'),
				medNombres=UPPER('$this->medNombres'),
				detIdTipoIdentificacion=$this->detIdTipoIdentificacion,
				medIdentificacion='$this->medIdentificacion',
				detIdEspecialidad=$this->detIdEspecialidad,
				detIdEstado=$this->detIdEstado,
				detIdDuracion=$this->detIdDuracion
				where medIdMedico=$id";	
		//echo $sql;
		Executor::doit($sql);
	}

}

?>