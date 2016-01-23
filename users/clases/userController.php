<?php
require("../conexion.php");
require("../models/users.php");

class user_controller{

	private $return = [];	
	private $conexion = null;
	private $user_model = null;

	public function user_controller(){
		$this->conexion = new conexion();
		$this->user_model = new user_model();
	}


	public function insert($data){		
		$return["error"] = false;
		$sql = $this->user_model->insert($data);
		$this->conexion->query($sql);
		return json_encode($this->return);
	}

	public function listUser(){		
		$data = [];
		$sql = $this->user_model->listUsers();
		$query = $this->conexion->query($sql, $this->conexion);

		while($row = pg_fetch_assoc($query)){
			$data[] = $row;
		}
		return json_encode($data);
	}

	public function delete($data){		
		$return["error"] = false;
		try{
			$sql = $this->user_model->deleteUsers($data);			
			$this->conexion->query($sql, $this->conexion);
			return json_encode($this->return);
		}catch(Exception $e){
			$this->return["error"] = true;
			return json_encode($this->return);
		}
		
	}
	public function select($data){		
		$sql = $this->user_model->select($data); 
		$query = $this->conexion->query($sql, $this->conexion);

		$row = pg_fetch_assoc($query);
		return json_encode($row);
	}

	public function update($data){		
		$return["error"] = false;
		$sql = $this->user_model->update($data);
		$this->conexion->query($sql);
		return json_encode($this->return);
	}
}

?>