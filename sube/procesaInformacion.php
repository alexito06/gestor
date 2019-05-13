<?php
require_once("../common/classGestor.php");

$datosGestor= new gestor();

#################################################################################

if(isset($_POST['task']) && $_POST['task']=='getEnviarArchivo'){

	$json = $datosGestor->getEnviarArchivo($_POST);
	die (json_encode($json));

}

if(isset($_POST['task']) && $_POST['task']=='getleerArchivo'){

	$json = $datosGestor->getleerArchivo($_POST);
	die (json_encode($json));

}

?>