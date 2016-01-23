<?php

class conexion{
	private $conexion = null;

	public function conexion(){
		$this->conexion =  pg_connect("host=localhost port=5432 dbname=Hotel user=postgres password=123") or die('No pudo conectarse: ' . pg_last_error());
		if(!$this->conexion){
			die('No pudo conectarse: ' . pg_last_error());
		}
	}

	function query($sql){
		return pg_query($this->conexion, $sql);
	}
}
?>