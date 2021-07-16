<?php
class SPBasica {
	public static $tablename = "paciente";

	public function SPBasica(){
		$this->pacIdPaciente=0;
		$this->pacApellidos='';
		$this->pacNombres='';
		$this->conIdTipoIdentificacion=4;
		$this->detIdTipoIdentificacion=0;
		$this->pacIdentificacion='';
		$this->conIdGenero=7;
		$this->detIdGenero=0;
		$this->conIdEstadoCivil=8;
		$this->detIdEstadoCivil=0;
		$this->pacFechaNacimiento=null;
		$this->conIdProvincia=21;
		$this->detIdProvincia=0;
		$this->conIdCanton=22;
		$this->detIdCanton=0;
		$this->conIdParroquia=22;
		$this->detIdParroquia=0;
		$this->conIdAseguradora=9;
		$this->detIdAseguradora=0;
		$this->conIdOcupacion=10;
		$this->detIdOcupacion=0;
		$this->pacContacto='';
	}
	
	public function add(){
		$sql = "insert into ".self::$tablename." (
		pacApellidos,
		pacNombres,
		conIdTipoIdentificacion,
		detIdTipoIdentificacion,
		pacIdentificacion,
		conIdGenero,
		detIdGenero,
		conIdEstadoCivil,
		detIdEstadoCivil,
		pacFechaNacimiento,
		conIdProvincia,
		detIdProvincia,
		conIdCanton,
		detIdCanton,
		conIdParroquia,
		detIdParroquia,
		conIdAseguradora,
		detIdAseguradora,
		conIdOcupacion,
		detIdOcupacion,
		pacContacto		
		) ";
		$sql .= "values (
		UPPER(\"$this->pacApellidos\"),
		UPPER(\"$this->pacNombres\"),
		$this->conIdTipoIdentificacion,
		$this->detIdTipoIdentificacion,
		UPPER(\"$this->pacIdentificacion\"),
		$this->conIdGenero,
		$this->detIdGenero,
		$this->conIdEstadoCivil,
		$this->detIdEstadoCivil,
		\"$this->pacFechaNacimiento\",
		$this->conIdProvincia,
		$this->detIdProvincia,
		$this->conIdCanton,
		$this->detIdCanton,
		$this->conIdParroquia,
		$this->detIdParroquia,
		$this->conIdAseguradora,
		$this->detIdAseguradora,
		$this->conIdOcupacion,
		$this->detIdOcupacion,
		UPPER(\"$this->pacContacto\"))";
		//now(),
		//echo $sql;
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where pacIdPaciente=$id";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function getByIdSec($id){
		$sql = "select 
		pacIdPaciente,
		pacApellidos,
		pacNombres,
		conIdTipoIdentificacion,
		detIdTipoIdentificacion,
		pacIdentificacion,
		conIdGenero,
		detIdGenero,
		conIdEstadoCivil,
		detIdEstadoCivil,
		pacFechaNacimiento,
		conIdProvincia,
		detIdProvincia,
		conIdCanton,
		detIdCanton,
		conIdParroquia,
		detIdParroquia,
		conIdAseguradora,
		detIdAseguradora,
		conIdOcupacion,
		detIdOcupacion,
		pacContacto,
		year(now())-year(pacFechaNacimiento) edad,
		date_format(now(), '%d/%m/%Y') hoy
		from ".self::$tablename." where pacIdPaciente=$id";
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::one($query[0],new SPBasica());
	}
	
	public static function getInfoByIdSec($id){
		$sql = "select 
		pacIdPaciente,
		pacApellidos,
		pacNombres,
		conIdTipoIdentificacion,
		detIdTipoIdentificacion,
		pacIdentificacion,
		conIdGenero,
		detIdGenero,
		conIdEstadoCivil,
		detIdEstadoCivil,
		pacFechaNacimiento,
		conIdProvincia,
		detIdProvincia,
		conIdCanton,
		detIdCanton,
		conIdParroquia,
		detIdParroquia,
		conIdAseguradora,
		detIdAseguradora,
		conIdOcupacion,
		detIdOcupacion,
		pacContacto,
		year(now())-year(pacFechaNacimiento) edad,
		date_format(now(), '%d/%m/%Y') hoy
		from ".self::$tablename." where pacIdPaciente=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPBasica());
	}
	
	public static function getById($id){
		$sql = "select 
		pacIdPaciente,
		pacApellidos,
		pacNombres,
		conIdTipoIdentificacion,
		detIdTipoIdentificacion,
		pacIdentificacion,
		conIdGenero,
		detIdGenero,
		conIdEstadoCivil,
		detIdEstadoCivil,
		pacFechaNacimiento,
		conIdProvincia,
		detIdProvincia,
		conIdCanton,
		detIdCanton,
		conIdParroquia,
		detIdParroquia,
		conIdAseguradora,
		detIdAseguradora,
		conIdOcupacion,
		detIdOcupacion,
		pacContacto,
		year(now())-year(pacFechaNacimiento) edad
		from ".self::$tablename." where pacIdentificacion='$id'";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SPBasica());
	}
	
	public static function getByDesc($q){
		$sql = "select * from ".self::$tablename." where pacApellidos='$q'";
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::one($query[0],new SPBasica());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by pacIdPaciente asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPBasica());
	}
	
	public static function getLike($q){
		$sql = "select 		
		pacIdPaciente,
		pacApellidos,
		pacNombres,
		conIdTipoIdentificacion,
		detIdTipoIdentificacion,
		pacIdentificacion,
		conIdGenero,
		detIdGenero,
		conIdEstadoCivil,
		detIdEstadoCivil,
		pacFechaNacimiento,
		conIdProvincia,
		detIdProvincia,
		conIdCanton,
		detIdCanton,
		conIdParroquia,
		detIdParroquia,
		conIdAseguradora,
		detIdAseguradora,
		conIdOcupacion,
		detIdOcupacion,
		pacContacto,
		year(now())-year(pacFechaNacimiento) edad from ".self::$tablename." where pacApellidos like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SPBasica());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		//echo $sql;
		return Model::one($query[0],new SPBasica());
	}
	
	public function updatecompleto()
	{
		$sql = "update ".self::$tablename.
		" set	pacApellidos=UPPER('$this->pacApellidos'),
				pacNombres=UPPER('$this->pacNombres'),
				detIdTipoIdentificacion=$this->detIdTipoIdentificacion,
				pacIdentificacion='$this->pacIdentificacion',
				detIdGenero=$this->detIdGenero,
				detIdEstadoCivil=$this->detIdEstadoCivil,
				pacFechaNacimiento=\"$this->pacFechaNacimiento\",
				detIdProvincia=$this->detIdProvincia,
				detIdCanton=$this->detIdCanton,
				detIdParroquia=$this->detIdCanton,
				detIdAseguradora=$this->detIdAseguradora,
				detIdOcupacion=$this->detIdOcupacion,
				pacContacto=UPPER('$this->pacContacto')
				where pacIdPaciente=$this->pacIdPaciente";
			
		//echo $sql;
		Executor::doit($sql);
	}

}

?>