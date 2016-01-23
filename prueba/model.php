<?php

class user_model{

	public function loadHabitacion(){

		$sql = "
		SELECT  id,
		descripcion 
		from \"Habitacion\"";
		return $sql;
	}

	public function cargarAcomodaciones($data){
		$id = $data['idHabitacion'];
		$sql = "
		Select b.id,
		b.descripcion
		from \"Habitacion_acomodacion\" a
		inner join \"Acomodacion\" b on a.id_acomodacion = b.id
		where a.id_habitacion =".$id;
		return $sql;
	}

	
	
	public function insert( $data){

		$name = $data['name'];
		$phone = $data['phone'];
		$address = $data['address'];
		$habitacion = $data['habitacion'];
		$acomodacion = $data['acomodacion'];
		$sql = "
		INSERT INTO \"Hotel\"
		(nombre,telefono,direccion,id_acomodacion,id_habitacion)
		VALUES
		('".$name."',".$phone.",'".$address."',".$habitacion.",".$acomodacion.")"; 
		return $sql;

	}
	
	public function listhotel(){

		$sql = "SELECT 
		a.id,
		a.nombre, 
		a.telefono,
		a.direccion,
		b.descripcion as habitacion,
		c.descripcion as acomodacion
		from \"Hotel\" a
		inner join \"Habitacion\" b on a.id_habitacion = b.id
		inner join \"Acomodacion\" c on a.id_acomodacion = c.id";
		return $sql;
	}
	
	public function deleteHotel($data){ 	
		$id = $data['idHotel'];
		$sql = "
		DELETE FROM \"Hotel\"
		WHERE id = ".$id;  
		return $sql;
	}
	
	public function selectHotel($data){ 	 
		$id = $data['idHotel'];
		$sql = "SELECT id, nombre, telefono, direccion,id_habitacion,id_acomodacion from \"Hotel\"
		where id = ".$id; 
		return $sql;
	}
	public function updateHotel($data){ 
		$id = $data['idHotel'];
		$name = $data['name'];
		$phone = $data['phone'];
		$address = $data['address'];
		$idHabitacion = $data['habitacion'];
		$idAcomodacion = $data['acomodacion'];
		$sql = "UPDATE \"Hotel\"
		SET nombre='".$name."',
		telefono= ".$phone.",
		direccion = '".$address."',
		id_habitacion =".$idHabitacion.",
		id_acomodacion =".$idAcomodacion."
		WHERE id=".$id;
		return $sql;


	}


	
}

?>