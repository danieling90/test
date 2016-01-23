<?php
require("conexion.php");
require("model.php");


$user_model = new user_model();
$conexion = new conexion();
$user = new hotel_controller($user_model, $conexion);

if ($_POST["option"] == "cargar"){
	$user->cargarHabitaciones();
}else if ($_POST["option"] == "insert"){
	$user->insert();
}else if ($_POST["option"] == "list"){
	$user->listhotel();
}else if ($_POST["option"] == "delete"){
	$user->delete();
}else if($_POST["option"] == "selectHotel"){
	$user->selectHotel();
}else if($_POST["option"] == "updateHotel"){
	$user->updateHotel();
}else if($_POST["option"] == "cargarAcomodaciones"){
	$user->cargarAcomodaciones();
}


class hotel_controller{

	private $return = [];	
	private $conexion = null;
	private $user_model = null;

	public function hotel_controller($user_model, $conexion){
		$this->conexion = $conexion;
		$this->user_model = $user_model;
	}


	public function cargarHabitaciones(){
		$sql = $this->user_model->loadHabitacion();
		$query = $this->conexion->query($sql, $this->conexion);
		

		while($row = pg_fetch_assoc($query)){
			echo "<option value='".$row['id']."' >".$row['descripcion']."</option>";
		}
				
	}

	public function cargarAcomodaciones(){
		$sql = $this->user_model->cargarAcomodaciones($_POST);
		$query = $this->conexion->query($sql, $this->conexion);
		

		while($row = pg_fetch_assoc($query)){
			echo "<option value='".$row['id']."' >".$row['descripcion']."</option>";
		}
				
	}
	
	public function insert(){		
		$return["error"] = false;
		$sql = $this->user_model->insert($_POST);
		$this->conexion->query($sql);
		echo json_encode($this->return);
	}
	
	
	public function listhotel(){		
		$data = [];
		$sql = $this->user_model->listhotel();
		$query = $this->conexion->query($sql);

		while($row = pg_fetch_assoc($query)){
			$data[] = $row;
		}
		echo json_encode($data);
	}
	
	public function delete(){		
		$return["error"] = false;
		try{
			
			$sql = $this->user_model->deleteHotel($_POST);			
			$this->conexion->query($sql);
			echo json_encode($this->return);
		}catch(Exception $e){
			$this->return["error"] = true;
			echo json_encode($this->return);
		}
		
	}
	
	public function selectHotel(){		
		$data = []; 
		$sql = $this->user_model->selectHotel($_POST); 
		$query = $this->conexion->query($sql);

		$data = pg_fetch_assoc($query);
		echo json_encode($data);
	}
	
	public function updateHotel(){		
		$return["error"] = false;
		$sql = $this->user_model->updateHotel($_POST);
		$this->conexion->query($sql);
		echo json_encode($this->return);
	}
	
	

	
}


?>