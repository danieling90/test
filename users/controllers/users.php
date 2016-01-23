<?php
// Llamar al método como si fuera del cliente
$cliente = new SoapClient(null, array('location' => 'http://localhost/users/ws/service.php','uri' => 'urn:webservices', ));

if ($_POST["option"] == "insert"){
	echo $cliente->insert($_POST);
}else if ($_POST["option"] == "list"){
	echo $cliente->listUser();
}else if ($_POST["option"] == "delete"){   
	echo $cliente->delete($_POST);
}else if($_POST["option"] == "select"){
	echo $cliente->select($_POST);
}else if($_POST["option"] == "update"){
	echo $cliente->update($_POST);
}

?>