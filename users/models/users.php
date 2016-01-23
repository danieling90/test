<?php

class user_model{

	public function insert( $data){

		$id = $data['id'];
		$name = $data['name'];
		$lastname = $data['lastname'];
		$sql = "
		INSERT INTO usuarios
		(cedula,nombre,apellido)
		VALUES
		(".$id.",'".$name."','".$lastname."')"; 
		return $sql;

	}

	public function listUsers(){

		$sql = "SELECT id_usuario,cedula, nombre,apellido from usuarios";
		return $sql;
	}

	public function deleteUsers ($data){ 	
		$id = $data['idUser'];
		$sql = "
		DELETE FROM usuarios
		WHERE id_usuario = ".$id;  
		return $sql;
	}
	
	public function select($data){ 	 
		$id = $data['idUser'];
		$sql = "SELECT id_usuario,cedula, nombre,apellido from usuarios
		where id_usuario = ".$id; 
		return $sql;
	}
	public function update( $data){ 
		$id = $data['idUser'];
		$ced = $data['id'];
		$name = $data['name'];
		$lastname = $data['lastname'];
		$sql = "UPDATE usuarios
		SET cedula=".$ced.",nombre= '".$name."',apellido = '".$lastname."'
		WHERE id_usuario=".$id;
		return $sql;


	}
}

?>