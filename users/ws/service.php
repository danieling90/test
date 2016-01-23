<?php
require("../clases/userController.php");
$server = new SoapServer(null, array('uri' => 'urn:webservices'));
 
// Asignamos la Clase
$server->setClass('user_controller');
 
// Atendemos las peticiones
$server->handle();

?>